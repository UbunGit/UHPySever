<?php
header ( "Content-Type: text/html; charset=UTF-8" );
/**
 * 公共的请求http，并返回结果
 */

/**
 *
 * 发送post请求
 *
 * @param string $url
 *        	请求地址
 * @param array $post_data
 *        	post键值对数据
 * @return string
 *
 *
 */
function send_post($url, $post_data) {

	$data = json_encode ( $post_data );
	$result = curl_file_Post_contents ( $url, $data );
	
    $result = strchr($result,"{");
    $result = trim($result);
  
    $returnData = (json_decode($result,true));
//     __log(new myException("json解析数据：".$returnData,0));
    return $returnData;
}

function curl_file_get_contents($durl) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $durl );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 5 );
	curl_setopt ( $ch, CURLOPT_USERAGENT, _USERAGENT_ );
	curl_setopt ( $ch, CURLOPT_REFERER, _REFERER_ );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$r = curl_exec ( $ch );
	curl_close ( $ch );
	return $r;
}

/**
 * Curl版本
 * 使用方法：
 * $post_string = "app=request&version=beta";
 * request_by_curl('http://jb51.net/restServer.php',$post_string);
 */
function curl_file_Post_contents($remote_server, $post_string) {
    
    __log(new myException("请求参数：".$remote_server."?mypost=".$post_string,0));
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $remote_server );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_string );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $ch, CURLOPT_USERAGENT, "Jimmy's CURL Example beta" );
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($post_string)));
	$data = curl_exec ( $ch );
	curl_close ( $ch );
    __log(new myException("返回参数：".$data,0));
	return $data;
}

?>