<?php

namespace Helper;
use Fuel\Core\Config;

class Ip2area {
   
   static function toarea($ip){
        Config::load('common');
        $ip2area = new \Classes\Ip2area(APPPATH . 'qqwry.dat');
        $locate = $ip2area->getlocation($ip);
        $locate['area'] = iconv('GB2312','UTF-8//IGNORE', $locate['area']);
        if ($locate['area'] == '日本'){
            $locate['area'] = '未知';
        }
        return $locate['area'];
   } 

}
