<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link rel="stylesheet" href="stylesheets/default.css " type="text/css"/>
</head>
<body><div id="logo"><table><tr><td><a href="#"><img  alt="bunengzhai" src="images/logo.jpg" /></a></td></tr></table></div>
<?php //这里检查是否有消息要加载
if($session->check_error_message()){
	output_error_message($session->check_error_message());
}
if($session->check_notice_message()){
	output_notice_message($session->check_notice_message());
}
?>