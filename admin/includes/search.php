<?php
	class Search{
		private $crud;
		private $val;

		public function __construct (Crud $crud, Validation $val){
			$this->crud = $crud;
			$this->val = $val;
		}
	//U $what postavljamo sa kojom tabelom cemo raditi
	public function searchByName($what){
			//Kada se pritisne Search button
			if (isset($_POST['search'])){
				//Provlacimo trazenu rec kroz filter, da budemo sigurni da su u pitanju samo slova i brojevi
				$search = $this->val->string_filter($_POST['search_input']);
				//u searchinput dodajemo rec search i $what i tako pozivamo i funkciju iz CRUD-u
				$searchinput = "search" . $what;
				//Useru dodajemo taj upit
				$user = $this->crud->$searchinput($search);
				//Ako nije prazan user,vraca nam vrednosti pretrage
				if (!empty($user))
					return $user[0][strtolower($what) . '_id'];
				//Ako jeste prazan,vraca nam gresku,da ne postoji takva vrednost
				else
					echo '<span class="notification n-error">Ne postojaca vrednost</span>';
			}
			//Action je stranica sa koje vrsimo pretragu
			$action = $_GET['action'];
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=".$action."'>";
			echo "<input type='text' name='search_input'>";
			echo "<input type='submit' name='search' value='Search' class='submit-green'>";
			echo "</form>";
			exit;
		}
	}
?>