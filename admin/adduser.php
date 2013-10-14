<?php 
require_once('../includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
 require_once(SITE_ROOT_PATH.'header.php'); ?>
<?php $title = 'The Register Page Of Bar Team'; ?>
<title><?php echo $title; ?></title>
</head>

<body>
<?php require_once(SITE_ROOT_PATH.'login.php'); ?>

<tr>
	<td>
	<h1>The Register Page Of Bar Team</h1>
	<hr />
	<?php
		if(  isset($_POST['submit']) && isset($_SESSION['user_id']) ){
			if( ($_SESSION['user_id'] == 'sunny') ){
				$user_id = $_POST['user_id'];
				$user_nickname = $_POST['user_nickname'];
				$user_password1 = $_POST['user_password1'];
				$user_password2 = $_POST['user_password2'];
				if( $user_password1 == $user_password2){
					$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
					$user_password1 = sha1($user_password1);
					$query = "INSERT INTO user_info".
					"(user_info_id, user_id, user_nickname, user_password)".
					"VALUES(NULL, '$user_id', '$user_nickname', '$user_password1')";
					mysqli_query($dbc,"SET NAMES 'utf8'");
					$result = mysqli_query($dbc, $query);
					mysqli_close($dbc);
					echo '添加用户成功.<br />';
				}
				else{
				echo '请保持两次密码一致.<br />';
				}
			}
			else{
			echo '你不是管理员.';
			}
		}
else{
echo '此页面只有管理员才可以看,不是请自觉忽略,谢谢合作.';
}

	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	  <label for="textfield">登录名</label>
  <input name="user_id" type="text" id="textfield" >
 <br /> <br />
    <label for="textfield">昵称</label>
  <input name="user_nickname" type="text" id="textfield">
   <br /> <br />
    <label for="textfield">登陆密码</label>
  <input name="user_password1" type="password" id="textfield">
       <br /> <br />
	  <label for="textfield">重复密码</label>
  <input name="user_password2" type="password" id="textfield">
  <br /> <br />
  <input name="submit" type="submit" value="注册">
  <input name="reset" type="reset" value="重置">
	</form>
		</td>
		
		<?php require_once(SITE_ROOT_PATH.'navigation.php'); ?>
		
	</tr>
</table>
</body>
</html>
