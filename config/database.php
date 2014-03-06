<?php

class database{

	private $host = 'localhost';
	private $dbname = 'code_crew';
	private $username = 'root';
	private $password ='';  
	private $opt = array(
	      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	      );
	public $con = '';



	public function connect(){


        $this->con = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username, $this->password,$this->opt);
	}

	}



?>