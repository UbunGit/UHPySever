<?php
require_once ('../Public_php/Globle_sc_fns.php');
$userName = __getCookies ( 'userName' );
$leftArr = getleftArr ();

if (__get ( 'interFaceName' )) {
	$interFaceName = __get ( 'interFaceName' );
} else {
	$interFaceName = $leftArr [0];
}

/* 输出头部信息 */
$jsArr = array (
		"../../SmartHome_JS/ScanInterFace.js",
		"../../SmartHome_JS/Tooltips.js",
		"../../SmartHome_JS/MenuNav.js" 
);
$cssArr = array (
		'../../SmartHome_JS/CSS/ScanInterFace.css',
		'../../SmartHome_JS/CSS/MenuNav.css',
		'../../SmartHome_JS/CSS/LeftNav.css' 
);

$inPutArr = getInterFaceInputArr ( $interFaceName );
$outPutArr = getInterFaceOutputArr ( $interFaceName );
$interFaceInfo = getInterFaceInfo ( $interFaceName );

outPutHead ( $jsArr, $cssArr, "接口查询" );
echo '<div class="data" data_interFaceName ="' . $interFaceInfo ['interFaceName'] . '"/>';

/* 输出顶部导航 */
outputNav ( $userName );
/* 输出侧边栏 */
outputLeftNav ( $leftArr );
outputInterface ( $inPutArr, $outPutArr, $interFaceInfo );
outputFoot ();

/**
 * 输出接口信息html
 */
function outputInterface($inPutArr, $outPutArr, $interFaceInfo) {
	echo '<div class="interfaceInfo">';
	outputInterFaceHead_scan ();
	outputInterFaceInfo_scan ( $inPutArr, $outPutArr, $interFaceInfo );
	echo '</div>';
}

/**
 * 输出查看接口时头信息
 */
function outputInterFaceHead_scan() {
	echo '<div class="interfaceInfoHead">
	<button class="addNewInterFace">添加新接口</button>
	<button class="changeInterFace">修改接口</button>
	</div>';
}
function outputInterFaceInfo_scan($inPutArr, $outPutArr, $interFaceInfo) {
	echo '<div class="inteFaceInfoBody">
	<h2>' . $interFaceInfo ['interFaceName'] . '(' . $interFaceInfo ['interFaceNameStr'] . ')</h2>
	<scan>
	<p>版本号: ' . $interFaceInfo ['interFaceBeginVersions'] . '~' . $interFaceInfo ['interFaceEndVersions'] . '</p>	
	<p>时间: ' . $interFaceInfo ['interFaceBeginTime'] . '~' . $interFaceInfo ['interFaceEndTime'] . '</p>
	<p>路径: ' . $interFaceInfo ['interFacepath'] . '</p>
	<p>' . $interFaceInfo ['interFaceDescribe'] . '</p><br>';
	
	if (! empty ( $inPutArr )) {
		echo '<table class="inteFaceInputTable" >
		<caption>输入参数</caption>';
		echo '<tr>
					<td>名称</td>
					<td>描述</td>
					<td>类型</td>
					<td>开始版本</td>
					<td>结束版本</td>
		  		    <td>结束时间</td>
					<td>是否可空</td>
					</tr>';
		foreach ( $inPutArr as $value ) {
			echo '<tr>
					<td>' . $value ['parameterName'] . '</td>
					<td>' . $value ['parameterDescribe'] . '</td>
					<td>' . $value ['parameterType'] . '</td>
					<td>' . $value ['parameterBeginVersions'] . '</td>
					<td>' . $value ['parameterEndVersions'] . '</td>
					<td>' . $value ['parameterEndTime'] . '</td>	
					<td>' . $value ['parameterCanNil'] . '</td>
					</tr>';
		}
	}
	echo '</table>';
	
	if (! empty ( $outPutArr )) {
		
		echo '<table class="inteFaceOutputTable" ><tr>
				<caption>输出参数</caption>';
		echo '<tr>
				  <td>名称</td>
				  <td>描述</td>
				  <td>类型</td>
				  <td>开始版本</td>
				  <td>结束版本</td>
				  <td>结束时间</td>
				  <td>是否可空</td>
				  </tr>';
		foreach ( $outPutArr as $value ) {
			echo '<tr>
						<td>' . $value ['parameterName'] . '</td>
						<td>' . $value ['parameterDescribe'] . '</td>
						<td>' . $value ['parameterType'] . '</td>
						<td>' . $value ['parameterBeginVersions'] . '</td>
						<td>' . $value ['parameterEndVersions'] . '</td>
						<td>' . $value ['parameterEndTime'] . '</td>
						<td>' . $value ['parameterCanNil'] . '</td>
						</tr>';
		}
	}
	echo '
	</table>
	<p class="outPutText"></p> 
	</div>';
}

/**
 * 获取接口列表数据
 */
function getleftArr() {
	$returnArr = array ();
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getInterfaceList ();
	if ($request) {
		
		if ($request ['inforCode'] == 0) {
			$temResu = $request ['result'];
			if (is_array ( $temResu )) {
				foreach ( $temResu as $value ) {
					array_push ( $returnArr, $value ['interFaceName'] );
				}
			} else {
				array_push ( $returnArr, $temResu ['interFaceName'] );
			}
		} else {
			__alert ( $request ['result'] );
		}
		return $returnArr;
	} else {
		__alert ('服务器连接异常');
	}
}

/**
 * 获取接口信息
 */
function getInterFaceInfo($interFaceName) {
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getInterFaceInfo ( $interFaceName );
	$returnArr = array ();
	if ($request) {
		if ($request ['inforCode'] == 0) {
			$temResu = $request ['result'];
			return $temResu [0];
		} else {
			__alert ( $request ['result'] );
		}
	} else {
		__alert ('服务器连接异常' );
	}
}
/**
 * 获取接口入参列表
 */
function getInterFaceInputArr($interFaceName) {
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getInputValueList ( $interFaceName );
	
	if ($request) {
		if ($request ['inforCode'] == 0) {
			$temResu = $request ['result'];
			return $temResu;
		}else {
			__alert ( $request ['result'] );
		}
	} else {
		__alert ( '服务器连接异常' );
	}
}
/**
 * 获取接口出参列表
 */
function getInterFaceOutputArr($interFaceName) {
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getOutputValueList ( $interFaceName );
	
	if ($request) {
		if ($request ['inforCode'] == 0) {
			$temResu = $request ['result'];
			return $temResu;
		}
	} else {
		echo 'alert(请求接口失败)';
	}
}
?>