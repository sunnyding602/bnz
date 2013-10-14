<?php
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
	if( isset($_POST['submit_tijiao']) ){
		$user_pass_phrase = sha1($_POST['verify']);
		if ( ( $_SESSION['pass_phrase'] == $user_pass_phrase ) && !empty($_POST['user_id1']) && !empty($_POST['user_nickname1'])&&
			!empty($_POST['user_password1']) && !empty($_POST['user_password2']) && !empty($_POST['user_email'])  ) {
			$user_id1 = $_POST['user_id1'] ;
			$user_nickname1 = $_POST['user_nickname1'];
			if( $_POST['user_password1'] != $_POST['user_password2'] ){
				$_SESSION['message'] = '两次密码不一致';
				redirect_to('zhuce.php');
				}else{
					$user_password = sha1($_POST['user_password1']);
					}
					
			$user_email = $_POST['user_email'];
			//链接数据库检查 是否有用户名相同的用户
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			mysqli_query($dbc,"SET NAMES 'utf8'");
			$data_tijiao1 = "SELECT * FROM user_info WHERE user_id = '$user_id1' "; 
			$results_tijiao1 = mysqli_query($dbc, $data_tijiao1);
			if ( !( mysqli_num_rows($results_tijiao1) ) ){
				$data_tijiao2 = "INSERT INTO zhuce_before (id, app_id, app_nickname, app_password, app_email, app_time, apped_time, approval)".
				" VALUES( NULL, '$user_id1', '$user_nickname1', '$user_password', '$user_email', NOW(), 0, 0 )";
				mysqli_query($dbc, $data_tijiao2);
				
				mysqli_close($dbc);
				$_SESSION['message'] = '提交成功,请关注<strong><a href src="yanzheng.php">验证</a></strong>页面, 通过验证后请使用<strong>登陆名</strong>和您自己的<strong>密码</strong>登陆并及时上传自己的头像';
				//send mail
				require_once('mail/sendmail2.php');
				
				redirect_to('zhuce.php');
				}else{$_SESSION['message'] = '登陆名已被注册.';
					redirect_to('zhuce.php');
					}
		
		}else{$_SESSION['message'] = '验证码为空或者输入信息有误.';
			redirect_to('zhuce.php');
			
			}
			
		
	}
?>

