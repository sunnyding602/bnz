<?php

include_once ('../includes/initialize.php');
//保护数据
//this page should be protected
//include(LIB_PATH.DS.'protect.php');


if( isset($_POST['record_subnote']) ){

	if( !isset($_POST['topic_id']) ){
		$session->set_error_message ( 'ERROR,OMIT STH' );
		redirect_to ( 'bbs.php' );
	}
	$topic_id = $_POST['topic_id'];
	
	if( strlen($_POST ['neirong'])<3 ){
		$session->set_error_message ( '请不要灌水~' );
		$url = 'bbs_content.php?topic_id='.$topic_id;
		redirect_to ( $url );
	}
	if(isset($_POST ['biaoti'])) $biaoti = $_POST ['biaoti']; else $biaoti = '回复';
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
	
		$query_fabiao2 =  "INSERT INTO tieba_content(content_id, topic_id, content_zuozhe, content_biaoti, content_neirong, ".
				" content_tupianlianjie, content_fabiaoshijian)".
				" VALUES(NULL, '$topic_id', '$yonghuming', '$biaoti', '$neirong', '$tupianlianjie', '$now')";
		$database->query($query_fabiao2);
		//-------------------------------------将最后回复作者写入数据库-----------
		$query_zuihouhuifu = "UPDATE tieba_topics SET topic_zuihouhuifu = '$yonghuming', ".
		" topic_zuihouhuifushijian = '$now' WHERE topic_id = '$topic_id'";
		$database->query($query_zuihouhuifu);
		//-------------------------------------将最后回复作者写入数据库-----------
		
		$url = 'bbs_content.php?topic_id='.$topic_id;
		
	
	
	$session->set_notice_message ( '发表成功' );
	redirect_to ( $url );
}






?>