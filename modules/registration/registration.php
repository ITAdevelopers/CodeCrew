<?php

	class registration
	{

		public function __construct(Crud $crud,Validation $validate)
            {

                $this->crud = $crud;
                $this->val = $validate;
                // podtke dobijene iz html formi filtriramo radi predostroznosti funkcijom trim
                $this->username = nemesis;//trim($_POST['username']);
                $this->password = proba123;//trim($_POST['password']);
               
                $this->errors = array();
            }



            /* funkcija za registraciju. 
               Prvo proverava da li je korisnik upisao nesto u polja forme , pa ako jeste proverava da li su unete vrednosti ispravne, onda proverava da li takav korisnik postoji u bazi i ako postoji obavestava ga o tome , a ako ne postoji upisuje ga u bazu kao novog korisnika .
               Nisam koristio htmlenteties iz razloga sto funkcija filter izbacuje sve iz stringa sto nije slovo ili broj , a mysqli_real_escape_string nema potrebe jer se koristi PDO konekcija*/

        public function registerUser(){

            if (isset($this->username) && isset($this->password)){
                if ($this->val->isUserNameValid($this->username) && $this->val->isPasswordValid($this->password)){
                    $rezultat = $this->crud->searchUser($this->username);
                    if (count($rezultat) > 0 ) {
                           $this->_errors[] = "Korisničko ime je zauzeto";
                       } else {
                          $this->crud->addUser($this->username,$this->password);
                       }
                   } else {
                    $this->_errors[] =  "Nepravilno unešene vrednosti!. Moraju biti slova ili brojevi i najmanje 5 karaktera.";
                   }

            } else {
                $this->_errors[] = "Polja ne mogu biti prazna!";
            }
        }

         /* Za ispis gresaka koristimo foreach petlju 
          
           foreach($error as $msg) {
            echo $msg;
           }
       
        */

    }