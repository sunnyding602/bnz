<?php
	//这里是主页面,发表主题提交页面
	date_default_timezone_set('Asia/Shanghai');
	$now = date('Y-m-j H:i:s');
    require_once('../includes/config.php');
    require_once(SITE_ROOT_PATH.'includes/initialize.php');
	$error_msg = '';
	//抓取数据,链接数据库~链接数据库
	if( isset($_POST['topic_id']) ){
		$topic_id = $_POST['topic_id'];
	}
	if( isset($_POST['submit_fabiao2']) ){
		$user_pass_phrase = sha1($_POST['verify']);
		$_POST['neirong'] = trim($_POST['neirong']);
		if( !empty($_POST['biaoti']) && !empty($_POST['neirong']) && ( $_SESSION['pass_phrase'] == $user_pass_phrase ) ){
			//提交后抓取内容
			$biaoti = $_POST['biaoti'];
			$neirong = $_POST['neirong'];
			$tupianlianjie = $_POST['tupianlianjie'];
			$yonghuming = $_POST['yonghuming'];
				//------------------------
                //方法已经移走

            //---------------------
            $ip = get_client_ip();
            if( !isset($_SESSION['user_id']) ) { $yonghuming = $ip;}
            else { $yonghuming = $_SESSION['user_nickname']; }

                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            mysqli_query($dbc,"SET NAMES 'utf8'");

            $query_fabiao2 =  "INSERT INTO tieba_content(content_id, topic_id, content_zuozhe, content_biaoti, content_neirong, ".
                " content_tupianlianjie, content_fabiaoshijian)".
                " VALUES(NULL, '$topic_id', '$yonghuming', '$biaoti', '$neirong', '$tupianlianjie', '$now')";
            mysqli_query($dbc, $query_fabiao2);
            //-------------------------------------将最后回复作者写入数据库-----------
            $query_zuihouhuifu = "UPDATE tieba_topics SET topic_zuihouhuifu = '$yonghuming', ".
			" topic_zuihouhuifushijian = '$now' WHERE topic_id = '$topic_id'";
			mysqli_query($dbc, $query_zuihouhuifu);
			//-------------------------------------将最后回复作者写入数据库-----------
			mysqli_close($dbc);
			$url = 'xianshineirong2.php?topic_id='.$topic_id;
			header('Location:'. $url);
		}else{ 
			if( isset($_GET['page']) ) $current_page=$_GET['page'];
			else $current_page=1;
				
			header ( 'Location: xianshineirong2.php?topic_id=' . $topic_id . '&page=' . $current_page.'#sub' );
			$_SESSION ['message'] = '请确内容完整和验证码正确.';
		}
	}
	
?>
