<?php 

class Security{

/*
@ method salt pasword
@ uzima password koji mu je dat kao parametar i dodaje na njega salt i dodatak koji su takodje kriptovani
@ vraca novi password koji nije ni u jednoj poznatoj enkripciji

 */
	public function salt_password($password){

		$salt = "CodeCrewTeamAlpha";
		$dodatak = "CeatedByAs";

		$new_pass = sha1($salt) . md5($password) . sha1($dodatak);

		return $new_pass;


	}

	public function filter_input($input){
		if (preg_match('/^[a-zA-Z0-9]+$/', $input)){
			return trim($input);
		}
		else {
                    header('Location: ../error.php');
		}

	}
        public function filter_int($input){
            if (preg_match('/^[0-9]+$/', $input)){
			return trim($input);
		}
		else {
                    header('Location: ../error.php');
		}
        }


}
?>