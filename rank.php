<?php
	
	$user_total_circle = $user_total_bar = 0;
	
	while( $row = mysqli_fetch_array($results) ){
		$category_circle = $row['category_circle'];
		$category_1 = $row['category_1'];
		$category_2 = $row['category_2'];
		$category_3 = $row['category_3'];
		$category_4 = $row['category_4'];
		$category_5 = $row['category_5'];
		$category_6 = $row['category_6'];
		$user_thoughts = $row['user_thoughts'];
		$user_date = $row['user_date'];
		//计算总成绩
		
		$user_total_circle = $user_total_circle + $category_circle;
		$user_total_bar = $user_total_bar + $category_1 + $category_2 + $category_3 + $category_4 + $category_5 + $category_6;
		

	}
		$user_total = 5*$user_total_circle + $user_total_bar;
			//把算出总分写入数据库
			
		$querytotal = "UPDATE user_info SET user_total_circle = '$user_total_circle' , user_total_bar = '$user_total_bar' ,user_total = '$user_total' ".
		"  WHERE user_info_id = '$user_info_id' ";
		mysqli_query($dbc, $querytotal);
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
		$query_find = "SELECT * FROM user_info WHERE user_info_id = '$user_info_id' ";
		$results_find = mysqli_query($dbc, $query_find);
		$row_find = mysqli_fetch_array($results_find);
		$user_rank = $row_find ['user_rank'];	
		
?>

