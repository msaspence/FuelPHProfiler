<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Request extends Tab
{

	public $title = "Request";
	public $id = "request";
	public $template = "profiler_tabs/tree.php";

	public function get_data()
	{
		return array(
			'tree' => $_REQUEST,
			'overviews' => array(
				count($_REQUEST,COUNT_RECURSIVE)." Variable".(count($_REQUEST,COUNT_RECURSIVE) == 1 ? "" :"s")
			)
		);

		return $return;
	}

	public function get_summary()
	{
		return count($_REQUEST,COUNT_RECURSIVE)." Item".(count($_REQUEST,COUNT_RECURSIVE) == 1 ? "" : "s");
	}

}