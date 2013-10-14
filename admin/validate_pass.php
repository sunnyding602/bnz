<?php
require_once('../includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
// If the session vars aren't set, try to set them with a cookie
if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_nickname']) && isset($_COOKIE['user_info_id']) ) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['user_info_id'] = $_COOKIE['user_info_id'];
        $_SESSION['user_nickname'] = $_COOKIE['user_nickname'];
    }
}
if ($_SESSION['user_id'] != 'sunny') exit;
//链接数据库 , 让管理员查看被审核状态,显示所有数据~
if( isset($_GET['id']) ){
    $id = $_GET['id'];
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_query($dbc,"SET NAMES 'utf8'");

    $query0 = "SELECT * FROM zhuce_before WHERE id = '$id'";//取出该用户所有信息,便于后面$query2 添加
    $result = mysqli_query($dbc, $query0);
    $row = mysqli_fetch_array($result);
    //$id = $row['id'];
    $app_id = $row['app_id'];
    $app_nickname = $row['app_nickname'];
    //$app_time = $row['app_time'];
    //$apped_time = $row['apped_time']; 
    //$approval = $row['approval'];
    $app_password = $row['app_password'];
    $app_email = $row['app_email'];


    $query1 = "UPDATE zhuce_before SET approval = 1 , apped_time = NOW() WHERE id = '$id'"; //设置为已验证
    mysqli_query($dbc, $query1);

    $query2 = "INSERT INTO user_info".
        "(user_info_id, user_id, user_password, user_nickname, user_email ) " .
        "VALUES(NULL, '$app_id',  '$app_password', '$app_nickname', '$app_email') ";//向user_info 里为用户添加初始数据



    mysqli_query($dbc, $query2);

    mysqli_close($dbc);
    echo '验证成功';
    header('Location: validateuser.php');

}
else{
    echo '未得到ID';
}
?>
