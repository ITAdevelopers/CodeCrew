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
	array($this, "_gc"),
	
	
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
	//provera da li je konekcija zatvorena
	if($this->pdo->close()){
		//ako jeste true
		return true;
	}else{
		//u suprotnom false
		return false;
	}
}
	
public function _read($id){

	$this->pdo->query('SELECT data FROM sessions WHERE id = :id');
	$this->pdo->bind(':id', $id );

	if($this->pdo->execute()){

		$row = $this->pdo->single();

		return $row['data'];

	}else{

		return '';
	}


}	
	
public function _write($id, $data){

$access = time();

$this->pdo->query('REPLACE INTO sessions VALUES ( :id, :access, :data) ');
$this->pdo->bind(':id', $id);
$this->pdo->bind(':access', $access);
$this->pdo->bind(':data', $data);

if($this->pdo->execute()){
	return true;
}else{
	return false;
}

}	
public function _destroy($id){

	$this->pdo->query('DELETE FROM sessions WHERE id = :id ');

	$this->pdo->bind(':id', $id);

	if($this->pdo->execute()){

		return true;
	}else{
		return false;
	}
}

public function _gc($max){

	$old = time() - $max;

	$this->pdo->query('DELETE * FROM sessions WHERE access < :old');

	$this->pdo->bind(':old', $old);

	if($this->pdo->execute()){

		return true;
	}else{
		return false;
	}


}
	
	
	
	
	
	
	
	
}

?>
