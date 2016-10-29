<?php
require_once ('../Public_php/Globle_sc_fns.php');
$userName = __getCookies ( 'userName' );

/* 输出头部信息*/
$jsArr = array("ScanInterFace.js",
		"Tooltips.js",
		"Cookie.js",);
$cssArr = array('ScanInterFace.css',
		'header.css');

$interFaceList = getInterfaceList();

$outPut = new OutPut();
$outPut->outPutHead ( $jsArr, $cssArr, "接口查询" );
/* 输出顶部导航*/
$userimg = __getCookies ( 'userImg' );
$userName = __getCookies('userName');
$userInfo = array(
		"heardImg" =>"fc3d.jpg",
		"userName"=>$userName,
);
$outPut->outPutHeader($userInfo);
$outPut->outSider();
outMainContent();
$outPut->outputFoot();

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
			$uri = $_SERVER['HTTP_HOST'];
			header('Location:./AddNewInterFace.php');
			exit;
		}
		return $returnArr;
	} else {
		__alert ('服务器连接异常');
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
		__alert ('服务器连接异常' );
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
		}else {
			__alert ( $request ['result'] );
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
function outMainContent(){
	?>
	<section id="main-content">
		<section class="wrapper">
			<div class="row">
				<div class="col-md-3">
	<?php
	$interFaceList = getInterfaceList();
	outInterFaceList($interFaceList);
	?>
				</div>

				<div class="col-md-9">
	<?php
	@$interFacename = __get(interFaceName);
	if ($interFacename){
		$interFaceinfo = getInterFaceInfo($interFacename);
	}else {
		$interFaceinfo =$interFaceList[0];
		$interFacename =$interFaceinfo['interFaceName'];
	}
	outInterFacrBastInfo($interFaceinfo);
	$inputArr =getInterFaceInputArr($interFacename);
	outInterFaceInput($inputArr);
	?>
				</div>
			</div>
	</section></section>
	<?php
}

/**
 *  输出接口列表
 * @param unknown $interFaceList
 */
function outInterFaceList($interFaceList){
	?>
	<section class="panel">
                          <div class="panel-body">
                              <input type="text" placeholder="Keyword Search" class="form-control">
                          </div>
                      </section>
     <section class="panel">
     <header class="panel-heading">接口列表
     	<span class="tools pull-right">
             <a class="fa fa-plus"> </a>
        </span>
      </header>
     <div class="panel-body">
           <ul class="nav prod-cat">
	<?php
	foreach ($interFaceList as $value){
		
		echo '<li><a href=./ScanInterFace.php?interFaceName='.$value['interFaceName'].'><i class=" fa fa-leaf"></i>  ' .$value['interFaceName'] .' <small>' .$value['interFaceNameStr'] .'</small></a> </li>';
	}
	?>
	 		</ul>
     </div>
    </section>
	<?php
}


function outInterFacrBastInfo($baseinfo){
	?>
	 <div class="row">
	                  <div class="col-lg-6">
	                      <section class="panel" style="height:450px">
	                          <header class="panel-heading">基本信息
	                          	<span class="tools pull-right">
                         			<a class="fa fa-wrench"> 修改</a>
                         			<a class="fa fa-plus-square" href="javascript:;"> 测试</a>
                         			<a class="fa  fa-trash-o" href="javascript:;"> 删除</a>
                    			</span>
	                          </header>
	                          <div class="panel-body">
	                           <?php 
	                                      if($baseinfo) {
	                                      	echo '<form role="form" class="form-horizontal tasi-form exitinfo-form">';
	                                      }
	                                      else {
	                                      	echo '<form role="form" class="form-horizontal tasi-form addinfo-form">';
	                                      }
	                            ?>
	                             
	                              
	                                  <div class="form-group">
	                                      <label class="col-lg-12 control-label"> 接口名称</label>
	                                      <div class="col-lg-12">
	                                          <input type="text" placeholder="接口名称" name="interFaceName" class="form-control" value=<?php 
	                                          if($baseinfo) echo $baseinfo['interFaceName'];
	                                          ?>>
	                                      </div> 
	                                  </div>
	                                  
	                                  <div class="form-group">
	                                      <label class="col-lg-12 control-label">接口中文名称</label>
	                                      <div class="col-lg-12">
	                                          <input type="text" placeholder="接口中文名称" name="interFaceNameStr" class="form-control" value=<?php if($baseinfo) echo $baseinfo['interFaceNameStr'];?>>
	                                      </div>
	                                  </div>
	                                  
	                                  <div class="form-group">
	                                  <label class="col-lg-12 control-label">接口路径</label>
	                                  <div class="col-lg-12">
	                                  <select class="form-control  m-bot15 "  name="interFacepath" >
	                                              <option <?php if (strcmp($baseinfo['interFacepath'],"interface")==0) echo 'selected="selected"';?> >interface</option>
	                                              <option <?php if (strcmp($baseinfo['interFacepath'],"samrtHome")==0) echo 'selected="selected"';?> >samrtHome</option>
	                                              <option <?php  if (strcmp($baseinfo['interFacepath'],"FCAnalyse")==0) echo 'selected="selected"';?> >FCAnalyse</option>
	                                  </select>
	                                  </div>
	                                  </div>
	
	                                  <div class="form-group">
	                                      <div class="col-lg-offset-9 col-lg-2 col-sm-2">
	                                      <?php 
	                                      if($baseinfo) {
	                                      	echo '<button class="btn btn-primary saveinterface" type="submit">修改</button>';
	                                      }
	                                      else {
	                                      	echo '<button class="btn btn-primary addinterface" type="submit">添加</button>';
	                                      }
	                                      ?>
	                                          
	                                      </div>
	                                  </div>
	                                  
	                              </form>
	                          </div>
	                      </section>
	                  </div>
	                  <div class="col-lg-6" >
	                      <section class="panel" style="height:450px">
	                          <header class="panel-heading">
	                              版本控制
	                          </header>
	                          <div class="panel-body">
	                              <form role="form" class="form-horizontal tasi-form">
	                                  <div class="form-group">
	                                      <label class="col-lg-12 control-label">开始版本号</label>
	                                      <div class="col-lg-12">
	                                          <input type="text" placeholder="" id="f-name" class="form-control" value=<?php if($baseinfo) echo $baseinfo['interFaceBeginVersions'];?>>
	                                      </div>
	                                      <label class="col-lg-12 control-label">结束版本号</label>
	                                      <div class="col-lg-12">
	                                          <input type="text" placeholder="" id="l-name" class="form-control" value=<?php if($baseinfo) echo $baseinfo['interFaceEndVersions'];?>>
	                                      </div>
	                                      <label class="col-lg-12 control-label">开始时间</label>
	                                      <div class="col-lg-12">
	                                          <input type="text" placeholder="" id="l-name" class="form-control" value=<?php if($baseinfo) echo $baseinfo['interFaceBeginTime'];?>>
	                                      </div>
	                                      <label class="col-lg-12 control-label">结束时间</label>
	                                      <div class="col-lg-12">
	                                          <input type="text" placeholder="" id="l-name" class="form-control" value=<?php if($baseinfo) echo $baseinfo['interFaceEndTime'];?>>
	                                      </div>
	                                      <label class="col-lg-12 control-label">接口描述</label>
	                                      <div class="col-lg-12">
	                                          <input type="text" placeholder="" id="l-name" class="form-control" value=<?php if($baseinfo) echo $baseinfo['interFaceDescribe'];?>>
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

function outInterFaceInput($inputArr){
	?>
	 <section class="panel">
	         <header class="panel-heading"> 入参
	         </header>
	         <div class="panel-body">

	                <label class="col-lg-12 control-label">开始版本号</label>
	                <div class="col-lg-12">
	                    <input type="text" placeholder="" id="f-name" class="form-control" value=<?php if($inputArr) echo $baseinfo['interFaceBeginVersions'];?>>
	                </div>
	          </div>
	  </section>
	<?php
}
?>