<?php
/**
 * 按功能组装HTTP请求的数据
 */
class Globle_HttpIntface {
	function __construct() {
	}
	
	function requestInterface($options){
		
		if (isset($_COOKIE["userName"])){
			$options['userName'] = $_COOKIE["userName"];
		}else{
			$options['userName'] = 'userName';
		}
		$request = send_post ( HTTPREQUESTURL, $options );
		if ($request) {
			return $request;
		} else {
			__log ( new myException ( "接口请求失败: ", - 10001 ) );
		}
	}
	
	/**
	 * 获取接口列表
	 */
	function getInterfaceList(){
		$funName = 'getInterFaceList';
		$options = array (
				'inefaceMode' => $funName,
		);
		return $this->requestInterface($options);
	}
	
	/**
	 * 获取接口信息
	 */
	function getInterFaceInfo($interFaceName){
		
		$funName = 'getInterFaceInfo';
		$options = array (
				'inefaceMode' => $funName,
				'interFaceName' => $interFaceName,
		);
		return $this->requestInterface($options);
	}
	
	/**
	 * 根据接口名获取输入参数
	 * @param 接口名 $interFaceName
	 */
	function getInputValueList($interFaceName){
		$funName = 'getInputValueList';
		$options = array (
				'inefaceMode' => $funName,
				'interFaceName' => $interFaceName,
		);
		return $this->requestInterface($options);
	}
	
	/**
	 * 根据接口名获取输出参数
	 * @param 接口名 $interFaceName
	 */
	function getOutputValueList($interFaceName){
		$funName = 'getOutputValueList';
		$options = array (
				'inefaceMode' => $funName,
				'interFaceName' => $interFaceName
		);
		return $this->requestInterface($options);
	}
	
	/**
	 * 获取会员列表
	 * @param 每页数量 $pageSize
	 * @param 第几页 $pageNum
	 */
	function  getMemberList($pageSize,$pageNum){
		$funName = 'getMemberList';
		$options = array (
				'inefaceMode' => $funName,
				'pageSize' => $pageSize,
				'pageNum' => $pageNum
		);
		return $this->requestInterface($options);
	}
	
	/**
	 * 获取会员信息
	 * @param 会员帐号 $memberNO
	 * @return 会员信息dic
	 */
	function getMemberInfo($memberNO){
		
		$funName = 'getMemberInfo';
		$options = array (
				'inefaceMode' => $funName,
				'memberNO' => $memberNO
		);
		return $this->requestInterface($options);
	}
	
	function getFC3DData(){
		$funName = 'getFC3DData';
		$options = array (
				'inefaceMode' => $funName
		);
		return $this->requestInterface($options);
	}
	
  
}

?>