<?php
/**
 * Created by PhpStorm.
 * User: ubungit
 * Date: 2018/8/23
 * Time: 下午1:11
 */

class AddGoodsController extends BaseViewController
{

    function viewwillLoad()
    {
        parent::viewwillLoad();
        /* 输出头部信息 */
        array_push($this->jsArr, "AddGoodsController.js", "Cookie.js");

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
        <div class="panel panel-info">
            <div class="panel-heading">
                商品信息
                <span class="pull-right">
                  <a href="javascript:;" class='save goods-info-a'>保存 </a>
                </span>
            </div>
         <section class="panel">
            <div class="panel-heading">
                基本信息
            </div>

            <div class="panel-body bio-graph-info">
                <form class="form-horizontal goodsinfo_from">

                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品名称</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="text_goodsName" placeholder=" "
                                   name="goodsName">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品类别</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="text_goodsType" placeholder=" "
                                   name="goodsType">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品库存</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="text_goodsReserve" placeholder=" "
                                   name="goodsReserve">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品编号</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="text_goodsNO" placeholder=" "
                                   name="goodsNO">
                        </div>
                    </div>

                </form>
            </div>


        </section>

        <section class="panel">
            <div class="panel-heading">
                价格信息
            </div>

            <div class="panel-body bio-graph-info">
                <form class="form-horizontal goodsinfo_from">

                    <div class="form-group">
                        <label class="col-lg-2 control-label">商品成本价</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="text_goodsCostPrice" placeholder=" "
                                   name="goodsCostPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">预售价</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="text_goodsPrice" placeholder=" " name="goodsPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">折扣</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="text_goodsDiscount" placeholder=" " name="goodsDiscount">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">最低价</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="text_goodsMinPrice" placeholder=" " name="goodsMinPrice">
                        </div>
                    </div>

                </form>
            </div>
        </section>

        <section class="panel">
            <div class="panel-heading">
                图片信息
            </div>

            <div class="panel-body bio-graph-info">
                <div class="pro-img-list">
                    <div class="col-lg-6">

                        <a>
                            <input type="file" name="file" id="input_file" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" onchange="imgPreview(this) " style="display: none">
                            <img src="" alt="" onclick="$('input[id=input_file]').click();" style="height: 52px; width:52px;">
                        </a>
                        <a href="#">
                            <input type="file" name="file" id="input_file" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" onchange="imgPreview(this) " style="display: none">
                            <img src="" alt="" onclick="$('input[id=input_file]').click();" style="height: 52px; width:52px">
                        </a>
                        <a href="#">
                            <input type="file" name="file" id="input_file" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" onchange="imgPreview(this) " style="display: none">
                            <img src="" alt="" onclick="$('input[id=input_file]').click();" style="height: 52px; width:52px">
                        </a>
                        <a href="#">
                            <input type="file" name="file" id="input_file" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" onchange="imgPreview(this) " style="display: none">
                            <img src="" alt="" onclick="$('input[id=input_file]').click();" style="height: 52px; width:52px">
                        </a>
                    </div>
                </div>
            </div>

        </section>
        </div>
        <?php
    }
}