<?php

Autoloader::add_classes(array(
	'FuelPHProfiler\\TabInterface'       => __DIR__.'/tabinterface.php',
	'FuelPHProfiler\\Tab'       => __DIR__.'/tab.php',
	'FuelPHProfiler\\Tab\\Info' => __DIR__.'/tab/info.php',
	'FuelPHProfiler\\Tab\\Console' => __DIR__.'/tab/console.php',
	'FuelPHProfiler\\Tab\\Speed' => __DIR__.'/tab/speed.php',
	'FuelPHProfiler\\Tab\\Query' => __DIR__.'/tab/query.php',
	'FuelPHProfiler\\Tab\\Memory' => __DIR__.'/tab/memory.php',
	'FuelPHProfiler\\Tab\\Files' => __DIR__.'/tab/files.php',
	'FuelPHProfiler\\Tab\\Config' => __DIR__.'/tab/config.php',
	'FuelPHProfiler\\Tab\\Session' => __DIR__.'/tab/session.php',
	'FuelPHProfiler\\Tab\\Request' => __DIR__.'/tab/request.php',
));

class Profiler {

	static public $logs = array();
	static public $combined_log = array();
	static public $timers = array();
	static public $timers_text = array();
	static public $queries = array();
	static public $query_time = 0;
	static public $query_count = 0;
	static public $query;

	static public $default_tabs = array(
		'FuelPHProfiler\Tab\Info',
		'FuelPHProfiler\Tab\Console',
		'FuelPHProfiler\Tab\Speed',
		'FuelPHProfiler\Tab\Query',
		'FuelPHProfiler\Tab\Memory',
		'FuelPHProfiler\Tab\Files',
		'FuelPHProfiler\Tab\Config',
		'FuelPHProfiler\Tab\Session',
		'FuelPHProfiler\Tab\Request',
	);
	static protected $tabs = array();

	static public function init()
	{
		foreach(\Config::get('profiling.tabs',array_reverse(static::$default_tabs)) as $tab) {
			static::add_tab($tab);
		}
	}

	static public function add_tab($tab)
	{
		if (!in_array($tab, \Config::get('profiling.disabled',array()))) {
			$tabI = new $tab();
			if (!($tabI instanceof FuelPHProfiler\TabInterface)) {
				throw new \Fuel\Core\FuelException("FuelPHProfiler tabs must implement FuelPHProfiler\TabInterface, {$tab} does not.");
			}
			if (!in_array($tabI->get_id(), array_keys(static::$tabs))) {
				static::$tabs[$tabI->get_id()] = $tabI;
			}
		}
	}

	static public function mark($text)
	{
		static::log('split',$text);
	}

	static public function start_timer($id,$text=null)
	{
		if (is_null($text)) {
			$text = $id;
		}
		static::$timers_text[$id] = $text;
		static::$timers[$id] = microtime(true);
		static::log('timer start',"Start: $text");
	}

	static public function stop_timer($id)
	{
		$start = static::$timers[$id];
		$log_item = array(
			"timer" => microtime(true)-$start,
			"message" => "Stop: ".static::$timers_text[$id]
		);
		static::log('timer stop',$log_item);
	}

	static public function mark_memory($object=false, $text = 'Memory usage')
	{
		$memory = $object ? strlen(serialize($object)) : memory_get_usage();
		$log_item = array(
			"memory" => $memory,
			"message" => $text,
			"data_type" => gettype($object),
		);
		if (is_object($object)) {
			$log_item['class'] = get_class($object);
		}
		static::log('memory', $log_item);
	}

	static public function output()
	{
		if (isset(static::$tabs['speed'])) {
			static::$tabs['speed']->set_end_time(microtime(true));
		}
		if (isset(static::$tabs['memory'])) {
			static::$tabs['memory']->set_memory_peak_usage(memory_get_peak_usage());
		}
		$template = \Config::get('profiling.template', PKGPATH.'fuelphprofiler/views/profiler.php');
		$output = \View::forge($template,array('tabs'=>array_reverse(static::$tabs)));
		return $output;
	}

	public static function console($text)
	{
		static::log('console',$text);
	}

	public static function log($type,$text,$time=null)
	{
		if (is_null($time)) {
			$time = microtime(true)-FUEL_START_TIME;
		}

		$log_item = array(
			'time'=>$time,
			'type'=>$type,
			'message'=>$text,
		);

		if (is_array($text)) {
			$log_item = array_merge($log_item,$text);
		}

		static::$logs[$type][] = $log_item;
		static::$combined_log[] = $log_item;
	}

	public static function get_log($type)
	{
		return isset(static::$logs[$type]) ? static::$logs[$type] : array();
	}

	public static function get_combined_log()
	{
		return static::$combined_log;
	}

	public static function get_log_types()
	{
		return array_keys(static::$logs);
	}

	public static function get_log_counts()
	{
		$return = array();
		foreach(static::get_log_types() as $type) {
			$return[$type] = count(static::$logs[$type]);
		}
		return $return;
	}

	public static function app_total()
	{
		return array(
			microtime(true) - FUEL_START_TIME,
			memory_get_peak_usage() - FUEL_START_MEM
		);
	}

	public static function start($dbname, $sql)
	{
		static::$query = array(
			'sql' => \Security::htmlentities($sql),
			'time_ep' => microtime(true),
		);
		return true;
	}

	public static function stop($text=null)
	{
		array_push(static::$queries, static::$query);
		static::$query_count++;
		$time = (static::$query['time_ep'] - FUEL_START_TIME);
		$timer = (microtime(true) - static::$query['time_ep']);
		static::$query_time += $timer;
		$log_item = array(
			'message'=>static::$query['sql'],
			'timer'=>$timer,
		);
		static::log('query',$log_item, $time);
	}


	public static function get_query_count()
	{
		return static::$query_count;
	}

	public static function get_query_time()
	{
		return static::$query_time;
	}

	public static function get_queries()
	{
		return static::$queries;
	}

	public static function get_readable_file_size($size, $retstring = null) {

		$sizes = array('bytes', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

		if ($retstring === null) {
			$retstring = '%01.2f %s';
		}

		$lastsizestring = end($sizes);

		foreach ($sizes as $sizestring) {
			if ($size < 1024) {
				break;
			}
			if ($sizestring != $lastsizestring) {
				$size /= 1024;
			}
		}
		if ($sizestring == $sizes[0]) {
			$retstring = '%01d&nbsp;%s';
		}
		// Bytes aren't normally fractional

		return sprintf($retstring, $size, $sizestring);
	}

	public static function get_readable_time($time) {
		$time = $time*1000;
		$ret = $time;
		$formatter = 0;
		$formats = array('ms', 's', 'm');
		if($time >= 1000 && $time < 60000) {
			$formatter = 1;
			$ret = ($time / 1000);
		}
		if($time >= 60000) {
			$formatter = 2;
			$ret = ($time / 1000) / 60;
		}
		$ret = number_format($ret,0,'.','') . '&nbsp;' . $formats[$formatter];
		return $ret;
	}

}