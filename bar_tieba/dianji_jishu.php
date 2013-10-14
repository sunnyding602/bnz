<?php
//点击计数

$query_dianji0 = "SELECT topic_dianji FROM tieba_topics WHERE topic_id = '$topic_id'";
$result_dianji0 = mysqli_query($dbc, $query_dianji0); 
$row_dianji0 = mysqli_fetch_array($result_dianji0);
$jishu = $row_dianji0['topic_dianji'] + 1;
$query_dianji1 = "UPDATE tieba_topics SET topic_dianji = '$jishu' WHERE topic_id = '$topic_id'";
mysqli_query($dbc, $query_dianji1);

?>