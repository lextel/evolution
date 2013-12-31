<?php

namespace Helper;

class Member {

    /**
     * 获取IP
     *
     * @return string IP
     */
    public function getIp() {

        $unknown = 'unknown';
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'],$unknown)){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],$unknown)){
            $ip = $_SERVER['REMOTE_ADDR']; 
        }

        if(false !== strpos($ip, ',')) {
            $ip = reset(explode(',', $ip));
        }

        return $ip;
    }
}

