<?php
require_once('initialize.php');

$database = new Database ( );
$database->open_connection ();

$query = "SELECT * FROM user_statistics ORDER BY user_date DESC";
$database->ouput_table ( $query );
echo '<hr />';
echo $database->total_rows('jishuqi');
//$database->close_connection ();

?>