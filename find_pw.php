<?php $message ='';?>
<?php
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
require_once(SITE_ROOT_PATH.'header.php'); 
?>
<?php $title = '找回密码'; ?>
<title><?php echo $title; ?></title>
</head>

<body>
<div class="content">
  <?php require_once(SITE_ROOT_PATH.'login.php'); ?>
  <?php require_once(SITE_ROOT_PATH.'navigation.php'); ?>
  <h1>Muscle training Website</h1>
  <h2>your level in the real world</h2>
  <hr size="1"/>
  you won't be the world's strongest man,this website will never change 
  your dream,but others. let them dream of being you.<br /><br />
  <strong>请提交你的登陆名,和电子邮件地址,我们将会以邮件告知您 密码信息,以最新邮件为准!请勿多次重复提交</strong><br />	
  <?php
  	if( isset($_POST['submit_email']) ){
		$user_pass_phrase = sha1($_POST['verify']);
		if ( ( $_SESSION['pass_phrase'] == $user_pass_phrase ) && !empty($_POST['user_id']) && !empty($_POST['user_email']) ){
		$user_id = $_POST['user_id'];
		$user_email = $_POST['user_email'];
		
		$database = new Database();
		$database->open_connection();
		$sql = "SELECT * FROM user_info WHERE user_id ='$user_id' AND user_email = '$user_email' ";
		
		if( $database->affected_rows($sql) == 1){
			$pw = '';
			  for ($i = 0; $i < 6; $i++) {
   			  $pw .= chr(rand(97, 122));
  			  }
				$pw_hashed = sha1($pw);
			 //send mail
			require_once('mail/sendmail3.php');
			
			$sql = "UPDATE user_info SET user_password = '$pw_hashed' WHERE user_id ='$user_id' AND user_email = '$user_email' ";
			$database->query($sql);
			
			$database->close_connection();
			$message = '邮件已发送,请检查您的邮箱,切勿重复刷新本页面';
			}else{
				$message = '输入信息不匹配';
				}
			
		}else $message = '请保持信息完整正确';
  
	}
  ?>
  <?php echo output_message($message); ?>
<form action="<?=SITE_ROOT_URL?>find_pw.php" method="post" >
	
	<label for="textfield">登录名</label>
	<input name="user_id" type="text" id="textfield" >
	<br /> <br />
    <label for="textfield">电子邮件</label>
	<input name="user_email" type="text" id="textfield">
    <br /> <br />
	<label for="textfield">验证码</label>
	<input name="verify" type="text" id="textfield" size="6" />
	

	<img name="img1" src="captcha.php" alt="Verification pass-phrase" style="cursor : pointer;" onClick="this.src='captcha.php?t='+(new Date()).getTime();''">
	<br /> <br />
	<input name="submit_email" type="submit" value="提交">
	<input name="reset" type="reset" value="重置">
</form>
  <hr size="1"/>
  <?php require('footer.php'); ?>
</div>
</body>


</html>
