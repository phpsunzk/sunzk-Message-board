<?php
namespace core\lib\drive\log;
//存放在文件中

use core\lib\config;

class file
{
    public $path;
    public function __construct()
    {
        $conf = config::get('OPTION','log');
        $this->path = $conf['PATH'];
    }

    public function log($message,$file='log')
    {
        /**
         * 1.确定文件存储位置是否存在
         *  创建目录
         *
         * 2.写位置
         */

        if(!is_dir($this->path.date('Ymd'))){
            mkdir($this->path . date('Ymd'),'0777',true);
        }

        return file_put_contents($this->path .date('Ymd') .'/'. $file .'.php',date('Y-m-d H:i:s') . json_encode($message).PHP_EOL,FILE_APPEND);
    }
}