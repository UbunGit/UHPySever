<?php
require_once('./BaseViewController.php');

class Predictor3DVC extends BaseViewController
{

    function viewwillLoad()
    {
        /* 输出头部信息 */
        $this->jsArr = array(
            "Predictor3D.js"
        );

        /* 输出头部信息 */
        $this->absjsArr = array(

            '<script src=' . $this->getAssets('chart-master/Chart.js') . '></script>'
        );

        $this->abscssArr = array();
        $this->cssArr = array(
            'header.css',
            'Predictor3D.css'
        );

        $this->title = "频率统计";
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
                <section class="panel">
                    <header class="panel-heading">
                        频率统计
                        <ul class="nav pull-right top-menu">

                            <li>
                                <div class="col-lg-1">
                                    <i class="fa fa-calendar"></i> <input id="begindate" type="text"
                                                                          value="2002-01-01" size="16">
                                </div>
                            </li>
                            <li>
                                <div class="col-lg-1">
                                    <i class="fa fa-calendar"></i> <input id="enddate" type="text"
                                                                          value="2016-11-8" size="16">
                                </div>
                            </li>
                            <li><select class="form-control probabilityCount col-lg-1" size="1">
                                    <option value="5" selected="selected">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select></li>
                        </ul>

                    </header>
                    <div class="panel-body text-center">
                        <canvas id="bar"></canvas>
                    </div>
                </section>
            </section>
        </section>
        <?php
    }
}
?>