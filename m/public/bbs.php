<?php $title = '不能宅 - 贴吧';?>
<?php 
//这个地方用来包含所有文件
include ('../includes/initialize.php');
include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'header.php'); 
//记得加保护
//include(LIB_PATH.DS.'protect.php');
?>



<!--<div class="error"><b>这个是错误信息框</b></div>-->
<div class="notice"><a href="#">不能宅手机版正式上线</a></div>

<div class="sectitle">欢迎来到小分队官方网站</div>
<div><span class="gray">随时随地与现实中的朋友保持联系并分享数据</span></div>


<div class="sectitle"><a href="#sub">发表帖子</a></div>
<ul class="dot_list sec">
<?php
//贴吧主题页面显示~~~~
	
	//-------------------------------------------------分页--------------------
	//require('../class/page.class.php');//加载类文件

	$sql="SELECT * FROM tieba_topics";
	$queryc=$database->query($sql);
	$nums=$database->num_rows($queryc);
	
	$each_disNums=10;
	$sub_pages=10;
	$pageNums = ceil($nums/$each_disNums);
	//$dangqianye = $_SERVER['PHP_SELF'];
	$subPage_link="bbs.php?page=";
	$subPage_type=2;//为1时,显示结果1,为2时,显示结果2
	
	if( isset($_GET['page']) ) $current_page=$_GET['page'];
	else $current_page=1;
	
	$sikp = ($current_page-1)*$each_disNums;
		
	//分页----------------------------------------------------------------------------
	$query_xianshi1 = "SELECT * FROM tieba_topics ORDER BY topic_zuihouhuifushijian DESC limit $sikp,$each_disNums"; 
	//上面添加了limit $sikp,$each_disNums
	
	$results_xianshi1 = $database->query($query_xianshi1);
	while( $rows_xianshi1 = $database->fetch_array($results_xianshi1) ){
		$topic_id = $rows_xianshi1['topic_id'];
		$dianji = $rows_xianshi1['topic_dianji'];
		$huifu = $rows_xianshi1['topic_huifu'];
		$biaoti = $rows_xianshi1['topic_name'];
		//$zuozhe = $rows_xianshi1['topic_zuozhe'];
		//$zuihouhuifu = $rows_xianshi1['topic_zuihouhuifu'];
		$zuihouhuifushijian = $rows_xianshi1['topic_zuihouhuifushijian'];
		//$zuihouhuifushijian_xianshi = substr($zuihouhuifushijian, 5, 5);
		//作者显示 得分情况~~~~~~会员 or 非会员都不一样 现在先测试
		
		//抓到数据显示	
	
		//echo'<td class="haha">' . $dianji . '</td>';
		//echo'<td class="haha">' . $huifu . '</td>';
		
		echo '<li><span class="gary">'.substr($zuihouhuifushijian,5,5).'</span>&nbsp;<span><a href="bbs_content.php?topic_id='.$topic_id.'">'. $biaoti .'</a></span></li>';
		//echo'<td class="haha"><a  href="bbs.php?topic_id=' . $topic_id .'" target=_blank >'  '</a>&nbsp;</td>';
	}

?>
</ul>
</div>

<?php
echo '<br />';
//分页
$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);



?>
<form action="record_note.do.php" method="post"><p><a name="sub"></a>
    
    标题:<br />
    <input type="text" name="biaoti" value="" /><br />
    内容:<br />
    <textarea name="neirong"></textarea>
    <br />
    <input type="submit" name="record_note" value="发表" class="button" />&nbsp;</p>
    </form>
<!--
<div class="nopad"><div class="sec">这个可以弄出一条线来</div></div>
-->


<?php include_once(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'footer.php'); ?>
