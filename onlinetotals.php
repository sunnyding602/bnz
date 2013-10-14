<?php
//在线会员
// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");

$query = "SELECT * FROM jishuqi WHERE TIME_TO_SEC(last_visit) >( TIME_TO_SEC(NOW())-900 ) AND
last_visit > CURRENT_DATE()";
$results = mysqli_query($dbc,$query);
$zaixianrenshu = mysqli_affected_rows($dbc);
/*echo '在线会员:';
while( $rows = mysqli_fetch_array($results) ){
	$lastest_visit = $rows['user_id'];
	if( $lastest_visit!='MTuser' ) echo $lastest_visit .' ';
}*/




echo $zaixianrenshu;

mysqli_close($dbc);
?>
