<?php

class Console {
	static public function log($data) {
		\Profiler::console($data);
	}
}