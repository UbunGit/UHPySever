
<?PHP

require_once('../Public_php/Globle_sc_fns.php');

$jsArr = array("Register.js","Tooltips.js","Cookie.js");
$cssArr = array('Register.css');
$outPut = new OutPut();
echoRegister();
$outPut->outPutHead($jsArr,$cssArr,"注册");

$outPut-> outputFoot();
function echoRegister(){
	$config= new ConfigINI();
	$imagePath = $config->get('URL.root_image');
	?>
	<img src="<?php echo $imagePath.'2.jpg' ?> " id="img" /> 
	<div class="main_box">
	<table class="Register_Table">
	
	<tr>
	<td><input type="text"  name="username" placeholder=" Pick a username"/></td>
	</tr>
	
	<tr>
	<td><input type="text" name="telNO" placeholder=" Pick a phoneNO"/></td>
	</tr>
	<tr>
	<td><input type="password" name="passwd" placeholder=" Pick a passwd"/></td>
	</tr>
	
	<tr>
	<td colspan="2" align="center">
	<button type="button" class="register">注册</button></td></tr>
	<tr>
	</table>
	</div>
	<?php
	
}
?>
