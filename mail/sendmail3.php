<?php


$to_name = $user_id;
$to = $user_email;
$subject = 'bunengzhai.cn(您的新密码)';
$message = <<<EMAILBODY
亲爱的 {$user_id},

你好！感谢使用本系统找回密码，您的新密码为  {$pw}

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