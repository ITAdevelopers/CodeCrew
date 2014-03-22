<?php
require_once "config/paths.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>Unauthorized</title>

<meta charset="utf-8">
    <title><?php echo $page; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo URL_PATH . 'css/bootstrap.css'; ?>" rel="stylesheet">
    <style type="text/css">
      body {
       
       background: url("<?php echo URL_PATH; ?>images/pozadina_01.jpg");
        background-repeat: no-repeat;
          background-size: cover;
      }
    </style>
    <link href="<?php echo URL_PATH . 'css/bootstrap-responsive.css'; ?>" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Cantata+One" rel="stylesheet" type="text/css">
        <style type="text/css">
        
        #greska{
            
            width:80%;
            margin-left:auto;
            margin-right: auto;
            margin-top: 5%;
            color: #000;
            
        }
         
        
        
        
        </style>
    </head>

    <body>
        <div class="row-fluid">
        <div  id="greska">
        <div class="span12">
            
            <h2>Prilikom otvaranja stranice, dogodila se greska. Moguci razlozi su:</h2>
            <ul>
            <li>Nemate dozvolu da vidite ovu stranicu</li>
            <li>Niste se prijavili na sistem.</li>
            
            
            
            </ul>
            <a href="<?php echo URL; ?>">Vratite se na pocetnu stranicu.</a>
            
            
            </div>
        
        </div>
        </div>

    </body>
</html>
