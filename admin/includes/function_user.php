<?php
	class Function_user{
		private $crud;
		private $val;
		private $paginate;

		public function __construct(Crud $crud, Validation $val, Pagination $paginate){
			$this->crud = $crud;
			$this->val = $val;
			$this->paginate = $paginate;
		}
		//Funkcija za izlistavanje svih korisnika
		public function listUsers(){
			echo "<div class='module'>";
			echo "<h2><span>List of all users</span></h2>";
            echo '<table id="myTable" class="tablesorter">';
                echo '<thead><tr>';
                	echo '<th width="5%">User Id</th><th width="30%">Username</th><th width="5%">Role</th><th width="15%">Last_Login</th><th width="15%">Account Created</th><th width="20%">Actions</th>';
                echo '</tr></thead><tbody>';
                $pages = $this->paginate->paginate(10);
                $users = $this->paginate->fetch_results();

               	foreach ($users as $user){
			         echo "<tr><td>" . $user['user_id'] . "</td>";
			         echo "<td>" . $user['username'] . "</td>";
			         echo "<td>" . $user['role'] . "</td>";
			         echo "<td>" . $user['last_login'] . "</td>";
			         echo "<td>" . $user['created'] . "</td>";
			         echo "<td><a href='users.php?action=edit&id=".$user['user_id']."'><img src='img/pencil.gif' alt='edit' title='Edit User'>";
			         echo "<a href='users.php?action=delete&id=".$user['user_id']."''><img src='img/minus-circle.gif' alt='delete' title='Delete User'></a></td></tr>";
			    }
			echo "</tbody></table></div>";
			
			foreach ($pages as $p){
				echo "<a href=".$_SERVER['PHP_SELF']."?action=list&page=$p id='pagination'>$p</a>";
			}
		}


		public function editUser($id){
			if(!isset($id)){
				$id = $this->search();
			}
			$num_of_roles = $this->crud->count('roles')[0][0];
			$user = $this->crud->searchUser($id)[0];
			if (isset($_POST['submit'])){
				$old_username = $user['username'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$password2 = $_POST['password2'];
				$old_role = $user['role'];
				$role = $_POST['role'];
				if ($user['username'] != $username){
					if ($this->val->isUserNameValid($username)){
						if (!($this->crud->searchUser($username))){
							$this->crud->changeUsername($id, $username);
							echo "<span class='notification n-success'>username is changed from $old_username to $username</span>";	
						}
						else{
							echo '<span class="notification n-error">Username already exists</span>';
						}
					}
					else {
						echo '<span class="notification n-error">Username not valid</span>';		
					}
				}
				if (!empty($password)){
					if ($password == $password2){
						if ($this->val->isPasswordValid($password)){
							$this->crud->changePassword($id, $password);
							echo "<span class='notification n-success'>Password has been changed</span>";
						}
						else {
							echo '<span class="notification n-error">Password is not valid</span>';
						}
					}
					else {
						echo '<span class="notification n-error">Password must be same</span>';	
					}
				}
				if ($user['role_id'] != $role){
					$this->crud->changeUserRole($id, $role);
					echo "<span class='notification n-success'>Role had been changed from $old_role to ".$this->crud->searchRole($role)[0]['role']."</span>";	
					echo "Role had been changed from ".$old_role." to ".$this->crud->searchRole($role)[0]['role'];
				}
			}
			$username = (isset($username)) ? $username : $user['username'];
			$role = (isset($role))? $role : $user['role'];
			echo "<div class='module'>";
				echo "<h2><span>Form</span></h2>";         
	            echo '<div class="module-body">';
					echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=edit&id=".$id."'>";
						echo "<label for='id'>User id:</label>";
						echo "<input type='text' name='id' value='".$user['user_id']."' disabled></input><br>";
						echo "<label for'username'>Username: </label>";
						echo "<input type='text' name='username' value='$username'></input><br>";
						echo "<label for='password'>New password</label>";
						echo "<input type='password' name='password' value=''><br>";
						echo "<label for='rpassword2'>Retype password</label>";
						echo "<input type='password' name='password2' value=''></input><br>";
						echo "<label for='role'>Role</label>";
						echo "<select name='role'>";
							for ($i=1; $i<=$num_of_roles; $i++){
								$selected = "";
								$role1 = $this->crud->searchRole($i)[0];
								if ($role1['role'] == $role)
									$selected = "selected='selected'";
								echo "<option value='".$role1['role_id']."'$selected>".$role1['role']."</option>";
							}
						echo "</select><br>";
						echo "<input type='submit' name='submit' value='Submit' class='submit-green'>";
						echo "<input type='reset' name='Reset Data' class='submit-gray'>";
					echo "</form>";	
				echo "</div>";
			echo "</div>";

		}

		public function createUser(){
			$num_of_roles = $this->crud->count('roles')[0][0];
			$username = (isset($_POST['username']))? $_POST['username'] : "";
			$password =(isset($_POST['password']))? $_POST['password'] : "";
			$password1 =(isset($_POST['password1']))? $_POST['password1'] : "";
			$role =(isset($_POST['role']))? $_POST['role'] : "";
			if (isset($_POST['register'])){
				if($this->val->isUserNameValid($username)){
					if (!($this->crud->searchUser($username))){
						if ($password == $password1){
							if ($this->val->isPasswordValid($password)){
								$this->crud->addUser($username, $password, $role);
								$user = $this->crud->searchUser($username)[0];
								echo '<span class="notification n-success">Successfuly added user</span>';
								echo "<div class='module'>";
									echo "<h2><span>You have added user with this data:</span></h2>";
									echo '<div class="module-body">';
									echo "<strong>Id:</strong> ".$user['user_id']."<br>";
									echo "<strong>Username:</strong> ".$user['username']."<br>";
									echo "<strong>Role:</strong> ".$user['role']."<br>";
									echo "<strong>Date Created:</strong> ".$user['created'] . "<br>";
									echo "</div></div>";
								exit;
							}
							else{
								echo '<span class="notification n-error">Password is not valid</span>';	
							}
						}
						else {
							echo '<span class="notification n-error">Password must be same</span>';	
						}		
					}
					else{
						echo '<span class="notification n-error">Username already exists</span>';	
					}
				}
				else{
					echo '<span class="notification n-error">Username is not valid</span>';	
				}
			}
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=create'>";
				echo "<label for'username'>Username:</label>";
				echo "<input type='text' name='username' value='$username'><br>";
				echo "<label for='password'>Password</label>";
				echo "<input type='password' name='password'><br>";
				echo "<label for='password1'>Retype Password</label>";
				echo "<input type='password' name='password1'><br>";
				echo "<label for='role'>Select Role</label>";
				echo "<select name='role'>";
					for ($i=1; $i<=$num_of_roles; $i++){
						$selected = "";
						$role1 = $this->crud->searchRole($i)[0];
						if ($role1['role'] == $role)
							$selected = "selected='selected'";
						echo "<option value='".$role1['role_id']."'$selected>".$role1['role']."</option>";
					}
				echo "</select><br>";
				echo "<input type='submit' name='register' value='Create' class='submit-green'>";
			echo "</form>";


		}

		function delUser($id){
			if(!isset($id)){
					$id = $this->search();
					}
			$user = $this->crud->searchUser($id)[0];
			echo "<div class='module'>";
			if (isset($_POST['delete'])){
				$this->crud->deleteUser($id);
				echo "<h2><span>You have deleted this user:</span></h2><br>";
			}
			else {
				echo "<h2><span>Are you sure you want to delete this user?:</h2></span><br>";
			}
			echo '<div class="module-body">';
			echo "<strong>Id:</strong> ".$user['user_id']."<br>";
			echo "<strong>Username:</strong> ".$user['username']."<br>";
			echo "<strong>Role:</strong> ".$user['role']."<br>";
			echo "<strong>Last Login:</strong>".$user['last_login']."<br>";
			echo "<strong>Date Created:</strong> ".$user['created'] . "<br>";
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=delete&id=$id'>";
			echo "<input type='submit' name='delete' value='Delete' class='submit-green'>";
			echo "</form>";
			echo '</div></div>';

		}

	public function search(){
			if (isset($_POST['search'])){
				$username = $_POST['search_username'];
				$user = $this->crud->searchUser($username);
				if (!empty($user))
					return $user[0]['user_id'];
				else
					echo '<span class="notification n-error">Korisnik sa tim nadimkom ne postoji</span>';
			}
			$action = $_GET['action'];
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=".$action."'>";
			echo "<input type='text' name='search_username'>";
			echo "<input type='submit' name='search' value='Search' class='submit-green'>";
			echo "</form>";
			exit;
				
		}
	}

?>