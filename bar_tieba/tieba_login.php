<?php
  // If the session vars aren't set, try to set them with a cookie
 /* if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_nickname']) && isset($_COOKIE['user_info_id']) ) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['user_info_id'] = $_COOKIE['user_info_id'];
      $_SESSION['user_nickname'] = $_COOKIE['user_nickname'];
    }
  }*/
  if( isset($_SESSION['user_id']) ){
		  echo '<a href="../passwordchange.php"><strong>' .$_SESSION['user_id']. '</strong></a> | ' .'<a href="logout.php">退出</a>';
  }
  else{
  if( !isset($_SESSION['user_id']) && isset($_POST['submit_login']) ){
        // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['user_password']));
	  $user_password  = sha1($user_password );
	  $query = "SELECT user_id, user_info_id, user_nickname FROM user_info WHERE user_id = '$user_id' AND user_password = '$user_password'";
      mysqli_query($dbc,"SET NAMES 'utf8'");
	  $data = mysqli_query($dbc, $query);
        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          
		  $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
		  $_SESSION['user_info_id'] = $row['user_info_id'];
          $_SESSION['user_nickname'] = $row['user_nickname'];
         /* setcookie('user_id', $row['user_id'], time() + 1800);    // expires in 30 min
          setcookie('user_info_id', $row['user_info_id'], time() + 1800);
          setcookie('user_nickname', $row['user_nickname'], time() + 1800);  // expires in 30 min*/
		  echo '<a href="../passwordchange.php"><strong>' .$_SESSION['user_id']. '</strong></a> | ' .'<a href="logout.php">退出</a>';
		  header('Location: index1.php');
		}
		
		else{
		echo '用户名/密码错误';
		}
}

?>

<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for="textfield">登录名</label>
  <input name="user_id" type="text" id="textfield" size="10">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="textfield">密码</label>
  <input name="user_password" type="password" id="textfield" size="10">
<input name="submit_login" type="submit" value="登陆">
<?php if( !isset($_SESSION['user_id']) ) echo '<a href="zhuce.php">注册</a>|找回密码';?>
</form>

<?php
	
}
?>
