<?php 

	function categories_to_form($categories){
		$aCategories = array();

		$aCategories[0] = "Select an option";
		//array_push($aCategories, array('' => "Select an option"));

		
		foreach($categories as $category){
	
			//array_push($aCategories, array("$category->category_id" => "$category->name"));
			//array_push($aCategories, array("1" => "Category 1"));
			$aCategories[$category->category_id] = $category->name;
		}
	
		return $aCategories;
	}