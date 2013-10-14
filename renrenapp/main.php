<?php
header('P3P:CP="CAO PSA OUR"');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
游戏页面
<hr>
用户信息：<br>
<?php

require_once './class/RenrenRestApiService.class.php';
$restApi = new RenrenRestApiService;
$session_key=$_SESSION["session_key"];
$params = array('fields'=>'uid,name,sex,birthday,mainurl,hometown_location,university_history,tinyurl,headurl','session_key'=>$session_key);
$res = $restApi->rr_post_curl('users.getInfo', $params);//curl函数发送请求
//$res = $restApi->rr_post_fopen('users.getInfo', $params);//如果你的环境无法支持curl函数，可以用基于fopen函数的该函数发送请求
//print_r($res);//输出返回的结果

$userId = $res[0]["uid"];
$username = $res[0]["name"];
$birthday = $res[0]["birthday"];
$tinyurl = $res[0]["tinyurl"];
$sex = $res[0]["sex"];
$headurl = $res[0]["headurl"];
$mainurl = $res[0]["mainurl"];
echo "userId:".$userId.'<br>';
echo "username:".$username.'<br>';
echo "sex:".$sex.'<br>';
echo "birthday:".$birthday.'<br>';
echo "tinyurl:".$tinyurl.'<br>';
echo "headurl:".$headurl.'<br>';
echo "mainurl:".$mainurl.'<br>';
		if(true)//如果userId已经存在
		{
			//直接取出对应的app用户信息
		}
		else
		{
			//在app的系统中注册相关信息
		}
?>
<hr>
<img src="<?=$tinyurl?>">
<hr>
人人API(基于APP)：<br>
<a  href="./api/feed.php" >API同步新鲜事</a><br>
<a  href="./api/photo.php" >上传照片</a><br>
<hr>
人人分享（不基于APP）：<br>
<hr>
<a  href="./share/share.html" >人人分享</a><br>
人人喜欢（不基于APP）：<br>
<a  href="./share/like.html" >人人喜欢</a><br>
<hr>
人人Dialog（基于APP）：<br>
<a  href="./dialog/feedDialog.php" >弹出新鲜事弹层</a><br>
<a  href="./dialog/requestDialog.php" >弹出邀请好友弹层</a>
</body>
</html>