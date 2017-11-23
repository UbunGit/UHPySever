
<?php

require_once ('../Public_php/Globle_sc_fns.php');

$outPut = new OutPut();
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

$outPut->outPutHead ($cssArr, null,"主页" );
if (isset($_POST['userName'])){
	 __setCookies('userName', $_POST['userName'], null) ;
}
	
$userName =__getCookies('userName');
$userimg = isset($_POST['userImg']) ? $_POST['userImg'] :__getCookies ( 'userImg' );


$userInfo = array(
		"heardImg" =>empty($userimg)? "fc3d.jpg":$userimg,
		"userName"=>$userName,
);
$outPut->outPutHeader($userInfo);
$outPut->outSider("主页");
$outPut->outputFoot ($jsArr,null);

?>

