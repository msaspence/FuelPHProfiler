<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Config extends Tab
{

	public $title = "Config";
	public $id = "config";
	public $template = "profiler_tabs/tree.php";

	public function get_data()
	{
		return array(
			'tree' => \Config::$items,
			'overviews' => array(
				count(\Config::$items,COUNT_RECURSIVE)." Config item".(count(\Config::$items,COUNT_RECURSIVE) == 1 ? "" :"s")
			),
		);
	}

	public function get_summary()
	{
		return count(\Config::$items, COUNT_RECURSIVE)." Item".(count(\Config::$items,COUNT_RECURSIVE) == 1 ? "" : "s");
	}

}