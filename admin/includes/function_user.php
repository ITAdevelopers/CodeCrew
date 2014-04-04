<?php
	class Function_user{
		private $crud;
		private $val;
		private $paginate;
		private $search;

		public function __construct(Crud $crud, Validation $val, Pagination $paginate, Search $search){
			$this->crud = $crud;
			$this->val = $val;
			$this->paginate = $paginate;
			$this->search = $search;
		}
		//Funkcija za izlistavanje svih korisnika
		public function listUsers(){
			//ako je postavljena stranica, dajemo njenu vrednost,ako ne,dajemo vrednost 1
			$page = (isset($_GET['page']))? $_GET['page'] : 1;

			echo "<div class='module'>";
			echo "<h2><span>List of all users</span></h2>";
            echo '<table id="myTable" class="tablesorter">';
                echo '<thead><tr>';
                	echo '<th width="5%">User Id</th><th width="30%">Username</th><th width="5%">Role</th><th width="15%">Last_Login</th><th width="15%">Account Created</th><th width="20%">Actions</th>';
                echo '</tr></thead><tbody>';
                //Pozivanje methoda paginate, tabela users, 10 linkova po stranici
               	$users = $this->paginate->paginate("users",10);
               	//Ispisujemo vrednosti koje smo dobili u tabelu.
               	foreach ($users as $user){
			         echo "<tr><td>" . $user['user_id'] . "</td>";
			         echo "<td>" . $user['username'] . "</td>";
			         echo "<td>" . $user['role'] . "</td>";
			         echo "<td>" . $user['last_login'] . "</td>";
			         echo "<td>" . $user['created'] . "</td>";
			         //Klikom na slicicu, salje nas na edit deo,sa ID-em, tako odma' dobijamo korisnika. 
			         echo "<td><a href='users.php?action=edit&id=".$user['user_id']."'><img src='img/pencil.gif' alt='edit' title='Edit User'>";
			         //Isto kao prethodno,samo brisanje
			         echo "<a href='users.php?action=delete&id=".$user['user_id']."''><img src='img/minus-circle.gif' alt='delete' title='Delete User'></a></td></tr>";
			    }
			echo "</tbody></table></div>";
			//Ispisivanje brojeva,previous page itd
			$this->paginate->write_results('list');
		}

		public function editUser($id){
			//Provera da li postoji ID korisnika,ako ne postoji,daje nam polje za pretragu istih
			if(!isset($id)){
				$id = $this->search->searchByName('User');
			}
			//Prebrojavanje Rola,potrebno zbog padajuceg menija
			$num_of_roles = $this->crud->count('roles')[0][0];
			//uzimanje podataka usera
			$user = $this->crud->searchUser($id)[0];
			if (isset($_POST['submit'])){
				//Pamcenje starog nadimka i uzimanje novog,da bi se podaci u tabeli odmah osvezili, nakon menjanja
				$old_username = $user['username'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$password2 = $_POST['password2'];
				$old_role = $user['role'];
				$role = $_POST['role'];
				//Provera da li smo menjali username
				if ($user['username'] != $username){
					//Provera da li je username validan
					if ($this->val->isUserNameValid($username)){
						//provera da li postoji vec takvo korisnicko ime
						if (!($this->crud->searchUser($username))){
							//kad prodje sve testove, menja ime i ispisuje iz kog u koje smo promenili
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
				//Provera da li je nesto ukucano u polja za password
				if (!empty($password)){
					//Ako jeste,proverava da li su oba polja popunjena
					if ($password == $password2){
						//Provera da li je password dobro unesen
						if ($this->val->isPasswordValid($password)){
							//Promena sifre i ispisavanje da je u redu
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
				//Provera da li je promenjna rola
				if ($user['role_id'] != $role){
					//Ako jeste,menja je i izbacuje potvrdu 
					$this->crud->changeUserRole($id, $role);
					echo "<span class='notification n-success'>Role had been changed from $old_role to ".$this->crud->searchRole($role)[0]['role']."</span>";	
				}
			}
			//Provera da li je postavljen username,ako jeste, ispisuje ga u input kolonu
			$username = (isset($username)) ? $username : $user['username'];
			//Proverava da li je stavljena rola,ako jeste, postavlja je na selected
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
							//Ispisivanje svih rola, i iz padajuceg menija bira koju ce
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
			//Proverava da li je postavljen username, ako jeste, ostavlja ga u inputu i ako ima neka greska
			$username = (isset($_POST['username']))? $_POST['username'] : "";
			$password =(isset($_POST['password']))? $_POST['password'] : "";
			$password1 =(isset($_POST['password1']))? $_POST['password1'] : "";
			$role =(isset($_POST['role']))? $_POST['role'] : "";
			if (isset($_POST['register'])){
				//Provera da li je username validan
				if($this->val->isUserNameValid($username)){
					//Provera da li vec postoji takav username
					if (!($this->crud->searchUser($username))){
						//Provera da li su sifre iste
						if ($password == $password1){
							//Provera da li je password regularan
							if ($this->val->isPasswordValid($password)){
								//Upisivanje i izlistavanje podataka koje smo uneli
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
			//Ako nije postavljen ID,poziva se funkcija search i polje za pretragu
			if(!isset($id)){
				$id = $this->search->searchByName('User');
			}
			//Izvlacenje podataka vezanih za korisnika kojeg hocemo da brisemo
			$user = $this->crud->searchUser($id)[0];
			echo "<div class='module'>";
			if (isset($_POST['delete'])){
				//brisanje korisnika i notifikacija sa podacima
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

	}

?>