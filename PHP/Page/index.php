
<?php
require_once ('../Public_php/Globle_sc_fns.php');



/* 输出头部信息 */
$jsArr = array (
		"index.js",
		"Tooltips.js",
		"Cookie.js"
);
$cssArr = array (
		'index.css',
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
$outPut->outputFoot ();


?>
