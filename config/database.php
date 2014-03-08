<?php

class database{

	private $host = 'mysql1001.mochahost.com';
	private $dbname = 'nemesis_codecrew';
	private $username = 'nemesis_code';
	private $password ='code1234';  
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