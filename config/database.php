<?php

class database{

	private $host = 'localhost';
	private $dbname = 'codecrew';
	private $username = 'proba';
	private $password ='proba1234';  
	private $opt = array(
	      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	      );
	public $pdo = '';

	public function connect(){

      return $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username, $this->password,$this->opt);
	}

}

?>