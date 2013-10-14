<strong>THE  LASTEST TOPICS</strong><br />
<?php
	date_default_timezone_set('Asia/Shanghai');
	$now = date('Y-m-j H:i:s');
	//echo  substr($now,5,2);2009-04-11 17:00:52 
	  
	$now_hot = '2009-'. substr($now,5,2).'-01 00:00:00';
	//hot query
	//$query_hottopic = "SELECT * " .
	//" FROM tieba_topics  WHERE topic_zuihouhuifushijian > '$now_hot' ORDER BY topic_huifu DESC , topic_dianji DESC LIMIT 10";
	$query_hottopic = "SELECT *  FROM tieba_topics ORDER BY topic_zuihouhuifushijian DESC LIMIT 10";

	$results_hottopic = mysqli_query($dbc, $query_hottopic);
	
	echo '<table width="100%">';
	while( $rows_hottopic = mysqli_fetch_array($results_hottopic) ){
		$topic_id = $rows_hottopic['topic_id'];
	//最后回复
		$query_zuihouhuifu = "SELECT * FROM tieba_topics WHERE topic_id = {$topic_id}";
		$result_zuihouhuifu = mysqli_query($dbc, $query_zuihouhuifu);
		$result_zuihouhuifu = mysqli_fetch_array($result_zuihouhuifu);
		$zuihouhuifu = $result_zuihouhuifu['topic_zuihouhuifu'];
		//-------
		$topic_name = $rows_hottopic['topic_name'];
		$topic_dianji = $rows_hottopic['topic_dianji'];
		$topic_huifu = $rows_hottopic['topic_huifu'];
		$topic_zuozhe =  $rows_hottopic['topic_zuozhe'];
		$topic_zuihouhuifushijian = $rows_hottopic['topic_zuihouhuifushijian']; 
echo '<tr>';
echo '<td>';
	echo '<a href="bar_tieba/xianshineirong2.php?topic_id=' . $topic_id . '">' . $topic_name . '</a>('. $topic_dianji.'/'. $topic_huifu .')';
echo '</td>';
echo '<td>';
	if( isset($_SESSION['user_id']) ){
			$database = new Database();
		$database->open_connection();
		$sql = "SELECT user_info_id, topic_zuihouhuifu".
		" FROM user_info".
		" INNER JOIN tieba_topics".
		" WHERE topic_zuihouhuifu = user_nickname AND user_nickname = '$zuihouhuifu'";
		$result = mysqli_fetch_array( $database->query($sql) );
		$user_info_id = $result['user_info_id'];
		$database->close_connection();

		echo ' Last Reply: <a href="changeinfo.php?user_info_id='.$user_info_id.'" target="_blank">' . $zuihouhuifu .'</a>';
		}else{
			echo ' Last Reply: ' . $zuihouhuifu;
		}
echo '</td>';
echo '<td align="right">';
	echo ' [' . substr($topic_zuihouhuifushijian,0,16).']';
echo '</td>';
echo '</tr>';
	}
echo '</table>';	
?>
