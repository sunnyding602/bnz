<?php
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
?>
<?php if( !isset($_SESSION['user_id']) ) { echo '本功能只对注册用户开放'; exit;}?>
<?php
require_once(SITE_ROOT_PATH.'header.php'); 
?>

<?php $title = '个人中心'; ?>
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
  <br />

  <span class="boldWord">基本资料</span> 
  <?php
  if( $_SESSION['user_info_id'] == $_GET['user_info_id'] ){
  	echo '<a href="xiugaiziliao.php">修改资料</a> | ';
	echo '<a href="touxiang_upload.php">修改头像</a> | ';
	echo '<a href="passwordchange.php">修改密码</a><br /><br />';
  }
   ?>

  
  <table width="500" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120px"><?php
   

	if( !empty($_GET['user_info_id']) ){
						$user_info_id = $_GET['user_info_id'];
						$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
						mysqli_query($dbc,"SET NAMES 'utf8'");
						$query_touxiang = "SELECT * FROM user_touxiang WHERE user_info_id = '$user_info_id'";
						$result_touxiang = mysqli_query($dbc, $query_touxiang);
						$row_touxiang = mysqli_fetch_array($result_touxiang );
						if(!empty($row_touxiang )) {//如果用户有头像则显示
						$touxiang_name1 = $row_touxiang['touxiang_name'];
						//echo '目前头像: ';
						echo '<img src="'. TX_UPLOADPATH.$touxiang_name1.'" width="100" height="100" />';
						}else {
						//echo '目前头像: ';
						echo '<img src="'. TX_UPLOADPATH.'default.jpg" width="100" height="100" />'; 
						}
	}else{
		if( isset($_GET['topic_id']) ){
			
			redirect_to('bar_tieba/xianshineirong2.php?page='.$_GET['page'].'&topic_id='.$_GET['topic_id']);
			
			}
		if( isset($_GET['at_tieba']) )
		redirect_to('bar_tieba/index1.php?page='.$_GET['page']);
		else redirect_to('index.php');
		}
  
  ?> </td>
    <td >
    <?php 
	$database = new Database();
	$database->open_connection();
	$sql = "SELECT * FROM user_info where user_info_id = '$user_info_id' LIMIT 1";
	$result = mysqli_fetch_array( $database->query($sql) );
	$user_nickname = $result['user_nickname'];
	if( !empty($result['user_email']) )
	$user_email = $result['user_email'];
	else 
	$user_email = '****************';
	
	$sql_yinsi = "SELECT * FROM user_info WHERE user_info_id = $user_info_id AND yin_si = 1";
	
	$yin_si = $database->affected_rows( $sql_yinsi );
	
	$database->close_connection();
	?>
    用户昵称:<?php echo $user_nickname;?><br/><br/>
    
    电子邮件:<?php if($yin_si) echo $user_email; 
				else{
				if($_SESSION['user_nickname'] == $user_nickname) echo $user_email;	
				else echo '****************';
					} 

			?><br/><br/>
    隐私设置:<?php if($yin_si) echo '公开'; else echo '不公开';?> 
      <?php
  if( $_SESSION['user_info_id'] == $_GET['user_info_id'] ){
  	echo '(<a href="gongkai.php?user_info_id='.$user_info_id.'">公开</a> | ';
	echo '<a href="bugongkai.php?user_info_id='.$user_info_id.'">不公开</a>)';
  	}
	
	if( isset($_SESSION['message']) ) 
	echo output_message($_SESSION['message']); 
	
	$_SESSION['message']='';
   ?>
    <br/>
    
    
    </td>
  </tr>
  </table>
	<br />
  <span class="boldWord">点滴纪录</span>
	<br />
    <?php
	
if( $yin_si ){
 if( isset($_GET['user_info_id']) ){
	 // Connect to the database
	$user_info_id = $_GET['user_info_id'];
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_query($dbc,"SET NAMES 'utf8'");
	$query = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id'";
	
	
	
	$results = mysqli_query($dbc, $query);
	$_SESSION['width'] = 30+22*mysqli_num_rows($results);
	
	//----------------paiming------------------------------------------------------------------------------
	require_once('rank.php');
	//---------------------$user_total_circle $user_total_bar $user_rank --------------------------------------
	//托出所有个人记录
	echo '<br />';
	echo $user_nickname.' 个人记录 '; 
	echo '<br />';
	echo ' 已跑了'. $user_total_circle .'圈 '; 
	echo ' 拉杠总数' . $user_total_bar . '个 '; 
	echo ' 综合排名 :' .$user_rank;

	echo '<br />等级: ';
	require_once('level.php');
	echo'<br/>';
	
	$_SESSION['img_id'] = $_GET['user_info_id'];
    echo '<br />';
	?>
	<iframe src="includes/open-flash-chart-2-ichor/version-2-ichor/bar_img.php" width="765" frameborder="0" height="220" scrolling="no" marginwidth="0" marginheight="0" ></iframe>
	<?php
	echo '<table >';
	echo '<tr><th>跑圈</th><th>正手</th><th>反手</th><th>前翻</th><th>撑</th><th>俯卧撑</th><th>仰卧起坐</th><th>     your own thoughts     </th><th>日期       </th></tr>';
//分页-------------------------------------------------------------
		require('class/page.class.php');//加载类文件

		$sql="SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id'";
		$queryc=mysqli_query($dbc,$sql);
		$nums=mysqli_num_rows($queryc);
		
		$each_disNums=50;
		$sub_pages=10;
		$pageNums = ceil($nums/$each_disNums);
		$subPage_link='changeinfo.php?user_info_id='. $user_info_id .'&page=';
		$subPage_type=2;//为1时,显示结果1,为2时,显示结果2
		if( isset($_GET['page']) ) $current_page=$_GET['page'];
		else $current_page=1;
		$skip = ($current_page-1)*$each_disNums;
		//分页--------------------------------------------------------------

$query_liechu = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id' ORDER BY user_date DESC limit $skip,$each_disNums";
	
	$results_liechu = mysqli_query($dbc, $query_liechu);
	while( $row = mysqli_fetch_array($results_liechu) ){
		$category_circle = $row['category_circle'];
		$category_1 = $row['category_1'];
		$category_2 = $row['category_2'];
		$category_3 = $row['category_3'];
		$category_4 = $row['category_4'];
		$category_5 = $row['category_5'];
		$category_6 = $row['category_6'];
		$user_thoughts = $row['user_thoughts'];
		$user_date = $row['user_date'];
	
		echo '<tr><td>'.$category_circle.'</td><td>'.$category_1.'</td><td>'.$category_2.'</td><td>'.$category_3.'</td><td>'.$category_4.'</td><td>'
		.$category_5.'</td><td>'.$category_6.'</td><td>'.$user_thoughts.'</td><td>'.$user_date.'</td></tr>';
	}
	echo '</table>';
	
		
    mysqli_close($dbc);
    echo '<br /><br />';
		$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
	}
	else{
	echo '<br />请登录';
	
	}
} else if($_SESSION['user_nickname'] == $user_nickname){
	
	//---------------------------------------------------------
	if( isset($_GET['user_info_id']) ){
	 // Connect to the database
	$user_info_id = $_GET['user_info_id'];
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_query($dbc,"SET NAMES 'utf8'");
	$query = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id'";
	

	
	$results = mysqli_query($dbc, $query);
	//----------------paiming------------------------------------------------------------------------------
	require_once('rank.php');
	//---------------------$user_total_circle $user_total_bar $user_rank --------------------------------------
	//托出所有个人记录
	echo '<br />';
	echo $user_nickname.' 个人记录 '; 
	echo '<br />';
	echo ' 已跑了'. $user_total_circle .'圈 '; 
	echo ' 拉杠总数' . $user_total_bar . '个 '; 
	echo ' 综合排名 :' .$user_rank;

	echo '<br />等级: ';
	require_once('level.php');
	echo'<br/>最近60天的成绩图表';
  //  echo '<br /><img src="get_zhuzhuangtu.php?user_info_id='.$user_info_id.'"/>';
	echo '	<iframe src="'.SITE_ROOT_PATH.'includes/open-flash-chart-2-ichor/version-2-ichor/bar_img.php" width="765" frameborder="0" height="220" scrolling="no" marginwidth="0" marginheight="0" ></iframe>';
	echo '<table >';
	echo '<tr><th>跑圈</th><th>正手</th><th>反手</th><th>前翻</th><th>撑</th><th>俯卧撑</th><th>仰卧起坐</th><th>     your own thoughts     </th><th>日期       </th></tr>';
//分页-------------------------------------------------------------
		require('class/page.class.php');//加载类文件

		$sql="SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id'";
		$queryc=mysqli_query($dbc,$sql);
		$nums=mysqli_num_rows($queryc);
		
		$each_disNums=50;
		$sub_pages=10;
		$pageNums = ceil($nums/$each_disNums);
		$subPage_link='changeinfo.php?user_info_id='. $user_info_id .'&page=';
		$subPage_type=2;//为1时,显示结果1,为2时,显示结果2
		if( isset($_GET['page']) ) $current_page=$_GET['page'];
		else $current_page=1;
		$skip = ($current_page-1)*$each_disNums;
		//分页--------------------------------------------------------------

$query_liechu = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id' ORDER BY user_date DESC limit $skip,$each_disNums";
	
	$results_liechu = mysqli_query($dbc, $query_liechu);
	while( $row = mysqli_fetch_array($results_liechu) ){
		$category_circle = $row['category_circle'];
		$category_1 = $row['category_1'];
		$category_2 = $row['category_2'];
		$category_3 = $row['category_3'];
		$category_4 = $row['category_4'];
		$category_5 = $row['category_5'];
		$category_6 = $row['category_6'];
		$user_thoughts = $row['user_thoughts'];
		$user_date = $row['user_date'];
	
		echo '<tr><td>'.$category_circle.'</td><td>'.$category_1.'</td><td>'.$category_2.'</td><td>'.$category_3.'</td><td>'.$category_4.'</td><td>'
		.$category_5.'</td><td>'.$category_6.'</td><td>'.$user_thoughts.'</td><td>'.$user_date.'</td></tr>';
	}
	echo '</table>';
	
		
    mysqli_close($dbc);
    echo '<br /><br />';
		$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
	}
	else{
	echo '<br />请登录';
	
	}
	
	
	//-----------------------------------------------------------
	
	
		}else echo '<br />用户设为 隐私'
?>
  <hr size="1"/>		
  
  <?php require('footer.php'); ?>
  
</div>
</body>


</html>
