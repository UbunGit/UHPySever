
<?PHP

require_once('../Public_php/Globle_sc_fns.php');

$jsArr = array("../../SmartHome_JS/JS/Register.js","../../SmartHome_JS/JS/Tooltips.js","../../SmartHome_JS/JS/Cookie.js");
$cssArr = array('../../SmartHome_JS/CSS/Register.css');
outPutHead($jsArr,$cssArr,"注册");
?>
<div class="main_box">
<table class="Register_Table">
<tr>
<td>用户名:</td>
<td><input type="text"  name="username"/></td></tr>
<tr>
<td>手机号码:</td>
<td><input type="text" name="telNO"/></td></tr>
<tr>
<td>密码:</td>
<td><input type="password" name="passwd"/></td></tr>
<tr>
<tr>
<td colspan="2" align="center">
<button type="button" class="register">注册</button></td></tr>
<tr>
</table>
</div>
<?php
    outputFoot();
    ?>
