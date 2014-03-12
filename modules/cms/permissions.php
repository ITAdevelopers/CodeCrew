<?php
class Permission {
	private $conn;
	private $pdo;
	private $pass;
	private $login;
	private $crud;
	private $id;
	private $permission;
	private $user_permissions;
	private $article;
	private $role;




	public function __construct (database $conn, Security $security,Login $log, Crud $crud){
		$this->pass = $security;
		$this->conn = $conn;
		$this->pdo = $this->conn->connect();
		$this->login = $log;
		$this->crud = $crud;
		$this->article = $_GET['article'];
		$this->id = $_SESSION['id'];
	}

	public function check($user, $article){
		$user = $this->id;
		$article = $this->article;
		$this->permission = $this->crud->searchArticle($article);
		$this->user_permissions = $this->crud->searchUser($this->id);

		if ($this->permission[0]['permission'] == 1){			
			$this->role = $this->crud->searchResourcesByArticleAndRole($this->article,$this->user_permissions[0]['role_id']);
			if ($this->role)	{
				echo "ima zastitu i korisnik moze da koristi";
			}
			else{
				echo "ima zastitu i korisnik ne moze da koristi";
			}
		}
		else{
			echo "nema zastitu";
		}
	}
}

?>
