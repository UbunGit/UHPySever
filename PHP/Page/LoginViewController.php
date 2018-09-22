<?PHP
require_once('../UIKit/UIKit.php');
class LoginViewController extends ViewController {
	function viewwillLoad() {
		/* 输出头部信息 */
		$this->jsArr = array (
				"Login.js",
				"Tooltips.js",
				"Cookie.js" 
		);
		
		/* 输出头部信息 */
		$this->absjsArr = array ();
		
		$this->abscssArr = array ();
		$this->cssArr = array (
				'Login.css' 
		);
		
		$this->title = "登陆";
		$this->outMain ();
	}
	function outMain() {

		?>

<div class="main_box">
	<table class="login_Table">
		<tr>
			<td><input type="text" name="username" placeholder=<?php echo __getText("RegisterController.input your user name","请输入你的用户名")?> /></td>
		</tr>
		<tr>
			<td><input type="password" name="passwd"
				placeholder=" Pick a password" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button type="button" class="log">Sign in</button>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button type="button" class="register">Sign up</button>
			</td>
		</tr>

	</table>
</div>
<?PHP
}
    
 }
?>