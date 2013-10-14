<?php
//setcookie ("rank", "total", time() + 3600 * 24 * 2);
echo '<br /><strong>RANKLIST TOP TEN</strong>';
//----------------------总排行榜计算---------------
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");



$query0 = "SELECT * FROM user_info";
$results0 = mysqli_query($dbc, $query0);
while( $rows0 = mysqli_fetch_array($results0) ){
    //拉出有用信息
    $user_info_id = $rows0['user_info_id'];

    $query1 = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id'";

    $results1 = mysqli_query($dbc, $query1);
    //初始化数据
    $user_total_circle = $user_total_bar = 0;
    while( $rows1 = mysqli_fetch_array($results1) ){


        $category_circle = $rows1['category_circle'];
        $category_1 = $rows1['category_1'];
        $category_2 = $rows1['category_2'];
        $category_3 = $rows1['category_3'];
        $category_4 = $rows1['category_4'];
        $category_5 = $rows1['category_5'];
        $category_6 = $rows1['category_6'];
        //计算总成绩

        $user_total_circle = $user_total_circle + $category_circle;

        $user_total_bar = $user_total_bar + $category_1 + $category_2 + $category_3 + $category_4 + $category_5 + $category_6;
    }

    $user_total = 5*$user_total_circle + $user_total_bar;
    //	把算出总分写入数据库	
    $querytotal = "UPDATE user_info SET user_total_circle = '$user_total_circle' , user_total_bar = '$user_total_bar' ,user_total = '$user_total' ".
        "  WHERE user_info_id = '$user_info_id' ";
    mysqli_query($dbc, $querytotal);
}
//计算排名
$queryrank1 = "SELECT * FROM user_info ORDER BY user_total DESC";
$results_rank = mysqli_query($dbc, $queryrank1 );
$rank = 1;
while( $rows = mysqli_fetch_array($results_rank)  ){

    $user_id = $rows['user_id'];


    $query_rank = "UPDATE user_info SET user_rank = '$rank' WHERE user_id ='$user_id' ";
    mysqli_query($dbc, $query_rank);
    $rank++;
}


//--------------------总排行榜计算上---------

$query = "SELECT * FROM user_info ORDER BY user_total DESC,user_rank ASC LIMIT 10 ";

$result = mysqli_query($dbc, $query);

echo '<table>';
echo '<tr><td></td><td>昵称</td><td>跑圈总数&nbsp;</td><td>&nbsp;拉杠总数&nbsp;</td><td>&nbsp;排名&nbsp;</td><td>&nbsp;最近体会...</td></tr>';
while($row = mysqli_fetch_array($result)){
    $user_info_id = $row['user_info_id'];
    $user_nickname = $row['user_nickname'];
    $user_total_circle = $row['user_total_circle'];
    $user_total_bar = $row['user_total_bar'];
    $user_rank  = $row['user_rank'];
    //找出他的最近想法
    $query_xiangfa = "SELECT user_thoughts FROM user_statistics WHERE user_info_id='$user_info_id' ORDER BY user_date DESC";
    $result_xiangfa = mysqli_query($dbc, $query_xiangfa);
    $row_xiangfa = mysqli_fetch_array($result_xiangfa);
    $xiangfa = $row_xiangfa['user_thoughts'];
    //截取字符,避免过长
    if(strlen($xiangfa)>=90)
        $xiangfa = getstr($xiangfa,60,'utf-8').'...';
    //找出头像
    $query_touxiang = "SELECT * FROM user_touxiang WHERE user_info_id = '$user_info_id'";
    $result_touxiang = mysqli_query($dbc, $query_touxiang);
    $row_touxiang = mysqli_fetch_array($result_touxiang);
    $touxiang_name = $row_touxiang['touxiang_name'];
    if( isset($_SESSION['user_id']) ){//如果是会员，则显示链接
        if(!empty($touxiang_name)){//如果有头像，则显示头像
            if ($user_rank <= 3){
                echo '<tr><td><img src="'. TX_UPLOADPATH.$touxiang_name.'" width="60" height="60" /></td><td><a href="changeinfo.php?user_info_id='.$user_info_id.'" target="_blank">' . $user_nickname .'</a></td><td>' . $user_total_circle . ' </td><td>' . $user_total_bar . '</td><td>' . $user_rank . '</td><td>' . $xiangfa . '</td></tr>';
            }else{

                echo '<tr><td><img src="'. TX_UPLOADPATH.$touxiang_name.'" width="50" height="50" /></td><td><a href="changeinfo.php?user_info_id='.$user_info_id.'" target="_blank">' . $user_nickname .'</a></td><td>' . $user_total_circle . ' </td><td>' . $user_total_bar . '</td><td>' . $user_rank . '</td><td>' . $xiangfa . '</td></tr>';
            }

        }else{
            echo '<tr><td><img src="'. TX_UPLOADPATH.'default.jpg" width="50" height="50" /></td><td><a href="changeinfo.php?user_info_id='.$user_info_id.'" target="_blank">' . $user_nickname .'</a></td><td>' . $user_total_circle . ' </td><td>' . $user_total_bar . '</td><td>' . $user_rank . '</td><td>' . $xiangfa . '</td></tr>';
        }
    }else{//不是会员，没有链接
        if(!empty($touxiang_name)){//如果有头像，则显示头像
            if ($user_rank <= 3){
                echo '<tr><td><img src="'. TX_UPLOADPATH.$touxiang_name.'" width="60" height="60" /></td><td>' . $user_nickname .'</td><td>' . $user_total_circle . ' </td><td>' . $user_total_bar . '</td><td>' . $user_rank . '</td><td>' . $xiangfa . '</td></tr>';
            }else{

                echo '<tr><td><img src="'. TX_UPLOADPATH.$touxiang_name.'" width="50" height="50" /></td><td>' . $user_nickname .'</td><td>' . $user_total_circle . ' </td><td>' . $user_total_bar . '</td><td>' . $user_rank . '</td><td>' . $xiangfa . '</td></tr>';
            }

        }else{
            echo '<tr><td><img src="'. TX_UPLOADPATH.'default.jpg" width="50" height="50" /></td><td>' . $user_nickname .'</td><td>' . $user_total_circle . ' </td><td>' . $user_total_bar . '</td><td>' . $user_rank . '</td><td>' . $xiangfa . '</td></tr>';
        }



    }


}
echo '</table><br />';
?>

