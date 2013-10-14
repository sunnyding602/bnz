<?php require_once('includes/initialize.php'); ?>
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
   <br />头像目前已支持所有名称命名,如果你的头像上传成功而无法正常显示请检查图片格式是否为gif/jpg,头像显示为100X100像素

  <?php



$user_info_id = -1; //用户没有登陆,这个值将使用户无法上传头像

if( isset($_SESSION['user_id']) ){
						$user_info_id = $_SESSION['user_info_id'];
						$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
						mysqli_query($dbc,"SET NAMES 'utf8'");
						$query_touxiang = "SELECT * FROM user_touxiang WHERE user_info_id = '$user_info_id'";
						$result_touxiang = mysqli_query($dbc, $query_touxiang);
						$row_touxiang = mysqli_fetch_array($result_touxiang );
						if(!empty($row_touxiang )) {//如果用户有头像则显示
						$touxiang_name1 = $row_touxiang['touxiang_name'];
						//echo '目前头像: ';
						echo '<img src="'. TX_UPLOADPATH.$touxiang_name1.'" width="100" height="100" />'; echo '<br />';
						}else {
						//echo '目前头像: ';
						echo '<img src="'. TX_UPLOADPATH.'default.jpg" width="100" height="100" />'; echo '<br />';
						}
						
if( isset($_POST['submit_touxiang']) ){
		$user_pass_phrase = sha1($_POST['verify']);
		if ( $_SESSION['pass_phrase'] == $user_pass_phrase ){
			//$touxiang_name = $_FILES['touxiang']['name'];
			$touxiang_type = $_FILES['touxiang']['type'];
							$image_tname = time();
			if($touxiang_type == 'image/gif') $touxiang_name = $image_tname.'.gif';
			if($touxiang_type == 'image/pjpeg')  $touxiang_name = $image_tname.'.jpg';
			else $touxiang_name = $image_tname.'.jpg';
			$touxiang_size = $_FILES['touxiang']['size']; 
			if ((($touxiang_type == 'image/gif') || ($touxiang_type == 'image/jpeg') || ($touxiang_type == 'image/pjpeg') || ($touxiang_type == 'image/png'))&& ($touxiang_size > 0) && ($touxiang_size <= TX_MAXFILESIZE)) {
				if ($_FILES['touxiang']['error'] == 0) {
					//貌似是所有都没有什么错误了,开始上传头像...
          			$target = TX_UPLOADPATH . $touxiang_name;
          			if( !file_exists(TX_UPLOADPATH.$touxiang_name) ){//文件存在则不能上传
					if (move_uploaded_file($_FILES['touxiang']['tmp_name'], $target)) {
						//下面分两种情况,1.用户已经上传过头像,2.第一次上传头像
						$query0 = "SELECT * FROM user_touxiang WHERE user_info_id = '$user_info_id'";  
						$result0 = mysqli_query($dbc, $query0);
						if( mysqli_num_rows($result0) == 1 ){//已有头像,更新图片名称 删除已有头像
							$row = mysqli_fetch_array($result0);
							$touxiang_past = $row['touxiang_name'];
							$query1 = "UPDATE user_touxiang SET touxiang_name = '$touxiang_name'".
							"WHERE user_info_id = '$user_info_id'";
							@unlink(TX_UPLOADPATH.$touxiang_past);
							mysqli_query($dbc, $query1);
							echo '头像已更新<br />';
							redirect_to($_SERVER['PHP_SELF']);
						}else{
							$query2 = "INSERT INTO user_touxiang (id, user_info_id, touxiang_name)".
							"VALUES(NULL, '$user_info_id', '$touxiang_name')";
							mysqli_query($dbc, $query2);
							echo '头像已上传<br />';
							redirect_to($_SERVER['PHP_SELF']);
						}
					
					
					}else echo '上传失败,请重试<br />';//end of move uploaded file
				 }else echo '上传失败,图片名重复,请更改<br />';//end of file_exists
				}else echo '上传失败,请重试<br />';//end of error == 0
			}else echo '上传失败,请重试,不是有效图像文件,或图片大于200k<br />';//end of image/gif
		
		}else echo '上传失败,请重试,验证码输入错误<br />';//end of verify



}//end of submit touxiang
}else echo '请登陆<br />';//end of $_SESSION['user_id']
@mysqli_close($dbc);
?>
   <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo TX_MAXFILESIZE; ?>" />
    <label for="user_id">登录名</label>
    <input type="text" id="user_id" name="user_id" readonly="true" value="<?php if( isset($_SESSION['user_id']) ) echo $_SESSION['user_id'];?>" />
    <br />
    <br />
    <label for="touxiang">上传头像</label>
    <input type="file" id="touxiang" name="touxiang" />
    <br />
    <br />
    <label for="screenshot">验证码</label>
    <input name="verify" type="text" id="verify" size="6" />
    <img src="captcha.php" alt="Verification pass-phrase" />
    <br />
    
    <input type="submit" value="上传" name="submit_touxiang" />
    </form>
  <hr size="1"/>	
  
  
  <?php require('footer.php'); ?>
  
</div>
</body>


</html>