
<?php 
date_default_timezone_set('Asia/Shanghai');
$year = date ('Y');
$month = date('m');
$day = date('d');
$hour = date ('H');
$minute = date ('i');
?>
<div id="footer">
    <!-- <a href="http://m.xiaonei.com/help/guestbook.do?">登陆</a><br /> -->
    <div class="sectitle">我要...?</div>
    <a href="rank.php">0看看排行榜</a><br />
    <a href="home.php">1去个人中心</a><br />
    <a href="bbs.php">2看看贴吧(finished)</a><br />
    <a href="record_data.php">3记录数据</a><br />
    <a href="about.php">4弄清这个网站是做什么的</a><br />
    <a href="logout.php">退出</a><br />
    [<?php echo $month .'月'. $day .'日'. $hour .':'. $minute;?>]<br/>
    Sunny <span title="revision 1448; SJSWT44-77.opi.com">&#169;</span> <?php echo $year;?>
</div>
</body>
</html>
<?php 
//关闭与数据库的链接
$database->close_connection();
//清理错误,提示信息
$session->remove_error_message();
$session->remove_notice_message();
?>