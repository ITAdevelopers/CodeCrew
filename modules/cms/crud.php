<?php

class Crud {
private $con;
private $pdo;
private $pass;

	/*U construct stavljam Database radi lakseg pozivanja kao i security zbog pretvaranja sifre*/
	public function __construct(Database $conn,Security $security){
		$this->con = $conn;
		$this->pdo = $this->con->connect();
		$this->pass = $security;
	}

	//Zbog Joina query-a definisem unapred
	protected $search_article = "SELECT articles.id,articles.page_id,pages.title,articles.content,articles.user_id,users.username,articles.created,articles.permission FROM articles 
								LEFT JOIN pages ON articles.page_id = pages.id
								LEFT JOIN users ON articles.user_id = users.id";

	protected $search_user = "SELECT users.id, users.username, users.password, users.role_id,roles.role, users.last_login,users.created FROM users
								LEFT JOIN roles ON users.role_id = roles.role";

	protected $search_resources = "SELECT resources.id, resources.article_id, resources.role_id FROM resources";

	/*Create deo
	jednostavni insert query-i*/
	public function addPage ($title) {
		$query = $this->pdo->prepare("INSERT INTO pages (id,title,created) VALUES (null,:title,NOW())");
		$query->execute(array(
		 	':title' => $title
		 ));
	}

	public function addArticle ($page_id,$content,$user_id) {
		$query = $this->pdo->prepare("INSERT INTO articles (id,page_id,content,user_id,created) VALUES (null,:page_id,:content,:user_id,NOW())" );
		$query->execute(array(
			':page_id' => $page_id,
			':content' => $content,
			':user_id' => $user_id
			));
	}

	public function addUser($username,$password,$role = 1){
		$pass = new Security;
		$query = $this->pdo->prepare ("INSERT INTO users (id,username,password,role_id,last_login,created) VALUES (null,:username, :password, :role, NOW(),NOW())");
		$query->execute(array(
			':username' => $username,
			':password' => $this->pass->salt_password($password),
			':role' => $role
			));
	}

	public function addRole ($role) {
		$query = $this->pdo->prepare("INSERT INTO roles (id,role) VALUES (null,:role)");
		$query->execute(array(
			':role' => $role
			));
	}

	public function addResources ($article,$role){
		$query = $this->pdo->prepare ("INSERT INTO resources (id,article_id,role_id) VALUES (null,:article, :role)");
		$query->execute(array(
			':article' => $article,
			':role' => $role
			));
	}

	//Delete deo
	/*Gde god je moguce stavljeno je, ako je broj da brise po ID-u, ako je tekst da brise po imenu*/
	public function deletePage($page){
		if (is_numeric($page)){
			$query = $this->pdo->prepare("DELETE FROM pages WHERE id=:id LIMIT 1");
			$query ->execute(array(
				":id" => $page
				));
		}
		else{
			$query =$this->pdo->prepare("DELETE FROM pages WHERE title=:title LIMIT 1");
			$query->execute(array(
				":title"=>$page
				));
		}
	}

	public function deleteArticle($article){
		$query = $this->pdo->prepare("DELETE FROM articles WHERE id=:id LIMIT 1");
		$query->execute(array(
			":id" => $article
			));	
	}


	public function deleteUser ($delete) {
		if (is_numeric($delete)){
			$query = $this->pdo->prepare ("DELETE FROM users WHERE id=:id LIMIT 1");
			$query->execute (array(
				":id" => $delete
				));
		}
		else {
			$query = $this->pdo->prepare ("DELETE FROM users WHERE username=:username LIMIT 1");
			$query->execute (array(
				":username" => $delete
				));
		}
	}

	public function deleteRole($role){
		if (is_numeric($role)){
			$query = $this->pdo->prepare ("DELETE FROM roles WHERE id=:id LIMIT 1");
			$query->execute(array(
				":id" => $role
				));
		}
		else {
			$query = $this->pdo->prepare ("DELETE FROM roles WHERE role=:role LIMIT 1");
			$query->execute(array(
				":role" => $role
				));
		}
	}

	public function deleteResources($id){
		$query = $this->pdo->prepare("DELETE FROM resources WHERE id=:id LIMIT 1");
		$query->execute(array(
			":id" => $id
			));
	}

	public function deleteResourcesByArticle($id){
		$query = $this->pdo->prepare("DELETE FROM resources WHERE article_id = :id");
		$query->execute(array(
			":id" => $id
			));
	}

	//Read deo
	public function searchPage($page){
		if(is_numeric($page)){
			$query = $this->pdo->prepare ("SELECT * FROM pages WHERE id=:id");
			$query->execute(array(
				":id" => $page
				));
		}
		else{
			$query = $this->pdo->prepare("SELECT * FROM pages WHERE title=:title");
			$query->execute(array(
				":title" => $page
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	//Pretraga po ID-u artikla

	//Pretraga strane, broj->id , tekst -> nazivu stranice
	public function searchArticle ($article){
			$query = $this->pdo->prepare($this->search_article . " WHERE articles.id=:id");
			$query->execute(array(
				":id" => $article
				));
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//Ako je broj pretraga po ID-u korisnika,ako je tekst po imenu korisnika
	public function searchArticleByUser ($user) {
		if (is_numeric($user)){
		$query = $this->pdo->prepare ($this->search_article . " WHERE articles.user_id=:id");
		$query->execute(array(
			":id" => $user
			));
		}
		else {
			$query = $this->pdo->prepare ($this->search_article . " WHERE users.username=:id");		
			$query->execute(array(
			":id" => $user
			));

		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//Pretraga po strani, ako je broj po ID-u,ako je tekst po imenu
	public function searchArticleByPage ($page) {
		if (is_numeric($page)){
		$query = $this->pdo->prepare ($this->search_article . " WHERE articles.page_id=:id");
		$query->execute(array(
			":id" => $page
			));
		}
		else {
			$query = $this->pdo->prepare ($this->search_article . " WHERE pages.title=:id");
			$query->execute(array(
			":id" => $page
			));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//Pretraga korisnika, broj ->Id-u, tekst po nazivu korisnika
	public function searchUser($user){
		if (is_numeric($user)){
			$query = $this->pdo->prepare ($this->search_user . " WHERE users.id = :id");
			$query->execute(array(
				":id" => $user
				));
		}
		else{
			$query = $this->pdo->prepare ($this->search_user . " WHERE users.username = :username");
			$query->execute(array(
				":username" => $user
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//pretraga korisnika po ulozi,ako je broj po ID-u uloge,ako je tekst po nazivu uloge.
	public function searchUserByRole($role){
		if (is_numeric($role)) {
			$query = $this->pdo->prepare ($this->search_user . " WHERE users.role_id = :role");
			$query->execute(array(
				":role" => $role
				));
		}
		else{
			$query = $this->pdo->prepare ($this->search_user . " WHERE roles.role = :role");
			$query->execute(array(
				":role" => $role
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//Pretraga uloge, broj-> po id-u, tekst po nazivu uloge.
	public function searchRole ($role){
		if(is_numeric($role)){
			$query = $this->pdo->prepare ("SELECT * FROM roles WHERE id=:id");
			$query->execute(array(
				":id" => $role
				));
		}
		else{
			$query = $this->pdo->prepare ("SELECT * FROM roles WHERE role=:role");
			$query->execute (array(
				":role" => $role
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function searchResources($id){
		$query = $this->pdo->prepare ($this->search_resources . " WHERE resources.id = :id");
		$query->execute(array(
			":id" => $id
			));
		return $query->fetchAll (PDO::FETCH_ASSOC);
	}

	public function searchResourcesByArticles ($id){
		$query = $this->pdo->prepare ($this->search_resources . " WHERE resources.article_id = :id");
		$query->execute(array(
			":id" => $id
			));
		return $query->fetchAll (PDO::FETCH_ASSOC);
	}

	public function searchResourcesByArticleAndRole ($id,$role){
		$query = $this->pdo->prepare ($this->search_resources . " WHERE article_id = :id AND role_id = :role");
		$query->execute(array(
			":id" => $id,
			":role" => $role
			));
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//Promena naziva uloge, ako je kao uslov postavljen broj,menja po njemu, u suprotnom menja po nazivu

	//Promena naziva strane, ako je broj onda po ID-u,u suprotnom po nazivu
	public function changePage ($what,$with){
		if(is_numeric($what)){
			$query = $this->pdo->prepare("UPDATE pages SET title = :with WHERE id = :what");
			$query->execute(array(
				":what" => $what,
				":with" => $with
				));
		}
		else{
			$query = $this->pdo->prepare("UPDATE pages SET title = :with WHERE title= :what LIMIT 1");
			$query ->execute(array(
				":what" => $what,
				":with" => $with
				));
		}
	}

	//Promena sadrzaja u Artiklu po ID-u
	public function changeArticleContent($what,$with){
		$query = $this->pdo->prepare ("UPDATE articles SET content = :with WHERE id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}
	//Promena ID stranice, po id-u artikla
	public function changeArticlePageId($what,$with){
		$query = $this->pdo->prepare ("UPDATE articles SET page_id = :with WHERE id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}
	//Promena korisnika koji je pisao artikal
	public function changeArticleUserId($what,$with){
		$query = $this->pdo->prepare ("UPDATE articles SET user_id = :with WHERE id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}

	//Promena korisnickog imena, ako je broj po ID-u, u suprotnom po username-u
	public function changeUsername ($what,$with){

		if(is_numeric($what)){
			$query = $this->pdo->prepare("UPDATE users SET username=:with WHERE id=:what");
			$query->execute(array(
				":with" => $with, 
				":what" => $what
				));
		}
		else{
			$query = $this->pdo->prepare ("UPDATE users SET username = :with WHERE username = :what LIMIT 1");
			$query->execute(array(
				":with" => $with,
				":what" => $what
				));
		}
	}
	//Promena sifre, ako je broj po ID-u, u suprotnom po username-u
	public function changePassword ($what,$with) {
		$pass = new Security;
		if (is_numeric($what)){
			$query = $this->pdo->prepare("UPDATE users SET password = :with WHERE id=:what LIMIT 1");
			$query->execute(array(
				":what" => $what,
				":with" => $this->pass->salt_password($with)
				));
		}
		else{
			$query = $this->pdo->prepare("UPDATE users SET password = :with WHERE username = :what LIMIT 1");
			$query->execute(array(
				":what" => $what,
				":with" =>$pass->salt_password($with)
				));
		}
	} 
	//Promena permissiona korisnika
	public function changeUserRole ($what,$with){
		if (is_numeric($what)){
			$query = $this->pdo->prepare ("UPDATE users SET role_id = :with WHERE id=:what LIMIT 1");
			$query->execute(array(
				":what" => $what,
				":with" => $with
			));
		}
		else{
			$query = $this->pdo->prepare("UPDATE users SET role_id = :with WHERE username = :what LIMIT 1");
			$query->execute (array(
				":what" => $what,
				":with" => $with
				));
		}
	}

	public function changeRole ($what, $with){
		if (is_numeric($what)){
			$query = $this->pdo->prepare ("UPDATE roles SET role= :with WHERE id=:what");

			$query->execute(array(
				":what" => $what,
				":with" => $with
				));
		}
		else{
			$query = $this->pdo->prepare ("UPDATE roles SET role=:with WHERE role=:what LIMIT 1");
			$query->execute(array(
				":what" => $what,
				":with" => $with
				));
		}
	}

	public function changeResourcesRole($what,$with){
		$query = $this->pdo->prepare ("UPDATE resources SET role_id = :with WHERE id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}
	
	public function list_pages()
	{
		$stm = $this->pdo->prepare('SELECT * FROM pages ORDER BY redosled ASC');
		$stm->execute();
		$pages = $stm->fetchAll();
		
		return $pages;
	}
}
?>