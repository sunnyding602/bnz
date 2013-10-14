<?php
	define('DB_USER','root');
	define('DB_HOST','localhost');
	define('DB_PASSWORD','123456');
	define('DB_NAME','bnz');
	define('TX_MAXFILESIZE', 204800);
    define('TX_UPLOADPATH', 'bar_image/touxiang/');
    $pathinfo =  pathinfo(__FILE__);
    $dirname = $pathinfo['dirname'];
    define('SITE_ROOT_PATH', substr($dirname, 0, -8) );
    define('SITE_ROOT_URL', 'http://www.bunengzhai.cn/' );

?>
