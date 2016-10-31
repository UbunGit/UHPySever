<?php
/**
 * 添加新接口信息
 */
require_once ('../Public_php/Globle_sc_fns.php');

$userName = __getCookies ( 'userName' );
$interFaceName = '';
if (__get ( 'interFaceName' )) {
	$interFaceName = __get ( 'interFaceName' );
}

/* 输出头部信息 */
$jsArr = array (
		"AddNewInterFace.js",
		"Tooltips.js",
		"Cookie.js" 
);
$cssArr = array (
		'AddNewInterFace.css',
		'header.css' 
);

$outPut = new OutPut ();
$outPut->outPutHead ($cssArr, "添加接口信息" );
/* 输出顶部导航 */
$userimg = __getCookies ( 'userImg' );
$userName = __getCookies ( 'userName' );
$userInfo = array (
		"heardImg" => "fc3d.jpg",
		"userName" => $userName 
);
$outPut->outPutHeader ( $userInfo );
$outPut->outSider ();
outputInterFaceInfo_edit ();
$outPut->outputFoot ($jsArr);
function outputInterFaceInfo_edit() {
	echo '<section id="main-content">';
	echo '<section class="wrapper">';
	// 接口基本信息from
	outIntefaceBasicInfofrom ();
	echo '</section></section>';
}
function outIntefaceBasicInfofrom() {
	?>

	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading"> 基本信息 </header>
			<div class="panel-body">
				<form role="form" class="form-horizontal tasi-form baseinfo-form">

					<div class="form-group">
						<label class="col-lg-10 control-label"> 接口名称</label>
						<div class="col-lg-10">
							<input type="text" placeholder="接口名称" name="interFaceName"
								class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-10 control-label">接口中文名称</label>
						<div class="col-lg-10">
							<input type="text" placeholder="接口中文名称" name="interFaceNameStr"
								class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-10 control-label">接口路径</label>
						<div class="col-lg-10">
							<select class="form-control  m-bot15 " name="interFacepath">
								<option>interface</option>
								<option>samrtHome</option>
								<option>FCAnalyse</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-offset-9 col-lg-2 col-sm-2">
							<button class="btn btn-primary saveinterface" type="submit">保存</button>
						</div>
					</div>

				</form>
			</div>
		</section>
	</div>
<?php
}

?>
