<?php
    
	// Ukljucujemo podesavanja putanja
	require_once "../config/paths.php";
    
    //Klasa sessions namenjena za smestanje sesije u bazu podataka
    require_once CONFIG_PATH . "sessions.php";

    //Klasa sessions namenjena za smestanje sesije u bazu podataka
require_once CONFIG_PATH . "sessions.php";

//Klasa secure data namenjena za kriptovanje sesije
require_once CONFIG_PATH . "secure_data.php";//Klasa secure data namenjena za kriptovanje sesije
    require_once CONFIG_PATH . "secure_data.php";

	require_once "includes/header.php";
	//Ukljucena podesavanja baze podataka
	require_once CONFIG_PATH . "database.php";
	//Security klassa sa metodima za ekripciju i zastitu skripte
	require_once CONFIG_PATH . "security.php";
	//Ukljucenje klase croud
	require_once MODULE_PATH . "cms/crud.php";
    require CONFIG_PATH . "/validation.php";

    require_once "includes/function_articles.php";
	//Kreiramo objekat Security
	$security = new Security();

    $validation = new Validation();
	//Kreiramo objekat Database koji je zaduzen za konekciju
	$conn = new database();
    $sessions = new Sessions($conn);
	//Kreiranje objekta Crud namenjenog za rad sa bazom podataka
	$crud = new Crud($conn, $security);
    
    

    //Kreiranje objekta Secure_data
    $secure_data = new Secure_data();
    $function = new Function_articles($crud, $validation, $secure_data);

   
	


    $action = (isset($_GET['action']))? $security->filter_input($_GET['action']) : '';
    $article_id = (isset($_GET['article_id']))? $security->filter_int($_GET['article_id']) : '';
    
   if($action == 'false'){
       echo $action;
       header("Location: error.php");
       exit();
   }
      if(isset($article_id) && $article_id == 'false'){
       
       header("Location: error.php");
       exit();
   }
   

    





?>

	<div class="container_12">
		<div class="grid_12">
				<a href="<?php echo "articles.php?action=list"?>" class="dashboard-module">
	                <img src="img/Crystal_Clear_file.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
	                <span>Lista artikala</span>
	            </a>

				<a href="<?php echo "articles.php?action=create"?>" class="dashboard-module">
	                <img src="img/Crystal_Clear_file.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
	                <span>Novi artikal</span>
	            </a>
				
			
	            <div style="clear: both"></div>
	        </div>
	        <div class="grid_12">

	            <?php
	            	if ($action == "list"){
	            		
                        $function->list_articles();

	            	}
                    elseif($action == "create"){
                        
                        $function->create_article();
                    }
                    elseif($action == 'changeperm' && isset($article_id)){

                    $function->change_permision_articles($article_id);
                    
                }
                elseif ($action == 'changepermstore' && isset($article_id)) {
                    
                    $function->update_permisions_table($article_id);
                    header('Location articles.php?action=changeperm&article_id='.$article_id);
                }
                elseif($action == 'store'){
                    $function->store_article();
                }
                elseif($action == 'edit' && isset($article_id)){
                    
                    $function->edit_article($article_id);
                    
                }
                elseif($action == 'editstore' && isset($article_id)){
                    
                    $function->edit_article_store($article_id);
                    
                }
                elseif($action == 'delete' && isset ($article_id)){
                    
                    $function->delete_article($article_id);
                }

	            ?>
	       </div>
	</div>

<?php
	require_once "includes/footer.php";
?>


