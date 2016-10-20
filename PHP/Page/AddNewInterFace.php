<?php
/**
 * 添加新接口信息
 */
require_once('../Public_php/Globle_sc_fns.php');

$userName = __getCookies('userName');
$interFaceName='';
if (__get ( 'interFaceName' )) {
	$interFaceName = __get ( 'interFaceName' );
}

/* 输出头部信息*/
$jsArr = array("AddNewInterFace.js","Tooltips.js");
$cssArr = array('AddNewInterFace.css','header.css');

$outPut = new OutPut();
$outPut->outPutHead($jsArr,$cssArr,"添加接口信息");
/* 输出顶部导航*/
$userimg = __getCookies ( 'userImg' );
$userName = __getCookies('userName');
$userInfo = array(
		"heardImg" =>"fc3d.jpg",
		"userName"=>$userName,
);
$outPut->outPutHeader($userInfo);
$outPut->outSider();
outputInterFaceInfo_edit();
$outPut->outputFoot();

function  outputInterFaceInfo_edit(){
	echo '<section id="main-content">';
	echo '<section class="wrapper">';
	//接口基本信息from
	outIntefaceBasicInfofrom();
	outIntefaceOtherInfofrom();
	echo '</section></section>';
}

// data_Dic = {"interFaceName":data['interFaceName'],
// "interFaceNameStr":data['interFaceNameStr'],
// "interFaceBeginVersions":data['interFaceBeginVersions'],
// "interFaceEndVersions":data['interFaceEndVersions'],
// "interFaceBeginTime":data['interFaceBeginTime'],
// "interFaceEndTime":data['interFaceEndTime'],
// "interFacepath":data['interFacepath'],
// "interFaceDescribe":data['interFaceDescribe']
function outIntefaceBasicInfofrom(){
	?>  <div class="row">
	                  <div class="col-lg-12">
	                      <section class="panel">
	                          <header class="panel-heading">
	                              基本信息
	                          </header>
	                          <div class="panel-body">
	                              <form role="form" class="form-horizontal tasi-form"  method="get" action="" novalidate="novalidate">
	                                  <div class="form-group">
	                                      <label class="col-lg-2 control-label">接口名称</label>
	                                      <div class="col-lg-10">
	                                          <input type="text" placeholder="" id="interFaceName" class="form-control">
	                                      </div>
	                                      
	                                  </div>
	                                  <div class="form-group">
	                                      <label class="col-lg-2 control-label">功能描述</label>
	                                      <div class="col-lg-10">
	                                          <input type="text" placeholder="" id="interFaceDescribe" class="form-control">
	                                      </div>
	                                  </div>
	                                  <label class="col-lg-0 control-label">接口路径</label>
	                                  <select class="form-control input-lg m-bot15"  id="interFacepath">
	                                              <option>InterFace</option>
	                                              <option>Option 2</option>
	                                              <option>Option 3</option>
	                                          </select>
	
	                                  <div class="form-group">
	                                      <div class="col-lg-offset-2 col-lg-10">
	                                          <button class="btn btn-danger" type="submit">保存</button>
	                                      </div>
	                                  </div>
	                              </form>
	                          </div>
	                      </section>
	                  </div>
	              </div>
	              <?php 
}

function outIntefaceOtherInfofrom(){
	?>  <div class="row">
	                  <div class="col-lg-12">
	                      <section class="panel">
	                          <header class="panel-heading">
	                              版本控制
	                          </header>
	                          <div class="panel-body">
	                              <form role="form" class="form-horizontal tasi-form">
	                                  <div class="form-group">
	                                      <label class="col-lg-2 control-label">开始版本号</label>
	                                      <div class="col-lg-10">
	                                          <input type="text" placeholder="" id="f-name" class="form-control">
	                                      </div>
	                                      <label class="col-lg-2 control-label">结束版本号</label>
	                                      <div class="col-lg-10">
	                                          <input type="text" placeholder="" id="l-name" class="form-control">
	                                      </div>
	                                      <label class="col-lg-2 control-label">开始时间</label>
	                                      <div class="col-lg-10">
	                                          <input type="text" placeholder="" id="l-name" class="form-control">
	                                      </div>
	                                      <label class="col-lg-2 control-label">结束时间</label>
	                                      <div class="col-lg-10">
	                                          <input type="text" placeholder="" id="l-name" class="form-control">
	                                      </div>
	                                      
	                                  </div>
	                                  
	                                  <div class="form-group">
	                                      <div class="col-lg-offset-2 col-lg-10">
	                                          <button class="btn btn-danger" type="submit">保存</button>
	                                      </div>
	                                  </div>
	                              </form>
	                          </div>
	                      </section>
	                  </div>
	              </div>
	              <?php 
}

?>
