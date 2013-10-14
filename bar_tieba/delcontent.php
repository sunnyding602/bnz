<?php
	require_once('connectvars.php');
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_query($dbc,"SET NAMES 'utf8'");
	if( isset($_GET['topic_id']) && isset($_GET['content_id']) ){
	$topic_id = $_GET['topic_id'];
	$content_id = $_GET['content_id'];
	}
	//topic_id 作用是 还要回到原来的页面
	$query = "DELETE FROM tieba_content WHERE content_id = '$content_id'";
	mysqli_query($dbc, $query);
	$url = 'xianshineirong2.php?topic_id='.$topic_id;
	header('Location:'.$url);
?>