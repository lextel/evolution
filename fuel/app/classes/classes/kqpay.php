<?php
/**
* 快钱支付
*/

namespace Classes;

class Kqpay {
    
    public function request($args = []){
        require('paymentLib/kuaiqian/kqrequest.php');
        $req = new KqRequest($args);
        return $req;
    }
    
    public function respone($params){
        require('paymentLib/kuaiqian/kqresponse.php');
        $res = new KqResponse($params);
        return $res;
    }

}
