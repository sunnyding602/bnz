<?php
require_once('connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");

if( isset($_GET['topic_id']) ){
$topic_id = $_GET['topic_id'];
}

$query1 = "DELETE FROM tieba_topics WHERE topic_id = '$topic_id '";
$query2 = "DELETE FROM tieba_content WHERE topic_id = '$topic_id";
mysqli_query($dbc, $query1);
mysqli_query($dbc, $query2);
mysqli_close($dbc);
header('Location: index1.php');
?>