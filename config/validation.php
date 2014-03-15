<?php

	class Validation 
	{
		  

	      //provera da li je  username sacinjen od slova i brojeva i da li mu je duzina izmedju 5 i 12 karaktera
	        public function isUserNameValid($password)
			    {
				    
				    $username = preg_match('/^[a-zA-Z0-9]{5,12}$/',$username);
				    return $username;
			    }

	      //provera da li je password sacinjen od slova i brojeva i da li mu je duzina izmedju 5 i 20 karaktera
			public function isPasswordValid($password)
			    {
			    	 
				    $password = preg_match('/^[a-zA-Z0-9]{5,20}$/',$password);
				    return $password;
			    }

			// Povera za validnost email-a ..., za sada ne treba 
			public function isEmailValid($email)
			    {
			    	 $EmailPattren = '/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])' .
            '(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i';

			    	 $IsEmailValid = preg_match($EmailPattren, $this->Email);
			    }


			    // funkcija sluzi da izbaci sve iz stringa sto nije slovo ili broj
	       	public function string_filter($var)
	            {
	                return (preg_replace('/[^a-zA-Z0-9]/','',$var));
	            }

	}