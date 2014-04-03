<?php 
class Pagination{
	private $crud;
	private $upit;
	private $pagenum;
	private $page_rows;

	public function __construct (Crud $crud){
		$this->crud = $crud;
	}
	public function paginate($page_rows){
		//Ako u linku nije ispisana strana, stavlja da je prva strana
		$this->pagenum =  (isset($_GET['page'])) ? $_GET['page']: 1;
		$counter = $this->pagenum;
		$uplimit = $this->pagenum + 2;
		$downlimit = $this->pagenum - 2;
		$this->page_rows = $page_rows;
		//Prebrojava koliko ima rezultata u tabeli
		$rows =$this->crud->count("users")[0];
		//Izracunavamo koliko stranica cemo imati (ukupan broj redova/broj redova po stranici)
		$last_page = ceil((float)$rows[0]/(float)$this->page_rows);
		//Ako je stranica stavljena u linku ispod 1, vraca je na prvu
		if ($this->pagenum < 1)
			$this->pagenum = 1;
		//Ako je stravljena veca stranica nego sto ih ima,vraca na poslednju
		elseif ($this->pagenum > $last_page)
			$this->pagenum = $last_page;
		//Ispisuje nam stranice i vracamo ih nazad sa returnom
			for($x=1; $x<=$last_page; $x++){
				$numbers[] = $x;
			
		}
		return $numbers;
	}

	public function fetch_results(){
		//Salje opet upit u bazu,ovaj put sa LIMIT fukcijom, da ispise tacno rezultatat koliko nam treba za datu stranu
		$this->upit = $this->crud->limitUsers (($this->pagenum-1)*$this->page_rows, $this->page_rows);
		//Vraca nam sve rezultate koje smo dobili, LIMIT-ovane, spremne za dalju obradu :)
		return $this->upit;
	}


}

?>