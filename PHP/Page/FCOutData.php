<?php
require_once ('../../Public_php/Globle_sc_fns.php');
/* 输出头部信息 */
$jsArr = array (
		"FCOutData.js" 
);
$cssArr = array (
		'header.css',
		'FCOutData.css' 
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
			<header class="panel-heading">出球频率
			<ul class="nav outData top-menu col-lg-2">
			<li class="outdataNum">当期出球 个：10 十：0 百：9
			</li>
			</ul>
				<ul class="nav pull-right top-menu">
					<li>
						<div class="col-lg-1 ">
							<input id="prewDate" type="button"
								value="Prew" size="16">
						</div>
					</li>
					<li>
						<div class="col-lg-1 ">
							<i class="fa fa-calendar"></i> <input id="outDate" type="text"
								value="2016-11-8" size="16">
						</div>
					</li>
					<li>
						<div class="col-lg-1 ">
							<input id=nextDate type="button"
								value="Next" size="16">
						</div>
					</li>
					<li><select class="form-control col-lg-1 frequency_outType"
						size="1">
							<option value="1001" selected="selected">个位</option>
							<option value="1002">十位</option>
							<option value="1003">百位</option>

					</select></li>

				</ul>
			</header>
			<div class="frequency">
				<table id="frequencyTable"
					class="table table-striped table-hover table-bordered dataTable">
					<thead className="cf">
						<tr>
							<th class="outNum">频率</th>
							<th class="outNum">0</th>
							<th class="outNum">1</th>
							<th class="outNum">2</th>
							<th class="outNum">3</th>
							<th class="outNum">4</th>
							<th class="outNum">5</th>
							<th class="outNum">6</th>
							<th class="outNum">7</th>
							<th class="outNum">8</th>
							<th class="outNum">9</th>
						</tr>
					</thead>
				</table>
			</div>
		</section>
		<section class="panel">
			<header class="panel-heading">设置比重
			</header>
			<div class="FC3DDataBalance">
				<table id="FC3DDataBalanceTable"
					class="table table-striped table-hover table-bordered dataTable">
				</table>
			</div>
		</section>
	</section>
</section>
<?php
}
?>