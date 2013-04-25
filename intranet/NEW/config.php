<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://'.$_SERVER['HTTP_HOST'].'/imagenation/intranet/');
define('LIBS', 'libs/');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'imagenation2');
define('DB_USER', 'almabranding');
define('DB_PASS', 'branding');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');
define('UPLOAD_ABS', URL.'../uploads/');
define('UPLOAD', '../uploads/');
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/imagenation/intranet/');
define('UPLOADS_ROOT', ROOT.'../uploads/');