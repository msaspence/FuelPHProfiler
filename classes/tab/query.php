<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Query extends Tab
{

	public $title = "Queries";
	public $id = "query";
	public $template = "profiler_tabs/log.php";

	public function get_data()
	{
		return array(
			'log' => \Profiler::get_log('query'),
			'overviews' => array(
				count($this->get_queries())." Quer".(count($this->get_queries()) == 1 ? "y" : "ies"  ),
				"Total time: ".\Profiler::get_readable_time($this->get_query_time()),
			),
			'filter' => array('query'),
		);
	}

	public function get_title()
	{
		return \Profiler::get_query_count()." Quer".(\Profiler::get_query_count() == 1 ? "y" : "ies");
	}

	public function get_summary()
	{
		return (string) \Profiler::get_readable_time(\Profiler::get_query_time());
	}

	public function get_queries()
	{
		return \Profiler::get_queries();
	}

	public function get_query_time()
	{
		return \Profiler::get_query_time();
	}

	public function get_guery_time()
	{
		return \Profiler::get_query_time();
	}
}