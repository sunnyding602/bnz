<?php
//click&see
require_once('connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");



$query0 = "SELECT * FROM user_info";
$results0 = mysqli_query($dbc, $query0);
while( $rows0 = mysqli_fetch_array($results0) ){
	//拉出有用信息
	$user_info_id = $rows0['user_info_id'];

	$query1 = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id'";
	
	$results1 = mysqli_query($dbc, $query1);
	//初始化数据
	$user_total_circle = $user_total_bar = 0;
	while( $rows1 = mysqli_fetch_array($results1) ){
			
	
		$category_circle = $rows1['category_circle'];
		$category_1 = $rows1['category_1'];
		$category_2 = $rows1['category_2'];
		$category_3 = $rows1['category_3'];
		$category_4 = $rows1['category_4'];
		$category_5 = $rows1['category_5'];
		$category_6 = $rows1['category_6'];
		//计算总成绩
		
		$user_total_circle = $user_total_circle + $category_circle;
	
		$user_total_bar = $user_total_bar + $category_1 + $category_2 + $category_3 + $category_4 + $category_5 + $category_6;
	}

	$user_total = 5*$user_total_circle + $user_total_bar;
	//	把算出总分写入数据库	
	$querytotal = "UPDATE user_info SET user_total_circle = '$user_total_circle' , user_total_bar = '$user_total_bar' ,user_total = '$user_total' ".
	"  WHERE user_info_id = '$user_info_id' ";
	mysqli_query($dbc, $querytotal);
}
//计算排名
$queryrank1 = "SELECT * FROM user_info ORDER BY user_total DESC";
$results_rank = mysqli_query($dbc, $queryrank1 );
$rank = 1;
while( $rows = mysqli_fetch_array($results_rank)  ){
	
	$user_id = $rows['user_id'];
	
	
	$query_rank = "UPDATE user_info SET user_rank = '$rank' WHERE user_id ='$user_id' ";
	mysqli_query($dbc, $query_rank);
	$rank++;
}
header('Location: index.php');
?>