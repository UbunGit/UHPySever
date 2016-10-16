<?PHP
    
    require_once('../Public_php/Globle_sc_fns.php');

    $jsArr = array("Login.js","Tooltips.js","Cookie.js");
    $cssArr = array('Globle.css','Login.css');
    $outPut = new OutPut();
    $outPut->outPutHead ( $jsArr, $cssArr, "主页" );
    $outPut->outPutHead($jsArr,$cssArr,"登录");
    
    $userName = __getCookies('userName');
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
$outPut->outputFoot();
    ?>