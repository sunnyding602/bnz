<?php
class regExp
{
    //一个字符串是否足够长
	static function is_long_enough($str='',$length=0){
		if(strlen($str)>$length)
			return TRUE;
		else
			return false;
		}
		
	//去除字符串空格
    static function strTrim($str)
    {
        return preg_replace("/\s/","",$str);
    }

    //验证用户名
    static function userName($str,$type,$len)
    {
        $str=self::strTrim($str);
        if($len<strlen($str))
        {
            return false;
        }else{
            switch($type)
            {
                case "EN"://纯英文
                    if(preg_match("/^[a-zA-Z]+$/",$str))
                    {
                        return true;
                    }else{
                        return false;
                    }
                    break;
                case "ENNUM"://英文数字
                    if(preg_match("/^[a-zA-Z0-9]+$/",$str))
                    {
                        return true;
                    }else{
                        return false;
                    }
                    break;
                case "ALL":    //允许的符号(|-_字母数字)
                    if(preg_match("/^[\|\-\_a-zA-Z0-9]+$/",$str))
                    {
                        return true;
                    }else{
                        return false;
                    }
                    break;
            }
        }
    }

    //验证密码长度
    static function passWord($min,$max,$str)
    {
        $str=self::strTrim($str);
        if(strlen($str)>=$min && strlen($str)<=$max)
        {
            return true;
        }else{
            return false;
        }
    }

    //验证Email
    static function Email($str)
    {
        $str=self::strTrim($str);
        
        if(preg_match("/^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.){1,2}[a-z]{2,4}$/i",$str))
        {
            return true;
        }else{
            return false;
        }
        
    }

    //验证身份证(中国)
    static function idCard($str)
    {
        $str=self::strTrim($str);
        if(preg_match("/^([0-9]{15}|[0-9]{17}[0-9a-z])$/i",$str))
        {
            return true;
        }else{
            return false;
        }
    }

    //验证座机电话
    static function Phone($type,$str)
    {
        $str=self::strTrim($str);
        switch($type)
        {
            case "CHN":
                if(preg_match("/^([0-9]{3}|0[0-9]{3})-[0-9]{7,8}$/",$str))
                {
                    return true;
                }else{
                    return false;
                }
                break;
            case "INT":
                if(preg_match("/^[0-9]{4}-([0-9]{3}|0[0-9]{3})-[0-9]{7,8}$/",$str))
                {
                    return true;
                }else{
                    return false;
                }
                break;
		}
	}
	//-------------------------------------
	// 数据入库 转义 特殊字符 传入值可为字符串 或 一维数组 
	function data_join($data) { 
		if(get_magic_quotes_gpc() == false) { 
			if (is_array($data)) { 
				foreach ($data as $k => $v)	{ 
					$data[$k] = addslashes($v); 
				} 
			} else { 
				$data = addslashes($data); 
			} 
		} 
		Return $data; 
	
	} 


	
	// 数据出库 还原 特殊字符 传入值可为字符串 或 一/二维数组 
	function data_revert($data) { 
		if (is_array($data)) { 
			foreach ($data as $k1 => $v1) { 
				if (is_array($v1)) { 
					foreach ($v1 as $k2 => $v2) { 
						$data[$k1][$k2] = stripslashes($v2); 
					} 
				} 
				else { 
					$data[$k1] = stripslashes($v1); 
				} 
			} 
		} 
		else { 
			$data = stripslashes($data); 
		} 
		Return $data; 
	} 

	
	
	//-----------------------------------
}
	
	/*以下是一些测试,只要去掉注释就能看到
	 $str="010-2711204";
	if(regExp::Phone("CHN",$str))
	{
		echo "ok";
	}else{
		echo "no";
	}

	$data1 =  regexp::data_join('fdshjkfn!@#$%^&*()-=+/\dskhnfdsfk');
	echo $data1; echo '<br />';
	
	$data2 = regexp::data_revert($data1);
	echo $data2;*/

?>