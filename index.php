<?php

/**
*入口文件
*1.定义常量
*2.加载函数库
*3.启动框架
*/

define('SUNZK',str_replace('\\','/',realpath('./')));
define('CORE', SUNZK.'/core');//核心文件目录
define('APP', SUNZK.'/App');
define('DEBUG', true);
define('MODULE','app');//为了文件规范

include "vendor\autoload.php";//引入错误类
if (DEBUG) {
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
	ini_set('display_error','On');
}else{
	ini_set('display_error', 'Off');
}

include CORE . '/common/function.php';
include CORE . '/sunzk.php';


spl_autoload_register("\core\sunzk::load");
\core\sunzk::run();