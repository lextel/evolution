<?php
/*
* 七牛图片回调
*/
namespace Helper;
use Fuel\Core\Config;
class Qiniu {

    /**
     * 获取token
     *
     * @param $bucket string 七牛的空间
     */
    public static function getHost($bucket) {

        Config::load('common');
        $host = Config::get('qiniu.host');

        return sprintf($host, $bucket);
    }
}
