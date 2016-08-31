<?php
/**
 * 会员管理页面
 */

require_once('../Public_php/Globle_sc_fns.php');

$userName = __getCookies('userName');


/* 输出头部信息*/
$jsArr = array("../../SmartHome_JS/MemberManagement.js","../../SmartHome_JS/Tooltips.js","../../SmartHome_JS/MenuNav.js");
$cssArr = array('../../SmartHome_JS/CSS/MemberManagement.css','../../SmartHome_JS/CSS/MenuNav.css','../../SmartHome_JS/CSS/LeftNav.css');

$memberList = getMemberList();
outPutHead($jsArr,$cssArr,"会员管理");


/* 输出顶部导航*/
outputNav($userName);
showMemberList($memberList);
outputFoot();

/**
 * 显示会员列表
 * @param 会员列表数组 $memeberArr
 */
function showMemberList($memeberArr){
	if (empty($memeberArr)){
		return ;
	}
	echo '
<div class="main_box">
<table class="memberTable">';
	echo '
		<tr class="headtr">
		<td>帐号</td>
		<td>登陆状态</td>
		<td>密码</td>
		<td>id</td>
		<td>等级</td>
		<td>tel</td>
		</tr>
		';
	foreach ($memeberArr as $member){
		echo '
		<tr class="memberNo" value='.$member['userName'].'>
		<td>'.$member['userName'].'</td>
		<td>'.$member['userLogState'].'</td>
		<td>'.$member['userPassWord'].'</td>
		<td>'.$member['userId'].'</td>
		<td>'.$member['userLevel'].'</td>
		<td>'.$member['userTel'].'</td>
		</tr>
		';
	}
echo '
</table>
</div>'; 
}

/**
 * 获取接口列表数据
 */
function getMemberList(){
	$returnArr = array();
	$httpIntface =new Globle_HttpIntface();
	$request = $httpIntface->getMemberList(10,1);
	if( $request){

		if ($request['inforCode']==0){
			$returnArr = $request['result'];
			
		}else {
			__alert ( $request['result']);
		}
		return  $returnArr;
	}else {
		__alert ( '服务器连接异常');
	}
}
?>