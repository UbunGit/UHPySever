

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Mosaddek">
<meta name="keyword"
	content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<link rel="shortcut icon" href="img/favicon.png">

<title>404</title>


<!-- Bootstrap core CSS -->
<link rel="stylesheet"
	href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	
<?PHP 
require_once('../Public_php/Globle_sc_fns.php');
$config = new ConfigINI ();
$assets = $config->get ( 'URL.root_assets' );
$cssPath = $config->get ( 'URL.root_css' );

echo '
<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet"
	href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">';

echo '<link rel="stylesheet"  href=' . $assets ."font-awesome/css/font-awesome.css"  . '></link>';
echo '<link rel="stylesheet"  href=' . $cssPath . "style.css". '>';

 ?>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>




<body class="body-404">

	<div class="container">

		<section class="error-wrapper">
			<i class="icon-404"></i>
			<h1>404</h1>
			<h2>page not found</h2>
			<p class="page-404">
				Something went wrong or that page doesn’t exist yet. <a
					href="index.php">Return Home</a>
			</p>
		</section>

	</div>


</body>
</html>

