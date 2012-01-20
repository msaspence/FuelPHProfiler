<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Info extends Tab
{

	public $title = "Info";
	public $id = "info";
	public $template = "profiler_tabs/info.php";

	public function phpinfo_array()
	{
		$info_arr = array();
		$info_lines = explode("\n", strip_tags($this->phpinfo(), "<tr><td><h2>"));
		$cat = "General";
		foreach($info_lines as $line)
		{
			// new cat?
			preg_match("~<h2>(.*)</h2>~", $line, $title) ? $cat = $title[1] : null;
			if(preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $line, $val))
			{
				$info_arr[$cat][$val[1]] = $val[2];
			}
			elseif(preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $line, $val))
			{
				$info_arr[$cat][$val[1]] = array("local" => $val[2], "master" => $val[3]);
			}
		}
		return $info_arr;
	}

	public function phpinfo()
	{
		ob_start();
		phpinfo();
		$phpinfo = ob_get_clean();
		$phpinfo = str_replace("/h1/", "h2", $phpinfo);
		return substr($phpinfo, strpos($phpinfo, "</table>")+8,strpos($phpinfo, "</body>"));
	}

	public function get_data()
	{
		$return = array();

		$return['app_info'] = array();
		if (defined('SITE_VERSION')) {
			$return['app_info']['site_version'] = SITE_VERSION;
		}
		if (defined('SITE_')) {
			$return['app_info']['site_version'] = SITE_VERSION;
		}
		$return['app_info']['env'] = \Fuel::$env;
		$return['app_info']['fuel_version'] = \Fuel::VERSION;

		$return['php_info'] = $this->phpinfo_array();

		return $return;
	}

	public function get_summary()
	{
		$return = \Fuel::VERSION;
		if (defined('SITE_VERSION')) {
			$return .= " : ".SITE_VERSION;
		}
		$return .= " : ".\Fuel::$env;
		return $return;
	}

	public function get_php_version()
	{
		return "PHP ".phpversion();
	}

	public function get_fuel_version()
	{
		return "FuelPHP ".\Fuel::VERSION;
	}

	public function get_app_version()
	{
		if (defined("APP_NAME")) {
			$return = APP_NAME;
		} else {
			$return = "App";
		}
		if (defined("APP_VERSION")) {
			$return .= " ".APP_VERSION;
		}
		return $return;
	}

	public function get_env()
	{
		return \Fuel::$env;
	}


}