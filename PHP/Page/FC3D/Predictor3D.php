<?php
require_once ('../../Public_php/Globle_sc_fns.php');
/* 输出头部信息 */
$jsArr = array (
		"Predictor3D.js"
);
$cssArr = array (
		'header.css',
		'Predictor3D.css'
);
$config = new ConfigINI ();
$cssabsArr = array ();
// $config->get ( 'URL.root_assets'. 'bootstrap-datetimepicker/css/datetimepicker.css')

$outPut = new OutPut ();
$jsabsArr = array (
		$outPut->getScriptStr ( $config->get ( 'URL.root_assets' ) . 'chart-master/Chart.js' )
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
$outPut->outSider ("3D彩票");
outmain ();
$outPut->outputFoot ( $jsArr, $jsabsArr );
function outmain() {
	?>
<section id="main-content">
	<section class="wrapper">
		<section class="panel">
			<header class="panel-heading">
				频率统计
				<ul class="nav pull-right top-menu">
					
					<li>
						<div class="col-lg-1">
							<i class="fa fa-calendar"></i> <input id="begindate" type="text"
								value="2002-01-01" size="16">
						</div>
					</li>
					<li>
						<div class="col-lg-1">
							<i class="fa fa-calendar"></i> <input id="enddate" type="text"
								value="2016-11-8" size="16">
						</div>
					</li>
					<li><select class="form-control probabilityCount col-lg-1" size="1">
							<option value="5" selected="selected">5</option>
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="20">20</option>
							<option value="25">25</option>
							<option value="30">30</option>
							<option value="50">50</option>
							<option value="100">100</option>
					</select></li>
				</ul>

			</header>
			<div class="panel-body text-center">
				<canvas id="bar"></canvas>
			</div>
		</section>
	</section>
</section>
<?php
}
?>