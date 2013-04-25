<?php 
include("conexion.php");
$cn = mysql_connect("vynl.db.5091863.hostedresource.com","vynl","Lesseps11");
mysql_select_db("vynl", $cn);
mysql_set_charset('utf8',$cn); 
$query = mysql_query("Delete FROM menus WHERE id=".$_GET['id']);
mysql_fetch_array($query);
echo '<script>self.close();</script>';
?>