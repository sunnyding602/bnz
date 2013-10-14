<?php
	//------------------------
	// get_client_ip   this method was removed by sunny @ 20:09 11:14 2012
	//---------------------
	$ip = get_client_ip();
	if( isset($_SESSION['user_id']) ){
		$user_id = $_SESSION['user_id'];
	}
	else{
		$user_id = 'MTuser';
	}
	//----------
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_query($dbc,"SET NAMES 'utf8'");
	
	//非会员语句
	$query0 = "SELECT * FROM jishuqi WHERE ip = '$ip'";
	
	//是会员语句
	$query1 = "SELECT * FROM jishuqi WHERE user_id = '$user_id'";
	
	//如果空,则
	$query2 = "INSERT INTO jishuqi (id, user_id, ip, times, last_visit)VALUES(NULL, '$user_id', '$ip', 1, NOW() )";
	
	//如果不空~,则 fetch_array 里+1
	
	if( isset($_SESSION['user_id']) ){
		$result1 = mysqli_query($dbc, $query1);
		//检查会员是不是第一次访问...,是则
		if( mysqli_num_rows($result1) == 0 ){
			mysqli_query($dbc, $query2);
		}
		else{
			//会员不是第一次访问,则读取times存储数据,+1存回
			 $result_er = mysqli_query( $dbc, $query1);
			 $row_er = mysqli_fetch_array($result_er);
			 $jishu = $row_er['times'] + 1;
			 //加完后,更新
			 $query_er = "UPDATE jishuqi SET times = '$jishu' , ip = '$ip' , last_visit = NOW() WHERE user_id = '$user_id' ";
			mysqli_query($dbc, $query_er);
		}
	}
	else{
		//检查非会员是否第一次访问
		$result0 = mysqli_query($dbc, $query0);
		if( mysqli_num_rows($result0) == 0 ){
			//非会员第一次访问,则
			$query_san = "INSERT INTO jishuqi (id, user_id, ip, times, last_visit)VALUES(NULL, '$user_id', '$ip', 1, NOW() )";
			mysqli_query( $dbc, $query_san);
		}
		else{
			//非会员非第一次访问,取出 然后+1放回去
			$query_si = "SELECT * FROM jishuqi WHERE ip = '$ip' AND user_id = '$user_id'";
			$result_si = mysqli_query($dbc, $query_si);
			$row_si = mysqli_fetch_array($result_si);
			$jishu = $row_si['times'] + 1;
			//加完后,更新 
			$query_wu = "UPDATE jishuqi SET times = '$jishu' , last_visit = NOW() WHERE ip = '$ip' AND user_id = '$user_id' ";
			mysqli_query( $dbc, $query_wu);
			
		}
	
	}
	mysqli_close($dbc);
?>
