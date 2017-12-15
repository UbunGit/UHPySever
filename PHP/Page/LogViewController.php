<?php
require_once ('./BaseViewController.php');
class LogViewController extends BaseViewController {
	var $logLevels;
	var $loguserName;
	var $business;
	var $search;
	var $logType;
	var $allcount;
	function viewwillLoad() {
		/* 输出头部信息 */
		$this->jsArr = array (
				"LogoInfo.js",
				"Tooltips.js",
				"config.js",
				"Cookie.js" 
		);
		
		/* 输出头部信息 */
		$this->absjsArr = array ();
		
		$this->abscssArr = array ();
		$this->cssArr = array (
				'header.css',
				'LogoInfo.css' 
		);
		
		$this->title = "日志分析";
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
		$this->loguserName = isset ( $_GET ["userName"] ) ? $_GET ['userName'] : '';
		$this->business = isset ( $_GET ["business"] ) ? $_GET ['business'] : '';
		$this->logLevels = isset ( $_GET ["logLevels"] ) ? $_GET ['logLevels'] : '0';
		$this->search = isset ( $_GET ["search"] ) ? $_GET ['search'] : '';
		$this->logType = isset ( $_GET ["logType"] ) ? $_GET ['logType'] : '1001';
		$this->pageNum = isset ( $_GET ["pageNum"] ) ? $_GET ['pageNum'] : '1';
		$logList = $this->getLogList ( $this->loguserName, '', '', $this->business, $this->logLevels, $this->search);
		$this->allcount = $logList ["allCount"];
		$this->outMainContent ( $logList ["datalist"], $this->logType );
	}
	
	/**
	 * 输出main-content
	 */
	function outMainContent($infoList, $logType) {
		?>
<section id="main-content">
	<section class="wrapper">
		<div class="col-md-8">
	<?php $this->outinfo($infoList); ?>
	</div>
		<div class="col-md-4">
	<?php $this->outrightTab($logType) ?>
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
						<a  href="javascript:;">[More]</a></br>
						<span> ' . substr ( $logDescription, 0, 250 ) . '</span>
						<span style="display:none;">' . __jsonFormat(json_decode($logDescription))   . '</span>
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
		<li <?php if($logType == 1001) echo 'class="active"'?>><a
			href="?logType=1001";"> <i class="fa fa-rocket"></i> <span>用户操作日志</span>
		</a></li>
		<li <?php if($logType == 1002) echo 'class="active"'?>><a
			href="?logType=1002"> <i class="fa fa-rocket"></i> <span>服务错误日志</span>
		</a></li>
	</ul>
	<div class="user-head">
		<i class="fa fa-filter"></i>
		<h3>筛选</h3>
	</div>
	<ul class="chat-list">
		<li>
			<div class="filter-cell">
				<label class="control-label">模糊搜索</label> <input type="text"
					class="search-text" placeholder="Search"
					value="<?php  echo $this->search?> "></input>
			</div>
		
		<li>
			<div class="filter-cell">
				<label class="control-label">错误等级</label> <input type="text"
					class="loglevel-text" placeholder="0"
					value="<?php  echo $this->logLevels ?> "></input>
			</div>
		</li>

		<li>
			<div class="filter-cell">
				<label class="control-label">用户名称</label> <input type="text"
					class="userName-text" placeholder="userName"
					value="<?php  echo $this->loguserName?>"></input>
			</div>
		</li>

		<li>
			<div class="filter-cell">
				<label class="control-label">业务名称</label> <input type="text"
					class="business-text" placeholder=""
					value="<?php  echo $this->business  ?> "></input>
			</div>
		</li>
	</ul>

	<ul class="chat-list pagination pull-right">

	<?php
		$pagecount = $this->allcount / 10 + ($this->allcount % 10 > 0 ? 1 : 0);
		for($x = 1; $x <= $pagecount; $x ++) {
			if ($this->pageNum == $x) {
				echo '<li class="active"><a class="pageNum-a" href="javascript:;">' . $x . '</a></li>';
			} else {
				echo '<li><a class="pageNum-a" href="javascript:;">' . $x . '</a></li>';
			}
		}
		?>
	</ul>

</aside>
<?php
	}
	/**
	 * 获取会员信息
	 *
	 * @param 会员账号 $userName        	
	 */
	function getLogList($memberNO, $beginTime, $endTime, $business, $levels,$search) {
		$returndata = [ ];
		$httpIntface = new Globle_HttpIntface ();
		$request = $httpIntface->getLogList ( $memberNO, $beginTime, $endTime, $business, $levels ,$search);
		if ($request) {
			if ($request ['inforCode'] == 0) {
				
				$returndata = $request ['result'];
			} else {

			}
			return $returndata;
		} else {
			echo 'alert(请求接口失败)';
		}
	}
}

?>