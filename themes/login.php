<?php

if(isset($_POST['register'])){
    $register->registerUser();
     header('Location: index.php');
     exit();
    

}
if(isset($_POST['login']))
{
 

  if($login->isLoggedIn()){
   
    header('Location: index.php');
      
  }
     
  else{
      
      $greske = $login->showErrors();
  }
      
    

}
      if(isset($greske)){
            foreach($greske as $key => $value){
                $greska = array('status' => 'neuspeh', 'message' => $value);
                echo json_encode($greska);
                exit();
            }
        }
if($login->isLoggedIn()){
      

    $data_user = '
    <h3>Dobrodosao/la, '.$secure_data->readData('username') .'</h3>
    <ul id="user_profile">

<li><i class="icon-wrench"></i> Podesavanja naloga </li>
<li><a href="index.php?action=logout"><i class="icon-off"></i> Izloguj se </a></li>



</ul>';
    ob_start();
    echo $data_user;
    ob_flush();
}else{
   
    $random = md5(uniqid(mt_rand(),true));
    $token = $secure_data->sessionSet('token', $random);
    
    $action = URL . 'index.php?action=login'; 
    $html = '
    <div class="row-fluid">
        <div class="span12" id="forma">
        <div id="response"></div>
    <form action="'. $action .'" method="post" onSubmit="return validate()" name="forma">
    <fieldset>
    <legend><h3>Login</h3></legend>
    <label>Username:</label>
    <input type="text" name="username" placeholder="Vas username..." id="username">
    
    <label>Password:</label>
    <input type="password" name="password" placeholder="Vas password" id="password">
    <input type="hidden" name="token" value="' . $token . '" id="token"/>
    <br />
    
    
    <input type="submit" name="login" class="btn btn-primary" value="Log In" /> 
    <a href="#myModal" role="button" class="btn" data-toggle="modal">Register</a>

   


    </fieldset>
    </form>
    
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Registration</h3>
            </div>
            <div class="modal-body">
            <form action="index.php?action=register" method="post">
                <label for"username">Your desired username</label>
                <input type="text" name="username"><br>
                <label for"password">Your password</label>
                <input type="password" name="password">
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary" name="register">Register</button>
                </form>
                   </div>
        </div>
</div>
</div>


';
    ob_start();
    ?>
    <script type="text/javascript">

function CodeCrewRedirect(){
	location.href='index.php';
	}
function getRequestBody(form){
    var pieces = [];
    var elements = form.elements;
    for(var i=0; i < elements.length ; i++){
        var element = elements[i];
        var name = encodeURIComponent(element.name);
        var value = encodeURIComponent(element.value);
        
        pieces.push(name + "=" + value);
    }
    return pieces.join("&");
}
function processRespose(data){
    var result = JSON.parse(data);
   
    if(result.status == "neuspeh"){
      document.getElementById('response').innerHTML = "<ul><li class='label label-warning'>"+ result.message +"</li></ul>"; 
    
    }
    
    
}
function ajax_send(){
    var xhr = new XMLHttpRequest();
    var data = getRequestBody(document.forma);
    
    xhr.open("POST", "<?php echo URL; ?>index.php?action=login", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            var status = xhr.status;
            if((status >= 200 && status < 300) || status === 304){
                processRespose(xhr.responseText);
            }else{
                document.getElementById('response').innerHTML = "<ul><li class='label label-warning'>Neuspesno logovanje!</li></ul>";
            }
        }
    };
    xhr.send(data);
}   

function validate(){
    var username = document.getElementById('username').value;
    var password = document.getElementById("password").value;
    var token = document.getElementById("token").value;
    var validacija = false;
    
    
    
try{
    if(!username.match(/^[a-zA-Z0-9]*$/) || username == "" || username.length < 3){
        throw "Polje username mora sadrzati samo karaktere i brojeve, duzine ne manje od 3 karaktera!";
    }
      if(!password.match(/^[a-zA-Z0-9]*$/) || password == "" || password.length < 3){
        throw "Polje password mora sadrzati samo karaktere i brojeve, duzine ne manje od 3 karaktera!";
    }
   ajax_send();
    setTimeout('CodeCrewRedirect()',3000);
  
    
    
}catch(err){
    
    document.getElementById('response').innerHTML = "<ul><li class='label label-warning'>"+ err +"</li></ul>";
    
    
} 
return validacija;
}


</script>
<?php

    echo $html;
    ob_flush();

}
?>







