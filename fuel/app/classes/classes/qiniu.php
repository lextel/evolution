<?php

namespace Classes;
use Fuel\Core\Config;
require("qiniu/rs.php");

class Qiniu {

    /**
     * 获取token
     *
     * @param $bucket string 七牛的空间
     */
    public function getToken($bucket) {

        Config::load('common');
        $ak = Config::get('qiniu.ak');
        $sk = Config::get('qiniu.sk');
        Qiniu_SetKeys($ak, $sk);
        $putPolicy = new Qiniu_RS_PutPolicy($bucket);
        $putPolicy->mimeLimit = Config::get('qiniu.mime'); // 这里可以修改一下，每个空间作不同的限制

        return $putPolicy->Token(null);
    }
}