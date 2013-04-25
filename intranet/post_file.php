<?php

// If you want to ignore the uploaded files, 
// set $demo_mode to true;
if (!isset($_SESSION))session_start();
include_once("functions/functions.php");
$demo_mode = false;
$upload_dir = '../uploads/';
$allowed_ext = array('jpg','jpeg','png','gif');
$uploadType=$_GET['uploadType'];
$project=$_GET['project'];
$upload_dir = '../uploads/'.$project.'/images/';
$bbdd=$_GET['bbdd'];
$thumbWidth=400;
if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	exit_status('Error! Wrong HTTP method!');
}


if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
	
	$pic = $_FILES['pic'];

	if(!in_array(get_extension($pic['name']),$allowed_ext)){
		exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
	}	
        
        $pathinfo = pathinfo($pic["name"]);
        $ext='.'.$pathinfo['extension'];
        $file = uniqid($pathinfo['filename'].'_');
        $nameFile=$file.$ext;
	if(move_uploaded_file($pic['tmp_name'], $upload_dir.$nameFile)){
            $consulta=new Consulta();
            $SQL="INSERT INTO ".$bbdd." (project,name,caption) VALUES ('".$project."','".$nameFile."','".$pathinfo['filename']."')";
            $consulta->setConsulta($SQL);
            //createThumbsGallery( $upload_dir, $upload_dir, $thumbWidth );
            createThumbs($nameFile,$upload_dir, $upload_dir, $thumbWidth );
            exit_status('File was uploaded successfuly!');
	}
	
}

exit_status('Something went wrong with your upload!');


// Helper functions

function exit_status($str){
	echo json_encode(array('status'=>$str));
	exit;
}

function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}
?>