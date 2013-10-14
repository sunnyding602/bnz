<?php
header('P3P:CP="CAO PSA OUR"');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="wtb_styles/login.css" rel="stylesheet" type="text/css" /> 
</head>

<body>
<?php 
$xn_sig_added = $_GET["xn_sig_added"];
if($xn_sig_added==0)
{
	//跳转到授权页面
	$url="http://www.bunengzhai.cn/renrenapp/auth.php";
	echo "<script language='javascript' type='text/javascript'>"; 
	echo "window.location.href='$url'"; 
	echo "</script>";
}
else
{
	$session_key = $_GET["xn_sig_session_key"];
	$_SESSION["session_key"]=$session_key;
	
	//跳转到游戏页面
	/*注意！！！这里不要直接从iframe参数中获取xn_sig_user作为人人的uid，需要验证一下当前登录的人人用户和xn_sig_user是不是同一个人，否则把xn_sig_user该成别人的人人id就可以进入别人的app游戏账号，验证方法有两种：
	1、验证sig，算法看文档：http://wiki.dev.renren.com/wiki/Xn_sig
	2、用sessionkey调api接口取出真正的人人id，api文档：http://wiki.dev.renren.com/wiki/Users.getLoggedInUser
	*/
	$url="http://www.bunengzhai.cn/renrenapp/main.php";
	echo "<script language='javascript' type='text/javascript'>"; 
	echo "window.location.href='$url'"; 
	echo "</script>";
}
?>
</body>
</html>