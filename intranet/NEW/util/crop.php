<?php

// ideally one day this can do more than one image... 
// they would be stacked up to crop all at once in 
// Impromptu.. thus returning an array
require '../config.php';
$id=$_GET['id'];

date_default_timezone_set('UTC');

ini_set('display_errors',1);
ini_set('log_errors',1);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('UTIL_DIR', ROOT.'util/');
define('CURR_DIR', UTIL_DIR);
define('UPLOAD_DIR', UPLOADS_ROOT.$id.'/');

require "gd_image.php";
$gd = new GdImage();

foreach($_POST['imgcrop'] as $k => $v) {

	$filePath = UPLOAD_DIR . $v['filename'];
	$fullSizeFilePath = UPLOAD_DIR . $gd->createName($v['filename'], '_FULLSIZE');
        $newfullSizeFilePath = UPLOAD_DIR . $gd->createName($v['originalFilename'], '');
        $newavatarPath = UPLOAD_DIR . $gd->createName($v['originalFilename'], '_thumb');
	rename($filePath, $newavatarPath);
        $filePath = $newavatarPath;
	rename($fullSizeFilePath, $newfullSizeFilePath);

	// 2) compute the new coordinates
	$scaledSize = $gd->getProperties($filePath);
	$percentChange = $scaledSize['w'] / 500; // we know we scaled by width of 500 in upload
	$newCoords = array(
		'x' => $v['x'] * $percentChange,
		'y' => $v['y'] * $percentChange,
		'w' => $v['w'] * $percentChange,
		'h' => $v['h'] * $percentChange
	);

	// 3) crop the full size image
	$gd->crop($filePath, $newCoords['x'], $newCoords['y'], $newCoords['w'], $newCoords['h']);
	// 4) resize the cropped image to whatever size we need (lets go with 200 wide)
        $newWidth=($v['changeOpt']=='w')?$v['changeSize']:0;
        $newHidth=($v['changeOpt']=='h')?$v['changeSize']:0;
	$ar = $gd->getAspectRatio($newCoords['w'], $newCoords['h'], $newWidth, $newHidth);
	$gd->resize($filePath, $ar['w'], $ar['h']);	
}

echo "1";
