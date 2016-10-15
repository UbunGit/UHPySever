<?PHP
    
    require_once('../Public_php/Globle_sc_fns.php');

    $jsArr = array("../../SmartHome_JS/JS/Login.js","../../SmartHome_JS/JS/Tooltips.js","../../SmartHome_JS/JS/Cookie.js");
    $cssArr = array('../../SmartHome_JS/CSS/Globle.css','../../SmartHome_JS/CSS/Login.css');
    outPutHead($jsArr,$cssArr,"登录");
    
    $userName = __getCookies('userName');
 
    echo  $userName;
  
//     if (!empty($userName)){
    	
//     	header('Location: '.$uri.'./ScanInterFace.php');
    	 
//     	return ;
//     }
    ?>
<div class="main_box">
<table class="login_Table">
<tr>
<td><input type="text"  name="username" placeholder=" Pick a username"/></td></tr>
<tr>
<td><input type="password" name="passwd" placeholder=" Pick a password"/></td></tr>
<tr>
<td colspan="2" align="center">
<button type="button" class="log" >Sign in</button></td></tr>
<tr>
<tr>
<td colspan="2" align="center">
<button type="button" class="register" >Sign up</button></td></tr>
<tr>
</table>
</div>
<?php
    outputFoot();
    ?>