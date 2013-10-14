<?php
require_once '../class/RenrenRestApiService.class.php';

echo 'aid:'.$_POST["aid"].'<br>';
echo 'session_key:'.$_POST["session_key"].'<br>';
echo 'img_src:'.$_POST["img_src"].'<br>';
echo 'description:'.$_POST["description"].'<br>';

echo '<hr>';
echo '华丽的分割线';
echo '<hr>';

$session_key=$_POST["session_key"];
$aid=$_POST["aid"];
$img_src=$_POST["img_src"];
$description=$_POST["description"];
$isPublish=$_POST["isPublish"];
$restApi = new RenrenRestApiService;
if($isPublish==1)
{
preg_match('|\.(\w+)$|', $img_src, $ext);
#转化成小写
$ext = strtolower($ext[1]);

$myfile=array('upload'=>array(
'name'=>'your.'.$ext,
'tmp_name'=>$img_src,//如果是服务器本地图片，可以这么写：'tmp_name'=>'c:/pic.jpg'
'type'=>'image/'.$ext
));

$params = array('aid'=>$aid,'caption'=>$description,'session_key'=>$session_key);
//上传照片的方法，不默认开启，需要测试时，将如下两行代码解除注释，刷新一个该页面，即可将图片传到人人网
$res = $restApi->rr_photo_post_fopen('photos.upload',$params,$myfile);//基于fopen函数的发送请求
print_r($res);//输出结果
}
?>
<br><a  href="../main.php" >返回</a>