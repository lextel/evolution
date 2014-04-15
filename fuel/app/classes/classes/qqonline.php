<?php
namespace Classes;

class Qqonline {
  
    public static function qqState() {
        $config = \Config::load('qq');
        $qq = \Config::get('qq');
        $stateTmp = APPPATH . 'tmp' . DS . 'qqstate' . DS . $qq;
       
        $status = false;
        if(file_exists($stateTmp)) {
            $status = file_get_contents($stateTmp) == 1;
        }

        return $status;
    }
}
