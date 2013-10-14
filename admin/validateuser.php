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
//链接数据库 , 让管理员查看被审核状态,显示所有信息~
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");

$query = "SELECT * FROM zhuce_before ORDER BY app_time DESC";

$results = mysqli_query($dbc, $query);

echo '<table>';
echo '<tr><td>用户ID</td><td>登录名</td><td>用户昵称 </td><td>密码 </td><td>电子邮件</td><td>申请时间 </td><td>验证时间 </td><td> 验证状态</td></tr>'; 
while( $rows = mysqli_fetch_array($results) ){
    $id = $rows['id'];
    $app_id = $rows['app_id'];
    $app_nickname = $rows['app_nickname'];
    $app_password = $rows['app_password'];
    $app_email = $rows['app_email'];
    $app_time = $rows['app_time'];
    $apped_time = $rows['apped_time']; 
    $approval = $rows['approval'];

    if( $approval == 0 ){
        $approval = '未验证';
    }else $approval = '验证通过';

    echo '<tr>';
    echo '<td>' . $id . '</td>';
    echo '<td>' . $app_id . '</td>';
    echo '<td>' . $app_nickname . '</td>';
    echo '<td>' . $app_password . '</td>';
    echo '<td>' . $app_email . '</td>';
    echo '<td>' . $app_time . '</td>';
    echo '<td>' . $apped_time . '</td>';
    echo '<td>' . $approval . '</td>';


    if( $approval == '未验证' ){
        echo '<td><a href="'.SITE_ROOT_URL.'admin/validate_pass.php?id=' . $id . '">验证</a></td>';
        echo '<td><a href="'.SITE_ROOT_URL.'admin/validate_deny.php?id=' . $id . '">删除</a></td>';
    }else{
        echo '<td>验证</td>';
        echo '<td><a href="'.SITE_ROOT_URL.'admin/validate_deny.php?id=' . $id . '">删除</a></td>';

    }
    echo '</tr>';


}
echo '</table>';

mysqli_close($dbc);

?>
