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
			return "Visitors";
		}else {
			return $_COOKIE [$key];
		}
	}
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
?>