<?php 
class Session{
	private $pdo;
	
public function __construct(database $conn){
	
	$this->con = $conn;
	$this->pdo = $this->con->connect();
	session_set_save_handler(
	array($this, "_open"),
	array($this, "_close"),
	array($this, "_read"),
	array($this, "_write"),
	array($this, "_destroy"),
	array($this, "_gc")
	
	
	);
	session_start();
	
	
	
	
	}
public function _open(){
	//provera da li je uspesna konekcija sa bazom
	if($this->pdo){
		//ako jeste true
		return true;
	}else{
		//u suprotnom false
		return false;
	}

}

public function _close(){
	$this->pdo = null;
	//provera da li je konekcija zatvorena
	if($this->pdo == null){
		//ako jeste true
		return true;
	}else{
		//u suprotnom false
		return false;
	}
}
	
public function _read($id){

	$stm = $this->pdo->prepare('SELECT data FROM sessions WHERE id = :id');
	$stm->bindParam(':id', $id);
	
	

	if($stm->execute()){

		$row = $stm->fetchAll();

		return $row['data'];

	}else{

		return '';
	}


}	
	
public function _write($id, $data){

$access = time();

$stm =$this->pdo->prepare('REPLACE INTO sessions VALUES ( :id, :access, :data) ');
$stm->bindParam(':id', $id);
$stm->bindParam(':access', $access);
$stm->bindParam(':data', $data);

if($stm->execute()){
	return true;
}else{
	return false;
}

}	
public function _destroy($id){

	$stm = $this->pdo->prepare('DELETE FROM sessions WHERE id = :id ');

	$stm->bindParam(':id', $id);

	if($stm->execute()){

		return true;
	}else{
		return false;
	}
}

public function _gc($max){

	$old = time() - $max;

	$stm = $this->pdo->prepare('DELETE * FROM sessions WHERE access < :old');

	$stm->bindParam(':old', $old);

	if($stm->execute()){

		return true;
	}else{
		return false;
	}


}
	
	
	
	
	
	
	
	
}

?>
