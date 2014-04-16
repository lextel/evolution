<?php

/**
 * QQ在线状态修改
 */
namespace Fuel\Tasks;

class Qqstate {
    public static function run()
    {
        $config = \Config::load('qq');
        $qq = \Config::get('qq');
        $dir = APPPATH . 'tmp' . DS . 'qqstate' . DS;

        if(!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $stateTmp = $dir . $qq;
        
        $editTime = 0;
        if(file_exists($stateTmp)) {
            $editTime = filemtime($stateTmp);
        }

        if(time() - $editTime > \Config::get('ttl')) {
            $qIcon = file_get_contents('http://wpa.qq.com/pa?p=2:'.$qq.':52');
            $len = strlen($qIcon);
            if($len == 1627) {
                file_put_contents($stateTmp, 0);
            } else {
                file_put_contents($stateTmp, 1);
            }
        }

        return 'success';
    }
}
