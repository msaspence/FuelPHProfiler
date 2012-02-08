<?php

namespace Fuel\Core;
use \Profiler as BaseProfiler;

class Profiler extends BaseProfiler {
	public static function __callStatic($name, $arguments)
	{
		call_user_func_array("parent::$name", $arguments);
	}
}