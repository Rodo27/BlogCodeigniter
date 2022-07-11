<?php 

	function categories_to_form($categories){
		$aCategories = array();

		foreach($categories as $category){
			$aCategories[$category->category_id] = $category->name;	
		}

		return $aCategories;
	}