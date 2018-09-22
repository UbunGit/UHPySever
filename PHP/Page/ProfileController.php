<?php
/**
 * Created by PhpStorm.
 * User: ubungit
 * Date: 2018/7/26
 * Time: 下午3:32
 */

class ProfileController extends BaseViewController
{
    function viewwillLoad()
    {
        /* 输出头部信息 */
        parent::viewwillLoad();
        array_push($this->jsArr,"ProfileController.js","Cookie.js");

        /* 输出头部信息 */
        $this->absjsArr = array();

        $this->abscssArr = array();
        $this->cssArr = array(
            'ProfileController.css',
            'header.css'
        );

        $this->title = "新增接口";
    }
    function getuserInfo()
    {

        $userimg = __getCookies('headImage');
        $userName = __getCookies('userName');
        $phone = __getCookies('phone');
        $email = __getCookies('email');

        $this->userInfo = array(
            "heardImg" => $userimg,
            "userName" =>  $userName,
            "phone" =>  $phone,
            "email" =>  $email
        );
    }

    function viewLoadbody()
    {
        parent::viewLoadbody();
        echo '<section id="main-content">';
        echo '<section class="wrapper">';
        // 接口基本信息from
        $this->showProfileNav();
        $pageType= isset($_GET["pageType"])?$_GET["pageType"]:"edit";
        if ($pageType == "edit"){
            $this->showProfile_Edit();
        }

        echo '</section></section>';
    }

    function showProfileNav(){

        ?>

        <aside class="profile-nav col-lg-3">

                      <section class="panel">
                          <div class="user-heading round">
                              <a >
                                  <input type="file" name="file" id = "input_file" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" onchange="imgPreview(this) " >
                                  <img id="head_image" src= <?php  echo $this->userInfo['heardImg'];?> alt="" onclick="$('input[id=input_file]').click();">
                              </a>

                              <h1> <?php  echo $this->userInfo["userName"]; ?> </h1>

                              <?php
                                  echo  "<p> TEL:". $this->userInfo['phone']."</p><p> email:". $this->userInfo['email']."</p>"; ?>

                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li><a href="profile.html"> <i class="fa fa-user"></i> Profile</a></li>
                              <li><a href="profile-activity.html"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-danger pull-right r-activity">9</span></a></li>
                              <li class="active"><a href="profile-edit.html"> <i class="fa fa-edit"></i> Edit profile</a></li>
                          </ul>

                      </section>
                  </aside>
        <?php
    }

    function showProfile_Edit(){
        ?>
        <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1> 个人信息</h1>
                              <form class="form-horizontal">

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">用户名</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="f-name" placeholder=" " name="username" value=<?php echo $this->userInfo["userName"]?>>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">手机号码</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="c-name" placeholder=" " name="phone" value=<?php echo $this->userInfo["phone"]?>>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">邮箱地址</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="b-day" placeholder=" " name="email" value=<?php echo $this->userInfo["email"]?>>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="button" class="btn btn_save">保存</button>
                                          <button type="button" class="btn btn-default">取消</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"> 修改登录密码</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">原密码</label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control" id="c-pwd" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">新密码</label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control" id="n-pwd" placeholder=" ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">确认密码</label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control" id="rt-pwd" placeholder=" ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="button" class="btn btn-info">Save</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
                  </aside>
        <?php
    }
}
?>