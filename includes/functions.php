<?php


            function get_client_ip(){
                if ($_SERVER['REMOTE_ADDR']) {
                    $cip = $_SERVER['REMOTE_ADDR'];
                } elseif (getenv("REMOTE_ADDR")) {
                    $cip = getenv("REMOTE_ADDR");
                } elseif (getenv("HTTP_CLIENT_IP")) {
                    $cip = getenv("HTTP_CLIENT_IP");
                } else {
                    $cip = "unknown";
                }
                return $cip;
            }


function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
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


// 说明：获取完整URL

function curPageURL() 
{
    $pageURL = 'http';
/*
    if ($_SERVER["HTTPS"] == "on") 
    {
        $pageURL .= "s";
    }*/
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } 
    else 
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
	$search = end(explode("/",$pageURL));
	$pageURL = str_replace('/'.$search, '', $pageURL);
    return $pageURL;
}

//todo   replace the deprecated function
function   txtToEnter($str)   
  {   
  $str   =   ereg_replace(' ',"&nbsp;",$str);   
  $str   =   ereg_replace("\n","<br>",$str);   
  return   $str;   
  }  
?>
