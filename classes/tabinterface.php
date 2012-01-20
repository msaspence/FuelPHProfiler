<?php

namespace FuelPHProfiler;

interface TabInterface {
	public function get_id();
	public function get_title();
	public function get_summary();
	public function output();
}