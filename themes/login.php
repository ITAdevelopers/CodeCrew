<?php

if(isset($_POST['register'])){
    $register->registerUser();
     header('Location: index.php');
     exit();
    

}
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
    $data_user = '<ul id="user_profile">
<li><span class="icon-user"></span>'. $secure_data->readData('username') .' </li>



</ul>';
    ob_start();
    echo $data_user;
    ob_flush();
}else{
    $random = md5(uniqid(mt_rand(),true));
    $token = $secure_data->sessionSet('token', $random);
    
    $action = URL . 'index.php?action=login';
    
    $html = '<!doctype html>
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

    <a href="#myModal" role="button" class="btn" data-toggle="modal">Register</a>
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Registration</h3>
            </div>
            <div class="modal-body">
                <label for"username">Your desired username</label>
                <input type="text" name="username"><br>
                <label for"password">Your password</label>
                <input type="password" name="password">
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary" name="register">Save changes</button>
            </div>
        </div>


    </fieldset>
    </form>
</div>
</div>
</body>
</html>';
    ob_start();

    echo $html;
    ob_flush();

}
?>






