<?php
/*
Basic login example with php user class
http://phpUserClass.com
*/

require_once '/js/access.class.php';
$user = new flexibleAccess();
if ( isset($_GET['logout']) ) 
if ( $_GET['logout'] == 1 ) 
	$user->logout('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

if ( !$user->is_loaded() )
{
	//Login stuff:
	if ( isset($_POST['uname']) && isset($_POST['pwd'])){
	  if ( !$user->login($_POST['uname'],$_POST['pwd'],$_POST['remember'] )){//Mention that we don't have to use addslashes as the class do the job
	  echo $user->login($_POST['uname'],$_POST['pwd'],$_POST['remember']);
	    $no_pass="Usuario/Contrase�a Incorrectos";
	  }else{
	    //user is now loaded
	    //header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
		//header('Location: http://'.$_SERVER['HTTP_HOST'].'/intranet/home.php');
		if( !isset( $_SESSION ) ) session_start();
		header('Location: http://www.google.es');
	  }
	}
}else{
  //User is loaded
  echo '<a href="'.$_SERVER['PHP_SELF'].'?logout=1">logout</a>';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Flowing</title>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/login-box.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/preload.js"></script>
<script type="text/javascript" src="js/jquery.ez-bg-resize.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
</head>

<body>

<div id="page">
   <?php require("../header.php");?>
    <div id="login-box">
        <H2>Acceso</H2>
        <?php if(isset($no_pass)) echo $no_pass; ?>
        <br />
        <br />
        <form method="post" action="" />
        <div id="login-box-name" style="margin-top:20px;">Usuario:</div><div id="login-box-field" style="margin-top:20px;"><input name="uname" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
        <div id="login-box-name">Contrase�a:</div><div id="login-box-field"><input name="pwd" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
        <br />
        <span class="login-box-options"><input type="checkbox" name="remember" value="1"> Recordar <!--<a href="#" style="margin-left:30px;">Forgot password?</a>--></span>
        <br />
        <br />
         <input type="submit" value="" class="login-box-button"/>
        </form>
	</div>


</body>

</html>