<?php
	session_start();
	require_once('connectvars.php');
	if( isset($_POST['submit_email']) ){
		$user_pass_phrase = sha1($_POST['verify']);
		$subject = '有用户想注册MT';
		$user_id1 = $_POST['user_id1'] ;
		$user_nickname1 = $_POST['user_nickname1'];
		//链接数据库检查 是否有用户名相同的用户
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		mysqli_query($dbc,"SET NAMES 'utf8'");
		$data_mail = "SELECT * FROM user_info WHERE user_id = '$user_id1' "; 
		$results_email = mysqli_query($dbc, $data_mail);
		if ( !( mysqli_num_rows($results_email) ) ){
		
		
		
		$content = '登录名:'.$_POST['user_id1'] . '<br/>昵称:'. $_POST['user_nickname1'];
			if ( $_SESSION['pass_phrase'] == $user_pass_phrase && !empty($user_id1) && !empty($user_nickname1) ) {
			require_once("phpmailer/class.phpmailer1.php");
			
						function smtp_mail ( $sendto_email, $subject, $body, $extra_hdrs, $user_name) {
			$mail = new PHPMailer(); 
			$mail->IsSMTP();                // send via SMTP 
			$mail->Host = "smtp.sina.com"; // SMTP servers 
			$mail->SMTPAuth = true;         // turn on SMTP authentication 
			$mail->Username = "sunnyding602";   // SMTP username  注意：普通邮件认证不需要加 @域名
			$mail->Password = "williamsunny";        // SMTP password 
			$mail->From = "sunnyding602@sina.com";      // 发件人邮箱
			$mail->FromName = "MT User";  // 发件人
			
			$mail->CharSet = "utf-8";            // 这里指定字符集！
			$mail->Encoding = "base64"; 
			$mail->AddAddress($sendto_email,"sunnyding602");  // 收件人邮箱和姓名
			$mail->AddReplyTo("yourmail@cgsir.com","cgsir.com"); 
			//$mail->WordWrap = 50; // set word wrap 
			//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment 
			//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); 
			$mail->IsHTML(true);  // send as HTML 
					// 邮件主题
			$mail->Subject = $subject;
			// 邮件内容 
			$mail->Body =$body; //+上了 $name                                                      
			$mail->AltBody ="text/html"; 
			if(!$mail->Send()) 
				{ 
			  echo "邮件发送有误 <p>"; 
			  echo "邮件错误信息: " . $mail->ErrorInfo; 
			  exit; 
				} 
			else {
			  echo "$user_name 邮件发送成功!<br />"; 
				}
			}

			$email='sunnyding602@gmail.com';
	

			//参数说明(发送到, 邮件主题, 邮件内容, 附加信息, 用户名)
			smtp_mail($email, $subject, $content, '', $user_nickname1);
			
			echo '你已向管理员成功发送邮件,请等待一段时间申请的<strong>登录名</strong> 和 本站初始密码<strong>123456</strong>登陆并及时修改您的密码';
			}
			else{
			echo '验证码为空或者输入信息有误.';
			}
			
			
		}else{
			echo '登录名或昵称重复';
		}
			
	}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="textfield">登录名</label>
	<input name="user_id1" type="text" id="textfield" >
	<br /> <br />
	<label for="textfield">昵称</label>
	<input name="user_nickname1" type="text" id="textfield">
	<br /> <br />
	<label for="textfield">验证码</label>
	<input name="verify" type="text" id="textfield" size="6" />
	<img src="captcha.php" alt="Verification pass-phrase" />
	<br /> <br />
	<input name="submit_email" type="submit" value="注册">
	<input name="reset" type="reset" value="重置">
</form>