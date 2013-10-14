<?php
require_once('record.php');





$category_circle = $_GET['category_circle'];
$category_1 = $_GET['category_1'];
$category_2 = $_GET['category_2'];
$category_3 = $_GET['category_3'];
$category_4 = $_GET['category_4'];
$category_5 = $_GET['category_5'];
$category_6 = $_GET['category_6'];



$where=$_GET['where'];
$filename = $_GET['filename'];
$record = new Record($filename, $category_circle,$category_1,$category_2,$category_3,$category_4,$category_5,$category_6);
$recordArray = $record->getRecordArray();
xmlUtil::save($filename,$recordArray, $where);
xmlUtil::save($filename,$recordArray, $where);
//$records = xmlUtil::readXml('1.xml');
//print_r($recordArray);
$no = array(0=>'一', 1=>'贰', 2=>'叁');
?>

快速记录 方案<?php echo $no[$where];?> <span style="color:#36F">已保存</span>
    <?php
	  
	  echo '<br/>';
	  echo $category_circle.'<br/>'; 
	  echo $category_1.'<br/>' ;
	  echo $category_2.'<br/>' ;
	  echo $category_3.'<br/>' ;
	  echo $category_4.'<br/>' ;
	  echo $category_5.'<br/>' ;
	  echo $category_6.'<br/>' ;

	?>
    <input name="" type="button" onclick="saveToXml(<?php echo $where; ?>)" value="保存方案<?php echo $no[$where];?>" /><br/>
    <input name="" type="button" onclick="useSolution(<?php echo $where; ?>)" value="使用方案<?php echo $no[$where];?>" />