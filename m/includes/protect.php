<?php

if($session->logged_in){
}else{
	$session->set_error_message('用户信息保护,请登录');
	redirect_to('index.php');
}
?>