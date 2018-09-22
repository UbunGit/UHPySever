<?php
/**
 * Created by PhpStorm.
 * User: ubungit
 * Date: 2018/8/2
 * Time: 下午5:15
 */

class AdminEditController extends BaseViewController
{
    function viewwillLoad()
    {
        parent::viewwillLoad();
        /* 输出头部信息 */
        array_push($this->jsArr, "AdminEditController.js", "Cookie.js");

        /* 输出头部信息 */
        $this->absjsArr = array();

        $this->abscssArr = array();
        $this->cssArr = array(
            'AdminEditController.css',
            'header.css'
        );

        $this->abscssArr = array(
            "http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css",
            "http://cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css"

        );
        $this->absjsArr = array(
            '<script src="../JS/jquery/jquery-migrate-1.2.1.min.js"></script>,
         <!-- DataTables -->
       <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>,
       <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js"></script>'
        );

        $this->title = "会员信息管理";
    }

    function getuserInfo()
    {
        $userimg = __getCookies('headImage');
        $userName = __getCookies('userName');

        $this->userInfo = array(
            "heardImg" => $userimg,
            "userName" => $userName
        );
    }

    function viewLoadbody()
    {
        parent::viewLoadbody();
        echo '<section id="main-content">';
        echo '<section class="wrapper">';
        $this->showAdim_Edit();
        echo '</section></section>';
    }

    function showAdim_Edit()
    {
        ?>

        <section class="panel panel-info">
            <div class="panel-heading">
                基本信息
                <span class="pull-right">
                  <a href="javascript:;" id='a-save'>保存 </a>
                </span>

            </div>

            <div class="panel-body bio-graph-info">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label class="col-lg-2 control-label">用户名</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="input-adminName" placeholder=" "
                                   name="username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">手机号码</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="input-phone" placeholder=" " name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">邮箱地址</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="input-email" placeholder=" " name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">安全管理</label>
                        <div class="checkbox col-lg-6">
                                <input type="radio" name="radio-resetPassword" id="radio-reset" value="-2"> 重置密码
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">权限管理</label>
                        <div class="col-lg-6">
                            <ul class="summary-list">
                                <li>
                                    <a href="javascript:;">
                                        <i class="text-primary fa fa-user-plus">管理员</i>
                                        <input name="input-permissions" id="checkbox-admin" value="3" type="checkbox"
                                        >
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="text-info fa fa-linux">技术</i>
                                        <input name="input-permissions" id="checkbox-coder" value="2" type="checkbox">
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:;" onclick="">
                                        <i class=".text-info fa fa-user-md">运营</i>
                                        <input name="input-permissions" id="checkbox-operator" value="1"
                                               type="checkbox">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="text-success fa fa-user">用户</i>
                                        <input name="input-permissions" id="checkbox-user" value="0" type="checkbox">
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">禁用限制</label>
                        <div class="checkbox col-lg-6">
                        <input type="radio" name="radio-status" id="radio-defual" value="0"> 解禁&nbsp&nbsp
                        <input type="radio" name="radio-status" id="radio-stop" value="-1"> 禁用&nbsp&nbsp
                        </div>
                    </div>
                </form>
            </div>


        </section>
        <?php
    }

}

?>