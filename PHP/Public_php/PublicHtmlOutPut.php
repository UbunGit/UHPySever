<?php
class Output {
	private $imagePath;
	private $jsPath;
	private $cssPath;
	private $assets;
	function __construct() {
		$config = new ConfigINI ();
		$this->imagePath = $config->get ( 'URL.root_image' );
		$this->jsPath = $config->get ( 'URL.root_js' );
		$this->cssPath = $config->get ( 'URL.root_css' );
		$this->pagePath = $config->get ( 'URL.root_page' );
		$this->assets = $config->get ( 'URL.root_assets' );
	}
	function getPath($file) {
		$path = $this->pagePath . $file;
		return $path;
	}
	function getImage($imageFile) {
		return $this->imagePath . $imageFile;
	}
	function getjs($jsFile) {
		return $this->jsPath . $jsFile;
	}
	function getCSS($cssFile) {
		$path = $this->cssPath . $cssFile;
		return $path;
	}
	function getAssets($file) {
		$path = $this->assets . $file;
		return $path;
	}
	function getScriptStr($script) {
		return '<script src=' . $script . '></script>';
	}
	
	/**
	 * 输出头部消息
	 *
	 * @param 相对路径css路径 $cssarr        	
	 * @param 觉对路径css路径 $cssabsArr        	
	 * @param 标题 $headStr        	
	 */
	function outPutHead($cssarr, $cssabsArr, $headStr) {
		?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $headStr; ?></title>
<meta name="viewport"
	content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=no">
<!--bootstrap-->
<link rel="stylesheet"
	href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet"
	href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

 		<?php
		echo ' <!--external css-->';
		echo '<link rel="stylesheet"  href=' . $this->getAssets ( "data-tables/DT_bootstrap.css" ) . '></link>';
		echo '<link rel="stylesheet"  href=' . $this->getAssets ( "font-awesome/css/font-awesome.css" ) . '></link>';
		echo '<link rel="stylesheet"  href="' . $this->getAssets ( "jquery-easy-pie-chart/jquery.easy-pie-chart.css" ) . '">';
		echo '<link rel="stylesheet"  href=' . $this->getCSS ( "slidebars.css" ) . '>';
		echo '<link rel="stylesheet"  href=' . $this->getCSS ( "style.css" ) . '>';
		echo '<link rel="stylesheet"  href=' . $this->getCSS ( "style-responsive.css" ) . '>';
		echo '<link rel="stylesheet"  href=' . $this->getCSS ( "owl.carousel.css" ) . '>';
		echo '<link rel="stylesheet"  href=' . $this->getCSS ( "bootstrap-reset.css" ) . '>';
		
		if (! empty ( $cssarr )) {
			foreach ( $cssarr as $value ) {
				echo ('<link rel="stylesheet" type="text/css" media="screen" href="' . $this->getCSS ( $value ) . '"/>');
			}
		}
		if (! empty ( $cssabsArr )) {
			foreach ( $cssabsArr as $value ) {
				echo ('<link rel="stylesheet" type="text/css" media="screen" href="' . $value . '"/>');
			}
		}
	}
	
	/**
	 * 输出头部内容
	 */
	function outPutHeader($userInfo) {
		?>
		</head>
<body>

	<section id="container">

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
							src=<?php echo $this->getImage ( $userInfo ['heardImg']); ?>> <span
							class="username"><?php echo $userInfo ['userName'];?> </span> <b
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
	/*
	 * 输出底部
	 */
	function outputFoot($jsarr, $jsabsArr) {
		echo '</section>';
		echo '<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>';
		echo '<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "jquery/jquery.dcjqaccordion.2.7.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "jquery/jquery.scrollTo.min.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "jquery/jquery.nicescroll.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "jquery/jquery.sparkline.js" ) . ' ></script>';
		echo '<script charset="UTF-8" src=' . $this->getAssets ( "jquery-easy-pie-chart/jquery.easy-pie-chart.js" ) . ' ></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "owl.carousel.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "jquery/jquery.customSelect.min.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "respond.min.js" ) . '></script>';
		
		echo '<script charset="UTF-8" src=' . $this->getjs ( "slidebars.min.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "sliders.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "common-scripts.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "count.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "sparkline-chart.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "easy-pie-chart.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "config.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "Cookie.js" ) . '></script>';
		echo '<script charset="UTF-8" src=' . $this->getjs ( "Tooltips.js" ) . '></script>';
		
		if (! empty ( $jsabsArr )) {
			foreach ( $jsabsArr as $value ) {
				echo ($value);
			}
		}
		
		if (! empty ( $jsarr )) {
			foreach ( $jsarr as $value ) {
				echo ('<script charset="UTF-8" src="' . $this->getjs ( $value ) . '"></script>');
			}
		}
		echo '
<script> //owl carousel
		
      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true
		
          });
      });
		
      //custom select box
		
      $(function(){
          $(\'select.styled\').customSelect();
      });
		
</script>
				';
		echo '</body>';
		echo '</html>';
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
	
	/**
	 * 输出siderbar li
	 */
	function outSilerbarli($path, $text) {
		$locatonUrl = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ["REQUEST_URI"];
		if (strcmp ( $path, $locatonUrl ) == 0) {
			return '<li class="active"><a href=' . $path . '>' . $text . '</a></li>';
		} else {
			return '<li ><a href=' . $path . '>' . $text . '</a></li>';
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

	function outSider($sidebarTitle) {
		?>
		<!--sidebar start-->
		<aside>
			<div id="sidebar" class="nav-collapse ">
				<!-- sidebar menu start-->
				<ul class="sidebar-menu" id="nav-accordion">
				   	<li><?php echo  $this->outsidebarTitle( "主页",$sidebarTitle,"/index.php","fa fa-home");?></li>
					<li class="sub-menu"><?php echo  $this->outsidebarTitle( "接口管理",$sidebarTitle,"javascript:;",'fa fa-laptop');?>
					
						<ul class="sub">
						<?php
		echo $this->outSilerbarli ( $this->getPath ( "ScanInterFace.php" ), "接口查询" );
		echo $this->outSilerbarli ( $this->getPath ( "AddNewInterFace.php" ), "添加接口" );
		?>
						</ul></li>

					<li class="sub-menu"><li class="sub-menu"><?php echo  $this->outsidebarTitle( "3D彩票",$sidebarTitle,"javascript:;","fa fa-book");?>
						<ul class="sub">
							<?php
		echo $this->outSilerbarli ( $this->getPath ( "UpdateData.php" ), "更新数据" );
		echo $this->outSilerbarli ( $this->getPath ( "History3d.php" ), "历史出球" );
		echo $this->outSilerbarli ( $this->getPath ( "Predictor3D.php" ), "概率统计" );
		echo $this->outSilerbarli ( $this->getPath ( "FCOutData.php" ), "频率查询" );
		?>
						</ul></li>

					<li class="sub-menu"><a href="javascript:;"> <i class="fa fa-cogs"></i>
							<span>日志分析</span>
					</a>
						<ul class="sub">
							<li><a href=<?php echo  $this->getPath( "./logoInfo.php" );?>>日志分析</a></li>
						</ul></li>
				</ul>
				<!-- sidebar menu end-->
			</div>
		</aside>
		<?php
	}
}
;
?>
