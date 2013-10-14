<?php
require_once('../PHPMailer_v5.0.0/class.phpmailer.php');
require_once('../PHPMailer_v5.0.0/class.smtp.php');
require_once('../PHPMailer_v5.0.0/language/phpmailer.lang-zh_cn.php');



$to_name = 'sunny';
$to = 'sunnyding602@gmail.com';
$subject = 'Mail Test at'. strftime("%T", time());
$message = 'This is a test';
$message = wordwrap($message, 70);

$from_name = 'Sunny';
$from = 'sunny@bunengzhai.cn';
//PHP mailer
$mail = new PHPMailer();

$mail->CharSet = 'utf-8';

$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->SMTPAuth = true;
$mail->Username = "sunnyding602@gmail.com";
$mail->Password = "williamsunny";
$mail->SMTPSecure    = 'ssl';

$mail->FromName = $from_name;
$mail->From = $from;
$mail->AddAddress($to, $to_name);
$mail->Subject = $subject;
$mail->Body = $message;



$result = $mail->Send();
echo $result ? 'Sent' : 'Error';

?>