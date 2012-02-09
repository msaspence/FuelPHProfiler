<?php

namespace FuelPHProfiler;

abstract class Tab implements TabInterface {

	public $icon = false;
	public $summary = false;

	public function get_title() {
		return $this->title;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_icon() {
		return $this->icon;
	}

	public function get_summary() {
		return $this->summary;
	}

	public function output()
	{
		$template = \Config::get('profiling.views.'.get_class($this),$this->get_template());

		if (($path = \Finder::search('views', $template)) === false) {
			throw new \FuelException('The requested view could not be found: '.\Fuel::clean_path($path));
		} else {
			return \View::forge($path,array_merge($this->get_data(),array('tab'=>$this)),false);
		}

	}

	function get_data()
	{
		return array();
	}

	function get_template()
	{
		return PKGPATH."fuelphprofiler/views/".$this->template;
	}

}