<?php 
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
$user_info_id = $_SESSION['img_id'];

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");

$query1 = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id' order by user_date desc LIMIT 40";

$results1 = mysqli_query($dbc, $query1);
//初始化数据

$day_total = array();
$date = array();
$data = array();
while( $rows1 = mysqli_fetch_array($results1) ){
    $user_total_circle = $user_day_total  = $user_total_bar = 0;

    $category_circle = $rows1['category_circle'];
    $category_1 = $rows1['category_1'];
    $category_2 = $rows1['category_2'];
    $category_3 = $rows1['category_3'];
    $category_4 = $rows1['category_4'];
    $category_5 = $rows1['category_5'];
    $category_6 = $rows1['category_6'];
    $user_date = $rows1['user_date'];
    $user_date = substr($user_date,8,2);
    //计算总成绩

    $user_total_circle = $user_total_circle + $category_circle;

    $user_total_bar = $user_total_bar + $category_1 + $category_2 + $category_3 + $category_4 + $category_5 + $category_6;
    $user_day_total = 5*$user_total_circle + $user_total_bar;
    array_push($date,$user_date);
    array_push($day_total,$user_day_total);
    $data = array_combine($date,$day_total);
}
mysqli_close($dbc);


require_once('includes/open-flash-chart-2-ichor/version-2-ichor/php-ofc-library/open-flash-chart.php');
//$title = new title( date("D M d Y") );
$title = new title( 'Latest Days Records' );

$line_1_default_dot = new dot();
$line_1_default_dot->colour('#f00000');

$line_1 = new line();
$line_1->set_default_dot_style($line_1_default_dot);
$line_1->set_values( $day_total );
$line_1->set_width( 1);


$x = new x_axis();
$x->set_colour( '#428C3E' );
$x->set_grid_colour( '#86BF83' );
//
// we add a label to every X location
//
$x->set_labels_from_array(
    $date
);


$y = new y_axis();
$y->set_range( 0, 300, 50);


$chart = new open_flash_chart();
$chart->set_title( $title );
$chart->add_element( $line_1 );
$chart->set_x_axis( $x );
$chart->set_y_axis( $y );

echo $chart->toPrettyString();




?>
