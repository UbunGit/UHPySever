<?php
/**
 * Created by PhpStorm.
 * User: ubungit
 * Date: 2018/7/26
 * Time: 下午3:25
 */


class AdminController extends BaseViewController
{

    function viewwillLoad()
    {
        parent::viewwillLoad();
        /* 输出头部信息 */
        array_push($this->jsArr,"AdminController.js","Cookie.js");

        /* 输出头部信息 */
        $this->absjsArr = array();

        $this->abscssArr = array();
        $this->cssArr = array(
            'AdminController.css',
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

        $this->title = "管理员管理";
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
        $this->showAdminTable();
        echo '</section></section>';
    }

    function showAdminTable()
    {
        ?>
        <section class="panel">
            <header class="panel-heading">
                管理员列表
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">

                    <div class="btn-group">
                        <button id="admin_add_btn" class="btn green">
                            新增 <i class="fa fa-plus"></i>
                        </button>

                    </div>

                    <div class="space15"></div>

                    <table class="table table-striped table-hover table-bordered dataTable" id="admin_table"
                           aria-describedby="editable-sample_info" style="width: 100%;">
                        <thead>
                        <tr role="row">
                            <th class="sorting_disabled" >用户名</th>
                            <th class="sorting" >角色</th>
                            <th class="sorting" >手机号 </th>
                            <th class="sorting" > 状态 </th>
                            <th class="sorting_disabled"> </th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </section>
        <?php
    }

}

?>