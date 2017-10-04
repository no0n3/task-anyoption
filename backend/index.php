<?php

require_once '../main.php';
require_once('conf/init.php');

framework\App::getInst()->dispatch(
    isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : ''
);
