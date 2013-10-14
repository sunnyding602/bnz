<?php $message = ''; require_once('includes/initialize.php') ?>
<?php require_once('header.php'); ?>


<title>修改个人信息</title>
</head>

<body>
<div class="content">
  <?php require_once('login.php'); ?>
  <?php require_once('navigation.php'); ?>
  <h2>change your imformation</h2>
  <hr size="1"/>
  you won't be the world's strongest man,this website will never change 
  your dream,but others. let them dream of being you.<br /><br />
  <?php 
if( isset($_POST['password_submit']) && isset($_SESSION['user_id']) ){
	if( !empty($_POST['user_nickname']) && !empty($_POST['user_email']) ){
		if( strlen($_POST['user_email'])>10 ){
			$user_id = $_SESSION['user_id'];
			$user_nickname = $_POST['user_nickname'];
			$user_email = $_POST['user_email'];
			
			$database = new Database();
			$database->open_connection();
			$sql = "UPDATE user_info SET user_nickname = '$user_nickname' , ".
					" user_email = '$user_email' ".
					" WHERE user_id = '$user_id' LIMIT 1";
			$database->query($sql);
			$database->close_connection();
			$message = '修改成功';
			}else $message = '请输入正确电子邮件地址';
		}else $message = '请输入完整信息';
	}



echo output_message($message);
if( isset($_SESSION['user_id']) ){
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="passwordchange" id="passwordchange">';
	echo '<label for="textfield">登录名</label>';
	echo '<input name="user_id" type="text" value="' . $_SESSION['user_id'] . '" readonly="true"  id="textfield"><br /><br />';
	echo '<label for="textfield">昵称</label>';
	echo '<input name="user_nickname" type="text" value="' . $_SESSION['user_nickname'] . '"  id="textfield"><br /><br />';
	echo '<label for="textfield">电子邮件</label>';
	echo '<input name="user_email" type="text" id="textfield"><br /><br />';
	//echo '<label for="textfield">密码提示问题</label>';
	//echo '<input name="user_password_question" type="text" id="textfield"><br /><br />';
	//echo '<label for="textfield">答案</label>';
	//echo '<input name="user_password_answer" type="text" id="textfield"><br /><br />';
	echo '<input name="password_submit" type="submit" value="确认修改">';
	echo '</form>';
}
else $message = '请登陆';
?>
  <hr size="1"/>	
  
  
  
  
  <?php require('footer.php'); ?>
  
</div>

</body>


</html>