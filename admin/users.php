<?php
	// Ukljucujemo podesavanja putanja
	require_once "../config/paths.php";

	require_once "includes/header.php";
	//Ukljucena podesavanja baze podataka
	require_once CONFIG_PATH . "database.php";
	//Security klassa sa metodima za ekripciju i zastitu skripte
	require_once CONFIG_PATH . "security.php";
	//Ukljucenje klase croud
	require_once MODULE_PATH . "cms/crud.php";
	//Kreiramo objekat Security
	$security = new Security();
	//Kreiramo objekat Database koji je zaduzen za konekciju
	$conn = new database();
	//Kreiranje objekta Crud namenjenog za rad sa bazom podataka
	$crud = new Crud($conn, $security);
	$num_of_users = $crud->count('users')[0][0];

	$action = (isset($_GET['action']))? $_GET['action'] : null;

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
				<a href="<?php echo "users.php?action=change"?>" class="dashboard-module">
	                <img src="img/Crystal_Clear_file.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
	                <span>Change User</span>
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
	            		echo "<table>";
	            			echo "<tr><th>User Id</th><th>Username</th><th>Role</th><th>Last_Login</th><th>Account Created</th><th>Actions</th></tr>";
	            				for ($i=1; $i<=$num_of_users; $i++){
	            					$user = $crud->searchUser($i)[0];
	            					echo "<tr><td>" . $user['user_id'] . "</td>";
	            					echo "<td>" . $user['username'] . "</td>";
	            					echo "<td>" . $user['role'] . "</td>";
	            					echo "<td>" . $user['last_login'] . "</td>";
	            					echo "<td>" . $user['created'] . "</td>";
	            					//echo "<td><a href='users.php?'><img src='img/pencil.gif' tppabs='http://www.xooom.pl/work/magicadmin/images/pencil.gif' width='16' height='16' alt='edit'>""</td></tr>";
	            				}
	          			echo "</table>";

	            	}

	            ?>
	       </div>
	</div>

<?php
	require_once "includes/footer.php";
?>

<img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit">