<?php
    
class Function_articles{

private $crud;
private $validate;
private $secure;
public $errors;

public function __construct(Crud $crud, Validation $validation, Secure_data $secure){
    
    $this->crud = $crud;
    $this->validate = $validation;
    $this->secure = $secure;

}

public function list_articles(){
    
    $articles = $this->crud->list_articles_crud();

    if(is_null($articles)){
        echo "Trenutno nema artikala u bazi.";
    }else{
 ob_start();
  echo' <div class="float-right">
                        <a href="articles.php?action=create" class="button">
                        	<span>Novi artikal <img src="img/plus-small.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/plus-small.gif" width="12" height="9" alt="Novi artikal" /></span>
                        </a>
                    </div>    
                </div>';

echo ' <div class="module">
                	<h2><span>News</span></h2>
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:20%">Page</th>
                                    <th style="width:21%">Content</th>
                                    <th style="width:13%">Created</th>
                                    <th style="width:13%">Permision</th>
                                    <th style="width:15%">Created by</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>';
    foreach($articles as $a){
     echo ' <tr>
                                    <td class="align-center">'. $a["article_id"] .'</td>
                                    <td>'. $a["title"] .'</td>
                                    <td>' . substr($a["content"], 0, 55) . '</td>
                                    <td> ' .$a["created"] . '</td>
                                    <td> <a href="articles.php?action=changeperm&article_id='.$a["article_id"].'">' .$a["permission"] . '</td>
                                    <td> ' .$a["username"] . '</td>
                                    <td>                                    	
                                        <a href="articles.php?action=delete&article_id='.$a["article_id"].'"><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href="articles.php?action=edit&article_id='.$a["article_id"].'"><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                       
                                    </td>
                                </tr>';

    }
    echo '</tbody>
                        </table>
                        </form>
                        <div class="pager" id="pager">
                          
                        </div>
                        
                        <div style="clear: both"></div>
                     </div> <!-- End .module-table-body -->
                </div> <!-- End .module -->';
ob_flush();

    
     }

}

public function create_article(){
      $roles = $this->crud->get_all_rolles();
      $pages = $this->crud->list_pages();
 ob_start();   
    echo '<div class="module">
                     <h2><span>Form</span></h2>
                        
                     <div class="module-body">
                     <form action="'. $_SERVER["PHP_SELF"] . '?action=store" method="POST"> 
                      <p><select class="input-short" name="page"> ';
                     foreach($pages as $p){
                           echo "<option value='". $p['page_id'] ."'>" . $p['title'] ."</option>";
                      
                     }
                      echo '</select></p> <p>
                      <textarea id="wysiwyg" rows="11" cols="90" name="content">    </textarea> 
                      
                      </p>
                         <p>
                            <label>Permission</label>
                            <input type="number" class="input-short" name="permission" />
                      </p>'; 

                         foreach($roles as $r){
                          
                          echo "<label>
                          <input type='checkbox' name='box". $r['role_id'] ."' />
                          ".$r['role']."
                          </label> ";
                      }
                      
                 echo '      <fieldset>
                                <input class="submit-green" type="submit" value="Submit" /> 
                                <input class="submit-gray" type="reset" value="Cancel" />
                         </fieldset>

                      </form>
                      
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->';

                
ob_flush();
}
// Treba napraviti metod kojim snimam artikal !!!!!!!
public function store_article(){
    $this->errors = array();
    $input = array(
    'page' => trim($_POST['page']),
    'content' =>  trim($_POST['content']),
    'permission' => $_POST['permission'],
    'user_id'    => $this->secure->readData('ID')   
    
    );

    try{
        if(!is_numeric($input['page'])){
            
            throw new Exeption('Stranica nije u odgovarajucem formatu');
        }
        if(count($this->crud->searchPage($input['page'])) < 1){
            
            throw new Exeption('Stranica ne postoji');
        }

        if(!is_numeric($input['permission']) || $input['permission'] < 0 || $input['permission'] > 1){
            
            throw new Exeption('Takva dozvola ne postoji');
        }

        $this->crud->addArticle ($input['page'],$input['content'], $input['user_id'] ,$input['permission']);
       //odraditi permisions tabelu.....
        if($input['permission'] == 1){
            $roles = $this->crud->get_all_rolles();
            foreach ($roles as $r){
                $polje = 'box' . $r['role_id'];
               
                
                if($_POST[$polje] == true){
                    $id = $this->crud->last_id();
                    $id_a = $id[0]['article_id'];
                  
                    $this->crud->addResource($id_a, $r['role_id']);
                }else{
                    continue;
                }
            }
        }
         header('Location: articles.php?action=list');
    }catch(Exception $e){
        $this->errors[] = $e->getMessage();
    }
  


   


    


}

public function errors_show(){
    
    foreach($this->errors as $key => $value){
        echo '<span class="notification n-error">'. $value.'</span>';
    }
}

public function change_permision_articles($id){

$resource = $this->crud->searchResourcesByArticle ($id);
$articles = $this->crud->searchArticle($id);
$roles = $this->crud->get_all_rolles();

$dozvole = array();
foreach($resource as $res){
    $dozvole[] = $res['role_id'];
}


ob_start();

echo '<div class="module">
                     <h2><span>Form</span></h2>
                        
                     <div class="module-body">
                     <form action="'. $_SERVER["PHP_SELF"] . '?action=changepermstore&article_id='.$id.'" method="POST"> ';

                     foreach($articles as $a){
                         echo '   <p>
                            <label>Permission</label>
                            <input type="number" class="input-short" name="permission" value="'. $a['permission'] .'" />
                      </p>';
                     }
                     foreach($roles as $r){
                       if(in_array($r['role_id'], $dozvole )){
                           $checked = 'checked';
                       }else{
                           $checked = '';
                       }
                              echo "<label>
                          <input type='checkbox' name='box". $r['role_id'] ."' ". $checked. " />
                          ".$r['role']."
                          </label> ";
                     }
                      echo '      <fieldset>
                                <input class="submit-green" type="submit" value="Submit" /> 
                                <input class="submit-gray" type="reset" value="Cancel" />
                         </fieldset>

                      </form>
                      
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->';
                     
     ob_flush();              

               

}
//dodati metod za update dozvola
public function update_permisions_table($id){
    $roles = $this->crud->get_all_rolles();
    if(!is_numeric($_POST['permission'])){
        header("Location ../error.php");
            exit();
    }
    
    $this->crud->update_permision($id, $_POST['permission']);
    echo '<span class="notification n-success">Uspesno izmenjene dozvole</span>';
     echo "<a href='articles.php?action=changeperm&article_id={$id}'> Link nazad</a>";
    
    
    
    foreach ($roles as $r){
        $polje = 'box' . $r['role_id'];
        $input = (isset($_POST[$polje]))? $_POST[$polje] : false;
        if(!is_bool($input)){
            header("Location ../error.php");
            exit();
        }
        
       
        $current_set = $this->crud->searchResourcesByArticleAndRole($id, $r['role_id']);
        
       
        
        
        if($input == true && count($current_set) > 0){
            
                continue;
                
            }  
        elseif($input == true && count($current_set) < 1 ) {
            $this->crud->addResource($id, $r['role_id']);    
            }
        elseif($input == false && count($current_set) > 0){
            $this->crud->deleteResourcesByArticleAndRole($id, $r['role_id']);
        }
        elseif($input == false && count($current_set) < 1){
            continue;
        }     
        
        
        
        
        
    }
    
    
    
    
}

public function delete_article($id){
   
   $this->crud->deleteResourcesByArticle($id);
   $this->crud->deleteArticle($id);
   
   header('Location: articles.php?action=list');
    
    
}
public function edit_article($id){
    $pages = $this->crud->list_pages();
    $article = $this->crud->searchArticle($id);
    $stranica = $this->crud->searchPage($article[0]['page_id']);
    echo '<div class="module">
                     <h2><span>Form</span></h2>
                        
                     <div class="module-body">
                     <h3>Trenutna stranica: ' . $stranica[0]['title'] . '</h3>
                     <form action="'. $_SERVER["PHP_SELF"] . '?action=editstore&article_id='.$id .'" method="POST"> 
                      <p>
                      <label>Premesti u ? ili izaberi trenutnu stranicu kako ne bi bilo promena</label>
                      <select class="input-short" name="page"> ';
                     foreach($pages as $p){
                           echo "<option value='". $p['page_id'] ."'>" . $p['title'] ."</option>";
                      
                     }
                      echo '</select></p> <p>';
                      foreach ($article as $a){
                      echo '<textarea id="wysiwyg" rows="11" cols="90" name="content"> '. $a['content'] .'   </textarea> ';
                      }
                    echo '  </p>    <fieldset>
                                <input class="submit-green" type="submit" value="Submit" /> 
                                <input class="submit-gray" type="reset" value="Cancel" />
                         </fieldset>

                      </form>
                      
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->';
    
    
}
public function edit_article_store($id){
    $this->errors = array();
    $input = array(
    'page' => trim($_POST['page']),
    'content' =>  trim($_POST['content'])
    
    
    );
    


    try{
        if(!is_numeric($input['page'])){
            
            throw new Exeption('Stranica nije u odgovarajucem formatu');
        }
        if(count($this->crud->searchPage($input['page'])) < 1){
            
            throw new Exeption('Stranica ne postoji');
        }

       

       $this->crud->update_articles($id, $input['page'], $input['content']);
       
        
         header('Location: articles.php?action=list');
    }catch(Exception $e){
        $this->errors[] = $e->getMessage();
    }
    
    
    
}



    



}

?>

