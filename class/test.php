<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TEST</title>
</head>

<body>
<?php

	define('DB_USER','root');
	define('DB_HOST','localhost');
	define('DB_PASSWORD','123456');
	define('DB_NAME','bar_teamtest');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");
//require("include/webconfig.php");//加载数据库配置文件


require('../class/page.class.php');//加载类文件

$sql="select * from tieba_content";
$queryc=mysqli_query($dbc,$sql);
$nums=mysqli_num_rows($queryc);

$each_disNums=10;
$sub_pages=5;
$pageNums = ceil($nums/$each_disNums);
$subPage_link="test.php?page=";
$subPage_type=2;//为1时,显示结果1,为2时,显示结果2

$current_page=$_GET['page']!=""?$_GET['page']:1;

$sikp = ($current_page-1)*$each_disNums;

$sql="select * from tieba_content limit $sikp,$each_disNums";
$query=mysqli_query($dbc,$sql);
while($row=mysqli_fetch_array($query)){
echo $row['content_neirong']."<br>";
}

$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);

?>

</body>
</html>
