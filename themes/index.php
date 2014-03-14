<!doctype html>
<head>
<title>Twiter</title>
<meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
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
	<link href="<?php echo URL_PATH . 'css/style.css'; ?>" rel="stylesheet">
	
	<!-- Slider styles -->
	
	<link rel="stylesheet" href="<?php echo URL_PATH . 'nivo-slider/nivo-slider.css'; ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo URL_PATH . 'nivo-slider/themes/default/default.css'; ?>" type="text/css" />
	

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
   


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
			
			<li><a href="<?php echo URL . 'index.php?title='.$menu['title']; ?>"><?php echo $menu['title'] ?></a></li>
			
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?php echo URL_PATH . 'nivo-slider/jquery.nivo.slider.pack.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
$ ("#slider").nivoSlider ();
});
</script>
<div id="container"> 
<div class="row">
<div class="span6 well" id="firstcol">
<?php 
foreach ($stranica as $prva){

echo $prva["content"];
}?>

</div>
<div class="span4 well" id="sidebar">
<h1>Fusce ultrices</h1>
<p2>01-14-2013</p2> </br>
<a href ="#" title "">Vestibulum laoreet lorem sed amet condimentum eget ultrices et mago porttitor nequese blandit.</a>
</li>
</div>



</div>

</div>
<script src"<?php echo THEMES_PATH . 'js/bootstrap.js'; ?>"></script>
</body>
</html>