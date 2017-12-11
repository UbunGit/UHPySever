<?php
require_once('./BaseViewController.php');

class UpdateData3dVC extends BaseViewController
{

    function viewwillLoad()
    {
        /* 输出头部信息 */
        $this->jsArr = array(
            "UpdateData.js"
        );

        /* 输出头部信息 */
        $this->absjsArr = array(

            "<script src=https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.js></script>",
            '<script src=' . $this->getAssets('chart-master/Chart.js') . '></script>'
        );

        $this->abscssArr = array();
        $this->cssArr = array(
            'header.css',
            'UpdateData.css'
        );

        $this->title = "更新数据";
    }

    function getuserInfo()
    {
        $userimg = __getCookies('userImg');
        $userName = __getCookies('userName');

        $this->userInfo = array(
            "heardImg" => "fc3d.jpg",
            "userName" => $userName
        );
    }

    function viewLoadbody()
    {
        parent::viewLoadbody();

        $this->outmain();
    }


    function outmain()
    {
        ?>
        <section id="main-content">
            <section class="wrapper">

                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-md-3">
                        <section id="main_silder" class="panel">
                            <header class="panel-heading"> Category</header>
                            <div class="panel-body">
                                <ul class="nav prod-cat">
                                    <li><a class="active" href="./UpdateData.php"><i class=" fa fa-angle-right"></i>
                                            3D数据更新</a>
                                    </li>
                                    <li><a href="./RecommendOutNO.php"><i class=" fa fa-angle-right"></i> 推荐数据</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Beauty</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Coat &amp;
                                            Jacket</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Jeans</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Jewellery</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Electronics</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Sports</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Technology</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Watches</a></li>
                                    <li><a href="#"><i class=" fa fa-angle-right"></i> Accessories</a></li>
                                </ul>
                            </div>
                        </section>

                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9">
                        <section class="panel">
                            <header class="panel-heading">
                                更新福彩3D数据
                                <span class="tools pull-right">
                                <input id="btnSend" type="button" value="更新"/>
                            </span>
                            </header>
                            <div>

                            </div>
                        </section>


                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9">
                        <section class="panel">
                            <header class="panel-heading">
                                来自服务端的消息
                                <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-remove"></a>
                            </span>
                            </header>
                            <div class="panel-body">
                              <textarea id="txtContent" cols="150" rows="10" readonly="readonly"
                                        class="comments"></textarea>
                            </div>
                        </section>
                    </div>
                    <div>

            </section>
        </section>
        <?php
    }
}
?>