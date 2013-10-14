<?php //require_once('connectvars.php'); ?>

<?php
	if( isset($_GET['id']) ){
		$id = $_GET['id'];
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	mysqli_query($dbc,"SET NAMES 'utf8'");
	$query_announcement = "SELECT * FROM announcement WHERE id = '$id '";
	$results_announcement = mysqli_query($dbc, $query_announcement);
	
	while( $rows_announcement = mysqli_fetch_array($results_announcement) ){
		$announcement_id = $rows_announcement['id'];
		$announcement_theme = $rows_announcement['theme'];
		$announcement_content = $rows_announcement['content'];
		$announcement_time_at = $rows_announcement['time_at'];
	}
	echo '<strong>OFFICIAL ANNOUNCEMENT</strong><br />';
	echo '<h4>'. $announcement_theme.' </h4>'.$announcement_time_at.'<br />';
	echo txtToEnter($announcement_content).'<br />';
	//echo '<a href="index.php">返回</a><br />';
	
	}
	mysqli_close($dbc);
?>

