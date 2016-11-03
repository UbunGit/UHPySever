<?php
require_once ('../../Public_php/Globle_sc_fns.php');
require_once ('FCOutPutPage.php');
/* 输出头部信息 */
$jsArr = array (
		"FCOutData.js" 
);
$cssArr = array (
		'header.css',
		'FCOutData.css'
		
);
$config = new ConfigINI ();
$cssabsArr = array (
// 		$config->get ( 'URL.root_assets' )	
);
$outPut = new OutPut ();
$jsabsArr = array (
		$outPut->getScriptStr($config->get ( 'URL.root_assets' ).'chart-master/Chart.js')
);


/* 输出顶部导航 */
$userimg = __getCookies ( 'userImg' );
$userName = __getCookies ( 'userName' );
$userInfo = array (
		"heardImg" => "fc3d.jpg",
		"userName" => $userName 
);

$outPut = new OutPut ();
$outPut->outPutHead ( $cssArr, $cssabsArr, "接口查询" );
$outPut->outPutHeader ( $userInfo );
$outPut->outSider ();
out ();
$outPut->outputFoot ( $jsArr, $jsabsArr );
function out() {
	?>
<section id="main-content">
<section class="wrapper">
<section class="panel">
	<header class="panel-heading"> Bar </header>
	<div class="panel-body text-center">
		<canvas id="bar" height="600" width="1000"
			style="width: 500px; height: 300px;"></canvas>
	</div>
</section>
</section>
</section>
<?php
}
?>