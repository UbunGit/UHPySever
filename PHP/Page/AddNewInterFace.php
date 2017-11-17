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
$outPut->outPutHead ( $cssArr, null, "添加接口信息" );
/* 输出顶部导航 */
$userimg = __getCookies ( 'userImg' );
$userName = __getCookies ( 'userName' );
$userInfo = array (
		"heardImg" => "fc3d.jpg",
		"userName" => $userName 
);
$outPut->outPutHeader ( $userInfo );
$outPut->outSider ( "接口管理" );
outputInterFaceInfo_edit ();
$outPut->outputFoot ( $jsArr, null );
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
			<form  class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-lg-3 control-label"> 接口名称</label>
					<div class="col-lg-9">
						<input type="text" placeholder="接口名称" name="interFaceName"
							class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label">接口中文名称</label>
					<div class="col-lg-9">
						<input type="text" placeholder="接口中文名称" name="interFaceNameStr"
							class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label">接口路径</label>
					<div class="col-lg-9">
						<select class="form-control  m-bot15 " name="interFacepath">
							<option>interface</option>
							<option>samrtHome</option>
							<option>FCAnalyse</option>
						</select>
					</div>
				</div>
			<div class="panel-foot">
				<ul class="summary-list">
				<li><a href="javascript:;"> <i class="fa fa-cloud text-primary saveIneface"></i>
						保存
				</a></li>
				<li><a href="javascript:;"> <i
						class="fa fa-cloud-download text-primary"></i> 导入
				</a></li>
				<li><a href="javascript:;"> <i
						class="fa fa-cloud-upload text-primary"></i> 导出
				</a></li>
			    </ul>
			</div>
		</div>
 </form>
	</section>
</div>
<?php
}

?>
