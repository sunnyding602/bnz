
<strong>&nbsp;BETA VERISON 11.2</strong>|
<a href="<?=SITE_ROOT_URL?>index.php" >首页</a>|
<?php 
if( !isset($_SESSION['user_id']) ){
    echo '<a href="'.SITE_ROOT_URL.'zhuce.php" target="_blank">用户注册</a>|';
    echo '<a href="'.SITE_ROOT_URL.'yanzheng.php" target="_blank">验证页面</a>|';
}

?>



<?php 
 if( isset($_SESSION['user_info_id']) ){
	 $user_info_id = $_SESSION['user_info_id'];
	echo '<a href="'.SITE_ROOT_URL.'changeinfo.php?user_info_id='.$user_info_id.'" target="_blank">个人中心</a>|';
 }
?>

    <a href="<?=SITE_ROOT_URL?>user_statistics_1.php" >每日数据统计</a>|

<a href="<?=SITE_ROOT_URL?>bar_tieba/index1.php" target="_blank">小分队贴吧</a>|<strong><a href="<?=SITE_ROOT_URL?>about.php" target="_blank">About</a></strong>| 在线人数: <strong>
<?php require('onlinetotals.php');?>
</strong>
