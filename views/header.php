<!DOCTYPE html>
<html>
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Image Nation | Photo & Motion Production Company</title>
<?php
if($this->projectInfo){
    foreach($this->projectInfo as $value){
       $ogdesc=
        'Photographer: '.$value['photo'].' - 
        Agency: '.$value['agency'].' - 
        Prod. Company: '.$value['prod'].' - 
        Location: '.$value['location']; 
       $ogname=$value['name'];
       $ogimg=($value['fb'])?'http://imagenation.es/uploads/'.$value['id'].'/'.$value['fb']:'http://imagenation.es/uploads/'.$value['id'].'/'.$value['avatar'];
    }
    
}else{
    $ogname='Image nation';
    $ogimg='http://www.imagenation.es/public/images/logoBig.png';
    $ogdec='Based in Barcelona, Spain, Image Nation is a full service, multilingual production company specialized in still photography and motion shoots';
}

?>
<meta property = 'og:url' content='<?='http://www.imagenation.es'.$_SERVER['REQUEST_URI']?>' />
<meta property = 'og:image' content='<?=$ogimg?>' />
<meta property = "og:title" content = "<?php echo $ogname;?>" />
<meta property = "og:description" content = "<?php echo $ogdesc;?>" />
<meta property = "og:type" content = "website" />
<meta property = "og:site_name" content = "Image nation" />
<meta name="description" content="Based in Barcelona, Spain, Image Nation is a full service, multilingual production company specialized in still photography and motion shoots.Our clients include Adidas, Alfa Romeo, Audi, BMW, Citroën, Fujitsu, GQ, Kia, Mercedes, Opel, Porsche, Seat, Sedus, Stihl, Toyota, Vodafone, Volkswagen, etc. and their publicity agencies. The Image Nation team can operate in English, German, French, Spanish and Catalan.Although Image Nation's primary focus is to provide top-quality photo and motion production services in Southern Europe, we have now expanded our purview to offer services to international agencies, production companies, photographers and director's worldwide.At client request, we produce campaigns in North America, South America, Asia, North and South Africa. To this end, Image Nation has built up a network of partners all over the world, giving us access to top-quality production services and facilities wherever we go." />
<meta name="keywords" content="Image Nation, Barcelona,Production Company, Photo,Film, Motion, Photo Production Worldwide, Film Production Worldwide, Motion Production Worldwide, Film Service Company, Commercial Production Company, " />
<meta name="author" content="http://www.imagenation.es" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo URL?>public/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL?>public/css/colorbox.css" />
 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="http://www.google.com/jsapi"></script>
<script>google.load("jquery", "1");</script>
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<body ondragstart="return false" style="overflow: auto;">
<?php include('analytics.php')?>
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
