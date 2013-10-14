<?php 
require_once '../includes/initialize.php';
//先预设下用户名和密码,以免到时候他说undefined variable
$username='';
$password='';
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	}


if ($result_array = $user->authenticate ( $username, $password ) ) {
	//echo $result_array['user_id'];
	$session->remove_error_message();
	$session->login($username);
	$_SESSION['user_info_id'] = $result_array['user_info_id'];
	$_SESSION['user_nickname'] = $result_array['user_nickname'];
	$_SESSION['user_total_circle'] = $result_array['user_total_circle'];
	$_SESSION['user_total_bar'] = $result_array['user_total_bar'];
	$_SESSION['user_rank'] = $result_array['user_rank'];
	redirect_to('record_data.php');
	
	print_r ( $result_array );
} else {
	$session->set_error_message('用户名,密码错误');
	
	redirect_to('index.php');
}
?>