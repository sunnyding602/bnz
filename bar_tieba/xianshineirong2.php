<?php
require_once('../includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>拉杠小分队官方贴吧</title>
</head>

<body>
<div class="content">
<?php require_once(SITE_ROOT_PATH.'login.php');?>
<?php require_once(SITE_ROOT_PATH.'navigation.php');?>
  <h4>拉杠小分队官方贴吧</h4><?php require_once(SITE_ROOT_PATH.'/bar_tieba/search.html');?>
  <hr size="1"/>	
  <?php require_once('../onlineusers.php')?>
  <hr size="1"/>
  <table cellspacing="0" width="100%">
    <thead>
      <tr>
        <td width="100">添加到收藏夹</td>
        <td width="100"> <a href="#sub">快速回复</a></td>
        <td></td>
        <td width="100"><a href="../index.php">返回主页</a></td>
        <td width="135"><a href="index1.php">返回贴吧首页</a></td>
        </tr>		
    </thead>
  </table>
  <?php
		//内容显示页面,接收$_GET['topic_id'] 从数据库中托出数据
		date_default_timezone_set('Asia/Shanghai');
		$now = date('Y-m-j H:i:s');
		
		
		
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		mysqli_query($dbc,"SET NAMES 'utf8'");

		if( isset($_GET['topic_id']) ){
			$topic_id = $_GET['topic_id'];
					//分页-------------------------------------------------------------
		require('../class/page.class.php');//加载类文件

		$sql="SELECT * FROM tieba_content WHERE topic_id = '$topic_id'";
		$queryc=mysqli_query($dbc,$sql);
		$nums=mysqli_num_rows($queryc);
		
		$each_disNums=21;
		$sub_pages=10;
		$pageNums = ceil($nums/$each_disNums);
		$subPage_link='xianshineirong2.php?topic_id='.$topic_id.'&page=';
		$subPage_type=2;//为1时,显示结果1,为2时,显示结果2
		if( isset($_GET['page']) ) $current_page=$_GET['page'];
		else $current_page=1;
		
		$skip = ($current_page-1)*$each_disNums;
		//分页--------------------------------------------------------------
			
			$query_xianshi2 = "SELECT * FROM tieba_content WHERE topic_id = '$topic_id' ".
			"ORDER BY content_fabiaoshijian ASC limit $skip,$each_disNums";
			//有了分页之后必须重新计算帖子总数
			$query_zongshuo ="SELECT * FROM tieba_content WHERE topic_id = '$topic_id' "; 
			$results_zongshuo = mysqli_query($dbc, $query_zongshuo);
			$huifu_fake = mysqli_affected_rows($dbc);
			$huifu = $huifu_fake - 1;
			
			//上面+上了limit
			$results_xianshi2 = mysqli_query($dbc, $query_xianshi2);		
			
			//已经算出回复总数,写入数据库
			$query_huifu = "UPDATE tieba_topics SET topic_huifu  = '$huifu' WHERE topic_id = '$topic_id'";
			mysqli_query($dbc, $query_huifu);
			//显示帖子总数
echo '<table width="72%"  border="0" cellpadding="0" cellspacing="0">';
echo '<tr>';
echo '<td tyle="padding-left:30px;padding-top:10px;padding-bottom:10px;"><div style="float:left;margin:5px 0 10px 0;">共有<font color="#ff0000">'.$huifu_fake.'</font>篇贴子&nbsp;&nbsp;</div><div style="float:left;margin-top:1px"></div></td>';
echo '</tr>';
echo '</table>';
			//拖出所有回复内容 设$i 计楼数
			if( $skip != 0 ) $i = $skip + 1;
			else $i = 1;
			while( $rows_xianshi2 = mysqli_fetch_array($results_xianshi2) ){
				//admin link del will use
				$content_id = $rows_xianshi2['content_id'];
				
				$content_zuozhe = $rows_xianshi2['content_zuozhe'];
				$content_biaoti = $rows_xianshi2['content_biaoti'];
				$content_neirong = $rows_xianshi2['content_neirong'];
				$content_tupianlianjie = $rows_xianshi2['content_tupianlianjie'];
				$content_fabiaoshijian = $rows_xianshi2['content_fabiaoshijian'];
				$content_tupianlianjie = '<img src="'. $content_tupianlianjie .'" />';
echo '<br />';
echo '<table width="61%" border="0"  bgcolor="#FFFFFF">';
echo '<tr>';

echo '<td valign="top" width="60" >';
require('tieba_touxiang.php');

echo '</td>';
echo '<td>';
echo $i.' ' ;



echo '<font color=#0000cc>'. $content_biaoti .'</font>';
echo '<br />';echo '<br />';


echo '<cc>'. txtToEnter($content_neirong) .'</cc>';
//$content_tupianlianjie != 0 2009-9-11 00:00 加进用于防止手机版显示图片与灰手机版的冲突 手机版 是直接赋值为0
//灰手机版是 下面那个值 这个问题可以在手机版里改0为 <img src="http://" />,但是这样我认为数据量太大
//不过灰手机版的量已经很大了~ 不过不想改~留点空间,改的话直接去修改写入数据库的值就好~
if( $content_tupianlianjie != 0 && $content_tupianlianjie != '<img src="http://" />' )
echo '<br />'.$content_tupianlianjie.'<br />';
echo '<br />';echo '<br />';

		$database = new Database();
		$database->open_connection();
		
		$sql = " SELECT user_info_id FROM user_info ".
		" inner join tieba_content where ".
		" content_zuozhe =user_nickname AND content_zuozhe = '$content_zuozhe'";
		$result = mysqli_fetch_array( $database->query($sql) );
		$user_info_id = $result['user_info_id'];
		$database->close_connection();
		
if( isset($_SESSION['user_id']) ){
	echo '作者：<a href="../changeinfo.php?&page='.$current_page.'&user_info_id='.$user_info_id.'&topic_id='. $topic_id .'">'. $content_zuozhe .'</a>&nbsp;';
	}else{
	echo '作者：'. $content_zuozhe .'&nbsp;';	
		}

require('tieba_level.php');

echo substr($content_fabiaoshijian, 0, 16);

echo ' <a href="#sub">回复此发言</a> &nbsp;';
//admin link del content
//admin link
		if( isset($_SESSION['user_info_id']) ){
			if($_SESSION['user_id'] == 'sunny')
			echo '<a href="delcontent.php?content_id=' . $content_id . '&topic_id='. $topic_id .'">delete</a>';
		}





echo '</td></tr></table>';
echo '<hr  align=left width="61%" size=1 >';
				//计楼数+1
				$i = $i + 1;
			}
		}
		$query_dianji0 = "SELECT topic_dianji FROM tieba_topics WHERE topic_id = '$topic_id'";
$result_dianji0 = mysqli_query($dbc, $query_dianji0); 
$row_dianji0 = mysqli_fetch_array($result_dianji0);
$jishu = $row_dianji0['topic_dianji'] + 1;
$query_dianji1 = "UPDATE tieba_topics SET topic_dianji = '$jishu' WHERE topic_id = '$topic_id'";
mysqli_query($dbc, $query_dianji1);
		
		
		mysqli_close($dbc);
		?>
  <?php
echo '<br />';
//分页
$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);
?>
  <?php require_once('submsg2.php');  ?>
  <?php require_once('../footer.php'); ?>
  
</div>
</body>
</html>
		




