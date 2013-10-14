<?php require_once(SITE_ROOT_PATH.'/login.php');?>
<?php require_once(SITE_ROOT_PATH.'/navigation.php');?>
<?php //jishuqi
require_once(SITE_ROOT_PATH.'/jishuqi.php');?>


<h4>拉杠小分队官方贴吧</h4><?php require_once('search.html');?>
	<hr size="1"/>	
	<?php require_once('../onlineusers.php')?>
	<hr size="1"/>	
<table cellspacing="0" width="100%">
<thead>
			<tr>
			  <td width="100">添加到收藏夹</td>
			  <td width="100"> <a href="#sub">发表新留言</a></td>
			  <td></td>
			  <td width="100"><a href="../index.php">返回主页</a></td>
			  <td width="135"></td>
			</tr>		
		</thead>
</table>
<table cellspacing="0" width="100%">
<thead>
			<tr>
			  <td width="4%" class="haha">点击</td>
			  <td width="4%" class="haha">回复</td>
			  <td width="35%" class="haha">标题</td>
			  <td width="10%" class="haha">作者</td>
			  <td width="14%" class="haha">最后回复</td>
			  <?php if( isset($_SESSION['user_id']) ){
          if($_SESSION['user_id'] == 'sunny')
          echo '<td width="10%" class="haha">和谐操作</td>';  
			  }?>
			</tr>		
		</thead>

<?php
//贴吧主题页面显示~~~~
	date_default_timezone_set('Asia/Shanghai');
	$now = date('Y-m-j H:i:s');
	

	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_query($dbc,"SET NAMES 'utf8'");
	
	//-------------------------------------------------分页--------------------
	require('../class/page.class.php');//加载类文件

	$sql="SELECT * FROM tieba_topics";
	$queryc=mysqli_query($dbc,$sql);
	$nums=mysqli_num_rows($queryc);
	
	$each_disNums=50;
	$sub_pages=10;
	$pageNums = ceil($nums/$each_disNums);
	//$dangqianye = $_SERVER['PHP_SELF'];
	$subPage_link="index1.php?page=";
	$subPage_type=2;//为1时,显示结果1,为2时,显示结果2
	
	if( isset($_GET['page']) ) $current_page=$_GET['page'];
	else $current_page=1;
	
	$sikp = ($current_page-1)*$each_disNums;
		
	//分页----------------------------------------------------------------------------
	$query_xianshi1 = "SELECT * FROM tieba_topics ORDER BY topic_zuihouhuifushijian DESC limit $sikp,$each_disNums"; 
	//上面添加了limit $sikp,$each_disNums
	
	$results_xianshi1 = mysqli_query($dbc, $query_xianshi1);
	while( $rows_xianshi1 = mysqli_fetch_array($results_xianshi1) ){
		$topic_id = $rows_xianshi1['topic_id'];
		$dianji = $rows_xianshi1['topic_dianji'];
		$huifu = $rows_xianshi1['topic_huifu'];
		$biaoti = $rows_xianshi1['topic_name'];
		$zuozhe = $rows_xianshi1['topic_zuozhe'];
		$zuihouhuifu = $rows_xianshi1['topic_zuihouhuifu'];
		$zuihouhuifushijian = $rows_xianshi1['topic_zuihouhuifushijian'];
		$zuihouhuifushijian_xianshi = substr($zuihouhuifushijian, 5, 5);
		//作者显示 得分情况~~~~~~会员 or 非会员都不一样 现在先测试
		
		//抓到数据显示	
echo'<tr>';
echo'<td class="haha">' . $dianji . '</td>';
echo'<td class="haha">' . $huifu . '</td>';

echo'<td class="haha"><a  href="xianshineirong2.php?topic_id=' . $topic_id .'" target=_blank >' . $biaoti . '</a>&nbsp;</td>';

//下面要建立链接~~~~
		$database = new Database();
		$database->open_connection();
		
		$sql1 = "SELECT user_info_id, topic_zuozhe".
		" FROM user_info".
		" INNER JOIN tieba_topics".
		" WHERE topic_zuozhe = user_nickname AND user_nickname = '$zuozhe'";
		
		$sql2 = "SELECT user_info_id, topic_zuihouhuifu".
		" FROM user_info".
		" INNER JOIN tieba_topics".
		" WHERE topic_zuihouhuifu = user_nickname AND user_nickname = '$zuihouhuifu'";
		$result1 = mysqli_fetch_array( $database->query($sql1) );
		$result2 = mysqli_fetch_array( $database->query($sql2) );
		
		$user_info_id1 = $result1['user_info_id'];
		$user_info_id2 = $result2['user_info_id'];
		
		$database->close_connection();



if( isset($_SESSION['user_id']) ){
	echo'<td class="haha"><a href="../changeinfo.php?at_tieba=1&page='.$current_page.'&user_info_id='.$user_info_id1.'" target="_blank">' . $zuozhe . '</a></td>';
	}else{
		echo'<td class="haha">' . $zuozhe . '</td>';
		}


if( isset($_SESSION['user_id']) ){
	echo'<td class="haha">' . $zuihouhuifushijian_xianshi .'&nbsp;<font color="#000000"><a href="../changeinfo.php?at_tieba=1&page='.$current_page.'&user_info_id='.$user_info_id2.'" target="_blank">' . $zuihouhuifu . '</a></font></td>';
	}else{
		echo'<td class="haha">' . $zuihouhuifushijian_xianshi .'&nbsp;<font color="#000000">' . $zuihouhuifu . '</font></td>';
		}

//admin link
		if( isset($_SESSION['user_info_id']) ){
			if($_SESSION['user_id'] == 'sunny')
			echo'<td class="haha"><a  href="deltopic.php?topic_id=' . $topic_id .'">delete</a></td>';
		}
echo'</tr >';
	}
	mysqli_close($dbc);
?>
</table>
<?php
echo '<br />';
//分页
$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
?>



<?php require_once('submsg1.php');?>

