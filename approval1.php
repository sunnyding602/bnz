
<?php
//require_once('connectvars.php');
//链接数据库 , 让用户查看被审核状态,只显示昵称~
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");
$query_approval = "SELECT * FROM zhuce_before ORDER BY app_time DESC";
$result_approval = mysqli_query($dbc, $query_approval);
echo '<table border="0">';
echo '<tr><td>用户昵称</td><td>申请时间</td><td>审核时间</td><td>审核结果</td></tr>';
while( $rows_approval = mysqli_fetch_array($result_approval) ){
	$app_nickname = $rows_approval['app_nickname'];
	$app_time = $rows_approval['app_time'];
	$apped_time = $rows_approval['apped_time']; 
	$approval = $rows_approval['approval'];
	if( $approval == 0 ){
	$approval = '未审核';
	}else {$approval = '审核通过';}
	
		echo '<tr>';
			echo '<td>' . $app_nickname . '</td>';
			echo '<td>' . $app_time . '</td>';
			echo '<td>' . $apped_time . '</td>';
			echo '<td>' . $approval . '</td>';
		echo '</tr>';
	
}
echo'</table>'; 
mysqli_close($dbc);

?>
