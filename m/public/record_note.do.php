<?php

include_once ('../includes/initialize.php');
//保护数据
//this page should be protected
//include(LIB_PATH.DS.'protect.php');


if( isset($_POST['record_note']) ){
	if( strlen($_POST ['biaoti'])<3 && strlen($_POST ['neirong'])<3 ){
		$session->set_error_message ( '请不要灌水~' );
		redirect_to ( 'bbs.php' );
	}
	$biaoti = $_POST ['biaoti'];
	$neirong = $_POST ['neirong'];
	//手机版目前没有这个功能,所以设置初始值
	$tupianlianjie = 0;
	//$tupianlianjie = $_POST ['tupianlianjie'];
	
	$ip = get_client_ip ();
	if (! isset ( $_SESSION ['user_nickname'] )) {
		$yonghuming = $ip;
	}else{
		$yonghuming = $_SESSION ['user_nickname'];
	}
	
	//1.存数据到tieba_topics,初始化所有数据
	$query_topic = "INSERT INTO tieba_topics (topic_id, topic_name, topic_dianji, topic_huifu, topic_zuozhe," . " topic_zuihouhuifu, topic_zuihouhuifushijian)" . "VALUES(NULL, '$biaoti', 0, 0, '$yonghuming', '$yonghuming', '$now')";
	$database->query ( $query_topic );
		
	//2.存数据到tieba_content,初始化所有数据
	//取出topic_id
	$query_quid = "SELECT topic_id FROM tieba_topics WHERE topic_zuihouhuifushijian = '$now' ";
	$result_quid = $database->query ( $query_quid );
	$row_quid = $database->fetch_array ( $result_quid );
	$topic_id = $row_quid ['topic_id'];
		
	//存数据
	$query_content = "INSERT INTO tieba_content(content_id, topic_id, content_zuozhe, content_biaoti, content_neirong, " . " content_tupianlianjie, content_fabiaoshijian)" . " VALUES(NULL, '$topic_id', '$yonghuming', '$biaoti', '$neirong', '$tupianlianjie', '$now')";
	$database->query ( $query_content );
	
	
	$session->set_notice_message ( '发表成功' );
	redirect_to ( 'bbs.php' );
}






?>