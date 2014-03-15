<?php
// Klasa funkcije cms
class Functions_cms{
private $conn;
private $pdo;
/* Kao promenljivu u konstruktor sam prosledio klasu Database i to je bukvalno kao da sam uradio
require config/database.php
$this->pdo = new Database()
sada konekciju mogu da koristim pozivom promenljive $this->pdo  */
	public function __construct(Crud $crud){

		$this->crud= $crud;

		


	}
/* Method pages_get() sluzi da bi izlistali sve stranice koje imamo u bazi i to rastucim redosledom
ovaj metod vraca niz $stranice */
public function pages_get(){

	$stranice = $this->crud->list_pages();

	return $stranice;

}


/* Ovaj metod se poziva iz metoda find_page() i pronalazi atiklal koji ima page_id isti kao id od stranice na kojoj smo
trenutno */
public function artikal_get($title){

	$artikal = $this->crud->searchArticleByPage($title);

	return $artikal;

}
/*ukoliko kroz metodu get nije prosledjena ni jedna stranica ova funkcija ce vratiti artikal za pocetnu stranicu */






}