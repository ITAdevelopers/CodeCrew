<?php


if(isset($_POST['login']))
{
 

  if($login->isLoggedIn())
     header('Location: index.php');
  else
    $greske = $login->showErrors();

}
      if(isset($greske)){
            foreach($greske as $key => $value){
                echo '<h3>Greske</h3>';
                echo '<p>'. $value.'</p>';
            }
        }
if($login->isLoggedIn()){
    ob_start();
    echo '
    <h3>Dobrodosao/la, '.$secure_data->readData('username') .'</h3>
    <ul id="user_profile">

<li><i class="icon-wrench"></i> Podesavanja naloga </li>
<li><i class="icon-off"></i> Izloguj se </li>



</ul>';
   ob_flush();
    
    
}else{
    $random = md5(uniqid(mt_rand(),true));
    $token = $secure_data->sessionSet('token', $random);
    
    $action = URL . 'index.php?action=login';
    ob_start();
    echo '<!doctype html>
<head>
<title>Twiter</title>
<meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">





</style>
</head>
<body>
    <div class="row-fluid">
        <div class="span3" id="forma">
    <form action="'. $action .'" method="post">
    <fieldset>
    <legend><h3>Login</h3></legend>
    <label>Username:</label>
    <input type="text" name="username" placeholder="Vas username...">
    
     <label>Password:</label>
    <input type="password" name="password" placeholder="Vas password">
    <input type="hidden" name="token" value="' . $token . '" />
    
    
    <input type="submit" name="login" class="btn btn-primary" value="Log In" />
    </fieldset>
    </form>
</div>
</div>
</body>
</html>';
    ob_flush();
   

   
    

}
?>






