<?php require_once('includes/initialize.php') ?>
<?php require_once('header.php'); ?>

<?php $title = 'Your Information'; ?>
<title><?php echo $title; ?></title>
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
	if( $_POST['user_password_old'] && $_POST['user_password_new1'] && $_POST['user_password_new2']  
	&&  $_POST['user_nickname']){
		$user_id = $_SESSION['user_id'];
		$user_nickname = $_POST['user_nickname'];
		//echo $user_nickname;
		$user_password_old = $_POST['user_password_old'];
		$user_password_new1 = $_POST['user_password_new1'];
		$user_password_new2 = $_POST['user_password_new2'];
		
		$user_password_old = sha1($user_password_old);
		if( $user_password_new1 == $user_password_new2 ){
			//密码确认无误,加密密码
			$user_password_hashed = sha1($user_password_new1);
			//链接数据库检查原来密码是否正确
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			mysqli_query($dbc,"SET NAMES 'utf8'");
			$query = "SELECT * FROM user_info WHERE user_id = '$user_id' AND user_password = '$user_password_old'";
			
			$results = mysqli_query($dbc, $query);
			
			if( mysqli_num_rows($results) == 1 ){
				//原来密码正确,为用户更改信息
				
				$querychange = "UPDATE user_info SET user_nickname = '$user_nickname' , ".
				" user_password = '$user_password_hashed' ".
				" WHERE user_id = '$user_id' AND user_password = '$user_password_old'";
				mysqli_query($dbc, $querychange);
				mysqli_close($dbc);
				echo '个人信息修改成功,请重新登陆以便看到最新信息.';
				
			}
			else{
				echo '旧密码输入错误,请核对';
			
			}
		 
		}
		else{
		echo '两次密码输入不一致.';
		}
	
	}
	else{
	echo '请确认信息完整.';
	}
	
}




if( isset($_SESSION['user_id']) ){
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="passwordchange" id="passwordchange">';
	echo '<label for="textfield">登录名</label>';
	echo '<input name="user_id" type="text" value="' . $_SESSION['user_id'] . '" readonly="true"  id="textfield"><br /><br />';
	echo '<label for="textfield">昵称</label>';
	echo '<input name="user_nickname" type="text" value="' . $_SESSION['user_nickname'] . '"  id="textfield"><br /><br />';
	echo '<label for="textfield">旧密码</label>';
	echo '<input name="user_password_old" type="password" id="textfield"><br /><br />';
	echo '<label for="textfield">新密码</label>';
	echo '<input name="user_password_new1" type="password" id="textfield"><br /><br />';
	echo '<label for="textfield">请重复</label>';
	echo '<input name="user_password_new2" type="password" id="textfield"><br /><br />';
	echo '<input name="password_submit" type="submit" value="确认修改">';
	echo '</form>';
}
else{
	echo '请登录';
}
?>
  <hr size="1"/>	
  
  
  
  
  <?php require('footer.php'); ?>
  
</div>
</body>


</html>