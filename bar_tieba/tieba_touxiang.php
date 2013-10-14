<?php
$touxiang_name = null;
$query = "SELECT user_info_id,user_total,user_rank FROM user_info WHERE user_nickname = '$content_zuozhe'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
$user_info_id1 = $row['user_info_id'];
$user_total = $row['user_total'];
$user_rank = $row['user_rank'];
if(!empty($user_info_id1)){
	$query = "SELECT * FROM user_touxiang WHERE user_info_id = '$user_info_id1'";
	$result = mysqli_query($dbc,$query);
	$row = mysqli_fetch_array($result);
	$touxiang_name = $row['touxiang_name'];
	if(!empty($touxiang_name)){
		echo '<img src="../'. TX_UPLOADPATH.$touxiang_name.'" width="60" height="60" />';
		
	}
}
if(empty($touxiang_name))
echo '<img src="../'. TX_UPLOADPATH.'default.jpg" width="60" height="60" />';
?>
