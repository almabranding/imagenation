<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH

define('URL', 'http://www.imagenation.es/');
define('BASE','http://www.imagenation.es/');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'mysql5-10.pro');
define('DB_NAME','imagenation2');
define('DB_USER', 'imagenation2');
define('DB_PASS','***');

define('LIBS', 'libs/');
// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');

define('UPLOAD', '../uploads/images/');