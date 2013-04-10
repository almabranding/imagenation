<?php
/*
Basic login example with php user class
http://phpUserClass.com
*/
require_once 'js/access.class.php';
$user = new flexibleAccess();
  $data = array(
  	'username' => 'Admin',
  	'email' => 'info@imagenation.es',
  	'password' => 'Imagine',
  	'active' => 1
  );
  $userID = $user->insertUser($data);//The method returns the userID of the new user or 0 if the user is not added
  if ($userID==0)
  	//echo 'User not registered';//user is allready registered or something like that
      echo '';
  else
  	echo 'User registered with user id '.$userID;
if ( isset($_GET['logout']) ) 
if ( $_GET['logout'] == 1 ) 
//	$user->logout('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	$user->logout('http://'.$_SERVER['HTTP_HOST'].'/intranet/index.php');
if ( !$user->is_loaded() )
{
	//Login stuff:
	if ( isset($_POST['uname']) && isset($_POST['pwd'])){
	  if ( !$user->login($_POST['uname'],$_POST['pwd'],$_POST['remember'] )){//Mention that we don't have to use addslashes as the class do the job
	  echo $user->login($_POST['uname'],$_POST['pwd'],$_POST['remember']);
	    $no_pass="Usuario/Contraseña Incorrectos";
	  }else{
	    //user is now loaded
	    //header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/intranet/home.php');
		//header('Location: http://flowing.es/');
	  }
	}
}else{
  //header('Location: http://'.$_SERVER['HTTP_HOST'].'/intranet/home.php');
  //echo '<a href="'.$_SERVER['PHP_SELF'].'?logout=1">logout</a>';
}
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Robots" content="Nofollow"/>
<title>Vynl Intranet</title>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/login-box.css" />
<script type="text/javascript">
      google.load("jquery", "1.7.1");     
      google.setOnLoadCallback(function() {
            // Your code goes here.
      });
</script>
</head>

<body>

<div id="page">
   <div id="header">
   <a href="index.php" > <div id="logo" style="margin:auto; float:none;"></div></a>
   </div>
    <div id="login-box">
        <H2>Access</H2>
        <?php if(isset($no_pass)) echo $no_pass; ?>
        <br />
        <br />
        <form method="post" action="" />
        <div id="login-box-name" style="margin-top:20px;">User:</div><div id="login-box-field" style="margin-top:20px;"><input name="uname" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
        <div id="login-box-name">Password:</div><div id="login-box-field"><input name="pwd" type="text" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
        <br />
        <span class="login-box-options"><input type="checkbox" name="remember" value="1"> Remember <!--<a href="#" style="margin-left:30px;">Forgot password?</a>--></span>
        <br />
        <br />
         <input type="submit" value="" class="login-box-button"/>
        </form>
	</div>


</body>