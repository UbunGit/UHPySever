<?php
class Output {
	private  $imagePath;
	private  $jsPath;
	private  $cssPath;
	function __construct() {
		$this->imagePath = "../../../Image/";
		$this->jsPath = "../../../JS/";
		$this->cssPath = "../../../CSS/";
	}
	function getImage($imageFile){
		return $this->imagePath.$imageFile;
	}
	function getjs($jsFile){
		return $this->jsPath.$jsFile;
	}
	function getCSS($cssFile){
		return $this->cssPath.$cssFile;
	}
	/*
	 * 输出头信息
	 */
	function outPutHead($jsarr, $cssarr, $headStr) {
		echo '<!DOCTYPE html>
				<html lang="en">';
		echo '<head>';
		echo '<meta charset="UTF-8">';
		echo '<title>' . $headStr . '</title>';
 		echo '<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=no">';
 		echo ' <!--external css-->';
      
        echo '<link rel="stylesheet"  href='.$this->getCSS("assets/font-awesome/css/font-awesome.css").'></link>';
        echo '<link rel="stylesheet"  href="'.$this->getCSS("assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css").'">';
 		
 		echo '<link rel="stylesheet"  href='.$this->getCSS("bootstrap-reset.css").'>
 		<link rel="stylesheet"  href="../../../CSS/bootstrap.min.css">';
 		echo '<link rel="stylesheet"  href='.$this->getCSS("slidebars.css").'>';
 		echo '<link rel="stylesheet"  href='.$this->getCSS("style.css").'>';
 		echo '<link rel="stylesheet"  href='.$this->getCSS("style-responsive.css").'>';
 		
 		if (! empty ( $cssarr )) {
 			foreach ( $cssarr as $value ) {
 				echo ('<link rel="stylesheet" type="text/css" media="screen" href="' .$this->getCSS ($value ). '"/>');
 			}
 		}
		
// 		echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
// 		if (! empty ( $jsarr )) {
// 			foreach ( $jsarr as $value ) {
// 				echo ('<script src="' . $value . '"></script>');
// 			}
// 		}
		echo '</head>';
		echo '<body>';
	}
	
	/**
	 * 输出头部内容
	 */
	function outPutHeader($userInfo) {
		echo '<header class="header white-bg">
    			<div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              	</div>
    			<!--logo start-->
            	<a href="index.html" class="logo">Ubun<span>Hub</span></a>
            	<!--logo end-->
<div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="' . $this->getImage($userInfo->heardImg) . '">
                            <span class="username">' . $userInfo->userName . '</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                            <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <li class="sb-toggle-right">
                        <i class="fa  fa-align-right"></i>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
    			
    			</header>';
	}
	/*
	 * 输出底部
	 */
	function outputFoot() {
		echo '</body>';
		echo '</html>';
	}
	/*
	 * 输出导航栏
	 */
	function outputNav($userimg) {
		echo '<div id="navfirst">
    			 <ul id="head">	
    			  <li><img class="userInfo" src="' . $userimg . '"/></li>
              </ul>
              <ul id="menu">	
              <li><a class="menuNav" src="./ScanInterFace.php">接口查询</a></li>
    		      <li><a class="menuNav" href="./TestInterFace.php">接口测试</a></li>
              <li><a class="menuNav" href="./MemberManagement.php">会员管理</a></li>
              </ul>
              </div>';
	}
	
	/**
	 * 输出左侧边栏
	 */
	function outputLeftNav($navArr) {
		echo '<div class="leftNav">
			  <ul>';
		if (! empty ( $navArr )) {
			foreach ( $navArr as $value ) {
				echo ('<li><a class="leftNavMenu" >' . $value . ' </a> </li>');
			}
		}
		;
		echo '</ul>
            </div>';
	}
	
	/**
	 * 输出<tr><td>
	 */
	function outPutTable_tr($key, $value) {
		echo '<tr>
    			<td>' . $key . '</td>
    			<td>' . $value . '</td>
    		  </tr>';
	}
}
;
?>