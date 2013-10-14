<?php $title = '不能宅 - 贴吧';?>
<?php 
//这个地方用来包含所有文件
include ('../includes/initialize.php');
include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'header.php'); 
//贴吧不应该保护~
//include(LIB_PATH.DS.'protect.php');
?>



<!--<div class="error"><b>这个是错误信息框</b></div>-->
<div class="notice"><a href="#">不能宅手机版正式上线</a></div>

<div class="sectitle">欢迎来到小分队官方网站</div>
<div><span class="gray">随时随地与现实中的朋友保持联系并分享数据</span></div>


<?php
		//内容显示页面,接收$_GET['topic_id'] 从数据库中托出数据

		if( !isset($_GET['topic_id']) ){
			$session->set_error_message ( 'ERROR,OMIT STH' );
			redirect_to ( 'bbs.php' );
			}
			$topic_id = $_GET['topic_id'];
		//分页-------------------------------------------------------------
		//require('../class/page.class.php');//加载类文件

		$sql="SELECT * FROM tieba_content WHERE topic_id = '$topic_id'";
		$queryc=$database->query($sql);
		$nums=$database->num_rows($queryc);
		
		$each_disNums=10;
		$sub_pages=10;
		$pageNums = ceil($nums/$each_disNums);
		$subPage_link='bbs_content.php?topic_id='.$topic_id.'&page=';
		$subPage_type=2;//为1时,显示结果1,为2时,显示结果2
		if( isset($_GET['page']) ) $current_page=$_GET['page'];
		else $current_page=1;
		
		$skip = ($current_page-1)*$each_disNums;
		//分页--------------------------------------------------------------
			
			$query_xianshi2 = "SELECT * FROM tieba_content WHERE topic_id = '$topic_id' ".
			"ORDER BY content_fabiaoshijian ASC limit $skip,$each_disNums";
			//有了分页之后必须重新计算帖子总数
			$query_zongshuo ="SELECT * FROM tieba_content WHERE topic_id = '$topic_id' "; 
			$results_zongshuo = $database->query($query_zongshuo);
			$huifu_fake = $database->affected_rows();
			$huifu = $huifu_fake - 1;
			
			//上面+上了limit
			$results_xianshi2 = $database->query($query_xianshi2);		
			
			//已经算出回复总数,写入数据库
			$query_huifu = "UPDATE tieba_topics SET topic_huifu  = '$huifu' WHERE topic_id = '$topic_id'";
			$database->query($query_huifu);
			//显示帖子总数
			echo '共有<font color="#ff0000">'.$huifu_fake.'</font>篇贴子<br />';

			//拖出所有回复内容 设$i 计楼数
			if( $skip != 0 ) $i = $skip + 1;
			else $i = 1;
			while( $rows_xianshi2 = $database->fetch_array($results_xianshi2) ){
				//admin link del will use
				$content_id = $rows_xianshi2['content_id'];
				
				$content_zuozhe = $rows_xianshi2['content_zuozhe'];
				$content_biaoti = $rows_xianshi2['content_biaoti'];
				$content_neirong = $rows_xianshi2['content_neirong'];
				$content_tupianlianjie = $rows_xianshi2['content_tupianlianjie'];
				$content_fabiaoshijian = $rows_xianshi2['content_fabiaoshijian'];
				$content_tupianlianjie = '<img src="'. $content_tupianlianjie .'" />';
		
		echo $i.' ' ;
		
		
		
		echo '<font color=#0000cc>'. $content_biaoti .'</font>';
		echo '<br />';echo '<br />';
		
		
		echo '<cc>'. txtToEnter($content_neirong) .'</cc>';
		
		
		echo '<br />';echo '<br />';

		
		$sql = " SELECT user_info_id FROM user_info ".
		" inner join tieba_content where ".
		" content_zuozhe =user_nickname AND content_zuozhe = '$content_zuozhe'";
		$result = $database->fetch_array( $database->query($sql) );
		$user_info_id = $result['user_info_id'];
		
		

	echo '作者：'. $content_zuozhe ;	echo '<br />';
		



	echo '时间：'. substr($content_fabiaoshijian, 5, 16); echo '<br />';

	echo ' <a href="#sub">回复此发言</a>'; echo '<br />';
	
	echo '<div class="nopad"><div class="sec"></div></div>'; echo '<br />';//一条线



				//计楼数+1
				$i = $i + 1;
			}
		
		
		$query_dianji0 = "SELECT topic_dianji FROM tieba_topics WHERE topic_id = '$topic_id'";
		$result_dianji0 = $database->query($query_dianji0); 
		$row_dianji0 = $database->fetch_array($result_dianji0);
		$jishu = $row_dianji0['topic_dianji'] + 1;
		$query_dianji1 = "UPDATE tieba_topics SET topic_dianji = '$jishu' WHERE topic_id = '$topic_id'";
		$database->query($query_dianji1);
		
		
		
		?>
  <?php
echo '<br />';
//分页
$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
?>
<div class="nopad"><div class="sec"></div></div>
<form action="record_subnote.do.php" method="post"><p><a name="sub"></a>
    <input type="hidden" name="topic_id" value="<?php if( isset($topic_id) ) echo $topic_id;?>" />
    标题:<br />
    <input type="text" name="biaoti" value="" /><br />
    内容:<br />
    <textarea name="neirong"></textarea>
    <br />
    <input type="submit" name="record_subnote" value="发表" class="button" />&nbsp;</p>
    
    </form>
<!--
<div class="nopad"><div class="sec">这个可以弄出一条线来</div></div>
-->


<?php include_once(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'footer.php'); ?>
