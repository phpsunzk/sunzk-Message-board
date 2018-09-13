<?php

/**
 * index后面加ctrl是为了防止类名和文件名重复的情况。
 */
namespace App\ctrl;

use core\lib\model;
use core\lib\config;
class indexCtrl extends \core\sunzk
{
	
	public function index()
	{
		$config = config::get('CTRL','route');
		$model = new model();

		/*$sql = "SELECT * FROM sunzk";
		$ret = $model->query($sql);
		$data = $ret->fetchall();*/
		$data = $model->select("sunzk",'*');
		$this->assign('data',$data);
		$this->display("index.html");
	}
}