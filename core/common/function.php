<?php


function p($val)
{
	if (is_bool($val)) {
		var_dump($val);
	}else if (is_null($val)) {
		var_dump(NULL);
	}else{
		echo "<pre style='position:relative;z-index:999;padding:10px;border-radius:5px;background:#ccc;border:1px solid #aaa;font-zize:14px;line-height:18px;opacity:0.9;'>".print_r($val,true)."</pre>";
	}
}