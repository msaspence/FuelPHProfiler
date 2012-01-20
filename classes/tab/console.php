<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Console extends Tab
{

	public $title = "Console";
	public $id = "console";
	public $template = "profiler_tabs/log.php";

	public function get_data()
	{
		return array(
			'log' => $this->get_combined_log(),
		);
	}

	public function get_summary()
	{
		return count(\Profiler::get_combined_log())." Message".(count(\Profiler::get_combined_log()) == 1 ? "" : "s");
	}

	public function get_combined_log()
	{
		return \Profiler::get_combined_log();
	}

}