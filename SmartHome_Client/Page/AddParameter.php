<?php
/**
 * 添加参数页面
 */

require_once('../Public_php/Globle_sc_fns.php');
$userName = __getCookies('userName');
$interFaceName='';
if (__get ( 'interFaceName' )) {
	$interFaceName = __get ( 'interFaceName' );
}

/* 输出头部信息*/
$jsArr = array("../../SmartHome_JS/AddParameter.js","../../SmartHome_JS/Tooltips.js","../../SmartHome_JS/MenuNav.js");
$cssArr = array('../../SmartHome_JS/CSS/AddParameter.css','../../SmartHome_JS/CSS/MenuNav.css','../../SmartHome_JS/CSS/LeftNav.css');

$leftArr = getleftArr();

outPutHead($jsArr,$cssArr,"修改接口参数");
/* 输出顶部导航*/
outputNav($userName);
/* 输出侧边栏*/
outputLeftNav($leftArr);
outParameterTable($interFaceName);
outputFoot();

/**
 * 输出参数列表
 */
function  outParameterTable($interFaceName){
	
	echo '<div class="inteFaceInfoBody">';
	echo '<h2 class="interFaceName">'.$interFaceName.'</h2>';
	echo '<table>
			<tr>
			<td>参数名:</td>
			<td><input class="parameterVal" tag="parameterName" type="text"></input></td>
			</tr>
	
			<tr>
			<td>参数描述:</td>
			<td><input class="parameterVal" tag="parameterDescribe" type="text"></input></td>
			</tr>
	
			<tr>
			<td>参数可以为空:</td>
			<td><input class="parameterVal" tag="parameterCanNil"  type="text"></input></td>
			</tr>
	
			<tr>
			<td>参数结束使用时间:
			</td><td><input class="parameterVal" tag="parameterEndTime"  type="text"></input></td>
			</tr>
	
			<tr>
			<td>参数开始版本:</td>
			<td><input class="parameterVal" tag="parameterBeginVersions"  type="text"></input></td>
			</tr>
	
			<tr>
			<td>参数结束版本:
			</td><td><input class="parameterVal" tag="parameterEndVersions"  type="text"></input></td>
			</tr>
	
			<tr>
			<td>参数类型:</td>
			<td><input class="parameterVal" tag="parameterType"  type="text">
			</input></td>
			</tr>
	
			<tr>
			<td>参数用途:</td>
			<td><input class="parameterVal" tag="parameterTypeuse"  type="text"></input></td>
			</tr>
	</table>
	<button class="saveParameter">确定</button>';
	echo '</div>';
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
?>