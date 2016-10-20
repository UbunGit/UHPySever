
<?php
require_once ('../Public_php/Globle_sc_fns.php');



/* 输出头部信息 */
$jsArr = array (
		"index.js",
		"Tooltips.js",
		"MenuNav.js",
		"Cookie.js"
);
$cssArr = array (
		'index.css',
		'MenuNav.css',
		'LeftNav.css',
		'header.css'
);
$outPut = new OutPut();
$outPut->outPutHead ( $jsArr, $cssArr, "主页" );

$userimg = __getCookies ( 'userImg' );
$userName = __getCookies('userName');
$userInfo = array(
		"heardImg" =>"fc3d.jpg",
		"userName"=>$userName,
);
$outPut->outPutHeader($userInfo);
$outPut->outSider();

echo '<table class="pageList">
         <tr>
			<td><a class="page" href="../FC3D/FCOutData.php">福彩3D</a></td>
  			<td><a class="page" href="../TestInterFace.php">接口测试</a></td>
            <td><a class="page" href="../MemberManagement.php">会员管理</a></td>
           <tr>
		</table>';
$outPut->outputFoot ();


?>
