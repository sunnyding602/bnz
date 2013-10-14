<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>拉杠小分队官方贴吧-->把内搜索</title>
</head>

<body>
<div class="content">
  <?php require_once('tieba_login.php');?>
  <?php require_once('navigation.php');?><br /><br />
  <table>
    <tr>
      <td>
<?php //todo     change the link to absolute url/path?>
        <form id="search" name="search" method="get" action="search.php">
          <input type="text" name="usersearch" />
          <input type="submit" name="submit_search" value="吧内搜索" />
          <input name="checkbox" type="radio" value="1" checked="checked" />按标题
          <input type="radio" name="checkbox" value="2" />按内容
        </form>
      </td>
      </tr>
  </table>
  <hr size="1">
  <?php
  require_once('connectvars.php');
  // This function builds a search query from the search keywords and sort setting
  function build_query($user_search, $sort) {
    $search_query = "SELECT * FROM tieba_content";

    // Extract the search keywords into an array
    $clean_search = str_replace(',', ' ', $user_search);
    $search_words = explode(' ', $clean_search);
    $final_search_words = array();
    if (count($search_words) > 0) {
      foreach ($search_words as $word) {
        if (!empty($word)) {
          $final_search_words[] = $word;
        }
      }
    }

    // Generate a WHERE clause using all of the search keywords
    switch($sort){
		//search for the biaoti
		case 1:
					$where_list = array();
			if (count($final_search_words) > 0) {
			  foreach($final_search_words as $word) {
				$where_list[] = "content_biaoti LIKE '%$word%'";
			  }
			}
			$where_clause = implode(' OR ', $where_list);
		
			// Add the keyword WHERE clause to the search query
			if (!empty($where_clause)) {
			  $search_query .= " WHERE $where_clause";
			}
			break;
		//search for the neirong
		case 2:
								$where_list = array();
			if (count($final_search_words) > 0) {
			  foreach($final_search_words as $word) {
				$where_list[] = "content_neirong LIKE '%$word%'";
			  }
			}
			$where_clause = implode(' OR ', $where_list);
		
			// Add the keyword WHERE clause to the search query
			if (!empty($where_clause)) {
			  $search_query .= " WHERE $where_clause";
			}
	}
	$search_query .= ' ORDER BY content_fabiaoshijian DESC';
	return $search_query;
	
}

//接收搜索词
//{
	if( !empty($_GET['usersearch']) ) $usersearch = $_GET['usersearch'];
	 else { echo '没有任何词,就想搜到东西? 这不可能!'; exit();}
	if( isset($_GET['checkbox']) ) $sort = $_GET['checkbox'];
	if( isset($_GET['submit_search']) ) $submit_search = 	$_GET['submit_search'];
	//如果提交了才可以建立query~
	$query = build_query($usersearch, $sort);
//}//
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'utf8'");

//分页-------------------------------------------------------------
		require('../class/page.class.php');//加载类文件

		$sql=build_query($usersearch, $sort);
		$queryc=mysqli_query($dbc,$sql);
		$nums=mysqli_num_rows($queryc);
		
		$each_disNums=10;
		$sub_pages=10;
		$pageNums = ceil($nums/$each_disNums);
		@$subPage_link='search.php?usersearch='.$usersearch.'&checkbox='.$sort.'&page=';
		$subPage_type=1;//为1时,显示结果1,为2时,显示结果2
		if( isset($_GET['page']) ) $current_page=$_GET['page'];
		else $current_page=1;
		
		$skip = ($current_page-1)*$each_disNums;
//分页--------------------------------------------------------------


$query = $query." limit $skip,$each_disNums";


$data = mysqli_query($dbc, $query);

while( $rows = mysqli_fetch_array($data) ){
	$topic_id = $rows['topic_id'];
	$zuozhe = $rows['content_zuozhe'];
	$biaoti = $rows['content_biaoti'];
	$neirong = $rows['content_neirong'];
	$fabiaoshijian = $rows['content_fabiaoshijian'];
	
	echo '<a href="xianshineirong2.php?topic_id='.$topic_id.'"><strong>'. $biaoti .'</strong></a>';
	echo '<br />';
	echo '内容: '.$neirong;
	echo '<br />';
	echo '作者: '.$zuozhe.' ';
	echo ' 发表时间: '.$fabiaoshijian;
	echo '<br />';
	echo '<br />';

}


mysqli_close($dbc);
$pg=new SubPages($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type);

?>
  <hr size="1">
  &copy;2009 Sunny Contact me ? Please mail to: sunnyding602@gmail(dot)com
</div>
</body>
</html>
