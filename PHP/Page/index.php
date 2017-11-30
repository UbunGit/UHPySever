<?php

require_once ('./LogViewController.php');
require_once ('./InterfaceManageVC.php');
require_once ('./LoginViewController.php');


$className= isset($_GET["className"]) ? $_GET ['className'] : 'LoginViewController';
$logViewcontroller =  new $className;;



?>