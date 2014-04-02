<?php
	// Ukljucujemo podesavanja putanja
	require_once "../config/paths.php";
	require_once "includes/function_user.php";
	require_once "includes/header.php";
	//Ukljucena podesavanja baze podataka
	require_once CONFIG_PATH . "database.php";
	//Security klassa sa metodima za ekripciju i zastitu skripte
	require_once CONFIG_PATH . "security.php";
	//Ukljucenje klase croud
	require_once MODULE_PATH . "cms/crud.php";
	require_once CONFIG_PATH . "validation.php";
	//Kreiramo objekat Security
	$security = new Security();
	//Kreiramo objekat Database koji je zaduzen za konekciju
	$conn = new database();
	//Kreiranje objekta Crud namenjenog za rad sa bazom podataka
	$crud = new Crud($conn, $security);
	$val = new Validation();
	$action = (isset($_GET['action']))? $security->filter_input($_GET['action']) : null;
	$id = (isset($_GET['id']))? $security->filter_input($_GET['id']) : null;
	$function = new Function_user($crud,$val);
?>

	<div class="container_12">
		<div class="grid_12">
				<a href="<?php echo "users.php?action=list"?>" class="dashboard-module">
	                <img src="img/Crystal_Clear_file.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
	                <span>List all users</span>
	            </a>

				<a href="<?php echo "users.php?action=create"?>" class="dashboard-module">
	                <img src="img/Crystal_Clear_file.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
	                <span>Create User</span>
	            </a>
				<a href="<?php echo "users.php?action=edit"?>" class="dashboard-module">
	                <img src="img/Crystal_Clear_file.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
	                <span>Edit User</span>
	            </a>
				<a href="<?php echo "users.php?action=delete"?>" class="dashboard-module">
	                <img src="img/Crystal_Clear_file.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
	                <span>Delete User</span>
	            </a>
	            <div style="clear: both"></div>
	        </div>
	        <div class="grid_12">

	            <?php
	            	if ($action == "list"){
	            		$function->listUsers();
	            	}
	            	elseif ($action=="edit"){
	            		$function->editUser($id);
	            	}
	            	elseif ($action=="create"){
	            		$function->createUser();
	            	}
	            	elseif ($action=="delete"){
	            		$function->delUser($id);
	            	}
	            ?>
	       </div>
	</div>

<?php
	require_once "includes/footer.php";
?>