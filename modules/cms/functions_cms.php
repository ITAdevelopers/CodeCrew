<?php
// Klasa funkcije cms
class Functions_cms{
private $conn;
private $pdo;
/* Kao promenljivu u konstruktor sam prosledio klasu Database i to je bukvalno kao da sam uradio
require config/database.php
$this->pdo = new Database()
sada konekciju mogu da koristim pozivom promenljive $this->pdo  */
	public function __construct(Database $conn){

		$this->con= $conn;

		$this->pdo = $this->con->connect();


	}
/* Method pages_get() sluzi da bi izlistali sve stranice koje imamo u bazi i to rastucim redosledom
ovaj metod vraca niz $stranice */
public function pages_get(){
	


	$stm = $this->pdo->prepare("SELECT * FROM pages");
	$stm->execute();

	$stranice = $stm->fetchAll();

	return $stranice;

}
/* Posto nam nije u cilju da se id stranice prikazuje zbog lepseg i citljivijeg url-a konvertujemo naziv stranice u id
kako bi mogli da pronadjemo sve artikle koji imaju potreban page_id  */
public function find_page($title){
	$stm = $this->pdo->prepare("SELECT id FROM pages WHERE title = ? LIMIT 1");
	$stm->execute(array($title));

	$niz = $stm->fetchAll();
	$id = $niz['0']['id'];

	return $this->artikal_get($id);
}
/* Ovaj metod se poziva iz metoda find_page() i pronalazi atiklal koji ima page_id isti kao id od stranice na kojoj smo
trenutno */
public function artikal_get($id){

	$stm = $this->pdo->prepare("SELECT * FROM articles INNER JOIN users ON articles.user_id = users.id WHERE articles.page_id = ?
		ORDER BY articles.id DESC LIMIT 1");
	$stm->execute(array($id));
	$artikal = $stm->fetchAll();

	return $artikal;

}
/*ukoliko kroz metodu get nije prosledjena ni jedna stranica ova funkcija ce vratiti artikal za pocetnu stranicu */
public function aricle_get($id){
	
	$stm = $this->pdo->prepare("SELECT * FROM articles WHERE page_id = ? ORDER BY order asc");
	$stm->execute(array($id));

	$artikli = $stm->fetchAll();

	return $artikli;
}





}