<?php
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
if( true == isset($_POST['submit_login']) ){
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_query($dbc,"SET NAMES 'utf8'");
    // Grab the user-entered log-in data
    $user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
    $user_password = mysqli_real_escape_string($dbc, trim($_POST['user_password']));
    $user_password  = sha1($user_password );
    $query = "SELECT user_id, user_info_id, user_nickname FROM user_info WHERE user_id = '$user_id' AND user_password = '$user_password'";

    $data = mysqli_query($dbc, $query);
    if (mysqli_num_rows($data) == 1) {
        // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
        $row = mysqli_fetch_array($data);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_info_id'] = $row['user_info_id'];
        $_SESSION['user_nickname'] = $row['user_nickname'];
        setcookie('user_id', $row['user_id'], time() + 1800);    // expires in 30 min
        setcookie('user_info_id', $row['user_info_id'], time() + 1800);
        setcookie('user_nickname', $row['user_nickname'], time() + 1800);  // expires in 30 min
        //在数据库里加入一column 登陆时间更新,计算当前用户在线around 30min
        //echo '<a href="changeinfo.php"><strong>' .$_SESSION['user_id']. '</strong></a> | ' .'<a href="logout.php">退出</a>';
        header('Location: index.php');
    }else{
        echo '用户名或者密码输入错了, 少年 username/password';
    }
}
@mysqli_close ( $dbc );
