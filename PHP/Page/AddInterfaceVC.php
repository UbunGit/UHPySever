<?php
/**
 * Created by IntelliJ IDEA.
 * User: UbunGit
 * Date: 2017/12/8
 * Time: 下午2:22
 */
require_once('./BaseViewController.php');

/**
 * 添加新接口信息
 */
class AddInterfaceVC extends BaseViewController
{

    function viewwillLoad()
    {
        /* 输出头部信息 */
        $this->jsArr = array(
            "AddNewInterFace.js",
            "Tooltips.js",
            "Cookie.js"
        );

        /* 输出头部信息 */
        $this->absjsArr = array();

        $this->abscssArr = array();
        $this->cssArr = array(
            'AddNewInterFace.css',
            'header.css'
        );

        $this->title = "日志分析";
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

        $this->outputInterFaceInfo_edit();
    }

    function outputInterFaceInfo_edit()
    {
        echo '<section id="main-content">';
        echo '<section class="wrapper">';
        // 接口基本信息from
        $this->outIntefaceBasicInfofrom();
        echo '</section></section>';
    }

    function outIntefaceBasicInfofrom()
    {
        ?>

        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading"> 基本信息</header>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-3 control-label"> 接口名称</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="接口名称" name="interFaceName"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">接口中文名称</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="接口中文名称" name="interFaceNameStr"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">接口路径</label>
                            <div class="col-lg-9">
                                <select class="form-control  m-bot15 " name="interFacepath">
                                    <option>interface</option>
                                    <option>samrtHome</option>
                                    <option>FCAnalyse</option>
                                </select>
                            </div>
                        </div>
                        <div class="panel-foot">
                            <ul class="summary-list">
                                <li><a href="javascript:;"> <i class="fa fa-cloud text-primary saveIneface"></i>
                                        保存
                                    </a></li>
                                <li><a href="javascript:;"> <i
                                                class="fa fa-cloud-download text-primary"></i> 导入
                                    </a></li>
                                <li><a href="javascript:;"> <i
                                                class="fa fa-cloud-upload text-primary"></i> 导出
                                    </a></li>
                            </ul>
                        </div>
                </div>
                </form>
            </section>
        </div>
        <?php
    }


}