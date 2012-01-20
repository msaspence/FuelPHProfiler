<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Memory extends Tab
{

	public $title = "Memory";
	public $id = "memory";
	public $template = "profiler_tabs/log.php";

	public function get_data()
	{
		return array(
			'log' => \Profiler::get_log('memory'),
			'overviews' => array(
				"Peak usage: ".\Profiler::get_readable_file_size($this->get_memory_peak_usage()),
				"Max usage: ".intval($this->get_memory_limit())."&nbspMB",
			),
			'filter' => array('memory'),
		);
	}

	public function get_summary()
	{
		return \Profiler::get_readable_file_size(memory_get_peak_usage());
	}

	public function get_memory_peak_usage()
	{
		return $this->memory_peak_usage;
	}

	public function set_memory_peak_usage($memory)
	{
		$this->memory_peak_usage = $memory;
	}

	public function get_memory_limit()
	{
		return ini_get("memory_limit");
	}

}