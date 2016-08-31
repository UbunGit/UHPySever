<?php
/**
 * 修改接口
 */
require_once('../Public_php/Globle_sc_fns.php');
$userName = __getCookies('userName');
$interFaceName='';
if (__get ( 'interFaceName' )) {
	$interFaceName = __get ( 'interFaceName' );
}

/* 输出头部信息*/
$jsArr = array("../../SmartHome_JS/EditInterFace.js","../../SmartHome_JS/Tooltips.js","../../SmartHome_JS/MenuNav.js");
$cssArr = array('../../SmartHome_JS/CSS/EditInterFace.css','../../SmartHome_JS/CSS/MenuNav.css','../../SmartHome_JS/CSS/LeftNav.css');

$inPutArr = getInterFaceInputArr($interFaceName);
$outPutArr = getInterFaceOutputArr($interFaceName);
$interFaceInfo = getInterFaceInfo($interFaceName);

outPutHead($jsArr,$cssArr,"修改接口信息");
echo '<div class="data" data_interFaceName ="'.$interFaceInfo['interFaceName'].'"/>';
$leftArr = getleftArr();
/* 输出顶部导航*/
outputNav($userName);
/* 输出侧边栏*/
outputLeftNav($leftArr);
outputInterFaceInfo_edit($inPutArr,$outPutArr,$interFaceInfo);
outputFoot();

/**
 * 输出编辑接口时头信息
 */
function  outputInterFaceHead_edit(){

	echo '<div class="interfaceInfoHead">
	<button class="SaveInterFace">保存</button>
	<button class="addParameter">添加参数</button>
	<button class="cancelEdit">返回</button>
	</div>';
}

function  outputInterFaceInfo_edit($inputArr,$outPutArr,$interFaceInfo){

	echo '<div class="inteFaceInfoBody">';
	outputInterFaceHead_edit();
	echo '<table class="inteFaceDescribe">
	<tr>
	<td>接口名称:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceName" value="'. $interFaceInfo['interFaceName'] .'"/></td>
	<td>接口中文名称:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceNameStr" value="'. $interFaceInfo['interFaceNameStr'] .'"/></td>
	</tr>
	<tr>
	<td>开始版本号:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceBeginVersions" value="'. $interFaceInfo['interFaceBeginVersions'] .'"/></td>
	<td>结束版本号:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceEndVersions" value="'. $interFaceInfo['interFaceEndVersions'] .'"/></td>
	</tr>
	<tr>
	<td>开始时间:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceBeginTime" value="'. $interFaceInfo['interFaceBeginTime'] .'"/></td>
	<td>结束时间:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceEndTime" value="'. $interFaceInfo['interFaceEndTime'] .'"/></td>
	</tr>
	<tr>
	<td>接口路径:</td>
	<td><input type="text"  class="inteFaceVar" tag="interFacepath" value="'. $interFaceInfo['interFacepath'] .'"/></td>
	<td>接口描述:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceDescribe" value="'. $interFaceInfo['interFaceDescribe'] .'"/></td>
	</tr>
	</table>
	</div>';
}
/**
 * 获取接口列表数据
 */
function getleftArr(){

	$httpIntface =new Globle_HttpIntface();
	$request = $httpIntface->getInterfaceList();
	$returnArr = array();
	if( $request){
		if ($request['inforCode']==0){
			$temResu = $request['result'];
			if (is_array($temResu)){
				foreach ($temResu as $value){
					array_push($returnArr,$value['interFaceName']);
				}
			}else {
				array_push($returnArr,$temResu['interFaceName']);
			}

		}else {
			array_push($returnArr,$request['inforMsg']);
		}
		return  $returnArr;

	}else {
		echo 'alert(请求接口失败)';
	}
}

/**
 * 获取接口信息
 *
 */
function  getInterFaceInfo($interFaceName){

	$httpIntface =new Globle_HttpIntface();
	$request = $httpIntface->getInterFaceInfo($interFaceName);
	$returnArr = array();
	if( $request){
		if ($request['inforCode']==0){
			$temResu = $request['result'];
			return  $temResu[0];
		}
	}else {
		echo 'alert(请求接口失败)';
	}
}
/**
 * 获取接口入参列表
 */
function  getInterFaceInputArr($interFaceName){

	$httpIntface =new Globle_HttpIntface();
	$request = $httpIntface->getInputValueList($interFaceName);

	if( $request){
		if ($request['inforCode']==0){
			$temResu = $request['result'];
			return  $temResu;
		}
	}else {
		echo 'alert(请求接口失败)';
	}
}
/**
 * 获取接口出参列表
 */
function  getInterFaceOutputArr($interFaceName){
	$httpIntface =new Globle_HttpIntface();
	$request = $httpIntface->getOutputValueList($interFaceName);

	if( $request){
		if ($request['inforCode']==0){
			$temResu = $request['result'];
			return  $temResu;
		}
	}else {
		echo 'alert(请求接口失败)';
	}
}
?>