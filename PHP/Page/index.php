<?php

require_once ('./LogViewController.php');
require_once ('./InterfaceManageVC.php');
require_once ('./LoginViewController.php');
require_once ('./AddInterfaceVC.php');
require_once ('./History3dVC.php');
require_once ('./UpdateData3dVC.php');
require_once ('./Predictor3DVC.php');
require_once ("FCOutDataVC.php");
require_once ("RecommendOutNOVC.php");
try{

    if (empty(__getCookies("userName"))){
        $className = "LoginViewController";
    }else{
        $className= isset($_GET["className"]) ? $_GET ['className'] : 'InterfaceManageVC';
    }
    $page =  new $className;
}catch (Exception $e){
    Header("Location: 404.php");
}
//catch (Error $e){
//    Header("Location: 404.php");
//}

?>