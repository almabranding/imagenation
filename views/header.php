<!DOCTYPE html>
<html>
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Image Nation | Photo & Motion Production Company</title>
<meta property="og:site_name" content="Image Nation" />
<meta name="description" content="Based in Barcelona, Spain, Image Nation is a full service, multilingual production company specialized in still photography and motion shoots.Our clients include Adidas, Alfa Romeo, Audi, BMW, Citroën, Fujitsu, GQ, Kia, Mercedes, Opel, Porsche, Seat, Sedus, Stihl, Toyota, Vodafone, Volkswagen, etc. and their publicity agencies. The Image Nation team can operate in English, German, French, Spanish and Catalan.Although Image Nation's primary focus is to provide top-quality photo and motion production services in Southern Europe, we have now expanded our purview to offer services to international agencies, production companies, photographers and director's worldwide.At client request, we produce campaigns in North America, South America, Asia, North and South Africa. To this end, Image Nation has built up a network of partners all over the world, giving us access to top-quality production services and facilities wherever we go." />
<meta name="keywords" content="Image Nation, Barcelona,Production Company, Photo,Film, Motion, Photo Production Worldwide, Film Production Worldwide, Motion Production Worldwide, Film Service Company, Commercial Production Company, " />
<meta name="author" content="http://www.almabranding.com" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo URL?>public/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL?>public/css/colorbox.css" />
 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="http://www.google.com/jsapi"></script>
<script>google.load("jquery", "1");</script>
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo URL?>public/js/jquery.colorbox.js"></script>
<script src="<?php echo URL?>public/js/jquery.ez-bg-resize.js"></script>
<script src="<?php echo URL?>public/js/functions.js"></script>
<script src="<?php echo URL?>public/js/jquery.masonry.min.js"></script>

<script src="<?php echo URL?>public/js/cufon-yui.js"></script>
<script src="<?php echo URL?>public/js/DINCond-Regular_500.font.js"></script>
<script src="<?php echo URL?>public/js/Helvetica_55_Roman_400.font.js"></script>
<script src="<?php echo URL?>public/js/Gill_Sans_Std_400.font.js"></script>

<script type="text/javascript">
    /*Cufon.set('fontSize', '11px').replace('body span,body p', { fontFamily: 'Helvetica 55 Roman'});*/
    Cufon.set('fontSize', '22px').replace('.menu', { fontFamily: 'DINCond-Regular'});
    Cufon.set('fontSize', '22px').replace('.back_arrow', { fontFamily: 'DINCond-Regular'});
    Cufon.set('fontSize', '12px').replace('.logo p', { fontFamily: 'Gill Sans Std'});
</script>
<body ondragstart="return false" style="overflow: auto;">
<div class="wrapper">
<header class="header">
    <a href="<?php echo URL;?>">
        <div class="logo">
            <div style="float:left;width: 200px;">
            
            <div class="logo_img"></div>
            <p>Photo & Motion<br/> Production Company</p>
             
            </div>
        </div>
    </a>
    <nav class="menu">
        <ul>
            <li><a href="<?php echo URL;?>works">Works</a></li>
            <li><a href="<?php echo URL;?>contact">Contact</a></li>
            <li><a href="http://imagenationblog.tumblr.com" target="_blank">Blog</a></li>
            <li><a class="loginBtn">Log in</a></li>
        </ul>
    </nav>
    <div class="clr"></div>
</header>
<div id="white_full" class="hide" onclick="$('.hide').css('display','none').html('')"></div>
<div id="white_box" class="hide"></div>
<script>
$("a.loginBtn").on('click', function(event){
    $('#white_box').html('<h2 style="width:100%">Log in</h2><form name="form" method="POST" enctype="multipart/form-data" action="https://clientzone.imagenation.es/connexion.php"><p><label for="user">Login</label><input maxlength="15" name="utilisateur" id="user" type="text" value=""/></p><p><label for="pass">Password</label><input name="mot_de_passe" id="pass" type="password" maxlength="10"/></p><div style="float:right;"><input type="submit" id="save" value="Login" class="btn"/></div></form>');
    $('#white_box').removeClass().addClass('login').addClass('hide');
    $('.hide').css('display','inherit');
    return false;
}); 
</script>    
