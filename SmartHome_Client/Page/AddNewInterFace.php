<?php
/**
 * 添加新接口信息
 */
require_once('../Public_php/Globle_sc_fns.php');

$userName = __getCookies('userName');
$interFaceName='';
if (__get ( 'interFaceName' )) {
	$interFaceName = __get ( 'interFaceName' );
}

/* 输出头部信息*/
$jsArr = array("../../SmartHome_JS/AddNewInterFace.js","../../SmartHome_JS/Tooltips.js","../../SmartHome_JS/MenuNav.js");
$cssArr = array('../../SmartHome_JS/CSS/AddNewInterFace.css','../../SmartHome_JS/CSS/MenuNav.css','../../SmartHome_JS/CSS/LeftNav.css');


outPutHead($jsArr,$cssArr,"添加接口信息");
/* 输出顶部导航*/
outputNav($userName);
outputInterFaceInfo_edit();
outputFoot();

function  outputInterFaceInfo_edit(){

	echo '<div class="inteFaceInfoBody">';
	outputInterFaceHead_edit();
	echo '<table class="inteFaceDescribe">
	<tr>
	<td>接口名称:</td>
	<td><input type="text"  class="inteFaceVar" tag="interFaceName"  /></td>
	<td>接口中文名称:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceNameStr" /></td>
	</tr>
	<tr>
	<td>开始版本号:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceBeginVersions" /></td>
	<td>结束版本号:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceEndVersions"  /></td>
	</tr>
	<tr>
	<td>开始时间:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceBeginTime"  /></td>
	<td>结束时间:</td>
	<td><input type="text" class="inteFaceVar" tag="interFaceEndTime"   /></td>
	</tr>
			
	<tr>
	<td>接口路径:</td>
	<td><input type="text"  class="inteFaceVar" tag="interFacepath" /></td>
	<td>接口描述:</td>
	<td><input type="text"  class="inteFaceVar" tag="interFaceDescribe" /></td>
	</tr>
	</table>
	</div>';
}

function  outputInterFaceHead_edit(){

	echo '<div class="interfaceInfoHead">
	<button class="SaveInterFace">保存</button>
	<button class="cancelEdit">返回</button>
	</div>';
}
?>