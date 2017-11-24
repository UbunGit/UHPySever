<?php
require_once ('../Public_php/ViewController.php');

abstract class BaseViewController extends ViewController{
	
	public $userInfo;
	

	function viewwillLoad() {
	
	}
	abstract public function getuserInfo();
	
	
	function viewLoadbody(){
		parent::viewLoadbody();
		echo '<section id="container">';
		$this->bodyLoadHead();
		$this->bodyLoadleftBar();
	}
	
	function bodyLoadHead(){
		?>
		<header class="header white-bg">
		<div class="sidebar-toggle-box">
		<div class="fa fa-bars tooltips"></div>
		</div>
		<!--logo start-->
		<a href="index.php" class="logo">Ubun<span>Hub</span></a>
		<!--logo end-->
		<div class="top-nav ">
		<!--search & user info start-->
		<ul class="nav pull-right top-menu">
		<li><input type="text" class="form-control search"
				placeholder="Search"></li>
				<!-- user login dropdown start-->
				<li class="dropdown"><a data-toggle="dropdown"
						class="dropdown-toggle" href="#"> <img alt=""
								src=<?php echo $this->getImage( $this->userInfo['heardImg']); ?>> <span
							class="username"><?php echo $this->userInfo['userName'];?> </span> <b
							class="caret"></b>
					</a>
						<ul class="dropdown-menu extended logout">
							<div class="log-arrow-up"></div>
							<li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
							<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
							<li><a href="Login.php"><i class="fa fa-key"></i> 注销</a></li>
						</ul></li>
					<li class="sb-toggle-right"><i class="fa  fa-align-right"></i></li>
					<!-- user login dropdown end -->
				</ul>
				<!--search & user info end-->
			</div>

		</header>
    			<?php
	}
	function bodyLoadleftBar(){
		?>
		<!--sidebar start-->
		<aside>
			<div id="sidebar" class="nav-collapse ">
				<!-- sidebar menu start-->
				<ul class="sidebar-menu" id="nav-accordion">
				   	<li><?php echo  $this->outsidebarTitle( "主页",$this->title,"/index.php","fa fa-home");?></li>
					<li class="sub-menu"><?php echo  $this->outsidebarTitle( "接口管理",$this->title,"javascript:;",'fa fa-laptop');?>
					
						<ul class="sub">
						<?php
		echo $this->outSilerbarli ( $this->getPath ( "InterfaceManageVC" ), "接口查询" );
		echo $this->outSilerbarli ( $this->getPath ( "AddNewInterFace.php" ), "添加接口" );
		?>
						</ul></li>

					<li class="sub-menu"><li class="sub-menu"><?php echo  $this->outsidebarTitle( "3D彩票",$this->title,"javascript:;","fa fa-book");?>
						<ul class="sub">
							<?php
		echo $this->outSilerbarli ( $this->getPath ( "UpdateData.php" ), "更新数据" );
		echo $this->outSilerbarli ( $this->getPath ( "History3d.php" ), "历史出球" );
		echo $this->outSilerbarli ( $this->getPath ( "Predictor3D.php" ), "概率统计" );
		echo $this->outSilerbarli ( $this->getPath ( "FCOutData.php" ), "频率查询" );
		?>
						</ul></li>

					<li class="sub-menu"><?php echo  $this->outsidebarTitle( "日志分析", $this->title, "javascript:;",'fa fa-laptop');?>
						<ul class="sub">
						<?php echo $this->outSilerbarli ( $this->getPath ( "LogViewController" ), "日志分析" ); ?>
						</ul></li>
				</ul>
				<!-- sidebar menu end-->
			</div>
		</aside>
		<?php
	}
	function bodyLoadsection(){
		
	}
	function bodyLoadFoot(){
		echo '</section>';
	}
	
	/**
	 * 输出siderbar li
	 */
	function outSilerbarli($path, $text) {
		$locatonUrl = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ["REQUEST_URI"];
		$url = './index.php?className='.$path;
		if (strcmp ( $path, $locatonUrl ) == 0) {
			
			return '<li class="active"><a href=' . $url. '>' . $text . '</a></li>';
		} else {
			return '<li ><a href=' . $url. '>' . $text . '</a></li>';
		}
	}
	
	/**
	 * 输出siderbar li
	 */
	function outsidebarTitle($text,$sidebarTitle,$herf,$faName) {
		
		if (strcmp ( $text, $sidebarTitle) == 0) {
			return "<a herf =".$herf.' class="active"><i class="'.$faName.'"></i> <span>'.$text.'</span> </a>
					';
		} else {
			return '<a herf ='.$herf.'>
						<i class="'.$faName.'"></i> <span>'.$text.'</span> </a>';
		}
	}
	
}

?>