<?php
/**
     * 定义一些公用的方法
     */

/**
 * 输出数组
 * 
 * @param 要输出的数组 $arr        	
 */
$tem = '';
function __printArrData($arr) {
	if ($GLOBALS['tem'] != ''){
	echo '</br>+----------------begin---------------+</br>';
	}
	if(is_array($arr)){
	foreach ( $arr as $key => $value ) {
		if(is_array($value)){
			echo $key.'=></br>';
			$GLOBALS['tem'] = $GLOBALS['tem'].'_ _ _ ';
			__printArrData($value);
		}else {
			echo $GLOBALS['tem'].$key . "=>" . $value.'</br>';
		}
	}
	}else {
		echo 'is not a array';
	}
	
}

/**
 * 获取get值
 * @param unknown get的字符串
 * @return 返回get方法的值
 */
function __get($str) {
	$val = ! empty ( $_GET [$str] ) ? $_GET [$str] : null;
	return $val;
}

/**
 * 设置Cookies值
 * @param unknown $key
 * @param unknown $value
 * @param unknown $expiredays
 */
function __setCookies($key, $value, $expiredays) {
	if ($key == null || $key == '' || $value == null || $value == '') {
		
		return;
	}
	if (empty ( $expiredays )) {
		$time = time ();
		$expiredays = time()+3600;
	}
	setcookie ( $key, $value, $expiredays );
}

/**
 * 返回Cookies中存储key的值
 * @param unknown $key
 * @return 返回存储的值
 */
function __getCookies($key) {
	if (empty ( $key )) {
		return null;
	} else {
		
		if (!array_key_exists($key, $_COOKIE)){
			return null;
		}else {
			return $_COOKIE [$key];
		}
	}
}

/**
 * 删除Cookies中存储key的值
 * @param unknown $key
 * @return 返回存储的值
 */
function __deleteCookies($key) {
    __setCookies($key,null);
}


/**
 *  获取系统信息
 * @return unknown|string
 */
function GetOs(){
	
	if(!empty($_SERVER['HTTP_USER_AGENT'])){
		$OS = $_SERVER['HTTP_USER_AGENT'];
		return $OS;
	}else{
		return "获取访客操作系统信息失败！";
	}
}
    
   
  
/**
 * 输出日志
 * 
 * @param 要输出的数组 $arr        	
 */
function __log($e) {
	$e->__errorlog ();
}

function __alert($msg){
	echo "<script> alert('{$msg}') </script>";
}



/** Json数据格式化
* @param  Mixed  $data   数据
* @param  String $indent 缩进字符，默认4个空格
* @return JSON
*/
function __jsonFormat($data, $indent=null)
{

    // json encode
    $data = json_encode($data, JSON_UNESCAPED_UNICODE);  //php5.4版本以上,如果低版本只能先urlencode然后再urldecode，保护中文

    // 缩进处理
    $ret = '';
    $pos = 0;
    $length = strlen($data);
    $indent = isset($indent) ? $indent : '--- ';
    $newline = "</br>";
    $prevchar = '';
    $outofquotes = true;

    for ($i = 0; $i <= $length; $i++) {

        $char = substr($data, $i, 1);

        if ($char == '"' && $prevchar != '\\') {
            $outofquotes = !$outofquotes;
        } elseif (($char == '}' || $char == ']') && $outofquotes) {
            $ret .= $newline;
            $pos--;
            for ($j = 0; $j < $pos; $j++) {
                $ret .= $indent;
            }
        }

        $ret .= $char;

        if (($char == ',' || $char == '{' || $char == '[') && $outofquotes) {
            $ret .= $newline;
            if ($char == '{' || $char == '[') {
                $pos++;
            }

            for ($j = 0; $j < $pos; $j++) {
                $ret .= $indent;
            }
        }

        $prevchar = $char;
    }

    return $ret;
}

/** 本地语言获取
 * @param  key  需要翻译的文字
 */
function __getText($key,$opt){

    $config= new ConfigINI('language');
    $text = $config->get($key);
    return $text;
}

?>