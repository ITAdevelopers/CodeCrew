<?php
	// Ukljucujemo podesavanja putanja
	require_once "../config/paths.php";
	// Ukljucujemo funkcije za korisnika
	require_once "includes/function_user.php";
	//Ukljucujemo header stranice
	require_once "includes/header.php";
	//Ukljucena podesavanja baze podataka
	require_once CONFIG_PATH . "database.php";
	//Security klassa sa metodima za ekripciju i zastitu skripte
	require_once CONFIG_PATH . "security.php";
	//Ukljucenje klase croud
	require_once MODULE_PATH . "cms/crud.php";
	//Ukljucujemo validaciju
	require_once CONFIG_PATH . "validation.php";
	require_once MODULE_PATH . "cms/pagination.php";
	//Kreiramo objekat Security
	$security = new Security();
	//Kreiramo objekat Database koji je zaduzen za konekciju
	$conn = new database();
	//Kreiranje objekta Crud namenjenog za rad sa bazom podataka
	$crud = new Crud($conn, $security);
	//Kreiranje objekta Validacije
	$val = new Validation();
	//Kreiranje objekta paginacije
	$pagination = new Pagination ($crud);
	//Kreiranje objekta funkcije
	$function = new Function_user($crud,$val,$pagination);
	//Proveravamo da li je stavljena akcija u URL-u,ako nije,stavljamo joj vrednost null
	$action = (isset($_GET['action']))? $security->filter_input($_GET['action']) : null;
	//Proveravamo da li je stavljen ID
	$id = (isset($_GET['id']))? $security->filter_input($_GET['id']) : null;
	//CSS da oznaci na kojoj stranici se nalazimo
	$current = "style='text-decoration: underline;color:#0063be; font-weight:bold '";
?>
	<div class="container_12">
		<div class="grid_12">
				<a href="<?php echo "users.php?action=list"?>" class="dashboard-module" <?php if ($action == "list") echo $current?>>
	                <img src="img/Crystal_Clear_file.gif" width="64" height="64" alt="list" >
	                <span>List all users</span>
	            </a>
				<a href="<?php echo "users.php?action=create"?>" class="dashboard-module" <?php if ($action == "create") echo $current?>>
	                <img src="img/Crystal_Clear_file.gif"  width="64" height="64" alt="create" >
	                <span>Create User</span>
	            </a>
				<a href="<?php echo "users.php?action=edit"?>" class="dashboard-module" <?php if ($action == "edit") echo $current?>>
	                <img src="img/Crystal_Clear_file.gif"  width="64" height="64" alt="edit" >
	                <span>Edit User</span>
	            </a>
				<a href="<?php echo "users.php?action=delete"?>" class="dashboard-module" <?php if ($action == "delete") echo $current?>>
	                <img src="img/Crystal_Clear_file.gif"  width="64" height="64" alt="delete" >
	                <span>Delete User</span>
	            </a>
	            <div style="clear: both"></div>
	        </div>
	        <div class="grid_12" id="users">

	            <?php
	            //U zavisnosti sta se nalazi u URL-u, tu funkciju pozivamo
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
	//Pozivanje footera
	require_once "includes/footer.php";
?>