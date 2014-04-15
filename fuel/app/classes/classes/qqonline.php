<?php
namespace Classes;

class Qqonline {
    private static $qq = '2698744419';
    private static $cacheTime = 600;
  
    public static function qqState($qq = '') {
       if(empty($qq)) $qq = self::$qq;
       $dir = APPPATH . 'tmp' . DS . 'qqstate' . DS;

       if(!file_exists($dir)) {
           mkdir($dir, 0755, true);
       }
       $stateTmp = $dir . $qq;
       
       $editTime = 0;
       if(file_exists($stateTmp)) {
           $editTime = filemtime($stateTmp);
       }

       if(time() - $editTime > self::$cacheTime) {
           $qIcon = file_get_contents('http://wpa.qq.com/pa?p=2:'.$qq.':52');
           $len = strlen($qIcon);
           if($len == 1627) {
               file_put_contents($stateTmp, 0);
               return false;
           } else {
               file_put_contents($stateTmp, 1);
               return true;
           }
       } else {
           return file_get_contents($stateTmp) == 1;
       }
    }
}
