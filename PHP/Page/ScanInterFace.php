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

function outMainContent(){
	echo '<section id="main-content">';
	echo '<section class="wrapper">';
	echo '<div class="row">';
	$interFaceList = getInterfaceList();
	outInterFaceList($interFaceList);
	
	$firstInterface =$interFaceList[0];
	outInterFacrBastInfo($firstInterface);
	$firstintFaceName = $firstInterface['interFaceName'];
	echo '</div>';
	echo '</section></section>';
}

/**
 *  输出接口列表
 * @param unknown $interFaceList
 */
function outInterFaceList($interFaceList){
	?> 
	
	<div class="col-md-3">
	<section class="panel">
                          <div class="panel-body">
                              <input type="text" placeholder="Keyword Search" class="form-control">
                          </div>
                      </section>
     <section class="panel">
     <header class="panel-heading">接口列表</header>
                          <div class="panel-body">
                           <ul class="nav prod-cat">
	<?php
	foreach ($interFaceList as $value){
		
		echo '<li><a href="#"><i class=" fa fa-leaf"></i>  ' .$value['interFaceName'] .' <small>' .$value['interFaceNameStr'] .'</small></a> </li>';
	}
	?>
	 		</ul>
     	</div>
     	 </section>
	</div>
	<?php
}
function outInterFacrBastInfo($baseinfo){
	?>
	<div class="col-md-9">
	<section class="panel">
	<h4 class="panel-heading"> <?php echo $baseinfo['interFaceName'].' ('.$baseinfo['interFaceNameStr'].')'; ?> </h4>
	<div class="panel-body text-left">
	<ul class="nav prod-cat">
		<li>  接口路径： <?php echo $baseinfo['interFacepath']; ?></li>
		<li>  接口描述</li>
		<li>  <?php echo $baseinfo['interFaceDescribe']; ?></li>
	</ul>
    </div>
	</section>
	</div>
	<?php
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
?>