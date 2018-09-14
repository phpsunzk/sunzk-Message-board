<?php

namespace core;

use \core\lib\log;
use \vendor\twig;
/**
 * 
 */
class sunzk
{
	public static $classMap = array();
	public $assign;
	static public function run()
	{
        p('ok');
		//启动日志存储
        log::init();


		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->action;
		$ctrlfile = APP . '/ctrl/' . $ctrlClass . 'Ctrl.php';
		$ctrlClass = '\\' . MODULE . '\ctrl\\' . $ctrlClass . 'Ctrl';
		//p($ctrlClass);die;
		if(is_file($ctrlfile)){
			include $ctrlfile;
			$ctrl = new $ctrlClass();
			$ctrl->$action();
            log::log('ctrl:' . $ctrlClass . '       '  . 'action:' . $action);
		}else{
			throw new \Exception('控制器未找到'.$ctrlClass);
		}
	}
	static public function load($class)
	{
		//自动加载类库
		if (isset($classMap[$class])) {
			return true;
		}else{
			$class = str_replace('\\', '/', $class);

			$file = SUNZK.'/'.$class.'.php';
			if (is_file($file)) {
				include $file;
				self::$classMap[$class] = $class;
			}else{
				return false;
			}
		}
	}
	public function assign($name,$value)
	{
		$this->assign[$name] = $value;
	}
	public function display($file)
	{
		//$file = APP . '/views/' . $file;


			if (isset($this->assign)) {
                $loader = new \Twig_Loader_Filesystem(APP.'/views');
                $twig = new \Twig_Environment($loader, array(
                    'cache' =>SUNZK.'/log/twig',
                    'debug'=>DEBUG
                ));
                $template=$twig->loadTemplate($file);
                $template->display($this->assign?$this->assign:'');
			}
			//include $file;
		}


}
