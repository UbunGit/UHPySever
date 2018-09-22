<?php
require_once ('./BaseViewController.php');

class RegisterController extends ViewController {
    function viewwillLoad() {
        /* 输出头部信息 */
        $this->jsArr = array (
            "register.js",
            "Tooltips.js",
            "Cookie.js"
        );

        /* 输出头部信息 */
        $this->absjsArr = array ();

        $this->abscssArr = array ();
        $this->cssArr = array (
            'register.css'
        );

        $this->title = "注册";
        $this->echoRegister ();
    }
	function echoRegister()
    {
        $config = new ConfigINI('path');
        $imagePath = $config->get('URL.root_image');
        ?>
        <div class="main_box">
            <table class="Register_Table">

                <tr>
                    <td><input type="text" name="username" placeholder=<?php echo __getText("RegisterController.input your user name","请输入你的用户名")?> /></td>
                </tr>

                <tr>
                    <td><input type="text" name="telNO" placeholder=<?php echo __getText("RegisterController.input your user phone NO","请输入你的手机号码")?> /></td>
                </tr>
                <tr>
                    <td><input type="password" name="passwd" placeholder= <?php echo __getText("RegisterController.input your user passwd","请设置你的密码")?> /></td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <button type="button" class="register"><?php echo __getText("RegisterController.register","注册")?></button>
                    </td>
                </tr>
                <tr>
            </table>
        </div>
        <?php
    }

}


?>
