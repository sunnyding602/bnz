<?php
function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_error_message($message="") {
  if (!empty($message)) { 
    echo "<div class=\"error\"><b>{$message}</b></div>";
  } else {
    echo "";
  }
}

function output_notice_message($message="") {
  if (!empty($message)) { 
    echo "<div class=\"notice\"><b>{$message}</b></div>";
  } else {
    echo "";
  }
}
//截取字符串
function getstr($string, $length,$charset='gb2312')
{
	if($length && strlen($string) > $length) {
		//囟址
		$wordscut = '';
		if($charset == 'utf-8') {
			//utf8
			$n = 0;
			$tn = 0;
			$noc = 0;
			while ($n < strlen($string)) {
				$t = ord($string[$n]);
				if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
					$tn = 1;
					$n++;
					$noc++;
				} elseif(194 <= $t && $t <= 223) {
					$tn = 2;
					$n += 2;
					$noc += 2;
				} elseif(224 <= $t && $t < 239) {
					$tn = 3;
					$n += 3;
					$noc += 2;
				} elseif(240 <= $t && $t <= 247) {
					$tn = 4;
					$n += 4;
					$noc += 2;
				} elseif(248 <= $t && $t <= 251) {
					$tn = 5;
					$n += 5;
					$noc += 2;
				} elseif($t == 252 || $t == 253) {
					$tn = 6;
					$n += 6;
					$noc += 2;
				} else {
					$n++;
				}
				if ($noc >= $length) {
					break;
				}
			}
			if ($noc > $length) {
				$n -= $tn;
			}
			$wordscut = substr($string, 0, $n);
		} else {
			for($i = 0; $i < $length - 1; $i++) {
				if(ord($string[$i]) > 127) {
					$wordscut .= $string[$i].$string[$i + 1];
					$i++;
				} else {
					$wordscut .= $string[$i];
				}
			}
		}
		$string = $wordscut;
	}
	return trim($string);
}
//获得用户IP
		function get_client_ip() {
			if ($_SERVER ['REMOTE_ADDR']) {
				$cip = $_SERVER ['REMOTE_ADDR'];
			} elseif (getenv ( "REMOTE_ADDR" )) {
				$cip = getenv ( "REMOTE_ADDR" );
			} elseif (getenv ( "HTTP_CLIENT_IP" )) {
				$cip = getenv ( "HTTP_CLIENT_IP" );
			} else {
				$cip = "unknown";
			}
			return $cip;
		}
	//控制输出格式	
		function   txtToEnter($str)   
  {   
  $str   =   ereg_replace(' ',"&nbsp;",$str);   
  $str   =   ereg_replace("\n","<br>",$str);   
  return   $str;   
  }
?>