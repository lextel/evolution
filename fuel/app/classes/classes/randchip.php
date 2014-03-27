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
    private $_config=[];
    private $_area=[];
    private $_city=[];
    
    /*
    * 从配置 里随机取个IP段然后生成IP
    */
    public function randomCHIp(){
        Config::load('chips');
        $this->_config = Config::get('ips');
        if(empty($this->_config)) {
            throw new Exception('ips config is not exists');
        }
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
    /*
    * 从配置了匹配对应的城市的IP段输出个
    */
    public function area2ip($local){
        Config::load('chareaip');
        $this->_area = Config::get('area');
        if(empty($this->_area)) {
            throw new Exception('chareaip config is not exists');
        }
        if (array_key_exists($local, $this->_area)){
            $ip = $this->_area[$local];
            $t1 = $ip[array_rand($ip, 1)];
            $ip1 = ip2long($t1[0]);
            $ip2 = ip2long($t1[1]);
            return long2ip(rand($ip1, $ip2));
        }
        return '0.0.0.0';
    }
    public function getCity(){
        Config::load('chareaip');
        $this->_city = Config::get('city');
        if(empty($this->_city)) {
            throw new Exception('chareaip config is not exists');
        }
        $cities = [];
        foreach($this->_city as $city){
            $cities[$city] = $city;
        }
        return $cities;
    }
}
