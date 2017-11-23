<?php
require_once ('../Public_php/Globle_sc_fns.php');

abstract class ViewController{
	
	public $jsArr; 
	public $cssArr;
	public $abscssArr;
	public $absjsArr;
	public $title;
	
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
		
		$this->viewwillLoad();
		$this->viewLoadhead();
		$this->viewLoadcss();
		$this->viewLoadbody();
		$this->viewLoadjs();
		$this->viewLoadfoot();
		
	}
	abstract public function viewwillLoad();
	
	
	function getPath($file) {

		return $file;
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
	
	function viewLoadhead() {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $this->title; ?></title>
<meta name="viewport"
	content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=no">
<?php
	}

	function viewLoadcss(){
?>
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
		
		if (! empty ( $this->cssArr )) {
			foreach ( $this->cssArr as $value ) {
				echo ('<link rel="stylesheet" type="text/css" media="screen" href="' . $this->getCSS ( $value ) . '"/>');
			}
		}
		if (! empty ( $this->abscssArr )) {
			foreach ( $this->abscssArr as $value ) {
				echo ('<link rel="stylesheet" type="text/css" media="screen" href="' . $value . '"/>');
			}
		}

	}
	function viewLoadbody(){
		echo "</head>";
		echo "<body>";
	}


function viewLoadjs() {
	
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
	
	if (! empty ( $this->absjsArr )) {
		foreach ( $this->absjsArr as $value ) {
			echo ($value);
		}
	}
	
	if (! empty ( $this->jsArr )) {
		foreach ( $this->jsArr as $value ) {
			echo ('<script charset="UTF-8" src="' . $this->getjs ( $value ) . '"></script>');
		}
	}
	?>
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
          $('select.styled').customSelect();
      });				
</script>
<?php
	
}
function viewLoadfoot (){
	echo '</body>';
	echo '</html>';
}
}
?>