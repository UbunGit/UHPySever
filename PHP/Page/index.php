<?php

require_once ('./LogViewController.php');
require_once ('./InterfaceManageVC.php');

$className= isset($_GET["className"]) ? $_GET ['className'] : 'LogViewController';
$logViewcontroller =  new $className;;



?>