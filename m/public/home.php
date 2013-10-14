<?php $title = '不能宅.CN - 个人中心';?>
<?php 
//这个地方用来包含所有文件
include ('../includes/initialize.php');
include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'header.php'); 
//保护数据
include(LIB_PATH.DS.'protect.php');
?>

<!--<div class="error"><b>这个是错误信息框</b></div>-->
<div class="notice"><a href="#">不能宅手机版正式上线</a></div>

<div class="sectitle">欢迎来到小分队官方网站</div>
<div><span class="gray">随时随地与现实中的朋友保持联系并分享数据</span></div>
<div class="nopad"><div class="sec">
<?php
//core
echo $_SESSION['user_nickname'].'的个人记录<br />';
echo '我已经圈 '.$_SESSION['user_total_circle'];
echo ' 杠 '.$_SESSION['user_total_bar'];
echo ' 排名 '.$_SESSION['user_rank'].'<br />';

/*
echo '<table >';
	echo '<tr><th>跑圈</th><th>正手</th><th>反手</th><th>前翻</th><th>撑</th><th>俯卧撑</th><th>仰卧起坐</th><th>     your own thoughts     </th><th>日期       </th></tr>';
//分页-------------------------------------------------------------
		//require('class/page.class.php');//加载类文件

		$sql="SELECT * FROM user_statistics WHERE user_info_id = {$_SESSION['user_info_id']}";
		$queryc=$database->query($sql);
		$nums=$database->num_rows($queryc);
		
		$each_disNums=10;
		$sub_pages=10;
		$pageNums = ceil($nums/$each_disNums);
		$subPage_link='home.php?page=';
		$subPage_type=2;//为1时,显示结果1,为2时,显示结果2
		if( isset($_GET['page']) ) $current_page=$_GET['page'];
		else $current_page=1;
		$skip = ($current_page-1)*$each_disNums;
		//分页--------------------------------------------------------------

$query_liechu = "SELECT * FROM user_statistics WHERE user_info_id = {$_SESSION['user_info_id']} ORDER BY user_date DESC limit $skip,$each_disNums";
	
	$results_liechu = $database->query($query_liechu);
	while( $row = $database->fetch_array($results_liechu) ){
		$category_circle = $row['category_circle'];
		$category_1 = $row['category_1'];
		$category_2 = $row['category_2'];
		$category_3 = $row['category_3'];
		$category_4 = $row['category_4'];
		$category_5 = $row['category_5'];
		$category_6 = $row['category_6'];
		$user_thoughts = $row['user_thoughts'];
		$user_date = $row['user_date'];
	
		echo '<tr><td>'.$category_circle.'</td><td>'.$category_1.'</td><td>'.$category_2.'</td><td>'.$category_3.'</td><td>'.$category_4.'</td><td>'
		.$category_5.'</td><td>'.$category_6.'</td><td>'.$user_thoughts.'</td><td>'.$user_date.'</td></tr>';
	}
	echo '</table>';
	$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
	
	*/
?>
</div></div>

<!--
<div class="nopad"><div class="sec">这个可以弄出一条线来</div></div>
-->

<?php include_once(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'footer.php'); ?>