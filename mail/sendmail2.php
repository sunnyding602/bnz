<?php


$to_name = $user_id1;
$to = $user_email;
$subject = '感谢注册bunengzhai.cn(不能宅.cn)';
$message = <<<EMAILBODY
亲爱的 {$user_id1},

你好！欢迎注册bunengzhai.cn，请留意验证页面的审核状态(www.bunengzhai.cn/yanzheng.php)
对本网站不了解？可以看下 about 页面(www.bunengzhai.cn/about.php)

本网站请你坚持自己的运动！

本邮件请勿回复。
EMAILBODY;
$message = wordwrap($message, 70);

$from_name = 'Sunny@bunengzhai.cn';
$from = 'sunnyding602@163.com';
//PHP mailer
$mail = new PHPMailer();

$mail->CharSet = 'utf-8';

$mail->IsSMTP();
$mail->Host = 'smtp.163.com';
$mail->Port = '25';
$mail->SMTPAuth = true;
$mail->Username = "sunnyding602";
$mail->Password = "147258369";
//$mail->SMTPSecure    = 'ssl';

$mail->FromName = $from_name;
$mail->From = $from;
$mail->AddAddress($to, $to_name);
$mail->Subject = $subject;
$mail->Body = $message;




$result = $mail->Send();
echo $result ? 'Sent' : 'Error';

?>