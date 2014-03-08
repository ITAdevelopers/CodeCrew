<?php 

// Ukljucujemo podesavanja putanja
require "config/paths.php";

//Ukljucena podesavanja baze podataka
require "config/database.php";

require 'modules/login/class_login.php';

//Security klassa sa metodima za ekripciju i zastitu skripte
require "config/security.php";

require "modules/cms/crud.php";

//Metode vezane za ucitavanje podataka iz baze podataka  vezane za CMS sistem
require "modules/cms/functions_cms.php";



//Kreiramo objekat Security
$security = new Security();

//Kreiramo objekat Database koji je zaduzen za konekciju
$conn = new database();
$login = new Login($conn);
$crud = new Crud($conn, $security);


//Kreiramo objekat Functions_cms i u konstruktor prosledjujemo konekciju sa bazom (PDO klassa)
$objekat = new Functions_cms($crud);

//Pozivam metod Functions_cms pages_get(), kao povrat dobijam niz koji sadrzi sve redove tabele pages...to nam je glavni meni
$stranice_menu = $objekat->pages_get();

//Inicijalizacija promenljive koja ce ucitavati sadrzaj za datu stranicu
$stranica = "";

//Ako ne postoji promenljiva $_GET['title'] uzimamo kao id stranice prvu stranicu 
if(!isset($_GET['title'])){
	$id = $stranice_menu['0']['id'];
	
	//Metod artical_get() povlaci arikal za pocetnu stranicu tj ako nije definisana stranica
	$stranica = $objekat->artikal_get($id);

	//U slucaju da postoji $_GET['title'] povuci ce zadnji arikal vezan za tu stranicu.
}else{
	$title = $_GET['title'];	
  $stranica = $objekat->artikal_get($title);
}

//Ukljucujemo themes/index.php koji je zaduzen za izgled....tj to nam je tema
require "themes/index.php";


?>

