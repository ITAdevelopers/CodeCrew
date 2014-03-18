<?php
if(!isset($title_sec)){
    $page = $stranice_menu[0]['title'];
}else{
    $page = $title_sec;
}


 ?>
<!doctype html>
<head>

<meta charset="utf-8">
    <title><?php echo $page; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo URL_PATH . 'css/bootstrap.css'; ?>" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="<?php echo URL_PATH . 'css/bootstrap-responsive.css'; ?>" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Cantata+One" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Imprima" rel="stylesheet" type="text/css">
	

	
	<!-- Slider styles -->
	
	<link rel="stylesheet" href="<?php echo URL_PATH . 'nivo-slider/nivo-slider.css'; ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo URL_PATH . 'nivo-slider/themes/default/default.css'; ?>" type="text/css" />
    <link href="<?php echo URL_PATH . 'css/style.css'; ?>" rel="stylesheet">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="<?php echo URL_PATH . 'js/bootstrap.js'; ?>" type="text/javascript"></script>
	

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
 <script type="text/javascript">
function login_get(){
$.ajax({
	url: "<?php echo URL; ?>index.php?action=login",
	success: function(data){
		$('#sidebar').html(data);
	},
	error:function(){

		$('#sidebar').html('Zao nam je opcija login nije dostupna.');
	}

});

}



 </script>  


</head>
<body>
	<div class="navbar">
        
        	<div class="navbar-inner">
             <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
           
            </a>
            <a href="#" class="brand">CodeCrew</a>
             <div class="nav-collapse collapse">
             
            <ul class="nav">
          <?php foreach($stranice_menu as $menu){ ?>
			
			<li class="<?php
                if($page == $menu['title']){
                    echo 'active';
                }

             ?>"><a href="<?php echo URL . $menu['title']; ?>"><?php echo $menu['title'] ?></a></li>
			
			<?php } ?>
            
            
            </ul>
            
            

				</div>
            
            
            
            
            </div><!--end of navbar-inner -->
            </div><!--end of navbar -->

			
           
            
            
            
            

		


  
	<div class="slider-wrapper theme-default">
    <div class="ribbon"></div>
<div id="slider" class="nivoSlider">
    <img src="<?php echo URL_PATH . 'images/image_1.jpg'; ?>">
    <img src="<?php echo URL_PATH . 'images/image_2.jpg'; ?>">
    <img src="<?php echo URL_PATH . 'images/image_3.jpg'; ?>">
</div>
</div>  

<script src="<?php echo URL_PATH . 'nivo-slider/jquery.nivo.slider.pack.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
$ ("#slider").nivoSlider ();
login_get();
});
</script>
<div id="container"> 
<div class="row-fluid">
<div class="span6 well" id="firstcol"><p>

<?php 
if(!isset($title_sec)){
    echo "<h3>{$stranice_menu[0]['title']} stranica</h3>";
}else{
    echo "<h3>{$title_sec} stranica</h3>";
}
foreach ($stranica as $prva){

echo $prva["content"];
}?>
</p>
</div>
<div class="span4 well" id="sidebar">

</div>



</div>

</div>

</body>
</html>
