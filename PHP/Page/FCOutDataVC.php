<?php


require_once('./BaseViewController.php');

class FCOutDataVC extends BaseViewController
{

    function viewwillLoad()
    {
        /* 输出头部信息 */
        $this->jsArr = array(
            "FCOutData.js"
        );

        /* 输出头部信息 */
        $this->absjsArr = array(

            '<script src=' . $this->getAssets('chart-master/Chart.js') . '></script>'
        );

        $this->abscssArr = array();
        $this->cssArr = array(
            'header.css',
            'FCOutData.css'
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
                    <header class="panel-heading">出球频率
                        <ul class="nav outData top-menu col-lg-2">
                            <li class="outdataNum">当期出球 个：10 十：0 百：9
                            </li>
                        </ul>
                        <ul class="nav pull-right top-menu">
                            <li>
                                <div class="col-lg-1 ">
                                    <input id="prewDate" type="button"
                                           value="Prew" size="16">
                                </div>
                            </li>
                            <li>
                                <div class="col-lg-1 ">
                                    <i class="fa fa-calendar"></i> <input id="outDate" type="text"
                                                                          value="2016-11-8" size="16">
                                </div>
                            </li>
                            <li>
                                <div class="col-lg-1 ">
                                    <input id=nextDate type="button"
                                           value="Next" size="16">
                                </div>
                            </li>
                            <li><select class="form-control col-lg-1 frequency_outType"
                                        size="1">
                                    <option value="1001" selected="selected">个位</option>
                                    <option value="1002">十位</option>
                                    <option value="1003">百位</option>

                                </select></li>

                        </ul>
                    </header>
                    <div class="frequency">
                        <table id="frequencyTable"
                               class="table table-striped table-hover table-bordered dataTable">
                            <thead className="cf">
                            <tr>
                                <th class="outNum">频率</th>
                                <th class="outNum">0</th>
                                <th class="outNum">1</th>
                                <th class="outNum">2</th>
                                <th class="outNum">3</th>
                                <th class="outNum">4</th>
                                <th class="outNum">5</th>
                                <th class="outNum">6</th>
                                <th class="outNum">7</th>
                                <th class="outNum">8</th>
                                <th class="outNum">9</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </section>
                <section class="panel">
                    <header class="panel-heading">设置比重
                    </header>
                    <div class="FC3DDataBalance">
                        <table id="FC3DDataBalanceTable"
                               class="table table-striped table-hover table-bordered dataTable">
                        </table>
                    </div>
                </section>
            </section>
        </section>
        <?php
    }
}
?>