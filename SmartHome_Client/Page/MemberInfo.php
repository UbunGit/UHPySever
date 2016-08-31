<?php
/**
 * 会员信息
 */

require_once('../Public_php/Globle_sc_fns.php');

$userName = __getCookies('userName');
$member = __get("memberNo");
$memberInfo = getMemberInfo($member);

/* 输出头部信息*/
$jsArr = array("../../SmartHome_JS/MemberInfo.js","../../SmartHome_JS/Tooltips.js","../../SmartHome_JS/MenuNav.js");
$cssArr = array('../../SmartHome_JS/CSS/MemberInfo.css','../../SmartHome_JS/CSS/MenuNav.css','../../SmartHome_JS/CSS/LeftNav.css');

outPutHead($jsArr,$cssArr,"会员信息");

/* 输出顶部导航*/
outputNav($userName);
showMemberInfo($memberInfo);
outputFoot();

function showMemberInfo($memberInfo){
	
	echo '<div class="inteFaceInfoBody">';
	echo '<table class="memberInfoTable">
	<tr>
	<td> 用户名:</td>
	<td><input type="text" readonly="readonly" class="userInfo" tag="userName" value="'. $memberInfo['userName'] .'"/></td>
	<td>用户id:</td>
	<td><input type="text" readonly="readonly" class="userInfo" tag="userId" value="'. $memberInfo['userId'] .'"/></td></tr>
	<tr>
	<td>用户密码:</td>
	<td><input type="text" class="userInfo" tag="userPassWord" value="'. $memberInfo['userPassWord'] .'"/></td>
	<td>用户等级:</td>
	<td><input type="text"  class="userInfo" tag="userLevel" value="'. $memberInfo['userLevel'] .'"/></td>
	
	</tr>
	<tr>
	
	<td>注册电话:</td>
	<td><input type="text" class="userInfo" tag="userTel" value="'. $memberInfo['userTel'] .'"/></td>
	<td>登陆状态:</td>
	<td><input type="text" class="userInfo" tag="userLogState" value="'. $memberInfo['userLogState'] .'"/></td>
	</tr>
	</table>
	<button class="commit">确定</button>
	</div>'; 
	
}

/**
 *  获取会员信息
 * @param 会员账号 $userName
 */
function getMemberInfo($userName){

	if (empty($userName)){
		$msg = 'userNmae is nil';
		echo "<script> alert('{$msg}') </script>";
		return;
	}
	$returnArr = array();
	$httpIntface =new Globle_HttpIntface();
	$request = $httpIntface->getMemberInfo($userName);
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

?>