<?php $title = '不能宅 - 排行榜';?>
<?php 
//这个地方用来包含所有文件
include ('../includes/initialize.php');
include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'header.php'); 

?>
<!--<div class="error"><b>这个是错误信息框</b></div>-->
<div class="notice"><a href="#">不能宅手机版正式上线</a></div>
<div class="sectitle">欢迎来到小分队官方网站</div>
<div><span class="gray">随时随地与现实中的朋友保持联系并分享数据</span></div>
<div class="nopad"><div class="sec">
<?php
      echo '<br /><strong>RANKLIST TOP TEN</strong> ';

	  $sql = "SELECT * FROM user_info ORDER BY user_total DESC,user_rank ASC LIMIT 10 ";
	  
	  $result = $database->query($sql);
	  //$result_array = $database->fetch_array($result);
	  //print_r($result_array);
	  echo '<table>';
	  echo '<tr><td>昵称&nbsp;</td><td>跑圈总数&nbsp;</td><td>拉杠总数&nbsp;</td><td>排名</td></tr>';
	  while($row = $database->fetch_array($result)){
	  	$user_info_id = $row['user_info_id'];
		$user_nickname = $row['user_nickname'];
		$user_total_circle = $row['user_total_circle'];
		$user_total_bar = $row['user_total_bar'];
		$user_rank  = $row['user_rank'];
		//找出他的最近想法
		$query_xiangfa = "SELECT user_thoughts FROM user_statistics WHERE user_info_id='$user_info_id' ORDER BY user_date DESC";
		$result_xiangfa = $database->query($query_xiangfa);
		$row_xiangfa = $database->fetch_array($result_xiangfa);
		$xiangfa = $row_xiangfa['user_thoughts'];
		//找出头像
		$query_touxiang = "SELECT * FROM user_touxiang WHERE user_info_id = '$user_info_id'";
		$result_touxiang = $database->query($query_touxiang);
		$row_touxiang = $database->fetch_array($result_touxiang);
		$touxiang_name = $row_touxiang['touxiang_name'];

		echo '<tr><td><a href="#">' . $user_nickname .'</a></td><td>' . $user_total_circle . ' </td><td>' . $user_total_bar . '</td><td>' . $user_rank . '</td></tr>';

	  }
	  echo '</table><br />';
?>    
    
    
    
</div></div>

<!--
<div class="nopad"><div class="sec">这个可以弄出一条线来</div></div>
-->


<?php include_once(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'footer.php'); ?>
