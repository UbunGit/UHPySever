<?php
   /*
    * 输出头信息
    */ 
    function outPutHead($jsarr,$cssarr,$headStr){
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
    /*
     * 输出底部
     */
    function outputFoot(){
        echo '</body>';
        echo '</html>';
    }
    /*
     * 输出导航栏
     */
    function  outputNav($userimg){
 
    	echo '<div id="navfirst">
    			 <ul id="head">	
    			  <li><img class="userInfo" src="'.$userimg.'"/></li>
              </ul>
              <ul id="menu">	
              <li><a class="menuNav" src="./ScanInterFace.php">接口查询</a></li>
    		      <li><a class="menuNav" href="./TestInterFace.php">接口测试</a></li>
              <li><a class="menuNav" href="./MemberManagement.php">会员管理</a></li>
              </ul>
              </div>';
    }
    
    /**
     *  输出左侧边栏
     */
    function  outputLeftNav($navArr){
    	 
    	echo '<div class="leftNav">
			  <ul>';
    	if (! empty ( $navArr )){
        	foreach ( $navArr as $value ) {
        		echo ('<li><a class="leftNavMenu" >'. $value .' </a> </li>');
        	}
        };
      echo '</ul>
            </div>';
    }
    
    /**
     * 输出<tr><td>
     */
   function outPutTable_tr($key,$value){
    	echo '<tr>
    			<td>'.$key.'</td>
    			<td>'.$value.'</td>
    		  </tr>';
    }

?>