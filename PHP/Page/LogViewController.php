<?php
require_once ('./BaseViewController.php');

class LogViewController extends BaseViewController{
	
	var $logLevels;
	var $loguserName;
	var $business;
	var $search;
	
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
	function getuserInfo(){
		
		$userimg = __getCookies ( 'userImg' );
		$userName = __getCookies ( 'userName' );
		
		$this->userInfo= array (
				"heardImg" => "fc3d.jpg",
				"userName" => $userName
		);
	}
	function viewLoadbody(){
		parent::viewLoadbody();
		$this->loguserName= isset($_GET["userName"]) ? $_GET ['userName'] : '';
		$this->business= isset($_GET["business"]) ? $_GET ['business'] : '';
		$this->logLevels= isset($_GET["logLevels"]) ? $_GET ['logLevels'] : '0';
		$this->search=  isset($_GET["search"]) ? $_GET ['search'] : '';
		
		$logList = $this->getLogList ( $this->loguserName, '', '', $this->business, $this->logLevels);
		$this->outMainContent ( $logList, $this->logType );
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
	<ul class="logLevels-input">
	    <li>
	    <div class="filter-cell">
		<label class="control-label">模糊搜索</label>
		<input type="text" class="search-text"   placeholder="Search" value="<?php  echo $this->search?> "></input>
		</div>
		
		<li>
		<div class="filter-cell">
		<label class="control-label">错误等级</label>
		<input type="text" class="loglevel-text"  placeholder="0"     value="<?php  echo $this->logLevels ?> "></input>
		</div>
		</li>
		
		<li>
		<div class="filter-cell">
		<label class="control-label">用户名称</label>
		<input type="text"  class="userName-text" placeholder="userName" value="<?php  echo $this->loguserName?>"></input>
		</div>
		</li>
		
		<li>
		<div class="filter-cell">
		<label class="control-label" >业务名称</label>
		<input type="text" class="business-text" placeholder="" value="<?php  echo $this->business  ?> "></input>
		</div>
		</li>
	</ul>
	<div>
                                  <ul class="pagination pagination-sm pull-right">
                                      <li><a href="#">«</a></li>
                                      <li><a href="#">1</a></li>
                                      <li><a href="#">2</a></li>
                                      <li><a href="#">3</a></li>
                                      <li><a href="#">4</a></li>
                                      <li><a href="#">5</a></li>
                                      <li><a href="#">»</a></li>
                                  </ul>
                              </div>

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
}

?>