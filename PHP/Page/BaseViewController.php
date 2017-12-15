<?php
require_once ('../Public_php/ViewController.php');

abstract class BaseViewController extends ViewController
{

    public $userInfo;
    public $className;

    function viewwillLoad()
    {

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
                                                                                   src=<?php echo $this->getImage($this->userInfo['heardImg']); ?>>
                            <span
                                    class="username"><?php echo $this->userInfo['userName']; ?> </span> <b
                                    class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                            <li><a class="logout-a"><i class="fa fa-key"></i> 注销</a></li>
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
                        if (empty($value["item"])){
                            echo '<li >' . '<a ><i class="' . $value["faname"] . '"></i> <span>' . $key . '</span> </a><ul>';
                        }else{
                            echo '<li class="sub-menu">' .'<a ><i class="' .  $value["faname"] . '"></i> <span>' . $key . '</span> </a><ul class="sub">';
                            foreach ($value["item"] as $itemkey => $itemValue) {
                                echo $this->outSilerbarli($itemValue["classNmae"], $itemkey);
                            }
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

    /**
     * 输出siderbar li
     */
    function outSilerbarli($path, $text)
    {
        $locatonUrl = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ["REQUEST_URI"];
        $url = './index.php?className=' . $path;
        if (strcmp($path, $this->className) == 0) {

            return '<li class="active"><a href=' . $url . '>' . $text . '</a></li>';
        } else {
            return '<li ><a href=' . $url . '>' . $text . '</a></li>';
        }
    }



    function getleftbarData()
    {
        $array = array(

            "主页" => array(
                "faname" => "fa fa-home"
            ),

            "接口管理" => array(
                "faname" => "fa fa-laptop",
                "item" => array(
                    "接口查询" => array(
                        "classNmae" => "InterfaceManageVC"
                    ),
                    "添加接口" => array(
                        "classNmae" => "AddInterfaceVC"
                    )

                )
            ),
            "3D彩票" => array(
                "faname" => "fa fa-book",
                "item" => array(
                    "更新数据" => array(
                        "classNmae" => "UpdateData3dVC"
                    ),
                    "历史出球" => array(
                        "classNmae" => "History3dVC"
                    ),
                    "概率统计" => array(
                        "classNmae" => "Predictor3DVC"
                    ),
                    "频率查询" => array(
                        "classNmae" => "FCOutDataVC"
                    )
                )
            ),
            "双色球" => array(
                "faname" => "fa fa-book",
                "item" => array(
                    "更新数据" => array(
                        "classNmae" => "UpdateData3dVC"
                    ),
                    "历史出球" => array(
                        "classNmae" => "History3dVC"
                    )
                )
            ),
            "日志分析" => array(
                "faname" => "fa fa-plapto",
                "item" => array(
                    "日志分析" => array(
                        "classNmae" => "LogViewController"
                    )

                )
            ),
        );
        return $array;
    }

}

?>