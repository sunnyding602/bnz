<?php $title = '不能宅 - 因为坚持，所以不同';?>
<?php 
//这个地方用来包含所有文件
include ('../includes/initialize.php');
include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'header.php'); 

//计数器  这个计数器在这里只能记录到非会员的访问~
	//---------------------
	$ip = get_client_ip();
	if( isset($_SESSION['user_id']) ){
		$user_id = $_SESSION['user_id'];
	}
	else{
		$user_id = 'MTuser';
	}
	
	//非会员语句
	$query0 = "SELECT * FROM jishuqi WHERE ip = '$ip'";
	
	//是会员语句
	$query1 = "SELECT * FROM jishuqi WHERE user_id = '$user_id'";
	
	//如果空,则
	$query2 = "INSERT INTO jishuqi (id, user_id, ip, times, last_visit)VALUES(NULL, '$user_id', '$ip', 1, NOW() )";
	
	//如果不空~,则 fetch_array 里+1
	
	if( isset($_SESSION['user_id']) ){
		$result1 = $database->query($query1);
		//检查会员是不是第一次访问...,是则
		if( $database->num_rows($result1) == 0 ){
			$database->query( $query2);
		}
		else{
			//会员不是第一次访问,则读取times存储数据,+1存回
			 $result_er = $database->query($query1);
			 $row_er = $database->fetch_array($result_er);
			 $jishu = $row_er['times'] + 1;
			 //加完后,更新
			 $query_er = "UPDATE jishuqi SET times = '$jishu' , ip = '$ip' , last_visit = NOW() WHERE user_id = '$user_id' ";
			$database->query($query_er);
		}
	}
	else{
		//检查非会员是否第一次访问
		$result0 = $database->query($query0);
		if( $database->num_rows($result0) == 0 ){
			//非会员第一次访问,则
			$query_san = "INSERT INTO jishuqi (id, user_id, ip, times, last_visit)VALUES(NULL, '$user_id', '$ip', 1, NOW() )";
			$database->query( $query_san);
		}
		else{
			//非会员非第一次访问,取出 然后+1放回去
			$query_si = "SELECT * FROM jishuqi WHERE ip = '$ip' AND user_id = '$user_id'";
			$result_si = $database->query($query_si);
			$row_si = $database->fetch_array($result_si);
			$jishu = $row_si['times'] + 1;
			//加完后,更新 
			$query_wu = "UPDATE jishuqi SET times = '$jishu' , last_visit = NOW() WHERE ip = '$ip' AND user_id = '$user_id' ";
			$database->query($query_wu);
			
		}
	
	}

?>



<!--<div class="error"><b>这个是错误信息框</b></div>-->
<div class="notice"><a href="#">不能宅手机版正式上线</a></div>

<div class="sectitle">欢迎来到小分队官方网站</div>
<div><span class="gray">随时随地与现实中的朋友保持联系并分享数据</span></div>
<div class="nopad"><div class="sec">
    <form action="login.php" method="post"><p>
    
    账号(账号):<br />
    <input type="text" name="username" value="" /><br />
    密码(区分大小写):<br />
    <input type="password" name="password" /><br />
    <input type="submit" name="login" value="登录" class="button" />&nbsp;<a href="/help/resetpassword.do?">找回密码</a></p>
    </form><div><a href= "#">手机30秒快速注册.</a>
</div></div>

<!--
<div class="nopad"><div class="sec">这个可以弄出一条线来</div></div>
-->


<?php include_once(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'footer.php'); ?>
