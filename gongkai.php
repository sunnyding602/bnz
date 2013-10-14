<?php
require_once('includes/initialize.php');

if($_SESSION['user_info_id'] == $_GET['user_info_id']){
	$user_info_id = $_SESSION['user_info_id'];
	$database = new Database();
	$database->open_connection();
	$sql = "UPDATE user_info SET yin_si = 1 WHERE user_info_id = '$user_info_id'";
	$database->query($sql);
	$_SESSION['message'] = '隐私设置为公开成功';
	$database->close_connection();
	redirect_to('changeinfo.php?user_info_id='.$user_info_id);
}
?>