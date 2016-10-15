<?php
class FCOutPutPage{
	/**
	 * 输出头
	 * @param unknown $jsarr
	 * @param unknown $cssarr
	 * @param unknown $headStr
	 */
	function  outPutHead($jsarr,$cssarr,$headStr){
		echo  '<!DOCTYPE html>';
		echo '<html>';
		echo '<head>';
		echo '<title>'.$headStr.'</title>';
		echo '<meta charset="UTF-8"/>';
		echo '<meta
        		name="viewport"
        		content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>';
		echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
		if (! empty ( $jsarr )) {
			foreach ( $jsarr as $value ) {
				echo ('<script src="' . $value . '"></script>');
			}
		}
		
		if (! empty ( $cssarr )){
			foreach ( $cssarr as $value ) {
				echo ('<link rel="stylesheet" type="text/css" media="screen" href="' . $value . '"/>');
			}
		}
		echo '</head>';
		echo '<body>';
	}
	
	/**
	 * 输出tabbar
	 */
	function  outPutTabBar(){
		echo '
				<table class="tabBar">
				<tr>
				<td><a class="page" href="./FC3D/FCOutData.php">开奖公告</a></td>
  				<td><a class="page" href="./TestInterFace.php">开奖预测</a></td>
            		<td><a class="page" href="./MemberManagement.php">开奖推荐</a></td>
				<td><a class="page" href="./MemberManagement.php">我的彩票</a></td>
				</tr>
				</table>
				';
	}
	
	/*
	 * 输出底部
	 */
	function outputFoot(){
		echo '</body>';
		echo '</html>';
	}
	
}
?>