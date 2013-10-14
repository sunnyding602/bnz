<?php 
require_once('../includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
require_once(SITE_ROOT_PATH.'header.php'); ?>
<?php $title = 'The Muscle Training Website'; ?>
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
<?php
if( isset($_SESSION['user_id']) &&  $_SESSION['user_id'] == 'sunny' ){
    if( isset($_POST['submit_add'])  && !empty($_POST['theme']) && !empty($_POST['content']) ){
        $theme = $_POST['theme'];
        $content = $_POST['content'];
        $user_nickname = $_SESSION['user_nickname'];
        //connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        mysqli_query($dbc,"SET NAMES 'utf8'");
        $query_announcement = "INSERT INTO announcement (id, user_nickname, theme, content, time_at) ".
            "VALUES(NULL, '$user_nickname', '$theme', '$content', NOW())";
        mysqli_query($dbc, $query_announcement);
        mysqli_close($dbc);
        echo '添加成功<br />';
    }
    else{
        if( isset($_POST['submit_add']) ) echo '添加失败,可能是由于内容为空所致.';
        else echo'';
    }
}
else{
    echo '不是管理员请自觉忽略次页面,谢谢合作.';
}
?>
  <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="textfield">Theme</label>
    <input name="theme" type="text" id="textfield" size="50" />
    <br /><br />
    content:<br />
    <textarea name="content" cols="80" rows="10" id="textarea"></textarea><br /><br />
    <input name="submit_add" type="submit" id="submit" value="添加公告" />
  </form>

  <hr size="1"/>

  <?php require_once(SITE_ROOT_PATH.'footer.php'); ?>
</div>
</body>


</html>
