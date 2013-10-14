<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start ();
//这里是主页面,发表主题提交页面
date_default_timezone_set ( 'Asia/Shanghai' );
$now = date ( 'Y-m-j H:i:s' );

require_once ('connectvars.php');

//抓取数据,链接数据库~链接数据库
if (isset ( $_POST ['submit_fabiao1'] )) {
	$user_pass_phrase = sha1 ( $_POST ['verify'] );
	$_POST ['biaoti'] = trim ( $_POST ['biaoti'] );
	$_POST ['neirong'] = trim ( $_POST ['neirong'] );
	if (! empty ( $_POST ['biaoti'] ) && ! empty ( $_POST ['neirong'] ) && ($_SESSION ['pass_phrase'] == $user_pass_phrase)) {
		//提交后抓取内容
		$biaoti = $_POST ['biaoti'];
		$neirong = $_POST ['neirong'];
		$tupianlianjie = $_POST ['tupianlianjie'];
		$yonghuming = $_POST ['yonghuming'];
		
		//------------------------
		function get_client_ip() {
			if ($_SERVER ['REMOTE_ADDR']) {
				$cip = $_SERVER ['REMOTE_ADDR'];
			} elseif (getenv ( "REMOTE_ADDR" )) {
				$cip = getenv ( "REMOTE_ADDR" );
			} elseif (getenv ( "HTTP_CLIENT_IP" )) {
				$cip = getenv ( "HTTP_CLIENT_IP" );
			} else {
				$cip = "unknown";
			}
			return $cip;
		}
		
		//---------------------
		$ip = get_client_ip ();
		if (! isset ( $_SESSION ['user_id'] )) {
			$yonghuming = $ip;
		} else {
			$yonghuming = $_SESSION ['user_nickname'];
		}
		$dbc = mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
		mysqli_query ( $dbc, "SET NAMES 'utf8'" );
		//1.存数据到tieba_topics,初始化所有数据
		$query_topic = "INSERT INTO tieba_topics (topic_id, topic_name, topic_dianji, topic_huifu, topic_zuozhe," . " topic_zuihouhuifu, topic_zuihouhuifushijian)" . "VALUES(NULL, '$biaoti', 0, 0, '$yonghuming', '$yonghuming', '$now')";
		mysqli_query ( $dbc, $query_topic );
		
		//2.存数据到tieba_content,初始化所有数据
		//取出topic_id
		$query_quid = "SELECT topic_id FROM tieba_topics WHERE topic_zuihouhuifushijian = '$now' ";
		$result_quid = mysqli_query ( $dbc, $query_quid );
		$row_quid = mysqli_fetch_array ( $result_quid );
		$topic_id = $row_quid ['topic_id'];
		
		//存数据
		$query_content = "INSERT INTO tieba_content(content_id, topic_id, content_zuozhe, content_biaoti, content_neirong, " . " content_tupianlianjie, content_fabiaoshijian)" . " VALUES(NULL, '$topic_id', '$yonghuming', '$biaoti', '$neirong', '$tupianlianjie', '$now')";
		mysqli_query ( $dbc, $query_content );
		header ( 'Location: index1.php' );
	} else {
		$_SESSION ['message'] = '请确保标题，内容，完整和验证码正确.';
		header ( 'Location: index1.php#sub' );
	}
}

?>
