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
require_once ("AdminController.php");
require_once ("ProfileController.php");
require_once ("RegisterController.php");
require_once ("AdminEditController.php");

require_once ("./Shoping/AddGoodsController.php");
require_once ("./Shoping/GoodsListController.php");




try{

    $className= isset($_GET["className"]) ? $_GET ['className'] : NULL;
    if (empty(__getCookies("userID")) and ($className != 'RegisterController')){
        $className = "LoginViewController";
    }else{
        $className= isset($_GET["className"]) ? $_GET ['className'] : 'ProfileController';
    }
    $page =  new $className;
}catch (Exception $e){
    Header("Location: 404.php");
}


?>