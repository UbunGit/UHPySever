<?php
/**
 * Created by PhpStorm.
 * User: ubungit
 * Date: 2018/8/23
 * Time: 下午3:34
 */


class GoodsListController extends BaseViewController
{

    function viewwillLoad()
    {
        parent::viewwillLoad();
        /* 输出头部信息 */
        array_push($this->jsArr, "GoodsListController.js", "Cookie.js");

        /* 输出头部信息 */
        $this->absjsArr = array();

        $this->abscssArr = array();
        $this->cssArr = array(
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

        $this->title = "添加商品";
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
        $this->showaddGoods();
        echo '</section></section>';
    }

    function showaddGoods()
    {
        ?>
        <section class="panel">
            <div class="panel-body input-group">
                <input type="text" placeholder="Keyword Search" class="form-control">
                <div class="input-group-btn">
                    <button tabindex="-1" class="btn btn-white" type="button">搜索</button>
                    <button tabindex="-1" class="btn btn-info add-btn" type="button">新增</button>
                </div>
            </div>
        </section>
        <section class="panel panel-info" >

            <div class="row product-list" style="background:#F3F3F3" id="goodsListSection"> </div>


        </section>
        <?php
    }
}
