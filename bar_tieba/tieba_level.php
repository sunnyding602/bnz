<style type="text/css">
<!--
.STYLE1 {
	color:#FF00FF;
	font-weight: bold;
}
-->
</style>

<?php
@define('IMAGE_PATH','../bar_image/levels');
$level=0;
if($user_total < 200) {$level = 0; $designation ='无名的旅人' ;$nextlevel = 200; $levelpath = 'level0';}
if($user_total >= 200) {$level = 1;$designation ='路旁的落叶' ; $nextlevel = 400; $levelpath = 'level1';}
if($user_total > 400) {$level = 2; $designation ='水面上的小草' ; $nextlevel = 800; $levelpath = 'level2';}
if($user_total > 800) {$level = 3;$designation = '呢喃的歌声'; $nextlevel = 1600; $levelpath = 'level3';}
if($user_total > 1600) {$level = 4;$designation ='地上的月影' ; $nextlevel = 3200; $levelpath = 'level4';}
if($user_total > 3200) {$level = 5;$designation ='奔跑的春风' ; $nextlevel = 6400; $levelpath = 'level5';}
if($user_total > 6400) {$level = 6;$designation ='苍之风云' ; $nextlevel = 12800; $levelpath = 'level6';}
if($user_total > 12800) {$level = 7;$designation ='摇曳的金星' ;$nextlevel = 25600; $levelpath = 'level7';}
if($user_total > 25600) {$level = 8;$designation ='欢喜的慈雨' ; $nextlevel = 38400; $levelpath = 'level8';}
if($user_total > 38400) {$level = 9;$designation ='蕴含的太阳' ; $nextlevel = 51200; $levelpath = 'level9';}
if($user_total > 51200) {$level = 10;$designation ='敬畏的静寂' ; $nextlevel = 76800; $levelpath = 'level10';}
if($user_total > 76800) {$level = 11;$designation ='无尽的雷鸣' ; $nextlevel = 102400; $levelpath = 'level11';}
if($user_total > 102400) {$level = 12;$designation ='震撼的咆哮' ; $nextlevel = 153600; $levelpath = 'level12';}
if($user_total > 153600) {$level = 13;$designation ='KONGFU COACH' ; $nextlevel = 200000; $levelpath = 'level13';}
$jinyan = ceil($user_total/$nextlevel*16);
echo '<br />等级: <img src="' . IMAGE_PATH . '/' . $levelpath.'/'.$jinyan . '.jpg" />';echo ' ';
echo' 称号:<span class="STYLE1">'.$designation.'</span>';
?>
