<?php

namespace Helper;

class Timer {

    /**
     * 生成带毫秒的时间戳
     *
     * return string 1851254152.582
     */
    public function millitime() {
      $microtime = microtime();
      $comps = explode(' ', $microtime);

      return sprintf('%d.%03d', $comps[1], $comps[0] * 1000);
    }

    /**
     * 友好时间
     *
     * @param $timestamp integer 时间戳
     *
     * @return string 友好时间
     */
    static function friendlyDate($timestamp) {
        $time = time() - $timestamp;
        $today = strtotime(date('Y-m-d'));
        if($time <= 60){
            return '刚刚';
        }elseif($time>=60 && $time<3600){
            $return=intval($time / 60)." 分钟前";
        }else{
            if($timestamp>$today){
                $return="今天 ".date("H:i",$timestamp);
            }elseif($timestamp<$today && $timestamp>($today-86400)){
                $return="昨天 ".date("H:i",$timestamp);
            }else{
                $return=date("Y-m-d H:i",$timestamp);
            }
        }

        return $return;
    }
}
