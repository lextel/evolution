<?php
/*
* 七牛图片回调
*/
namespace Helper;
use Fuel\Core\Config;
require("qiniu/rs.php");
class Qiniu {
    // 生成TOKEN
    public static function setToken(){
        //require_once("qiniu/rs.php");
        //空间名
        Config::load('common');
        
        $bucket = Config::get('qiniu.bucket');
        //AK
        $accessKey = Config::get('qiniu.AK');
        //SK
        $secretKey = Config::get('qiniu.SK');
        \Log::error($bucket);
        Qiniu_SetKeys($accessKey, $secretKey);
        $putPolicy = new Qiniu_RS_PutPolicy($bucket);
        //$putPolicy->ReturnUrl = "http://localhost/uploaded.php";
        //附加策略
        $putPolicy->mimeLimit = Config::get('qiniu.mimeLimit');
        $upToken = $putPolicy->Token(null);
        return $upToken;
    }
}
