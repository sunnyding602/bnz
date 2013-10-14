<?php
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
require_once(SITE_ROOT_PATH.'header.php'); 
?>
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
  your dream,but others. let them dream of being you.
  
  <br /><br />
  <strong>这个网站是干什么的?</strong><br />
  <br />
  这个网站的名称是Muscle training Website(目前域名会是bunengzhai.cn),顾名思义也就是帮助你坚持不懈的进行锻炼<br />
  目前支持以下一些项目的数据统计: 单杠的引体向上(正手/反手),单杠的前翻(就是许三多做的那个),俯卧撑,仰卧起坐<br />
  想要进行数据统计自然必须注册为会员,步骤为注册==>验证==>验证成功后用初始密码登录<br /><br />
  <strong>一点点声明!</strong><br />
  <br />
  这个网站无法判断你每天锻炼强度的真实性,这个也是目前没有办法解决的问题.所以只有希望每位队员记录下自己<br />
  实的信息<br /><br />
  <strong>关于拉杠小分队</strong><br />
  <br />
  偶高三第一学期末,此分队萌芽,第二学期此分队开始组成.最初的人员组成为,muscle(captian),特,嘴,小新,吉吉<br />
  大家都坚持了一学期,但是现在不知道到你们是否在坚持.希望这个网站能激励大家继续拉杠<br />
  关于这个名字...是我们嘴嘴同学想出来的~<br /><br />
  <strong>关于初始密码</strong><br />
  <br />
  功能更新很多了~~这个已经不必要看了~~,我们不显示队员的用户ID,只显示昵称.所以不用担心你账户安全<br /><br />
  <strong>关于上传头像</strong><br />
  <br />
  目前支持200K以下的头像上传.支持格式为jpg/gif,<br /><br />
  <strong>关于我</strong><br />
  <br />
  想要与我联系的话可以发邮件到sunnyding602#gmail.com<br />
  
  
  <br />
  
  
  
  
  
  
  <hr size="1"/>
  <?php require('footer.php'); ?>
</div>
</body>


</html>
