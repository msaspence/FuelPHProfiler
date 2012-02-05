<?php

class P {

	static public function m($text)
	{
		return \Profiler::mark($text);
	}

	static public function st($id,$text=null)
	{
		return \Profiler::start_timer($id,$text);
	}

	static public function spt($id)
	{
		return \Profiler::stop_timer($id);
	}

	static public function mm($object=false, $text = 'Memory usage')
	{
		return \Profiler::mark_memory($object, $text);
	}

	public static function c($text,$auto_open=false)
	{
		return \Profiler::console($text,$auto_open);
	}

	public static function l($type,$text,$time=null)
	{
		return \Profiler::log($type,$text,$time);
	}

	public static function s($dbname, $sql)
	{
		return \Profiler::start($dbname, $sql);
	}

	public static function sp($text=null)
	{
		return \Profiler::stop($text);
	}

	public static function i($text=null,$auto_open=true)
	{
		return \Profiler::inspect($text,$auto_open);
	}

}