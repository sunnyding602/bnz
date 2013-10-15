<?php
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
require_once ('jishuqi.php');


$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_info = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
$user_info['screen_name'];//昵称 
$user_info['profile_image_url'];
$_SESSION['user_id'] =  $user_info['screen_name'];
$_SESSION['user_info_id'] = $user_info['screen_name'];
$_SESSION['user_nickname'] = $user_info['screen_name'];


  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_nickname']) && isset($_COOKIE['user_info_id']) ) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
	  $_SESSION['user_info_id'] = $_COOKIE['user_info_id'];
      $_SESSION['user_nickname'] = $_COOKIE['user_nickname'];
    }
  }

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>不能宅.CN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <style>

    /* GLOBAL STYLES
    -------------------------------------------------- */
    /* Padding below the footer and lighter body text */

    body {
      padding-bottom: 40px;
      color: #5a5a5a;
    }



    /* CUSTOMIZE THE NAVBAR
    -------------------------------------------------- */

    /* Special class on .container surrounding .navbar, used for positioning it into place. */
    .navbar-wrapper {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 10;
      margin-top: 20px;
      margin-bottom: -90px; /* Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
    }
    .navbar-wrapper .navbar {

    }

    /* Remove border and change up box shadow for more contrast */
    .navbar .navbar-inner {
      border: 0;
      -webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25);
         -moz-box-shadow: 0 2px 10px rgba(0,0,0,.25);
              box-shadow: 0 2px 10px rgba(0,0,0,.25);
    }

    /* Downsize the brand/project name a bit */
    .navbar .brand {
      padding: 14px 20px 16px; /* Increase vertical padding to match navbar links */
      font-size: 16px;
      font-weight: bold;
      text-shadow: 0 -1px 0 rgba(0,0,0,.5);
    }

    /* Navbar links: increase padding for taller navbar */
    .navbar .nav > li > a {
      padding: 15px 20px;
    }

    /* Offset the responsive button for proper vertical alignment */
    .navbar .btn-navbar {
      margin-top: 10px;
    }



    /* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */

    /* Carousel base class */
    .carousel {
      margin-bottom: 60px;
    }

    .carousel .container {
      position: relative;
      z-index: 9;
    }

    .carousel-control {
      height: 80px;
      margin-top: 0;
      font-size: 120px;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      background-color: transparent;
      border: 0;
      z-index: 10;
    }

    .carousel .item {
      height: 500px;
    }
    .carousel img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 500px;
    }

    .carousel-caption {
      background-color: transparent;
      position: static;
      max-width: 550px;
      padding: 0 20px;
      margin-top: 200px;
    }
    .carousel-caption h1,
    .carousel-caption .lead {
      margin: 0;
      line-height: 1.25;
      color: #fff;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
    }
    .carousel-caption .btn {
      margin-top: 10px;
    }



    /* MARKETING CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .marketing .span4 {
      text-align: center;
    }
    .marketing h2 {
      font-weight: normal;
    }
    .marketing .span4 p {
      margin-left: 10px;
      margin-right: 10px;
    }


    /* Featurettes
    ------------------------- */

    .featurette-divider {
      margin: 80px 0; /* Space out the Bootstrap <hr> more */
    }
    .featurette {
      padding-top: 120px; /* Vertically center images part 1: add padding above and below text. */
      overflow: hidden; /* Vertically center images part 2: clear their floats. */
    }
    .featurette-image {
      margin-top: -120px; /* Vertically center images part 3: negative margin up the image the same amount of the padding to center it. */
    }

    /* Give some space on the sides of the floated elements so text doesn't run right into it. */
    .featurette-image.pull-left {
      margin-right: 40px;
    }
    .featurette-image.pull-right {
      margin-left: 40px;
    }

    /* Thin out the marketing headings */
    .featurette-heading {
      font-size: 50px;
      font-weight: 300;
      line-height: 1;
      letter-spacing: -1px;
    }



    /* RESPONSIVE CSS
    -------------------------------------------------- */

    @media (max-width: 979px) {

      .container.navbar-wrapper {
        margin-bottom: 0;
        width: auto;
      }
      .navbar-inner {
        border-radius: 0;
        margin: -20px 0;
      }

      .carousel .item {
        height: 500px;
      }
      .carousel img {
        width: auto;
        height: 500px;
      }

      .featurette {
        height: auto;
        padding: 0;
      }
      .featurette-image.pull-left,
      .featurette-image.pull-right {
        display: block;
        float: none;
        max-width: 40%;
        margin: 0 auto 20px;
      }
    }


    @media (max-width: 767px) {

      .navbar-inner {
        margin: -20px;
      }

      .carousel {
        margin-left: -20px;
        margin-right: -20px;
      }
      .carousel .container {

      }
      .carousel .item {
        height: 300px;
      }
      .carousel img {
        height: 300px;
      }
      .carousel-caption {
        width: 65%;
        padding: 0 70px;
        margin-top: 100px;
      }
      .carousel-caption h1 {
        font-size: 30px;
      }
      .carousel-caption .lead,
      .carousel-caption .btn {
        font-size: 18px;
      }

      .marketing .span4 + .span4 {
        margin-top: 40px;
      }

      .featurette-heading {
        font-size: 30px;
      }
      .featurette .lead {
        font-size: 18px;
        line-height: 1.5;
      }

    }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="http://www.bunengzhai.cn">不能宅.CN</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">首页</a></li>
              <li><a href="bar_tieba/index1.php" target="_blank">小分队贴吧</a></li>
              <li><a href="about.php" target="_blank">关于</a></li> 
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">更多<b class="caret"></b></a>
                <ul class="dropdown-menu">
<?php 
if( !isset($_SESSION['user_id']) ){
                echo '<li><a href="zhuce.php" target="_blank">用户注册</a></li>';
                echo '<li><a href="yanzheng.php" target="_blank">验证页面</a></li>';
}
if( isset($_SESSION['user_info_id']) ){
    $user_info_id = $_SESSION['user_info_id'];
                echo '<li><a href="changeinfo.php?user_info_id='.$user_info_id.'" target="_blank">个人中心</a></li>';
}
?>
              <li><a href="user_statistics_1.php" >每日数据统计</a></li>
                </ul>
              </li>
            </ul>
<!-- start login form-->
<form class="navbar-form pull-right" name="form1" method="post" action="login_index.php">
<?php

    if(false == isset($_SESSION['user_id'])){
        //上面是如果登陆之后.... 登陆逻辑如此奇葩..赶紧改吧     如果没有登陆
        echo '
            <input name="user_id" class="span2" type="text" placeholder="用户名">
            <input name="user_password" class="span2" type="password" placeholder="密码">
            <button name="submit_login" type="submit" class="btn">登陆</button>
            
            <a href="'.$code_url.'"><img src="http://www.bunengzhai.cn/libweibo/weibo_login.png" alt="使用微博登陆" style="width:150px" /></a>

            ';
    }else{
        echo '<img src="'.$user_info['profile_image_url'].'" alt="user_image" /> <li style="display:inline"><a href="changeinfo.php"><strong>' .$_SESSION['user_id']. '</strong></a> </li> ' .'<li style="display:inline"><a href="logout.php">退出</a></li>';
    }
?>
</form> 
<!-- /.login form-->
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <img src="http://getbootstrap.com/2.3.2/assets/img/examples/slide-01.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Welcome to Bunengzhai.CN</h1>
              <p class="lead">You won't be the world's strongest man,this website will never change your dream,but others. let they dream of being you.</p>
              <a class="btn btn-large btn-primary" href="zhuce.php">Sign up today</a>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="http://getbootstrap.com/2.3.2/assets/img/examples/slide-02.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Your level in the Real World</h1>
              <p class="lead">The level here is a reflection of you in the reality!</p>
              <a class="btn btn-large btn-primary" href="#">Learn more</a>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="http://getbootstrap.com/2.3.2/assets/img/examples/slide-03.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Perseverence.</h1>
              <p class="lead">Hey, there. I know it is hard to persist, but we are doing the same thing. Just keep at it and don't give up.</p>
              <a class="btn btn-large btn-primary" href="#">Never give up</a>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->

    <div class="container marketing">
   <?php $weekrank = '?rank=week'; 
   		$totalrank = '?rank=total'; 
   ?>
   <br />
  <strong><a href="<?php echo $weekrank?>">查看周排行</a></strong> |
  <strong><a href="<?php echo $totalrank?>">查看总排行</a></strong>
  <?php

// Connect to the database
$dbc = mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
mysqli_query ( $dbc, "SET NAMES 'utf8'" );




if(isset($_GET['rank'])){
	if($_GET['rank'] == 'week')
	require_once ('ranklistweek.php');
	if($_GET['rank'] == 'total')
	require_once ('ranklist.php');
}else{
		if(isset($_COOKIE['rank'])){
			if($_COOKIE['rank'] == 'week')
			require_once ('ranklistweek.php');
			if($_COOKIE['rank'] == 'total')
			require_once ('ranklist.php');
		}else{
			require_once ('ranklist.php');
			}		
}

		

require_once ('announcement.php');

?>
  <?php
	require_once ('showhottie.php');
	?>
  <hr size="1" />	
  <?php
	require_once ('onlineusers.php')?>
    在线人数:<?php require('onlinetotals.php');?>
<?php
    @mysqli_close ( $dbc );
?>
      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; <?=date('Y')?> 不能宅.CN  &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
</body>
</html>
