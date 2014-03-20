<?php 
  $mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $starttime = $mtime; 
// Ukljucujemo podesavanja putanja
require_once "config/paths.php";

//Ukljucena podesavanja baze podataka
require_once CONFIG_PATH . "database.php";
//Ukljucenje klase login
require_once MODULE_PATH . 'login/class_login.php';

//Security klassa sa metodima za ekripciju i zastitu skripte
require_once CONFIG_PATH . "security.php";
//Ukljucenje klase croud
require_once MODULE_PATH . "cms/crud.php";

//Metode vezane za ucitavanje podataka iz baze podataka  vezane za CMS sistem
require_once MODULE_PATH . "cms/functions_cms.php";

//Klasa sessions namenjena za smestanje sesije u bazu podataka
require_once CONFIG_PATH . "sessions.php";

//Klasa secure data namenjena za kriptovanje sesije
require_once CONFIG_PATH . "secure_data.php";

//klasa validacija namenjena za proveravanje podataka pri registraciji
require_once CONFIG_PATH . "validation.php";

//klasa registracija namenjena za registraciju novih korisnika.
require_once MODULE_PATH . "registration/registration.php";



//Kreiramo objekat Security
$security = new Security();

//Kreiramo objekat Database koji je zaduzen za konekciju
$conn = new database();

//Kreiranje objekta Login
$sessions = new Sessions($conn);

//Kreiranje objekta Secure_data
$secure_data = new Secure_data();

//Kreiranje objekta Login
$login = new Login($conn, $secure_data);

//Kreiranje objekta Crud namenjenog za rad sa bazom podataka
$crud = new Crud($conn, $security);
/*$val = new Validation();
$register = new registration($crud, $val);


$register->registerUser();

*/



//Kreiramo objekat Functions_cms i u konstruktor prosledjujemo konekciju sa bazom (PDO klassa)
$objekat = new Functions_cms($crud);


//Ako je promenljiva action = login uljucujemo je u index.php i stopiramo skriptu zato sto ostatak nije potreban.
$action = $security->filter_input($_GET['action']);
    if($action == 'login'){
        require_once THEMES_PATH ."login.php";
        exit();
            
    }
if($action == 'logout'){
    session_destroy();
    header('Location: index.php');
}



//Pozivam metod Functions_cms pages_get(), kao povrat dobijam niz koji sadrzi sve redove tabele pages...to nam je glavni meni
$stranice_menu = $objekat->pages_get();

//Inicijalizacija promenljive koja ce ucitavati sadrzaj za datu stranicu
$stranica = "";

//Ako ne postoji promenljiva $_GET['title'] uzimamo kao id stranice prvu stranicu 
if(!isset($_GET['title'])){
	$id = $stranice_menu['0']['page_id'];
	
	//Metod artical_get() povlaci arikal za pocetnu stranicu tj ako nije definisana stranica
	$stranica = $objekat->artikal_get($id);

	//U slucaju da postoji $_GET['title'] povuci ce zadnji arikal vezan za tu stranicu.
}else{
	$title_sec = $security->filter_input($_GET['title']);

if($title_sec == 'false'){
	header('Location: error.php');
	die();
}
	
  $stranica = $objekat->artikal_get($title_sec);
}

//Ukljucujemo themes/index.php koji je zaduzen za izgled....tj to nam je tema
require_once THEMES_PATH . "index.php";



?>
<br />
<?php
$mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $endtime = $mtime; 
   $totaltime = ($endtime - $starttime); 
   echo "This page was created in ".$totaltime." seconds"; 

?>

