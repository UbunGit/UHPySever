<?php
require_once ('../../Public_php/Globle_sc_fns.php');
/* 输出头部信息 */

$cssArr = array (
		'header.css',
		'History3d.css'

);
$config = new ConfigINI ();
$cssabsArr = array (
// 		$config->get ( 'URL.root_assets'. 'bootstrap-datetimepicker/css/datetimepicker.css')
);
$outPut = new OutPut ();
$jsArr = array (
		"History3d.js"
);
$jsabsArr = array (
		$outPut->getScriptStr($config->get ( 'URL.root_assets' ).'chart-master/Chart.js'),

);


/* 输出顶部导航 */
$userimg = __getCookies ( 'userImg' );
$userName = __getCookies ( 'userName' );
$userInfo = array (
		"heardImg" => "fc3d.jpg",
		"userName" => $userName
);

$outPut = new OutPut ();
$outPut->outPutHead ( $cssArr, $cssabsArr, "历史出球" );
$outPut->outPutHeader ( $userInfo );
$outPut->outSider ();
outmain ();
$outPut->outputFoot ( $jsArr, $jsabsArr );
function outmain() {
	?>
<section id="main-content">
<section class="wrapper">
<section class="panel">
        <header class="panel-heading">3d历史出球</header>
         <div class="panel-body">
          <section id="no-more-tables"></section>
          <table class="table table-striped table-hover table-bordered dataTable"
						>
          <thead className="cf">
         <tr>	
          	<th class="outType selectType" colSpan="3">个位</th>	
          	<th class="outType" colSpan="4">十位</th>	
          	<th class="outType" colSpan="4">百位</th>	
		</tr>
          </thead>
          </table>
          <div class="row-fluid">
          <div class="span6">
          <div class="dataTables_info" id="dynamic-table_info">Showing 1 to 10 of 10 entries</div>
          </div>
          <div class="span6">
          <div class="dataTables_paginate paging_bootstrap pagination">
          <ul>
          <li class="prev disabled">
          <a href="#">← Previous</a>
          </li>
          <li class="active"><a href="#">1</a> </li>
          <li><a href="#">2</a> </li>
       
          <li class="next"><a href="#">Next → </a></li>
          </ul>
          </div>
          </div>
          </div>
         </div>
</section>
            
</section>
</section>
<?php
}

?>
