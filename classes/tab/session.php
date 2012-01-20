<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Session extends Tab
{

	public $title = "Session";
	public $id = "session";
	public $template = "profiler_tabs/tree.php";

	public function get_data()
	{
		return array(
			'tree' => $this->get_session(),
			'overviews' => array(
				count($this->get_session(),COUNT_RECURSIVE)." Variable".(count($this->get_session(),COUNT_RECURSIVE) == 1 ? "" :"s"),
			)
		);

		return $return;
	}

	public function get_summary()
	{
		$session = $this->get_session();
		if (\Config::get('profiling.session_summary','username') === false) {
			return count($this->get_session())." Item".(count($this->get_session()) == 1 ? "" : "s");
		} else {
			if (isset($session[\Config::get('profiling.session_summary','username')])) {
				return $session[\Config::get('profiling.session_summary','username')];
			} else {
				return "anonymous";
			}
		}
	}

	public function get_session()
	{
		return \Session::get(null);
	}

}