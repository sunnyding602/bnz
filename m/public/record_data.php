<?php $title = '不能宅 - 记录数据';?>

<?php 
//这个地方用来包含所有文件
include ('../includes/initialize.php');
include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'header.php'); 
 
//非公共页面都得用protect.php保护,目前只有index.php是公共界面,
//如果protect.php加载到 initialize.php index.php header.php 里就会引起 循环重定向
//保护数据
include(LIB_PATH.DS.'protect.php');

//计数器  这个计数器在这里只能记录到会员的访问~
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


<!--<div class="error"><b>一切不合理的数据都将被清零</b></div>-->


<div class="sectitle">记录你的每一天</div>
<!-- <div><span class="gray">随时随地与现实中的朋友保持联系并分享数据</span></div>-->
<div class="nopad"><div class="sec">
    <form action="record_data.do.php" method="post"><p>
    
    跑圈(跑步):<br />
    <input type="text" name="pq" value="" /><br />
    正手(单杠):<br />
    <input type="text" name="zs" value="" /><br />
    反手(单杠):<br />
    <input type="text" name="fs" value="" /><br />
    前翻(单杠):<br />
    <input type="text" name="qf" value="" /><br />
    撑(双杠):<br />
    <input type="text" name="c" value="" /><br />
    俯卧撑:<br />
    <input type="text" name="fwc" value="" /><br />
    仰卧起坐:<br />
    <input type="text" name="ywqz" value="" /><br />
    今日所思(文字):<br />
    <textarea name="wz"></textarea>
    <br />
    <input type="submit" name="save" value="保存今日数据" class="button" />&nbsp;<a href="/help/resetpassword.do?">找回密码</a></p>
    </form></div>

<!--
<div class="nopad"><div class="sec">这个可以弄出一条线来</div></div>
-->


<?php include_once(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'footer.php'); ?>

