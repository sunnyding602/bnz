<?php 
require_once('../connectvars.php');
$category_circle = $_GET['category_circle'];
$category_1 = $_GET['category_1'];
$category_2 = $_GET['category_2'];
$category_3 = $_GET['category_3'];
$category_4 = $_GET['category_4'];
$category_5 = $_GET['category_5'];
$category_6 = $_GET['category_6'];
$user_thoughts = rawurldecode($_GET['user_thoughts']);
$user_info_id = $_GET['userid'];
$today = date('Y-m-d');
//-放超人机制-------------------------------
if($category_circle > 20 ) { $category_circle = 0; echo 'BOY! you are not a superman~'; }
if($category_1 > 100 ) { $category_1 = 0; echo 'BOY! you are not a superman~'; }
if($category_2 > 100 ) { $category_2 = 0; echo 'BOY! you are not a superman~'; }
if($category_3 > 20 ) { $category_3 = 0; echo 'BOY! you are not a superman~'; }
if($category_4 > 100 ) { $category_4 = 0; echo 'BOY! you are not a superman~'; }
if($category_5 > 200 ) { $category_5 = 0; echo 'BOY! you are not a superman~'; }
if($category_6 > 200 ) { $category_6 = 0; echo 'BOY! you are not a superman~'; }
//--------------------------------------------

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query1 = "INSERT INTO user_statistics".
    "(id, user_info_id, category_circle, category_1,category_2, category_3, category_4, category_5, category_6, user_thoughts, user_date)".
    "VALUES(NULL, '$user_info_id',".
    " '$category_circle', '$category_1', '$category_2', '$category_3', '$category_4', '$category_5', '$category_6', '$user_thoughts', '$today')";
$queryif = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id' AND user_date = '$today'";
$query2 = "UPDATE  user_statistics SET ".
    "category_circle = '$category_circle', category_1 = '$category_1', category_2 = '$category_2', category_3 = '$category_3'".
    ", category_4 = '$category_4', category_5 = '$category_5', category_6 = '$category_6' ,user_thoughts = '$user_thoughts ' ".
    " WHERE user_info_id = '$user_info_id' AND user_date = '$today'";
mysqli_query($dbc,"SET NAMES 'utf8'");
$resultsif = mysqli_query($dbc, $queryif);
if(mysqli_num_rows($resultsif) == 1){
    $result2 = mysqli_query($dbc, $query2);
    echo 'successfully updated!';
}
else{
    $result1 = mysqli_query($dbc, $query1);
    echo 'recorded successfully!';
}
mysqli_close($dbc);
