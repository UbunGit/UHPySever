<?php
require_once('../UIKit/UIKit.php');

abstract class BaseViewController extends ViewController
{

    public $userInfo;
    public $className;

    function viewwillLoad()
    {
        /* 输出头部信息 */
        $this->jsArr = array(
            "BaseViewController.js",
            "Cookie.js"
        );
        $this->cssArr = array();
        $this->abscssArr = array();
        $this->absjsArr = array();
    }

    abstract public function getuserInfo();


    function viewLoadbody()
    {
        parent::viewLoadbody();
        $this->getuserInfo();
        echo '<section id="container">';
        $this->bodyLoadHead();

        $this->className = __get("className");
        $this->bodyLoadleftBar();
    }

    /**
     * 输出siderbar li
     */
    public function outSilerbarli($path, $text)
    {

        $url = './index.php?className=' . $path;
        if (strcmp($path, $this->className) == 0) {

            return '<li class="active"><a href=' . $url . '>' . $text . '</a></li>';
        } else {
            return '<li ><a href=' . $url . '>' . $text . '</a></li>';
        }
    }

    function bodyLoadHead()
    {
        ?>
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips"></div>
            </div>
            <!--logo start-->
            <a href="index.php" class="logo">Ubun<span>Hub</span></a>
            <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li><input type="text" class="form-control search"
                               placeholder="Search"></li>
                    <!-- user login dropdown start-->
                    <li class="dropdown"><a data-toggle="dropdown"
                                            class="dropdown-toggle" href="#"> <img alt=""
                                                                                   src=<?php echo $this->userInfo['heardImg']; ?>>
                            <span
                                    class="username"><?php echo $this->userInfo['userName']; ?> </span> <b
                                    class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" fa fa-suitcase"></i><?php echo __getText("BaseViewController.profile","个人信息"); ?></a></li>
                            <li><a href="#"><i class="fa fa-cog "></i> <?php echo __getText("BaseViewController.settings","设置"); ?></a></li>
                            <li><a href="#"><i class="fa fa-bell-o"></i> <?php echo __getText("BaseViewController.notification","通知"); ?></a></li>
                            <li><a class="logout-a"><i class="fa fa-key logout" ></i> <?php  echo __getText("BaseViewController.logout","注销"); ?></a></li>
                        </ul>
                    </li>
                    <li class="sb-toggle-right"><i class="fa  fa-align-right"></i></li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>

        </header>
        <?php
    }

    function bodyLoadleftBar()
    {
        ?>
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <?php
                    foreach ($this->getleftbarData() as $key => $value) {
                        if (empty($value["item"])) {
                            echo '<li >' . '<a ><i class="' . $value["faname"] . '"></i> <span>' . $key . '</span> </a><ul>';
                        } else {



                            $ishas = false;
                            $ullistStr  =  '';
                            foreach ($value["item"] as $itemkey => $itemValue) {

                                if (strcmp($itemkey, $this->className) == 0) {
                                    $ishas = true;
                                }
                                $ullistStr = $ullistStr. $this->outSilerbarli($itemkey , $itemValue["text"]);
                            }
                            if ($ishas){
                                echo '<li class="sub-menu ">' . '<a class="active"><i class="' . $value["faname"] . '"></i> <span>' . $key . '</span> </a><ul class="sub">';
                            }else{
                                echo '<li class="sub-menu">' . '<a ><i class="' . $value["faname"] . '"></i> <span>' . $key . '</span> </a><ul class="sub">';
                            }
                            echo  $ullistStr;
                        }

                        echo '</ul></li>';
                    }
                    ?>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <?php
    }

    function bodyLoadsection()
    {

    }

    function bodyLoadFoot()
    {
        echo '</section>';
    }




    function getleftbarData()
    {
        $array = array(

            "主页" => array(
                "faname" => "fa fa-home",
                "item" => array(
                    "ProfileController" => array(
                        "text" => "个人信息"
                    )

                )
            ),
            "店铺管理" => array(
                "faname" => "fa fa-laptop",
                "item" => array(
                    "AddGoodsController" => array(
                        "text" => "商品添加"
                    ),
                    "GoodsListController" => array(
                        "text" => "商品列表"
                    )

                )
            ),

            "接口管理" => array(
                "faname" => "fa fa-laptop",
                "item" => array(
                    "InterfaceManageVC" => array(
                        "text" => "接口查询"
                    ),
                    "AddInterfaceVC" => array(
                        "text" => "添加接口"
                    )

                )
            ),
            "3D彩票" => array(
                "faname" => "fa fa-book",
                "item" => array(
                    "UpdateData3dVC" => array(
                        "text" => "更新数据"
                    ),
                    "History3dVC" => array(
                        "text" => "历史出球"
                    ),
                    "Predictor3DVC" => array(
                        "text" => "概率统计"
                    ),
                    "FCOutDataVC" => array(
                        "text" => "频率查询"
                    )
                )
            ),
            "双色球" => array(
                "faname" => "fa fa-book",
                "item" => array(
                    "UpdateData3dVC" => array(
                        "text" => "更新数据"
                    ),
                    "History3dVC" => array(
                        "text" => "历史出球"
                    )
                )
            ),
            "日志分析" => array(
                "faname" => "fa fa-plapto",
                "item" => array(
                    "LogViewController" => array(
                        "text" => "日志分析"
                    )

                )
            ),
            "系统管理" => array(
                "faname" => "fa fa-cog",
                "item" => array(
                    "AdminController" => array(
                        "text" => "管理员"
                    )

                )
            ),
        );
        return $array;
    }

}

?>