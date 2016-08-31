<?php

/**
 * 展现场景列表
 */
require_once('../Public_php/Globle_sc_fns.php');
$userimg = __getCookies('userImg');

/* 输出头部信息*/
$jsArr = array("../../SmartHome_JS/JS/ScenarioList.js","../../SmartHome_JS/JS/Tooltips.js","../../SmartHome_JS/JS/MenuNav.js");
$cssArr = array('../../SmartHome_JS/CSS/ScenarioList.css','../../SmartHome_JS/CSS/MenuNav.css','../../SmartHome_JS/CSS/LeftNav.css');
outPutHead($jsArr,$cssArr,"场景列表");
outputNav($userimg);


outputFoot();
?>