<?php

require_once('./BaseViewController.php');

class History3dVC extends BaseViewController
{
    public $pageNum;
    function viewwillLoad()
    {
        /* 输出头部信息 */
        $this->jsArr = array(
            "History3d.js"
        );

        /* 输出头部信息 */
        $this->absjsArr = array(
            '<script src=' . $this->getAssets("bootstrap-datetimepicker/css/datetimepicker.css") . '></script>'
        );

        $this->abscssArr = array(
            $this->getAssets("bootstrap-datetimepicker/css/datetimepicker.css")
        );
        $this->cssArr = array(
            'header.css',
            'History3d.css'
        );

        $this->title = "3D历史数据";
        $this->pageNum = isset ( $_GET ["pageNum"] ) ? $_GET ['pageNum'] : 1;
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
                    <header class="panel-heading">3d历史出球</header>
                    <div class="panel-body">
                        <section id="no-more-tables"></section>
                        <table class="table table-striped table-hover table-bordered dataTable"
                        >
                            <thead className="cf">
                            <tr>
                                <th class="outType selectType" colSpan="4">个位</th>
                                <th class="outType" colSpan="4">十位</th>
                                <th class="outType" colSpan="4">百位</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="dataTables_info" id="dynamic-table_info">Showing 1 to 10 of 10 entries</div>
                            </div>
                            <div class="span6">
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                    <ul>

                                        <?php

                                        $begin = ($this->pageNum-5>0)?$this->pageNum-5:1;

                                        for ($x=$begin; $x <= $begin+9; $x++ ){
                                            if ($x == $this->pageNum){
                                                echo '<li><a class="pageNum-a">'.$x.'</a></li>';
                                            }else{
                                                echo '<li  class="active"><a class="pageNum-a">'.$x.'</a></li>';
                                            }
                                        }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </section>
        </section>
        <?php
    }
}
?>
