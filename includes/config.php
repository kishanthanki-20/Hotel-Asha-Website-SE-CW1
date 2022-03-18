<?php

//Database Constants
defined('DB_SERVER') ? null : define("DB_SERVER","localhost");//define our database server
defined('DB_USER') ? null : define("DB_USER","root");		  //define our database user	
defined('DB_PASS') ? null : define("DB_PASS","");			  //define our database Password	
defined('DB_NAME') ? null : define("DB_NAME","hotelasha"); //define our database Name
// //Database Constants
// defined('DB_SERVER') ? null : define("DB_SERVER","fdb31.biz.nf");//define our database server
// defined('DB_USER') ? null : define("DB_USER","3934703_userdata");		  //define our database user	
// defined('DB_PASS') ? null : define("DB_PASS","Xilointxiloint618");			  //define our database Password	
// defined('DB_NAME') ? null : define("DB_NAME","3934703_userdata"); //define our database Name

$thisFile = str_replace('\\', '/', __FILE__);
$docRoot =$_SERVER['DOCUMENT_ROOT'];


$webRoot  = str_replace(array($docRoot, 'includes/config.php'), '', $thisFile);
$srvRoot  = str_replace('config/config.php','', $thisFile);
$webRoot = "/hotelasha/";
//echo $webRoot;
define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);
