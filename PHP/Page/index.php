
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
$outPut->outPutHead ($cssArr, null,"主页" );

print "CONTENT_TYPE: " . $_SERVER['CONTENT_TYPE'] . "<BR />";
$data = file_get_contents('php://input');
print "DATA: <pre>";
var_dump($data);
var_dump($_POST);
print "</pre>";

$userName = isset($_POST['userName']) ? $_POST['userName'] : __getCookies('userName');
$userimg = __getCookies ( 'userImg' );


$userInfo = array(
		"heardImg" =>"fc3d.jpg",
		"userName"=>$userName,
);
$outPut->outPutHeader($userInfo);
$outPut->outSider();
$outPut->outputFoot ($jsArr);

?>

<form method="post">

    <input type="text" name="name" value="ok" />
    <input type="submit" name="submit" value="submit" />

</form>
