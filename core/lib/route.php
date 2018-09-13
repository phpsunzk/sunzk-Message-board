<?php


namespace core\lib;

use core\lib\config;
/**
 * 
 */
class route
{
	public $ctrl;
	public $action;
	public function __construct()
	{
		//p($_SERVER['REQUEST_URI']);die;
		$path = $_SERVER['REQUEST_URI'];
		if (isset($path) && $path != '/') {
			$patharr = explode('/',trim($path,'/'));
			if (isset($patharr[0])) {
				$this->ctrl = $patharr[0];
			}
			unset($patharr[0]);
			if (isset($patharr[1])) {
				$this->action = $patharr[1];
				unset($patharr[1]);
			}else{
				$this->action = config::get('ACTION','route');
			}
			$count = count($patharr) + 2;
			$i = 2;
			unset($_GET);
			while ($i < $count) {
				$_GET[$patharr[$i]] = $patharr[$i + 1];
				$i = $i + 2;
			}
		}else{

			$this->ctrl = config::get('CTRL','route');

			$this->action = config::get('ACTION','route');
		}
	}
}