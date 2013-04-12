<?PHP
if(strstr($_SERVER['HTTP_HOST'],'localhost')){
    require_once 'js/access.class.alma.php';
}
if(strstr($_SERVER['HTTP_HOST'],'imagenation.es')){
    require_once 'js/access.class.php';
}
if( !isset( $_SESSION ) ) session_start();
$user = new flexibleAccess();
if ( $_GET['logout'] == 1 ) 
    $user->logout('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
if (!$user->is_loaded()) {
    header ("Location: index.php");
}
?>