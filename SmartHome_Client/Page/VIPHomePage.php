<?php
require_once ('../Public_php/Globle_sc_fns.php');

$userimg = __getCookies ( 'userImg' );

/* 输出头部信息 */
$jsArr = array (
		"../../SmartHome_JS/JS/VIPHomePage.js",
		"../../SmartHome_JS/JS/Tooltips.js",
		"../../SmartHome_JS/JS/MenuNav.js" 
);
$cssArr = array (
		'../../SmartHome_JS/CSS/VIPHomePage.css',
		'../../SmartHome_JS/CSS/MenuNav.css',
		'../../SmartHome_JS/CSS/LeftNav.css' 
);
outPutHead ( $jsArr, $cssArr, "场景列表" );

echo '<table id="pageList">
         
			<td><a class="page" href="./FC3D/FCOutData.php">福彩3D</a></td>
  			<td><a class="page" href="./TestInterFace.php">接口测试</a></td>
            <td><a class="page" href="./MemberManagement.php">会员管理</a></td>
            </table>';
outputFoot ();
?>