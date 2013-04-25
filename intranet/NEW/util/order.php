<?php
require '../config.php';
if (isset($_POST['orders'])) {
	
	$orders = explode('&', $_POST['orders']);
	$array = array();
	
	foreach($orders as $item) {
		$item = explode('=', $item);
		$item = explode('_', $item[1]);
		$array[] = $item[1];
	}
	
	try {
		$objDb = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		$objDb->exec("SET CHARACTER SET utf8");
		
		foreach($array as $key => $value) {
			$key = $key + 1;
			$sql = "UPDATE `project` 
					SET `orderNum` = ?
					WHERE `id` = ?";
			
			$objDb->prepare($sql)->execute(array($key, $value));		
		}
		
		echo json_encode(array('error' => false));
	
	} catch(Exception $e) {
	
		echo json_encode(array('error' => true));
		
	}
	
} else {
	echo json_encode(array('error' => true));
}