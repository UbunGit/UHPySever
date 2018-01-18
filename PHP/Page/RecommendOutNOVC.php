<?php
require_once('./BaseViewController.php');

class RecommendOutNOVC extends BaseViewController
{

    function viewwillLoad()
    {
        /* 输出头部信息 */
        $this->jsArr = array(
            "RecommendOutNO.js"
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

                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-md-3">
                        <section id="main_silder" class="panel">
                            <header class="panel-heading"> Category</header>
                            <div class="panel-body">
                                <ul class="nav prod-cat">
                                    <?php echo self::outSilerbarli("UpdateData3dVC", "更新数据"); ?>
                                    <?php echo self::outSilerbarli("RecommendOutNOVC", "推荐数据"); ?>

                                </ul>
                            </div>
                        </section>

                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9">
                        <div class="row">

                            <div class="col-lg-9 col-sm-9 col-md-9">
                                <section class="panel">
                                    <header class="panel-heading">
                                        来自服务端的消息 <span class="tools pull-right"> <input id="btnSend"
                                                                                        type="button" value="开始"/></span>
                                    </header>
                                    <div class="panel-body">
						<textarea id="txtContent" cols="150" rows="10" readonly="readonly"
                                  class="comments"></textarea>
                                    </div>
                                </section>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-md-3">
                                <section class="panel">
                                    <header class="panel-heading">
                                        正确率评估<span class="tools pull-right">  </span>
                                    </header>

                                    <div class="chart">
                                        <div class="pie-chart" data-percent="50"
                                             style="width: 135px; height: 135px; line-height: 135px;">
                                            <span>50</span>%

                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>
                    </div>

            </section>
        </section>
        <?php
    }
}

?>