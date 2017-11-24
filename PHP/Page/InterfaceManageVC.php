<?php
require_once ('./BaseViewController.php');

class InterfaceManageVC extends BaseViewController {

function viewwillLoad() {
	$outPut = new OutPut ();
	$config = new ConfigINI ();
	
	$this->jsArr = array (
		"jquery/jquery-migrate-1.2.1.min.js",
		"editable-table.js",
		"ScanInterFace.js",
		"editable-table.js", 
);

	$this->absjsArr = array (
		'<script src="../JS/jquery/jquery-migrate-1.2.1.min.js"></script>
         <!-- DataTables -->
       <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>',
		'<script> jQuery(document).ready(function() {
		EditinputableTable.init();
		EditoutputableTable.init();
		}); </script>' ,
		$outPut->getScriptStr($config->get ( 'URL.root_assets' ).'data-tables/DT_bootstrap.js')
);
	$this->cssArr = array (
		'ScanInterFace.css',
		'header.css' 
);
	$this->abscssArr = array (
		"http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" 
);

	$this->title = "接口管理系统";
}
function getuserInfo() {
	
	$userimg = __getCookies ( 'userImg' );
	$userName = __getCookies ( 'userName' );
	
	$this->userInfo = array (
			"heardImg" => "fc3d.jpg",
			"userName" => $userName
	);
}
function viewLoadbody() {
	parent::viewLoadbody ();

	$interFaceName= isset ( $_GET ["interFaceName"] ) ? $_GET ['interFaceName'] : 'log';

// 	if ($interFacename) {
// 		$interFaceinfo = getInterFaceInfo ( $interFacename );
// 	} else {
// 		$interFaceinfo = $interFaceList [0];
// 		$interFacename = $interFaceinfo ['interFaceName'];
// 		$url = './index.php?classNmae=' . $interFacename;
// 		header ( $url);
// 		exit ();
// 	}
	$interFaceinfo = $this->getInterFaceInfo ( $interFaceName);
	$inPutArr = $this->getInterFaceInputArr( $interFaceName );
	$outPutArr = $this->getInterFaceOutputArr( $interFaceName );
	$interFaceList =$this->getInterfaceList ();
	$this->outMainContent ( $interFaceList, $interFaceName, $interFaceinfo, $inPutArr, $outPutArr);

}


/**
 * 获取接口列表数据
 */
function getInterfaceList() {
	$returnArr = array ();
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getInterfaceList ();
	if ($request) {
		
		if ($request ['inforCode'] == 0) {
			$temResu = $request ['result'];
			return $temResu;
		} else {
			return null;
		}
		return $returnArr;
	} else {
		__alert ( '服务器连接异常' );
	}
}

/**
 * 获取接口信息
 */
function getInterFaceInfo($interFaceName) {
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getInterFaceInfo ( $interFaceName );
	$returnArr = array ();
	if ($request) {
		if ($request ['inforCode'] == 0) {
			$temResu = $request ['result'];
			return $temResu [0];
		} else {
			__alert ( $request ['result'] );
		}
	} else {
		__alert ( '服务器连接异常' );
	}
}

/**
 * 获取接口入参列表
 */
function getInterFaceInputArr($interFaceName) {
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getInputValueList ( $interFaceName );
	
	if ($request) {
		if ($request ['inforCode'] == 0) {
			$temResu = $request ['result'];
			return $temResu;
		} else {
			return null;
		}
	} else {
		__alert ( '服务器连接异常' );
	}
}

/**
 * 获取接口出参列表
 */
function getInterFaceOutputArr($interFaceName) {
	$httpIntface = new Globle_HttpIntface ();
	$request = $httpIntface->getOutputValueList ( $interFaceName );
	
	if ($request) {
		if ($request ['inforCode'] == 0) {
			$temResu = $request ['result'];
			return $temResu;
		}
	} else {
		echo 'alert(请求接口失败)';
	}
}

/**
 * 输出main-content
 */
function outMainContent($interFaceList, $interFacename, $interFaceinfo, $inputArr, $outputArr) {
	?>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-md-3">
	<?php
	$this->outInterFaceList ( $interFaceList );
	?>
		</div>
			<div class="col-md-9">
	<?php
	
	$this->outInterFacrBastInfo ( $interFaceinfo );
	$this->outInterFaceInput ( $inputArr );
	$this->outInterFaceOutput ( $outputArr );
	?>
				</div>
		</div>
	</section>
</section>
<?php
}

/**
 *  输出接口列表
 *
 * @param unknown $interFaceList        	
 */
function outInterFaceList($interFaceList) {
	?>
<section class="panel">
	<div class="panel-body">
		<input type="text" placeholder="Keyword Search" class="form-control">
	</div>
</section>
<section class="panel">
	<header class="panel-heading">
		接口列表 <span class="tools pull-right"> <a class="fa fa-plus addInterFace"> </a>
		</span>
	</header>
	<div class="panel-body">
		<ul class="nav prod-cat">
	<?php
	foreach ( $interFaceList as $value ) {
		
		echo '<li><a href=./index.php?className=InterfaceManageVC&interFaceName=' . $value ['interFaceName'] . '><i class=" fa fa-leaf"></i>  ' . $value ['interFaceName'] . ' <small>' . $value ['interFaceNameStr'] . '</small></a> </li>';
	}
	?>
	 		</ul>
	</div>
</section>
<?php
}
function outInterFacrBastInfo($baseinfo) {
	?>
<div class="row">
	<div class="col-lg-6">
		<section class="panel" style="height: 450px">
			<header class="panel-heading">
				基本信息 <span class="tools pull-right"> <a class="fa fa-plus-square"
					href="javascript:;"> 测试</a> <a class="fa  fa-trash-o"
					href="javascript:;"> 删除</a>
				</span>
			</header>
			<div class="panel-body">
				<form role="form" class="form-horizontal tasi-form exitinfo-form">
					
					<div class="form-group">
						<label class="col-lg-12 control-label"> 接口名称</label>
						<div class="col-lg-12">
							<input type="text" placeholder="接口名称" name="interFaceName"
								class="form-control"
								value=<?php if ($baseinfo) echo $baseinfo ['interFaceName'];?>>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-12 control-label">接口中文名称</label>
						<div class="col-lg-12">
							<input type="text" placeholder="接口中文名称" name="interFaceNameStr"
								class="form-control"
								value=<?php if($baseinfo) echo $baseinfo['interFaceNameStr'];?>>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-12 control-label">接口路径</label>
						<div class="col-lg-12">
							<select class="form-control  m-bot15 " name="interFacepath">
								<option
									<?php if (strcmp($baseinfo['interFacepath'],"interface")==0) echo 'selected="selected"';?>>interface</option>
								<option
									<?php if (strcmp($baseinfo['interFacepath'],"samrtHome")==0) echo 'selected="selected"';?>>samrtHome</option>
								<option
									<?php  if (strcmp($baseinfo['interFacepath'],"FCAnalyse")==0) echo 'selected="selected"';?>>FCAnalyse</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-offset-9 col-lg-2 col-sm-2">
							<button class="btn btn-primary" type="submit">修改</button>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
	<div class="col-lg-6">
		<section class="panel" style="height: 450px">
			<header class="panel-heading"> 版本控制 </header>
			<div class="panel-body">
				<form role="form" class="form-horizontal versions-form">
					<div class="form-group">
						<label class="col-lg-12 control-label">开始版本号</label>
						<div class="col-lg-12">
							<input type="text" placeholder="开始版本号"
								name="interFaceBeginVersions" class="form-control"
								value=<?php if($baseinfo) echo $baseinfo['interFaceBeginVersions'];?>>
						</div>
						<label class="col-lg-12 control-label">结束版本号</label>
						<div class="col-lg-12">
							<input type="text" placeholder="" name="interFaceEndVersions"
								class="form-control"
								value=<?php if($baseinfo) echo $baseinfo['interFaceEndVersions'];?>>
						</div>
						<label class="col-lg-12 control-label">开始时间</label>
						<div class="col-lg-12">
							<input type="text" placeholder="" name="interFaceBeginTime"
								class="form-control"
								value=<?php if($baseinfo) echo $baseinfo['interFaceBeginTime'];?>>
						</div>
						<label class="col-lg-12 control-label">结束时间</label>
						<div class="col-lg-12">
							<input type="text" placeholder="" name="interFaceEndTime"
								class="form-control"
								value=<?php if($baseinfo) echo $baseinfo['interFaceEndTime'];?>>
						</div>
						<label class="col-lg-12 control-label">接口描述</label>
						<div class="col-lg-12">
							<input type="text" placeholder="" name="interFaceDescribe"
								class="form-control"
								value=<?php if($baseinfo) echo $baseinfo['interFaceDescribe'];?>>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2 col-lg-offset-9">
							<button class="btn btn-primary " type="submit">保存</button>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
</div>
<?php
}
function outInterFaceInput($inputArr) {
	?>
<section class="panel">
	<header class="panel-heading">
		入参<span class="tools pull-right"> <a id="editable-input_new"
			class="fa fa-plus-square" href="javascript:;"> 添加</a>
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
									colspan="1" aria-label="Username" style="width: 100px;">参数名</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Full Name: activate to sort column ascending"
									style="width: 100px;">中文名</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Points: activate to sort column ascending"
									style="width: 100px;">可为空</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">开始版本</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">结束版本</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">类型</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Edit: activate to sort column ascending"
									style="width: 10px;">Edit</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Delete: activate to sort column ascending"
									style="width: 10px;">Delete</th>
							</tr>
						</thead>

						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php
	if ($inputArr) {
		foreach ( $inputArr as $value ) {
			echo '<tr class="odd" id=' . $value ["parameterId"] . '>';
			echo '<td class=" ">' . $value ["parameterName"] . '</td>';
			echo '<td class=" ">' . $value ["parameterDescribe"] . '</td>';
			echo '<td class=" ">' . $value ["parameterCanNil"] . '</td>';
			echo '<td class=" ">' . $value ["parameterBeginVersions"] . '</td>';
			echo '<td class=" ">' . $value ["parameterEndVersions"] . '</td>';
			echo '<td class=" ">' . $value ["parameterType"] . '</td>';
			echo '<td class=" "><a class="edit" href="javascript:;">Edit</a></td>
			<td class=" "><a class="delete" href="javascript:;">Delete</a></td>';
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
function outInterFaceOutput($outputArr) {
	?>
<section class="panel">
	<header class="panel-heading">
		出参<span class="tools pull-right"> <a id="editable-output_new"
			class="fa fa-plus-square" href="javascript:;"> 添加</a>
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
						id="editable-output" aria-describedby="editable-sample_info">
						<thead>
							<tr role="row">
								<th class="sorting_disabled" role="columnheader" rowspan="1"
									colspan="1" aria-label="Username" style="width: 100px;">参数名</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Full Name: activate to sort column ascending"
									style="width: 100px;">中文名</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Points: activate to sort column ascending"
									style="width: 100px;">可为空</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">开始版本</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">结束版本</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Notes: activate to sort column ascending"
									style="width: 100px;">类型</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Edit: activate to sort column ascending"
									style="width: 10px;">Edit</th>
								<th class="sorting" role="columnheader" tabindex="0"
									aria-controls="editable-sample" rowspan="1" colspan="1"
									aria-label="Delete: activate to sort column ascending"
									style="width: 10px;">Delete</th>
							</tr>
						</thead>

						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php
	if ($outputArr) {
		foreach ( $outputArr as $value ) {
			echo '<tr class="odd" id=' . $value ["parameterId"] . '>';
			echo '<td class=" ">' . $value ["parameterName"] . '</td>';
			echo '<td class=" ">' . $value ["parameterDescribe"] . '</td>';
			echo '<td class=" ">' . $value ["parameterCanNil"] . '</td>';
			echo '<td class=" ">' . $value ["parameterBeginVersions"] . '</td>';
			echo '<td class=" ">' . $value ["parameterEndVersions"] . '</td>';
			echo '<td class=" ">' . $value ["parameterType"] . '</td>';
			echo '<td class=" "><a class="edit" href="javascript:;">Edit</a></td>
			<td class=" "><a class="delete" href="javascript:;">Delete</a></td>';
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
}
?>