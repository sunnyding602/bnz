<?php
session_start();
  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_nickname']) && isset($_COOKIE['user_info_id']) ) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
	  $_SESSION['user_info_id'] = $_COOKIE['user_info_id'];
      $_SESSION['user_nickname'] = $_COOKIE['user_nickname'];
    }
  }
if(isset($_SESSION['user_id'])){
	if( $_SESSION['user_id'] != 'sunny' )
		echo 'You are <strong>NOT</strong>sunny'; exit();
}else { echo 'ÇëµÇÂ¼'; exit();}

?>