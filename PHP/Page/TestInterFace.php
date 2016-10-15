<?php
require_once('../Public_php/Globle_sc_fns.php');
$userName = __getCookies('userName');

/* 输出头部信息*/
$jsArr = array("../../SmartHome_JS/ScanInterFace.js","../../SmartHome_JS/Tooltips.js","../../SmartHome_JS/MenuNav.js","../../SmartHome_JS/TestInterFace.js");
$cssArr = array('../../SmartHome_JS/CSS/MenuNav.css','../../SmartHome_JS/CSS/TestInterFace.css','../../SmartHome_JS/CSS/LeftNav.css');
outPutHead($jsArr,$cssArr,"接口测试");

$leftArr = getleftArr();
$interFaceName='';
if (__get ( 'interFaceName' )) {
	$interFaceName = __get ( 'interFaceName' );
}else {
	$interFaceName = $leftArr[0];
}
/* 输出顶部导航*/
outputNav($userName);

/* 输出侧边栏*/
outputLeftNav($leftArr);

$inPutArr = getInterFaceInputArr($interFaceName);
$interFaceInfo = getInterFaceInfo($interFaceName);
outputInterfaceInfo($inPutArr ,$interFaceInfo);
outputFoot();


function  outputInterfaceInfo($inputArr,$interFaceInfo){
	echo '<div class="data" data_interFaceName ="'.$interFaceInfo['interFaceName'].'" data_interFacePath="'.$interFaceInfo['interFacepath'].'"></div>';
	echo '<div class="inteFaceInfoBody">
	<h2>'. $interFaceInfo['interFaceName'] .'('. $interFaceInfo['interFaceNameStr'].')</h2>
	<p>版本号: '.$interFaceInfo['interFaceBeginVersions'].'~'.$interFaceInfo['interFaceEndVersions'].'</p>	
	<p>时间: '.$interFaceInfo['interFaceBeginTime'].'~'.$interFaceInfo['interFaceEndTime'].'</p>
	<p>路径: '.$interFaceInfo['interFacepath'].'</p>
	<p>'.$interFaceInfo['interFaceDescribe'].'</p><br>	

	<table class="inteFaceinfoTable">
	<tr>
	<td>输入参数</td>
	<td><button class="requestInterFace" >提交</button></td>
	</tr>';
		if (!empty($inputArr)){
			foreach ($inputArr as $value){
				echo '<tr><td>'.$value['parameterName'].$value['parameterDescribe'].'</td>';
				echo '<td><input type="text" class="inputValue" tag="'.$value['parameterName'].'"></input></td></tr>';
			}
		}
		echo '
	</table>
	<pre class="outPutText"></pre> 
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
?>