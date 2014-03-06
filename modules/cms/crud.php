<?php

require_once ("security.php");
require_once ("include/configuration.php");


class Crud {
private $pdo;

	public function __contruct(Database $conn){

		$this->con = $conn;
		$this->pdo = $$this->con->connect();
	}
	//$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
	protected $search_article = "SELECT articles.id,articles.page_id,pages.title,articles.content,articles.user_id,users.username,articles.created FROM articles 
								LEFT JOIN pages ON articles.page_id = pages.id
								LEFT JOIN users ON articles.user_id = users.id";

	protected $search_user = "SELECT users.id, users.username, users.password, users.role, roles.role, users.last_login,users.created FROM users
								LEFT JOIN roles ON users.role = roles.id";

	//Create deo
	public function addRole ($role) {
		$query = $this->pdo->prepare("INSERT INTO roles (id,role) VALUES (null,:role)");

		$query->execute(array(
			':role' => $role
			));
	}

	public function addPage ($title) {
		//$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		$query = $this->pdo->prepare("INSERT INTO pages (id,title,created) VALUES (null,:title,NOW())");

		$query->execute(array(
		 	':title' => $title
		 	));
	}

	public function addArticle ($page_id,$content,$user_id) {
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		$query = $pdo->prepare("INSERT INTO articles (id,page_id,content,user_id,created) VALUES (null,:page_id,:content,:user_id,NOW())" );

		$query->execute(array(
			':page_id' => $page_id,
			':content' => $content,
			':user_id' => $user_id
			));
	}

	public function addUser($username,$password,$role){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		$pass = new Security;

		$query = $pdo->prepare ("INSERT INTO users (id,username,password,role,last_login,created) VALUES (null,:username, :password, :role, NOW(),NOW())");

		$query->execute(array(
			':username' => $username,
			':password' => $pass->salt_password($password),
			':role' => $role
			));
	}

	//Delete deo

	public function deleteUser ($delete) {
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");

		if (is_numeric($delete)){
			$query = $pdo->prepare ("DELETE FROM users WHERE id=:id LIMIT 1");

			$query->execute (array(
				":id" => $delete
				));
		}
		else {
			$query = $pdo->prepare ("DELETE FROM users WHERE username=:username LIMIT 1");

			$query->execute (array(
				":username" => $delete
				));
		}
	}

	public function deleteRole($role){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");

		if (is_numeric($role)){
			$query = $pdo->prepare ("DELETE FROM roles WHERE id=:id LIMIT 1");

			$query->execute(array(
				":id" => $role
				));
		}
		else {
			$query = $pdo->prepare ("DELETE FROM roles WHERE role=:role LIMIT 1");

			$query->execute(array(
				":role" => $role
				));
		}
	}

	public function deletePage($page){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");

		if (is_numeric($page)){
			$query = $pdo->prepare("DELETE FROM pages WHERE id=:id LIMIT 1");

			$query ->execute(array(
				":id" => $page
				));
		}
		else{
			$query =$pdo->prepare("DELETE FROM pages WHERE title=:title");

			$query->execute(array(
				":title"=>$page
				));
		}

	}

	public function deleteArticle($article){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");

		$query = $pdo->prepare("DELETE FROM articles WHERE id=:id LIMIT 1");
		$query->execute(array(
			":id" => $article
			));
		
	}

	//Read deo


	public function searchArticle ($article){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		

		if (is_numeric($article)){
			$query = $pdo->prepare($this->search_article . " WHERE articles.id=:id");

			$query->execute(array(
				":id" => $article
				));
		}

		else { // treba jos
			$query = $pdo->prepare($this->search_article . " WHERE articles.content LIKE :content");

			$query->execute(array(
				":content" => "%".$article."%"
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function searchArticleByUser ($user) {
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		if (is_numeric($user)){
		$query = $pdo->prepare ($this->search_article . " WHERE articles.user_id=:id");
			

		$query->execute(array(
			":id" => $user
			));
		}
		else {
			$query = $pdo->prepare ($this->search_article . " WHERE users.username=:id");
			

		$query->execute(array(
			":id" => $user
			));

		}
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}
	public function searchArticleByPage ($page) {
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		if (is_numeric($page)){
		$query = $pdo->prepare ($this->search_article . " WHERE articles.page_id=:id");
			

		$query->execute(array(
			":id" => $page
			));
		}
		else {
			$query = $pdo->prepare ($this->search_article . " WHERE pages.title=:id");
			
		$query->execute(array(
			":id" => $page
			));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function searchUser($user){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		if (is_numeric($user)){
			$query = $pdo->prepare ($this->search_user . " WHERE users.id = :id");

			$query->execute(array(
				":id" => $user
				));
		}
		else{
			$query = $pdo->prepare ($this->search_user . " WHERE users.username = :username");

			$query->execute(array(
				":username" => $user
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function searchUserByRole($role){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");

		if (is_numeric($role)) {
			$query = $pdo->prepare ($this->search_user . " WHERE users.role = :role");

			$query->execute(array(
				":role" => $role
				));
		}
		else{
			$query = $pdo->prepare ($this->search_user . " WHERE roles.role = :role");

			$query->execute(array(
				":role" => $role
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function searchPage($page){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		if(is_numeric($page)){
			$query = $pdo->prepare ("SELECT * FROM pages WHERE id=:id");

			$query->execute(array(
				":id" => $page
				));
		}
		else{
			$query = $pdo->prepare("SELECT * FROM pages WHERE title=:title");

			$query->execute(array(
				":title" => $page
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function searchRole ($role){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		if(is_numeric($role)){
			$query = $pdo->prepare ("SELECT * FROM roles WHERE id=:id");

			$query->execute(array(
				":id" => $role
				));
		}
		else{
			$query = $pdo->prepare ("SELECT * FROM roles WHERE role=:role");

			$query->execute (array(
				":role" => $role
				));
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function changeRole ($what, $with){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		if (is_numeric($what)){
			$query = $pdo->prepare ("UPDATE roles SET role= :with WHERE id=:what");

			$query->execute(array(
				":what" => $what,
				":with" => $with
				));
		}
		else{
			$query = $pdo->prepare ("UPDATE roles SET role=:with WHERE role=:what LIMIT 1");

			$query->execute(array(
				":what" => $what,
				":with" => $with
				));
		}
	}

	public function changePage ($what,$with){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");

		if(is_numeric($what)){
			$query = $pdo->prepare("UPDATE pages SET title = :with WHERE id = :what");

			$query->execute(array(
				":what" => $what,
				":with" => $with
				));
		}
		else{
			$query = $pdo->prepare("UPDATE pages SET title = :with WHERE title= :what LIMIT 1");

			$query ->execute(array(
				":what" => $what,
				":with" => $with
				));
		}

	}

	public function changeUsername ($what,$with){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");

		if(is_numeric($what)){
			$query = $pdo->prepare("UPDATE users SET username=:with WHERE id=:what");

			$query->execute(array(
				":with" => $with, 
				":what" => $what
				));
		}
		else{
			$query = $pdo->prepare ("UPDATE users SET username = :with WHERE username = :what LIMIT 1");

			$query->execute(array(
				":with" => $with,
				":what" => $what
				));
		}
	}

	public function changePassword ($what,$with) {
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		$pass = new Security;
		if (is_numeric($what)){
			$query = $pdo->prepare("UPDATE users SET password = :with WHERE id=:what LIMIT 1");

			$query->execute(array(
				":what" => $what,
				":with" =>$pass->salt_password($with)
				));
		}
		else{
			$query = $pdo->prepare("UPDATE users SET password = :with WHERE username = :what LIMIT 1");

			$query->execute(array(
				":what" => $what,
				":with" =>$pass->salt_password($with)
				));
		}
	} 

	public function changeArticleContent($what,$with){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		$query = $pdo->prepare ("UPDATE articles SET content = :with WHERE id=:what");

		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}

	public function changeArticlePageId($what,$with){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		$query = $pdo->prepare ("UPDATE articles SET page_id = :with WHERE id=:what");

		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}

	public function changeArticleUserId($what,$with){
		$pdo = new PDO ("mysql:host=localhost;dbname=code_crew","root","php");
		$query = $pdo->prepare ("UPDATE articles SET user_id = :with WHERE id=:what");

		$query->execute(array(
			":with" => $with,
			":what" => $what
			));
	}



}

?>