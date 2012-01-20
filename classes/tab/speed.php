<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Speed extends Tab
{

	public $title = "Speed";
	public $id = "speed";
	public $template = "profiler_tabs/log.php";

	public function get_data()
	{
		$return = array();
		return array(
			'log' => \Profiler::get_combined_log(),
			'overviews' => array(
				"Exec' time: ".\Profiler::get_readable_time($this->get_total_time()),
				"Max time: ".\Profiler::get_readable_time($this->get_time_allowed()),
			),
			'filter' => array('split','timer start','timer stop'),
		);

		return $return;
	}

	public function get_summary()
	{
		return \Profiler::get_readable_time($this->get_total_time());
	}

	public function set_end_time($time)
	{
		$this->end_time = $time;
	}

	public function get_end_time()
	{
		return $this->end_time;
	}

	public function get_total_time()
	{
		return $this->get_end_time() - FUEL_START_TIME;
	}

	public function get_time_allowed()
	{
		return ini_get("max_execution_time");
	}

}