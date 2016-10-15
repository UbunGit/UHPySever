<?php
require_once ('../Public_php/Globle_sc_fns.php');

$userimg = __getCookies ( 'userImg' );

/* 输出头部信息 */
$jsArr = array (
		"../../SmartHome_JS/JS/VIPHomePage.js",
		"../../SmartHome_JS/JS/Tooltips.js",
		"../../SmartHome_JS/JS/MenuNav.js",
		"../../SmartHome_JS/JS/Cookie.js"
);
$cssArr = array (
		'../../SmartHome_JS/CSS/VIPHomePage.css',
		'../../SmartHome_JS/CSS/MenuNav.css',
		'../../SmartHome_JS/CSS/LeftNav.css' 
);
outPutHead ( $jsArr, $cssArr, "功能列表" );
/** testdata*/
$userInfo = (object)[
		"heardImg" =>$userimg,
		"userName"=>"UbunGit",
];
outPutHeader($userInfo);

echo '<table class="pageList">
         <tr>
			<td><a class="page" href="../FC3D/FCOutData.php">福彩3D</a></td>
  			<td><a class="page" href="../TestInterFace.php">接口测试</a></td>
            <td><a class="page" href="../MemberManagement.php">会员管理</a></td>
           <tr>
		</table>';
outputFoot ();


?>
