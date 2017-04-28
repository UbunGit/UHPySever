<?php
require_once ('../../Public_php/Globle_sc_fns.php');
/* 输出头部信息 */

$cssArr = array (
		'header.css',
		'UpdateData.css'

);
$config = new ConfigINI ();
$cssabsArr = array (
// 		$config->get ( 'URL.root_assets'. 'bootstrap-datetimepicker/css/datetimepicker.css')
);
$outPut = new OutPut ();
$jsArr = array (
		"UpdateData.js"
);
$jsabsArr = array (
		$outPut->getScriptStr($config->get ( 'URL.root_assets' ).'chart-master/Chart.js'),
		"<script src=https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.js></script>"

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
$outPut->outSider ("3D彩票");
outmain ();
$outPut->outputFoot ( $jsArr, $jsabsArr );

function outmain() {
	?>
<section id="main-content">
<section class="wrapper">
<section class="panel">
 <div id="login">
        
        <div>
            <input id="sendText" type="text" placeholder="发送文本" value="更新数据" />
            <input id="btnSend"  type="button" value="发送" onclick="send()" />
        </div>
        <div>
            <div>
                来自服务端的消息
            </div>
            <textarea id="txtContent" cols="150" rows="10" readonly="readonly" class="comments"></textarea>
        </div>
    </div>

</section>          
</section>
</section>
<?php
}
?>