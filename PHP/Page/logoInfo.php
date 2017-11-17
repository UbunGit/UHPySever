
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
		'<script src="../JS/jquery/jquery-migrate-1.2.1.min.js"></script>
          </script>' 
);

$cssabsArr = array (
);
$cssArr = array (
		
		'header.css',
		'LogoInfo.css' 
);

$outPut->outPutHead ( $cssArr, null, "日志管理" );

$userimg = __getCookies ( 'userImg' );
$userName = __getCookies ( 'userName' );
$logType = $_GET['logType']; 

$userInfo = array (
		"heardImg" => "fc3d.jpg",
		"userName" => $userName 
);

$logList = getLogList ( null, '', '', "", "0" );
$outPut->outPutHeader ( $userInfo );
$outPut->outSider ( '日志分析' );
outMainContent ( $logList ,$logType);
$outPut->outputFoot ( $jsArr, $jsabsArr );

/**
 * 输出main-content
 */
function outMainContent($infoList,$logType) {
	?>
<section id="main-content">
	<section class="wrapper">
		<div class="col-md-8">
	<?php outinfo($infoList); ?>
	</div>
		<div class="col-md-4">
	<?php outrightTab($logType) ?>
	</div>
	</section>
</section>
<?php
}
function outinfo($infoList) {
	?>
<section class="panel">
	<header class="panel-heading">
		日志分析<span class="tools pull-right"> <a class="fa fa-refresh reload"
			href="javascript:;"> 删除</a>
		</span>
	</header>
	<div class="panel-body">
<?php
	
	if ($infoList != null) {
		foreach ( $infoList as $value ) {
			echo '<div class="room-box">';
			echo '<h5 class="text-primary">' . $value ["logLevels"] . '</h5>';
			echo '<p>
					<span class="text-muted">Member :</span> ' . $value ["logMember"] . ' |
					<span class="text-muted">Business :</span> ' . $value ["logBusiness"] . ' | 
					<span class="text-right">Time :</span> ' . $value ["logTime"] . '
				</p>';
			
			
			$logDescription = $value ["logDescription"];
			if (strlen ( $logDescription ) >= 250) {
				echo '<p class="logDescription">
						<a  href="javascript:;">[More]</a>
						<span> ' . substr ( $logDescription, 0, 250 ) . '</span>
						<span style="display:none;">' . $logDescription . '</span>
					 </p>';
			} else {
				echo '<p><span>' . $logDescription . '</span></p>';
			}
			echo '</div>';
		}
	}
	?>

	</div>
</section>
<?php
}
function outrightTab($logType) {
	?>
<aside class="left-side">
	<div class="user-head">
		<i class="fa fa-files-o"></i>
		<h3>日志类型</h3>
	</div>
	<ul class="chat-list">
		<li <?php if($logType == 1001) echo 'class="active"'?>><a href="?logType=1001";"> <i class="fa fa-rocket"></i> <span>用户操作日志</span>
		</a></li>
		<li <?php if($logType == 1002) echo 'class="active"'?> ><a href="?logType=1002"> <i class="fa fa-rocket"></i> <span>服务错误日志</span>
		</a></li>
	</ul>
	<div class="user-head">
		<i class="fa fa-files-o"></i>
		<h3>日志等级</h3>
	</div>
	<ul class="logLevels-input">
	<li> <input  type="text"  placeholder="Email Address"></input> </li>
	</ul>

</aside>
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