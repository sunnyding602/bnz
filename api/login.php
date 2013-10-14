<?php
require_once('../connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");
$user_id = mysqli_real_escape_string($dbc, trim($_GET['username']));
$user_password = mysqli_real_escape_string($dbc, trim($_GET['password']));
$user_password = sha1($user_password);
$sql = "SELECT user_id, user_info_id, user_nickname FROM user_info WHERE user_id = '$user_id' AND user_password = '$user_password'";
$data = mysqli_query($dbc, $sql);
if (mysqli_num_rows($data) == 1) {
    $row = mysqli_fetch_array($data);
    echo $row['user_info_id'];
}
mysqli_close($dbc);
