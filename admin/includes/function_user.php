<?php
	class Function_user{
		private $crud;
		private $val;

		public function __construct(Crud $crud, Validation $val){
			$this->crud = $crud;
			$this->val = $val;
		}

		public function listUsers(){
			$num_of_users = $this->crud->count('users')[0][0];
			echo "<div class='module'>";
			echo "<h2><span>Sample table</span></h2>";
            echo '<table id="myTable" class="tablesorter">';
                echo '<thead><tr>';
                	echo '<th width="5%">User Id</th><th width="30%">Username</th><th width="5%">Role</th><th width="15%">Last_Login</th><th width="15%">Account Created</th><th width="20%">Actions</th>';
                echo '</tr></thead><tbody>';
			    for ($i=1; $i<=$num_of_users; $i++){
			         $user = $this->crud->searchUser($i)[0];
			         echo "<tr><td>" . $user['user_id'] . "</td>";
			         echo "<td>" . $user['username'] . "</td>";
			         echo "<td>" . $user['role'] . "</td>";
			         echo "<td>" . $user['last_login'] . "</td>";
			         echo "<td>" . $user['created'] . "</td>";
			         echo "<td><a href='users.php?action=edit&id=".$user['user_id']."'><img src='img/pencil.gif' alt='edit'>";
			         echo "<a href='users.php?action=delete&id=".$user['user_id']."''><img src='img/minus-circle.gif' alt='delete' /></a></td></tr>";
			    }
			echo "</tbody></table></div>";
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
					$this->crud->changeUsername($id, $username);
					echo "username is changed from ".$old_username." to ". $username;
					}
					else {
						echo "Username is not valid";
					}
				}
				if (!empty($password)){
					if ($password == $password2){
						if ($this->val->isPasswordValid($password)){
							$this->crud->changePassword($id, $password);
							echo "Password had been changed";
						}
						else {
							echo "Password is not valid";
						}
					}
					else {
						echo "Passwords must be same";
					}
				}
				if ($user['role_id'] != $role){
					$this->crud->changeUserRole($id, $role);
					echo "Role had been changed from ".$old_role." to ".$this->crud->searchRole($role)[0]['role'];
				}
			}
			$username = (isset($username)) ? $username : $user['username'];
			$role = (isset($role))? $role : $user['role'];
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=edit&id=".$id."'>";
				echo "<input type='text' name='id' value='".$user['user_id']."'></input><br>";
				echo "<input type='text' name='username' value='$username'></input><br>";
				echo "<input type='text' name='password' value=''></input><br>";
				echo "<input type='text' name='password2' value=''></input><br>";
				echo "<select name='role'>";
					for ($i=1; $i<=$num_of_roles; $i++){
						$selected = "";
						$role1 = $this->crud->searchRole($i)[0];
						if ($role1['role'] == $role)
							$selected = "selected='selected'";
						echo "<option value='".$role1['role_id']."'$selected>".$role1['role']."</option>";
					}
				echo "</select><br>";
				echo "<input type='submit' name='submit' value='Submit'>";
				echo "<input type='reset' name='Reset Data'>";
			echo "</form>";	
		}

		public function createUser(){
			$num_of_roles = $this->crud->count('roles')[0][0];
			$username = (isset($_POST['username']))? $_POST['username'] : "";
			$password =(isset($_POST['password']))? $_POST['password'] : "";
			$password1 =(isset($_POST['password1']))? $_POST['password1'] : "";
			$role =(isset($_POST['role']))? $_POST['role'] : "";
			if (isset($_POST['register'])){
				if($this->val->isUserNameValid($username)){
					if ($password == $password1){
						if ($this->val->isPasswordValid($password)){
							$this->crud->addUser($username, $password, $role);
							$user = $this->crud->searchUser($username)[0];
							echo "You have added user with this data:<br>";
							echo "id: ".$user['user_id']."<br>";
							echo "username: ".$user['username']."<br>";
							echo "Role: ".$user['role']."<br>";
							echo "Date Created: ".$user['created'];
							exit;
						}
						else{
							echo "Password is not valid";
						}
					}
					else {
						echo "Password's are not same";
					}		
				}
				else{
					echo "Username is not valid";
				}
			}
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=create'>";
				echo "<label for'username'>Username:</label>";
				echo "<input type='text' name='username' value='$username'><br>";
				echo "<label for='password'>Password</label>";
				echo "<input type='text' name='password'><br>";
				echo "<label for='password1'>Retype Password</label>";
				echo "<input type='text' name='password1'><br>";
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
				echo "<input type='submit' name='register' value='Create'>";
			echo "</form>";


		}

		function delUser($id){
			if(!isset($id)){
					$id = $this->search();
					}
			$user = $this->crud->searchUser($id)[0];
			if (isset($_POST['delete'])){
				$this->crud->deleteUser($id);

			}

			echo "Are you sure you want to delete this user? :<br>";
			echo "id: ".$user['user_id']."<br>";
			echo "username: ".$user['username']."<br>";
			echo "Role: ".$user['role']."<br>";
			echo "Date Created: ".$user['created'] . "<br>";
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=delete&id=$id'>";
			echo "<input type='submit' name='delete' value='Delete'>";
			echo "</form>";



		}

	public function search(){
			if (isset($_POST['search'])){
				$username = $_POST['search_username'];
				$user = $this->crud->searchUser($username);
				if (!empty($user))
					return $user[0]['user_id'];
				else
					echo "User ne postoji";

			}
			$action = $_GET['action'];
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."?action=".$action."'>";
			echo "<input type='text' name='search_username'>";
			echo "<input type='submit' name='search' value='Search'>";
			echo "</form>";
			exit;
				
		}
			
		


	}

?>