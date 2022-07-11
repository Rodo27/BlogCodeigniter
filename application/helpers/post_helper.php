<?php 

	function posted(){
		return array("" => "Select an option","1" => "Si", "0" => "No");
	}

	function clean_name($name){
		return convert_accented_characters(url_title($name, '-', TRUE));
	}

	function all_images(){
		$CI = & get_instance();
		$CI->load->helper('directory');

		$dir = "files/post";
		$files = directory_map($dir);
	
		return $files;
	}

