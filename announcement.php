<?php // require_once('connectvars.php'); ?>

<?php // require 到index.php 的时候 不用 要上面的东西了~~~~ (做个表格)
	//1.content
	//2.links
	//connect to the database
	//$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//mysqli_query($dbc,"SET NAMES 'utf8'");
	$query_announcement = "SELECT * FROM announcement ORDER BY time_at DESC LIMIT 10";
	$results_announcement = mysqli_query($dbc, $query_announcement);
	echo '<strong>OFFICIAL ANNOUNCEMENT</strong><br />';
	//echo '<ul>';
	echo '<table  width="100%">';
	
	while( $rows_announcement = mysqli_fetch_array($results_announcement) ){
		$announcement_id = $rows_announcement['id'];
		$announcement_theme = $rows_announcement['theme'];
		//$announcement_content = $rows_announcement['content'];
		$announcement_time_at = $rows_announcement['time_at'];
		//build the links substr($announcement_theme,0,30)
		echo '<tr><td><a href="announcementshow.php?id=' . $announcement_id . '">[公告]' .$announcement_theme;
		echo ' ' . '</a><br /></td>';
		echo '<td align="right">['. substr($announcement_time_at,0,16) . '] </td>';
		//admin link
		if( isset($_SESSION['user_info_id']) ){
			if($_SESSION['user_id'] == 'sunny'){
				echo '<td><a href="announcementfix.php?id=' . $announcement_id . '">fix</a></td>';
				echo '<td><a href="bar_admin/delannouncement.php?id=' . $announcement_id . '">delete</a></td>';
			}
 		}
		
		
		echo '</tr>';
		
	}
	echo '</table>';
	//echo '</ul>';
	//mysqli_close($dbc);
?>
