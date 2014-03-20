<?php
/**
 * 随机获得中国国内IP
 *
 */
namespace Classes;

use \Exception;
use Fuel\Core\Log;
use Fuel\Core\Config;

class RandCHIp{
    private $_config;
    
    public function __construct() {

        Config::load('chips');
        $this->_config = Config::get('ips');
        if(empty($this->_config)) {
            throw new Exception('ips config is not exists');
        }
    }
    
    public function randomCHIp(){
        $ips = $this->_config[array_rand($this->_config, 1)];
        if (!is_array($ips)){
            $ips = split('[ ]+', $ips);
        }
        if (count($ips) < 2){
            return;
        }
        $ip1 = ip2long($ips[0]);
        $ip2 = ip2long($ips[1]);
        return long2ip(rand($ip1, $ip2));
    }
    
}
