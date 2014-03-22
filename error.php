<?php 
require_once "config/paths.php";

?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Error 404</title>
<style type="text/css">
body{
        background: url("<?php echo URL_PATH; ?>images/pozadina_01.jpg");
        background-size:cover;
    }
#poruka{
        width: 860px;
        height: 420px;
        margin:auto;
        margin-top: 5%;
    }    
    
    
    
</style>
</head>

<body>
    <div id="poruka">
    
    <img src="<?php echo URL_PATH; ?>images/404.jpg" />
    
    
    </div>
</body>
</html>
