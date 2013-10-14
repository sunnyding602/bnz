<?php session_start(); ?>
<?php require_once('header.php'); ?>
<?php require_once('connectvars.php') ?>
<?php $title = 'The Muscle Training Website'; ?>
<title><?php echo $title; ?></title>
</head>

<body>
<div class="content">
  <?php require_once('login.php'); ?>
  <?php require_once('navigation.php'); ?>
  <h1>Muscle training Website</h1>
  <h2>your level in the real world</h2>
  <hr size="1"/>
  you won't be the world's strongest man,this website will never change 
  your dream,but others. let them dream of being you.<br /><br />
  <?php
	if( isset($_SESSION['user_id']) &&  $_SESSION['user_id'] == 'sunny' ){
		if( isset($_POST['submit_fix'])  && !empty($_POST['theme']) && !empty($_POST['content']) ){
			$theme = $_POST['theme'];
			$content = $_POST['content'];
			$user_nickname = $_SESSION['user_nickname'];
			//connect to the database
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			mysqli_query($dbc,"SET NAMES 'utf8'");
			if( isset($_POST['id']) ) $id = $_POST['id'];
			else $id = -1;
			$query_announcement = "UPDATE announcement SET theme = '$theme' , content = '$content', time_at=NOW() ".
			"WHERE id = '$id'";
			mysqli_query($dbc, $query_announcement);
			mysqli_close($dbc);
			if($id == -1) echo '添加由于id='.$id .'错误<br />';
			else echo '修改成功<br />';
		}
		else{
			if( isset($_POST['submit_fix']) ) echo '修改失败,可能是由于内容为空所致.';
			else echo'';
		}
	}
	else{
	echo '不是管理员请自觉忽略次页面,谢谢合作.';
	}

?>
  <?php
if( isset($_GET['id']) ){ 
	$id = $_GET['id'];	
	
	//connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_query($dbc,"SET NAMES 'utf8'");
	//显示原先已有内容
	$query_fix =  "SELECT * FROM announcement WHERE id = '$id'";
	$result_fix = mysqli_query($dbc,$query_fix);
	$row_fix = mysqli_fetch_array($result_fix);
	
	$theme0 = $row_fix['theme'];
	$content0 = $row_fix['content'];
	
	mysqli_close($dbc);
}
?>
  <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="textfield">Theme</label>
    <input name="theme" type="text" id="textfield" size="50"  value="<?php if(isset($theme0)) echo $theme0;?>"/>
    <br /><br />
    content:<br />
    <textarea name="content" cols="80" rows="10" id="textarea"><?php if(isset($content0)) echo $content0;?>
  </textarea><br /><br />
    <input name="submit_fix" type="submit" id="submit" value="修改公告" />
    <input name="id" type="hidden" value="<?php if(isset($id)) echo $id;?>">
  </form>
  
  
  
  
  <hr size="1"/>
  
  <?php require('footer.php'); ?>
</div>
</body>


</html>