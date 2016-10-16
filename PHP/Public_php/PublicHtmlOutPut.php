<?php
class Output {
	private  $imagePath;
	private  $jsPath;
	private  $cssPath;
	function __construct() {
		$config= new ConfigINI();
		$this->imagePath = $config->get('URL.root_image');
		$this->jsPath = $config->get('URL.root_js');
		$this->cssPath = $config->get('URL.root_css');
	}
	function getImage($imageFile){
		return $this->imagePath.$imageFile;
	}
	function getjs($jsFile){
		return $this->jsPath.$jsFile;
	}
	function getCSS($cssFile){
		$path = $this->cssPath.$cssFile;
		return $path;
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
 		echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
 		';
 		echo ' <!--external css-->';
 		
        echo '<link rel="stylesheet"  href='.$this->getCSS("assets/font-awesome/css/font-awesome.css").'></link>';
        echo '<link rel="stylesheet"  href="'.$this->getCSS("assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css").'">';
 		
 		echo '<link rel="stylesheet"  href='.$this->getCSS("bootstrap-reset.css").'>';
 		echo '<link rel="stylesheet"  href='.$this->getCSS("bootstrap.min.css").'>';
 		echo '<link rel="stylesheet"  href='.$this->getCSS("slidebars.css").'>';
 		echo '<link rel="stylesheet"  href='.$this->getCSS("style.css").'>';
 		echo '<link rel="stylesheet"  href='.$this->getCSS("style-responsive.css").'>';
 		
 		if (! empty ( $cssarr )) {
 			foreach ( $cssarr as $value ) {
 				echo ('<link rel="stylesheet" type="text/css" media="screen" href="' .$this->getCSS ($value ). '"/>');
 			}
 		}
 		echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" ></script>';
 		echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"></script>';
 		echo'<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" ></script>';

 		echo '<script src='.$this->getCSS("assets/jquery-ui/jquery-ui-1.10.1.custom.min.js"). ' type="text/javascript"></script>';
 		echo '<script src='.$this->getCSS("assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js").' type="text/javascript"></script>';
		echo '<script class="include" src=' .$this->getjs("jquery/jquery.dcjqaccordion.2.7.js"). ' type="text/javascript"></script>';
		echo '<script src=' .$this->getjs("jquery/jquery.sparkline.js"). ' type="text/javascript"></script>';
		echo '<script src=' .$this->getjs("jquery/jquery.nicescroll.js"). ' type="text/javascript"></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.customSelect.min.js"). ' type="text/javascript"></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.js"). '></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.pulsate.min.js"). ' type="text/javascript"></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.scrollTo.min.js"). ' type="text/javascript"></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.steps.min.js"). ' type="text/javascript"></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.stepy.js"). ' type="text/javascript"></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.tagsinput.js"). ' type="text/javascript"></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.ui.touch-punch.min.js"). ' type="text/javascript"></script>';
// 		echo '<script src=' .$this->getjs("jquery/jquery.validate.min.js"). ' type="text/javascript"></script>';
		echo '<script src=' .$this->getjs("slidebars.min.js"). '></script>';
		echo '<script src=' .$this->getjs("common-scripts.js"). '></script>';
		echo '<script src=' .$this->getjs("respond.min.js"). '></script>';
		echo '<script src=' .$this->getjs("sliders.js"). '></script>';
		echo '<script src=' .$this->getjs("count.js"). '></script>';
		echo '<script src=' .$this->getjs("owl.carousel.js"). '></script>';
		echo '<script src=' .$this->getjs("sparkline-chart.js"). '></script>';
		echo '<script src=' .$this->getjs("easy-pie-chart.js"). '></script>';

		if (! empty ( $jsarr )) {
			foreach ( $jsarr as $value ) {
				echo ('<script src="' .$this->getjs($value). '"></script>');
			}
		}
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
            	<a href="index.php" class="logo">Ubun<span>Hub</span></a>
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
                            <li><a href="Login.php"><i class="fa fa-key"></i> 注销</a></li>
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
	function outSider(){
		echo '<!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="#">
                          <i class="fa fa-home"></i>
                          <span>主页</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-laptop"></i>
                          <span>Layouts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="boxed_page.html">Boxed Page</a></li>
                          <li><a  href="horizontal_menu.html">Horizontal Menu</a></li>
                          <li><a  href="header-color.html">Different Color Top bar</a></li>
                          <li><a  href="mega_menu.html">Mega Menu</a></li>
                          <li><a  href="language_switch_bar.html">Language Switch Bar</a></li>
                          <li><a  href="email_template.html" target="_blank">Email Template</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>UI Elements</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="modal.html">Modal</a></li>
                          <li><a  href="toastr.html">Toastr Notifications</a></li>
                          <li><a  href="widget.html">Widget</a></li>
                          <li><a  href="slider.html">Slider</a></li>
                          <li><a  href="nestable.html">Nestable</a></li>
                          <li><a  href="font_awesome.html">Font Awesome</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Components</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="grids.html">Grids</a></li>
                          <li><a  href="calendar.html">Calendar</a></li>
                          <li><a  href="gallery.html">Gallery</a></li>
                          <li><a  href="todo_list.html">Todo List</a></li>
                          <li><a  href="draggable_portlet.html">Draggable Portlet</a></li>
                          <li><a  href="tree.html">Tree View</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Form Stuff</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="form_component.html">Form Components</a></li>
                          <li><a  href="advanced_form_components.html">Advanced Components</a></li>
                          <li><a  href="form_wizard.html">Form Wizard</a></li>
                          <li><a  href="form_validation.html">Form Validation</a></li>
                          <li><a  href="dropzone.html">Dropzone File Upload</a></li>
                          <li><a  href="inline_editor.html">Inline Editor</a></li>
                          <li><a  href="image_cropping.html">Image Cropping</a></li>
                          <li><a  href="file_upload.html">Multiple File Upload</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                          <li><a  href="dynamic_table.html">Dynamic Table</a></li>
                          <li><a  href="editable_table.html">Editable Table</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-envelope"></i>
                          <span>Mail</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="inbox.html">Inbox</a></li>
                          <li><a  href="inbox_details.html">Inbox Details</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                          <li><a  href="flot_chart.html">Flot Charts</a></li>
                          <li><a  href="xchart.html">xChart</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-shopping-cart"></i>
                          <span>Shop</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="product_list.html">List View</a></li>
                          <li><a  href="product_details.html">Details View</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="google_maps.html" >
                          <i class="fa fa-map-marker"></i>
                          <span>Google Maps </span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="fa fa-comments-o"></i>
                          <span>Chat Room</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="lobby.html">Lobby</a></li>
                          <li><a  href="chat_room.html"> Chat Room</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-glass"></i>
                          <span>Extra</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="blank.html">Blank Page</a></li>
                          <li><a  href="sidebar_closed.html">Sidebar Closed</a></li>
                          <li><a  href="people_directory.html">People Directory</a></li>
                          <li><a  href="coming_soon.html">Coming Soon</a></li>
                          <li><a  href="lock_screen.html">Lock Screen</a></li>
                          <li><a  href="profile.html">Profile</a></li>
                          <li><a  href="invoice.html">Invoice</a></li>
                          <li><a  href="project_list.html">Project List</a></li>
                          <li><a  href="project_details.html">Project Details</a></li>
                          <li><a  href="search_result.html">Search Result</a></li>
                          <li><a  href="pricing_table.html">Pricing Table</a></li>
                          <li><a  href="faq.html">FAQ</a></li>
                          <li><a  href="fb_wall.html">FB Wall</a></li>
                          <li><a  href="404.html">404 Error</a></li>
                          <li><a  href="500.html">500 Error</a></li>
                      </ul>
                  </li>
                  <li>
                      <a  href="login.html">
                          <i class="fa fa-user"></i>
                          <span>Login Page</span>
                      </a>
                  </li>

                  <!--multi level menu start-->
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-sitemap"></i>
                          <span>Multi level Menu</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="javascript:;">Menu Item 1</a></li>
                          <li class="sub-menu">
                              <a  href="boxed_page.html">Menu Item 2</a>
                              <ul class="sub">
                                  <li><a  href="javascript:;">Menu Item 2.1</a></li>
                                  <li class="sub-menu">
                                      <a  href="javascript:;">Menu Item 3</a>
                                      <ul class="sub">
                                          <li><a  href="javascript:;">Menu Item 3.1</a></li>
                                          <li><a  href="javascript:;">Menu Item 3.2</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <!--multi level menu end-->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
	';
	}
}
;
?>