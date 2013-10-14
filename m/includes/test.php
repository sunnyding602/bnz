<?php
require_once('initialize.php');

//$database = new Database ( );
//$database->open_connection ();

$query = "SELECT * FROM jishuqi ORDER BY last_visit DESC";
$database->ouput_table ( $query );
echo '<hr />';
echo $database->total_rows('jishuqi');
//$database->close_connection ();

?>