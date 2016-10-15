<?php
require_once('../../Public_php/Globle_sc_fns.php');
require_once ('FCOutPutPage.php');
/* 输出头部信息 */
$jsArr = array (
		"../../../SmartHome_JS/JS/FCOutData.js",
);
$cssArr = array (
		'../../../SmartHome_JS/CSS/FCOutData.css'
);

$dataArr = getFC3DData();
$fcoutPut = new FCOutPutPage();
$fcoutPut->outPutHead ( $jsArr, $cssArr, "场景列表" );
showFC3DData($dataArr);
$fcoutPut->outPutTabBar();
$fcoutPut->outputFoot();

/**
 *  获取会员信息
 * @param 会员账号 $userName
 */
function getFC3DData(){

	$returnArr = array();
	$httpIntface =new Globle_HttpIntface();
	$request = $httpIntface->getFC3DData("100","0");
	if( $request){
		if ($request['inforCode']==0){
			$returnArr = $request['result'];

		}else {
			__alert($request['result']);
		}
		return  $returnArr;
	}else {
		echo 'alert(请求接口失败)';
	}
}
function showFC3DData($FC3DData){
   echo '<div class="scroll" >';
	foreach ($FC3DData as $data){	
	echo '
			<table class="DataTable" >
			<tr>
			<td width=100px>第'.$data["outNO"].'期</td>
			<td width=100px>'.$data["outdate"].'</td>
			<td>'.$data["out_bai"].'</td>
			<td>'.$data["out_shi"].'</td>
			<td>'.$data["out_ge"].'</td>
			</tr>
			</table>
			';
	}
	echo '</div>';
}
?>