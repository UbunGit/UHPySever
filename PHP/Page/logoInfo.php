
<?php
/*
 * 日志
 */
require_once ('../Public_php/Globle_sc_fns.php');

$config = new ConfigINI ();
$outPut = new OutPut ();
/* 输出头部信息 */
$jsArr = array (
		"LogoInfo.js",
		"Tooltips.js",
		"config.js",
		"Cookie.js" 
);

/* 输出头部信息 */
$jsabsArr = array (
		'<script src="http://192.168.1.27/xiaoqy/UHPySever/JS/jquery/jquery-migrate-1.2.1.min.js"></script>
         <!-- DataTables -->
         <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>',
		'<script> jQuery(document).ready(function() {
		EditinputableTable.init();
		}); </script>',
		$outPut->getScriptStr ( $config->get ( 'URL.root_assets' ) . 'data-tables/DT_bootstrap.js' ) 
);

$cssabsArr = array (
		"http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" 
);
$cssArr = array (
		
		'header.css' 
);

$outPut->outPutHead ( $cssArr, null, "主页" );

$userimg = __getCookies ( 'userImg' );
$userName = __getCookies ( 'userName' );

$userInfo = array (
		"heardImg" => "fc3d.jpg",
		"userName" => $userName 
);
$logList = getLogList ( null, '', '', "", "0" );
$outPut->outPutHeader ( $userInfo );
$outPut->outSider ();
outMainContent ( $logList );
$outPut->outputFoot ( $jsArr, $jsabsArr );

/**
 * 输出main-content
 */
function outMainContent($infoList) {
	?>
<section id="main-content">
	<section class="wrapper">
		<div class="col-md-12">
	<?php outinfo($infoList); ?>
	</div>
	</section>
</section>
<?php
}
function outinfo($infoList) {
	?>
<section class="panel">
	<header class="panel-heading">
		日志分析<span class="tools pull-right"> 
		<a class="fa fa-refresh reload" href="javascript:;"> 删除</a>
		</span>
	</header>
	<div class="panel-body">
		<div class="adv-table editable-table ">
			<div class="space15"></div>

			<div class="table-responsive" tabindex="1"
				style="overflow: hidden; outline: none;">

				<div id="editable-sample_wrapper"
					class="dataTables_wrapper form-inline" role="grid">

					<table
						class="table table-striped table-hover table-bordered dataTable"
						id="editable-input" aria-describedby="editable-sample_info">
						<thead>
							<tr role="row">
								<th class="sorting_disabled" role="columnheader" rowspan="1"
									colspan="1" aria-label="Username" style="width: 100px;">等级</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Full Name: activate to sort column ascending"
									style="width: 100px;">错误码</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Points: activate to sort column ascending"
									style="width: 100px;">错误描述</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">业务名称</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">会员账号</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">时间</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Delete: activate to sort column ascending"
									style="width: 10px;">Delete</th>
							</tr>
						</thead>

						<tbody class="info_tbody" role="alert" aria-live="polite" aria-relevant="all">
						<?php
	
	if ($infoList != null) {
		foreach ( $infoList as $value ) {
			echo '<tr class="odd" id=' . $value ["logId"] . '>';
			echo '<td class=" ">' . $value ["logLevels"] . '</td>';
			echo '<td class=" ">' . $value ["logCode"] . '</td>';
			echo '<td class=" "> 
				<div class="fa fa-eye tooltips" data-placement="right"
					data-original-title="' . $value ["logDescription"] . '">点击查看详情
 
</div>
         		</td>';
			echo '<td class=" ">' . $value ["logBusiness"] . '</td>';
			echo '<td class=" ">' . $value ["logMember"] . '</td>';
			echo '<td class=" ">' . $value ["logTime"] . '</td>';
			echo '<td class=" "><a class="delete" href="javascript:;">delete</a></td>';
			echo '</tr>';
		}
	}
	?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</section>
<?php
}

/**
 * 获取会员信息
 *
 * @param 会员账号 $userName        	
 */
function getLogList($memberNO, $beginTime, $endTime, $business, $levels) {
	$returnArr = array ();
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getLogList ( $memberNO, $beginTime, $endTime, $business, $levels );
	if ($request) {
		if ($request ['inforCode'] == 0) {
			
			$returnArr = $request ['result'];
		} else {
			__alert ( $request ['result'] );
		}
		return $returnArr;
	} else {
		echo 'alert(请求接口失败)';
	}
}

?>