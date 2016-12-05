<?PHP
    
    require_once('../Public_php/Globle_sc_fns.php');

    $jsArr = array("Login.js","Tooltips.js","Cookie.js");
    $cssArr = array('Globle.css','Login.css');
    $outPut = new OutPut();
    $outPut->outPutHead($cssArr,null,"登录");
    
    $userName = __getCookies('userName');
    $config= new ConfigINI();
    $imagePath = $config->get('URL.root_image');
    ?>
<img src="<?php echo $imagePath.'2.jpg' ?> " id="img" /> 
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
<td colspan="2" align="center">
<button type="button" class="register" >Sign up</button></td></tr>

</table>
</div>
<?php
$outPut->outputFoot($jsArr,null);
    ?>