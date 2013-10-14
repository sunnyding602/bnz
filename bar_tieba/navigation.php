
BETA VERISON 9.9|
<a href="../index.php" target="_blank">首页</a>|
<?php 
if( !isset($_SESSION['user_id']) ){
echo '<a href="../zhuce.php" target="_blank">用户注册</a>|';
echo '<a href="../yanzheng.php" target="_blank">验证页面</a>|';
}

?>



<?php 
 if( isset($_SESSION['user_info_id']) ){
	 $user_info_id = $_SESSION['user_info_id'];
	echo '<a href="http://bunengzhai.cn/changeinfo.php?user_info_id='.$user_info_id.'" target="_blank">个人中心</a>|';
 }
?>

<a href="../user_statistics_1.php" target="_blank">每日数据统计</a>|

<a href="index1.php" target="_blank">小分队贴吧</a><a href="../about.php" target="_blank">|<strong>About</strong></a><strong></strong>| 在线人数: <strong><?php require('../onlinetotals.php');?></strong>

