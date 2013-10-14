<?php
require_once('record.php');

$where=$_GET['where'];
$filename = $_GET['filename'];

$records = xmlUtil::readXml($filename);


	  echo $records['solution'][$where]['category_circle'].','; 
	  echo $records['solution'][$where]['category_1'].',' ;
	  echo $records['solution'][$where]['category_2'].',' ;
	  echo $records['solution'][$where]['category_3'].',' ;
	  echo $records['solution'][$where]['category_4'].',' ;
	  echo $records['solution'][$where]['category_5'].',' ;
	  echo $records['solution'][$where]['category_6'] ;
?>