<?php

namespace FuelPHProfiler\Tab;

use FuelPHProfiler\Tab;

class Files extends Tab
{

	public $title = "Files";
	public $id = "files";
	public $template = "profiler_tabs/files.php";

	public function get_data()
	{

		if (!isset($this->data)) {
			$this->data = array();

			$files = $this->get_included_files();
			$file_list = array();
			$size = 0;
			$largest = 0;

			foreach($files as $key => $file) {
				$file_size = filesize($file);
				$file_list[] = array(
					'name' => $file,
					'size' => $file_size
				);
				$size += $file_size;
				if($file_size > $largest) $largest = $file_size;
			}

			$this->data['size'] = $size;
			$this->data['largest'] = $largest;
			$this->data['files'] = $file_list;
			$this->summary = count($file_list).": ".$size;
		}
		return $this->data;
	}

	public function get_summary()
	{
		$data = $this->get_data();
		return \Profiler::get_readable_file_size($data['size']);
	}

	public function get_included_files()
	{
		return get_included_files();
	}

	public function get_total_file_size()
	{
		$data = $this->get_data();
		return $data['size'];
	}

	public function get_title()
	{
		$data = $this->get_data();
		return count($data['files'])." Files";
	}

}