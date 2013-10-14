<?php session_start(); ?>
<?php require_once('header.php'); ?>
<?php require_once('connectvars.php') ?>
<?php $title = 'Your Level In The Real World'; ?>
<title><?php echo $title; ?></title>
</head>

<body>
<div class="content">
  <?php require_once('login.php'); ?>
  <?php require_once('navigation.php'); ?>
  <h1>Your Level In The Real World</h1>
  <hr size="1"/>
  you won't be the world's strongest man,this website will never change 
  your dream,but others. let them dream of being you.
  
  
  
  <?php

 if( isset($_SESSION['user_info_id']) ){
	 // Connect to the database
	$user_info_id = $_SESSION['user_info_id'];
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_query($dbc,"SET NAMES 'utf8'");
	$query = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id'";
	

	
	$results = mysqli_query($dbc, $query);
	//----------------paiming------------------------------------------------------------------------------
	require_once('rank.php');
	//---------------------$user_total_circle $user_total_bar $user_rank --------------------------------------
	//托出所有个人记录
	echo '<br />';
	echo $_SESSION['user_nickname'].'个人记录 '; 
	echo ' 你已跑了'. $user_total_circle .'圈 '; 
	echo ' 拉杠总数' . $user_total_bar . '个 '; 
	echo ' 综合排名 :' .$user_rank;

	echo '<br />你现在等级为: ';
	require_once('level.php');
	echo'<br/>最近60天的成绩图表';
    echo '<br /><img src="zhuzhuangtu.php"/>';
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
		$subPage_link='showinfo.php?page=';
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
?>
  
  
  
  <br /><br />
  <hr size="1"/>	
  
  <?php require('footer.php'); ?>
</div>
</body>


</html>