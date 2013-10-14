<?php
// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 
	define('SITE_ROOT','D:' .DS. 'wwwroot' .DS. 'sunnyding60s' .DS. 'web' .DS.'m');

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');


//core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'pagination/page.class.php');
require_once(LIB_PATH.DS.'functions.php');
require_once(LIB_PATH.DS.'validate_common.php');
//database related objects
require_once(LIB_PATH.DS.'connectvars.php');
require_once(LIB_PATH.DS.'database.php');
require_once (LIB_PATH.DS.'user.php');

$database = new Database ( );
$database->open_connection ();
$database->query("SET NAMES 'utf8'");

$user = new User ( );
$session = new Session ( );
	
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-j');
$now = date ( 'Y-m-j H:i:s' );
?>