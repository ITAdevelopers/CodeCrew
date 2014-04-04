<?php 
class Pagination{
	private $crud;
	private $upit;
	private $pagenum;
	private $page_rows;
	private $table;
	private $last_page;
	private $numbers= array();

	public function __construct (Crud $crud){
		$this->crud = $crud;
	}
	public function paginate($table, $page_rows){
		//Ako u linku nije ispisana strana, stavlja da je prva strana
		$this->pagenum = (isset($_GET['page'])) ? $_GET['page']: 1;
		$this->page_rows = $page_rows;
		$this->table = $table;
		//Prebrojava koliko ima rezultata u tabeli
		$rows =$this->crud->count($table)[0];
		//Izracunavamo koliko stranica cemo imati (ukupan broj redova/broj redova po stranici)
		$this->last_page = ceil((float)$rows[0]/(float)$this->page_rows);
		//Ako je stranica stavljena u linku ispod 1, vraca je na prvu
		if ($this->pagenum < 1 || !is_numeric($this->pagenum))
			header('Location: ../error.php');
		//Ako je stravljena veca stranica nego sto ih ima,vraca na poslednju
		elseif ($this->pagenum > $this->last_page)
			$this->pagenum = $this->last_page;
		//Ispisuje nam stranice i vracamo ih nazad sa returnom
			for($x=1; $x<=$this->last_page; $x++){
				$this->numbers[] = $x;
		}
		//Salje opet upit u bazu,ovaj put sa LIMIT fukcijom, da ispise tacno rezultatat koliko nam treba za datu stranu
		$this->upit = $this->crud->paginate ($this->table,($this->pagenum-1)*$this->page_rows, $this->page_rows);
		//Vraca nam sve rezultate koje smo dobili, LIMIT-ovane, spremne za dalju obradu :)
		return $this->upit;
	}
	//Kao vrednost prihvata action, koji je ustvari u URL-u 
	public function write_results($action){
		echo "<div class='pagination'>";
			//ako je stranica prva, nece pokazati first i previous page
			if ($this->pagenum > 1){
				echo "<a href='".$_SERVER['PHP_SELF']."?action={$action}&amp;page=1' class='button'><span><img src='img/arrow-stop-180-small.gif' height='9' width='12' alt='First'>First</span></a>";
				echo "<a href='".$_SERVER['PHP_SELF']."?action={$action}&amp;page=". ($this->pagenum-1) ."' class='button'><span><img src='img/arrow-180-small.gif' height='9' width='12' alt='Previous'>Previous</span></a>";
			}
			echo "<div class='numbers'>";
			echo "<span>Page:</span>";
			//Petlja za ispisivanje svih stranica, ako je trenutna sklanja hyperlink sa nje
				foreach ($this->numbers as $p){
					if ($p == $this->pagenum)
						echo "<span>$p</span><span>|</span>";
					else
						echo "<a href=".$_SERVER['PHP_SELF']."?action={$action}&page=$p>$p</a><span>|</span>";
				}
			echo "</div>";
			//Ako je poslednja stranica, ne postavlja link za next page i last page
			if ($this->pagenum <= ($this->last_page)-1){
				echo "<a href='".$_SERVER['PHP_SELF']."?action={$action}&amp;page=".($this->pagenum+1) ."' class='button'><span><src='img/arrow-000-small.gif' height='9' width='12' alt='Next'>Next</span></a>";
				echo '<a href class="button last"><span><img src="img/arrow-stop-180-small.gif" height="9" width="12" alt="First">Last</span></a>';
			}
			echo '<div style="clear: both;"></div>';
			echo "</div>";

	}
}

?>