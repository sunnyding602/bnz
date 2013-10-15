<?php
	define('DB_USER',getenv('DB_DEFAULT_USER'));
	define('DB_HOST', getenv('DB_DEFAULT_HOST'));
	define('DB_PASSWORD',getenv('DB_DEFAULT_PASS'));
	define('DB_NAME','bnz');
	define('TX_MAXFILESIZE', 204800);
    define('TX_UPLOADPATH', 'bar_image/touxiang/');
    $pathinfo =  pathinfo(__FILE__);
    $dirname = $pathinfo['dirname'];
    define('SITE_ROOT_PATH', substr($dirname, 0, -8) );
    define('SITE_ROOT_URL', 'http://www.bunengzhai.cn/' );

?>
