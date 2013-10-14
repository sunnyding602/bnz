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
  <a href="adduser.php">添加用户</a><br /><br />
  <a href="addannouncement.php">添加公告</a><br /><br />
  <a href="validateuser.php" target="_blank">用户验证</a><br /><br />
  <a href="/test/test.php" target="_blank">IP记录</a><br /><br />
  
  
  
  
  <hr size="1"/>	
  
  <?php require('footer.php'); ?>
</div>
</body>


</html>
