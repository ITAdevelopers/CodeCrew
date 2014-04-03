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
	protected $search_article = "SELECT articles.article_id,articles.page_id,pages.title,articles.content,articles.user_id,users.username,articles.created,articles.permission FROM articles 
								LEFT JOIN pages ON articles.page_id = pages.page_id
								LEFT JOIN users ON articles.user_id = users.user_id";

	protected $search_user = "SELECT users.user_id, users.username, users.password, users.role_id,roles.role, users.last_login,users.created FROM users
								LEFT JOIN roles ON users.role_id = roles.role_id";

	protected $search_resources = "SELECT resources.resource_id, resources.article_id,articles.content, resources.role_id, roles.role FROM resources
									LEFT JOIN articles ON resources.article_id = articles.article_id
									LEFT JOIN roles ON resources.role_id = roles.role_id";

	/*Create deo
	jednostavni insert query-i*/
	public function addPage ($title,$redosled) {
		$query = $this->pdo->prepare("INSERT INTO pages (page_id,title,created,redosled) VALUES (null,:title,NOW(),:redosled)");
		$query->execute(array(
		 	':title' => $title,
		 	":redosled" => $redosled
		 ));
	}

	public function addArticle ($page_id,$content,$user_id,$permission = 0) {
		$query = $this->pdo->prepare("INSERT INTO articles (article_id,page_id,content,user_id,created,permission) VALUES (null,:page_id,:content,:user_id,NOW(),:permission)");
		$query->execute(array(
			':page_id' => $page_id,
			':content' => $content,
			':user_id' => $user_id,
			':permission' => $permission
			));
	}

	public function addUser($username,$password,$role = 1){
		$pass = new Security;
		$query = $this->pdo->prepare ("INSERT INTO users (user_id,username,password,role_id,last_login,created) VALUES (null,:username, :password, :role, NOW(),NOW())");
		$query->execute(array(
			':username' => $username,
			':password' => $this->pass->salt_password($password),
			':role' => $role
			));
	}

	public function addRole ($role) {
		$query = $this->pdo->prepare("INSERT INTO roles (role_id,role) VALUES (null,:role)");
		$query->execute(array(
			':role' => $role
			));
	}

	public function addResource ($article,$role){
		$query = $this->pdo->prepare ("INSERT INTO resources (resource_id,article_id,role_id) VALUES (null,:article, :role)");
		$query->execute(array(
			':article' => $article,
			':role' => $role
			));
	}
	//dodavanje slidera, ako se stavio samo url, dodaje ime i na aktivnost stavlja 0, a ako se stavi ime i 1, stavlja da odma' bude aktivan
	public function addSlider ($url, $active = 0){
		$query = $this->pdo->prepare ("INSERT INTO slider (slider_id,url,active) VALUES (null,:url, :active)");
		$query->execute(array(
			":url" => $url,
			":active" => $active
			));
	}

	//Delete deo
	/*Gde god je moguce stavljeno je, ako je broj da brise po ID-u, ako je tekst da brise po imenu*/
	public function deletePage($page){
		if (is_numeric($page)){
			$query = $this->pdo->prepare("DELETE FROM pages WHERE page_id=:id LIMIT 1");
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
		$query = $this->pdo->prepare("DELETE FROM articles WHERE article_id=:id LIMIT 1");
		$query->execute(array(
			":id" => $article
			));	
	}


	public function deleteUser ($delete) {
		if (is_numeric($delete)){
			$query = $this->pdo->prepare ("DELETE FROM users WHERE user_id=:id LIMIT 1");
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
			$query = $this->pdo->prepare ("DELETE FROM roles WHERE role_id=:id LIMIT 1");
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
		$query = $this->pdo->prepare("DELETE FROM resources WHERE resource_id=:id LIMIT 1");
		$query->execute(array(
			":id" => $id
			));
	}
	//Brisanje permisiona po artiklu
	public function deleteResourcesByArticle($id){
		$query = $this->pdo->prepare("DELETE FROM resources WHERE article_id = :id");
		$query->execute(array(
			":id" => $id
			));
	}

	public function deleteSlider($id){
		$query = $this->pdo->prepare("DELETE FROM slider WHERE slider_id = :id LIMIT 1");
		$query->execute(array(
			":id" => $id
			));
	}

	//Read deo

	//Pretraga po ID-u artikla
	//Pretraga strane, broj->id , tekst -> nazivu stranice

	public function searchPage($page){
		if(is_numeric($page)){
			$query = $this->pdo->prepare ("SELECT * FROM pages WHERE page_id=:id");
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


	public function searchArticle ($article){
			$query = $this->pdo->prepare($this->search_article . " WHERE articles.article_id=:id");
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
			$query = $this->pdo->prepare ($this->search_user . " WHERE users.user_id = :id");
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
			$query = $this->pdo->prepare ("SELECT * FROM roles WHERE role_id=:id");
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
	//pretraga dozvola
	public function searchResources($id){
		$query = $this->pdo->prepare ($this->search_resources . " WHERE resources.resource_id = :id");
		$query->execute(array(
			":id" => $id
			));
		return $query->fetchAll (PDO::FETCH_ASSOC);
	}
	//pretraga dozvola po artiklu
	public function searchResourcesByArticle ($id){
		$query = $this->pdo->prepare ($this->search_resources . " WHERE resources.article_id = :id");
		$query->execute(array(
			":id" => $id
			));
		return $query->fetchAll (PDO::FETCH_ASSOC);
	}
	//pretraga dozvola po artiklu i ovlascenju
	public function searchResourcesByArticleAndRole ($id,$role){
		$query = $this->pdo->prepare ($this->search_resources . " WHERE resources.article_id = :id AND resources.role_id = :role");
		$query->execute(array(
			":id" => $id,
			":role" => $role
			));
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function searchSlider($id){
		$query = $this->pdo->prepare ("SELECT * FROM slider WHERE slider_id=:id");
		$query->execute(array(
			":id" => $id
			));
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//pretraga slika po aktivnosti
	public function searchSliderByActivity($active = 0){
		$query = $this->pdo->prepare("SELECT * FROM slider WHERE active=:active");
		$query->execute(array(
			":active" => $active
			));
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//Promena naziva uloge, ako je kao uslov postavljen broj,menja po njemu, u suprotnom menja po nazivu

	//Promena naziva strane, ako je broj onda po ID-u,u suprotnom po nazivu
	public function changePage ($what,$with){
		if(is_numeric($what)){
			$query = $this->pdo->prepare("UPDATE pages SET title = :with WHERE page_id = :what");
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
		$query = $this->pdo->prepare ("UPDATE articles SET content = :with WHERE article_id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}
	//Promena ID stranice, po id-u artikla
	public function changeArticlePageId($what,$with){
		$query = $this->pdo->prepare ("UPDATE articles SET page_id = :with WHERE article_id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}
	//Promena korisnika koji je pisao artikal
	public function changeArticleUserId($what,$with){
		$query = $this->pdo->prepare ("UPDATE articles SET user_id = :with WHERE article_id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}

	//Promena korisnickog imena, ako je broj po ID-u, u suprotnom po username-u
	public function changeUsername ($what,$with){

		if(is_numeric($what)){
			$query = $this->pdo->prepare("UPDATE users SET username=:with WHERE user_id=:what");
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
			$query = $this->pdo->prepare("UPDATE users SET password = :with WHERE user_id=:what LIMIT 1");
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
			$query = $this->pdo->prepare ("UPDATE users SET role_id = :with WHERE user_id=:what LIMIT 1");
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
	//promena dozvola
	public function changeRole ($what, $with){
		if (is_numeric($what)){
			$query = $this->pdo->prepare ("UPDATE roles SET role= :with WHERE role_id=:what");

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
	//promena dozvola u resorsima
	public function changeResourcesRole($what,$with){
		$query = $this->pdo->prepare ("UPDATE resources SET role_id = :with WHERE resource_id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}
	//promena url-a slidera
	public function changeSliderUrl ($what,$with){
		$query = $this->pdo->prepare("UPDATE slider SET url=:with WHERE slider_id=:what");
		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}
	//promena aktivnosti slidera,s'tim da ako se napise samo za koji ID, vraca 0, ako se stavi broj 1, stavlja kao aktivan
	public function changeSliderActivity($what,$with = 0){
		$query=$this->pdo->prepare("UPDATE slider SET active=:with WHERE slider_id=:what");
		$query->execute(array(
			":with" =>$with,
			":what" =>$what
			));
	}
	//Funkcije vezane za neke klase
	//Za paginaciju count i limit search
	public function count($table) {
		$query = $this->pdo->prepare ("SELECT COUNT(*) FROM $table");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_BOTH);
	}

	public function limitUsers ($start,$display){
		$query = $this->pdo->prepare ($this->search_user . " ORDER BY user_id LIMIT :start,:display");
		$query->bindParam (":start", $start, PDO::PARAM_INT);
		$query->bindParam (":display",$display,PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}


	public function listUsers(){
		$query = $this->pdo->prepare ($this->search_user . " ORDER BY user_id ASC");
		$query->execute();
		return $query->fetchAll();
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