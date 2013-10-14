<?php
	define('DB_USER','a0417135850');
	define('DB_HOST','localhost');
	define('DB_PASSWORD','35541765');
	define('DB_NAME','a0417135850');
	define('TX_MAXFILESIZE', 204800);
    define('TX_UPLOADPATH', 'bar_image/touxiang/');
    $pathinfo =  pathinfo(__FILE__);
    $dirname = $pathinfo['dirname'];
    define('SITE_ROOT_PATH', substr($dirname, 0, -8) );
?>
