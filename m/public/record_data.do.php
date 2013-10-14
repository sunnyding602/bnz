<?php
include_once ('../includes/initialize.php');
//保护数据
include(LIB_PATH.DS.'protect.php');

if(isset($_SESSION['user_info_id'])) $user_info_id = $_SESSION['user_info_id'];

if (isset ( $_POST ['save'] )) {
	//数据合理化,
	(isset ( $_POST ['pq'] ) && is_numeric ( $_POST ['pq'] ) && ($_POST ['pq'] < 20)) ? $pq = $_POST ['pq'] : $pq = 0;
	(isset ( $_POST ['zs'] ) && is_numeric ( $_POST ['zs'] ) && ($_POST ['zs'] < 100)) ? $zs = $_POST ['zs'] : $zs = 0;
	(isset ( $_POST ['fs'] ) && is_numeric ( $_POST ['fs'] ) && ($_POST ['fs'] < 100)) ? $fs = $_POST ['fs'] : $fs = 0;
	(isset ( $_POST ['qf'] ) && is_numeric ( $_POST ['qf'] ) && ($_POST ['qf'] < 20)) ? $pq = $_POST ['qf'] : $qf = 0;
	(isset ( $_POST ['c'] ) && is_numeric ( $_POST ['c'] ) && ($_POST ['c'] < 20)) ? $c = $_POST ['c'] : $c = 0;
	(isset ( $_POST ['fwc'] ) && is_numeric ( $_POST ['fwc'] ) && ($_POST ['fwc'] < 200)) ? $fwc = $_POST ['fwc'] : $fwc = 0;
	(isset ( $_POST ['ywqz'] ) && is_numeric ( $_POST ['ywqz'] ) && ($_POST ['ywqz'] < 100)) ? $ywqz = $_POST ['ywqz'] : $ywqz = 0;
	(isset ( $_POST ['wz'] ) && ! empty ( $_POST ['wz'] )) ? $wz = $_POST ['wz'] : $wz = '因为坚持,所以不同';
	//书写判断今日数据是否存在语句
	$sql = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id ' AND user_date='$today'";
	
	if ($database->affected_rows ( $database->query ( $sql ) ) == 1) { //等于0就是没有找到就应写入,等于1就是找到了应更新
		//更新
		$sql = "UPDATE  user_statistics SET " . "category_circle = '$pq', category_1 = '$zs', category_2 = '$fs', category_3 = '$qf'" . ", category_4 = '$c', category_5 = '$fwc', category_6 = '$ywqz' ,user_thoughts = '$wz ' " . " WHERE user_info_id = '$user_info_id' AND user_date = '$today'";
		if ($database->query ( $sql ))
			$session->set_notice_message ( '数据已更新' );
		else
			$session->set_error_message ( '数据未更新' );
		redirect_to ( 'record_data.php' );
	} else {
		//写入
		$sql = "INSERT INTO user_statistics" . "(id, user_info_id, category_circle, category_1,category_2, category_3, category_4, category_5, category_6, user_thoughts, user_date)" . "VALUES(NULL, '$user_info_id'," . " '$pq', '$zs', '$fs', '$qf', '$c', '$fwc', '$ywqz', '$wz', '$today')";
		if ($database->query ( $sql ))
			$session->set_notice_message ( '数据已记录' );
		else
			$session->set_error_message ( '数据未记录' );
		redirect_to ( 'record_data.php' );
	
	}
}

?>
