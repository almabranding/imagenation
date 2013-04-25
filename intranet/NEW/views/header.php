<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Imagenation</title>
    <meta charset="UTF-8"> 
    <meta property="og:site_name" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/zebra_form.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/jquery.Jcrop.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/HTML5Upload.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/file-upload.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/jquery-impromptu.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/fineuploader.css" /> 
   <!-- <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css" />-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <script src="<?php echo URL; ?>public/js/custom.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery.min.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery.Jcrop.js"></script>
    <script src="<?php echo URL; ?>public/js/ajaxfileupload.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery.filedrop.js"></script>
    <script src="<?php echo URL; ?>/ckeditor/ckeditor.js"></script>
    <script src="<?php echo URL; ?>public/js/HTML5script.js"></script>
    <script src="<?php echo URL; ?>public/js/file-upload.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery.tablednd.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery.fineuploader-3.0.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery-impromptu.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery-uberuploadcropper.js"></script>
    
    <?php
    if (isset($this->js)) 
    {
        foreach ($this->js as $js)
        {
            echo '<script src="'.URL.'views/'.$js.'"></script>';
        }
    }
    ?>
</head>
<body>
<div id="wrapper">
<?php Session::init(); ?>
    <header>
    <div class="header_logo">
        <a href="index.php">
        <div id="logo">
            <img src="images/logo.png">
        </div>
        </a>
    </div>
    <div class="header_admin">
        <div class="header_admin_title">Administration panel</div>
        <div class="header_login"><!--<img src="<?php //echo BASE;?>intranet/images/account_ico.png">My account--> <a onClick="location.href='<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?logout=1';?>'"><img src="images/logout_ico.png">Logout</a></div>
    </div>    
    <nav class="header_menu" id="sidebarnav">
        <ul>
            <li><a href="<?php echo URL; ?>works">Works</a></li>
            <li><a href="<?php echo URL; ?>home">Home Images</a></li>
            <li><a href="<?php echo URL; ?>about">About us</a></li>
        </ul>
    </nav>
    <div class="header_shadow"></div>
</header>
<div id="mainarea">
<div class="white_full hide" id="white_full" onclick="$('.hide').css('display','none')"></div>
<div id="container">
    
    