<?PHP
require_once 'auth.php';
header("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header("Pragma: no-cache");
if (!isset($_SESSION))
    session_start(); $_SESSION['lang'] = 'ES';


if (!empty($_POST['username'])) {
    include_once("../functions/functions.php");
    //Register user:
    require_once 'js/access.class.php';
    $user = new flexibleAccess();
    //The logic is simple. We need to provide an associative array, where keys are the field names and values are the values :)
    $data = array(
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['pwd'],
        'active' => 1
    );
    $userID = $user->insertUser($data); //The method returns the userID of the new user or 0 if the user is not added
    
    if ($userID == 0)
        echo 'User not registered'; //user is allready registered or something like that
    else
        echo 'User registered with user id ' . $userID;
}
?>
<head>
</head>
<body>
    <div id="wrapper">
        <div id="mainarea">
            <h1>Register</h1>
            <p>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Username:</label> <input type="text" name="username" /><br/><br />
            <label> Password:</label> <input type="password" name="pwd" /><br /><br />
            <label> Email:</label> <input type="text" name="email" /><br /><br />
            <input type="submit" value="Register user" />
            </form>
            </p>
        </div> 
    </div> 
        <?php include 'footer.php'; ?>
</body>