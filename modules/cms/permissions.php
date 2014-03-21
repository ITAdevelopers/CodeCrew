<?php
class Permission {
	private $secure;
	private $crud;
	private $permission;
	private $id;
	private $user_permissions;
	private $article;
	private $role;




	public function __construct (Crud $crud, Secure_data $secure){
		$this->crud = $crud;
		$this->secure = $secure;
	}
	public function check($article, $permission){
		//Ako je dozvola 0, nema provera i svako moze otvoriti stranicu
		if ($permission == 0){}
		//ako je provera 1 i ako je postavljen ID u sesiji
		elseif ($permission == 1 && isset($_SESSION['ID'])){
			//id izvlacimo iz Sesije
			$this->id = $this->secure->readData('ID');
			//Ocitavamo koje pristupe ima korisnik pomocu id-a
			$this->user_permissions = $this->crud->searchUser($this->id);
			//Proveravamo da li u tabeli resources postoji kolona gde su ID i korisnik		
			@$this->role = $this->crud->searchResourcesByArticleAndRole($article,$this->user_permissions[0]['role_id']);
			//Ako postoji ijedna kolona, korisnika pustamo
			if ($this->role)	{}
			//ako ne postoji, vracamo ga na stranicu da se uloguje
			else{
				header ("location: unathorised.php");
				exit();
			}
		}
		//ako je dozvola za stranicu 1, a korisnik nije ulogovan (nema sesiju), vracamo ga na login stranu
		elseif($permission == 1 || !isset($_SESSION['ID'])){
			header ("location: unathorised.php");
			exit();
		}
	}
}

?>
