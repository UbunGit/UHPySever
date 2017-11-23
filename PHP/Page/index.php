<?php

require_once ('./LogViewController.php');

$className= isset($_GET["className"]) ? $_GET ['className'] : 'LogViewController';
$logViewcontroller =  new $className;;



?>