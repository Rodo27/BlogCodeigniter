<?php
	function image_user_helper($user_id){
		$CI = & get_instance();

		$user = $CI->User->find($user_id);

		if(isset($user) && $user->avatar != ''){
			return base_url("files/user/$user->avatar");	
		}

		return base_url("assets/img/logo.jpeg");

	}