<?php 

class Security{


	public function salt_password($password){

		$salt = "CodeCrewTeamAlpha";
		$dodatak = "CeatedByAs";

		$new_pass = sha1($salt) . md5($password) . sha1($dodatak);

		return $new_pass;


	}

	public function filter_input($input){


	}

	
}
?>