<?php
/**
 * 微博钱包支付
 *
 * @copyright : www.lltao.com
 */

namespace Classes;

class Weibopay {
    //public $pay_config;// 主配置文件
    public $weiboapi;
    function __construct() {
        require_once('paymentLib/weibopay/' . 'weiboapi.php');
        $this->weiboapi = new WeiboApi();
    }
    //支付接口
    public function pay($req)
    {
        //$weiboapi = new WeiboApi();
        $orderId = @$req["orderId"];
        $orderAmount = @$req["orderAmount"];
        $orderTime = @$req["orderTime"];
        $productName = @$req["productName"];
        //请注意参数的顺序
        $params=array();
        $params["inputCharset"] = $this->weiboapi->pay_config['inputCharset'];
        $params["bgUrl"] = $this->weiboapi->pay_config['bgUrl'];
        $params["version"] = $this->weiboapi->pay_config['version'];
        $params["language"] = $this->weiboapi->pay_config['language'];
        $params["signType"] = $this->weiboapi->pay_config['signType'];
        $params["merchantAcctId"] = $this->weiboapi->pay_config['merchantAcctId'];
        $params["orderId"] = $req['orderId'];
        $params["orderAmount"] = $req['money'] * 100;
        $params["orderTime"] = date("YmdHis");
        $params["productName"] = $req['productName'];
        $params["ext1"] = $req['action'];
        $params["ext2"] = $req['log_id'];
        $params["bankId"] = '';
        $params["pid"] = $this->weiboapi->pay_config['pid'];

        return $this->weiboapi->createRequestUrl($this->weiboapi->pay_config['wpay_url'], $params);
    }
    public function checkSignMsg($param)
    {
        //$weiboapi = new WeiboApi();
        $datas = [
            'merchantAcctId', 'version', 'language', 'signType', 'payType',
            'bankId', 'orderId', 'orderTime', 'orderAmount', 'dealId',
            'bankDealId', 'dealTime', 'payAmount', 'fee', 'ext1',
            'ext2', 'payResult', 'payIp', 'errCode', 'signMsg',
        ];
        $pay_params = [];
        foreach($datas as $key){
            $pay_params[$key] = isset($param[$key]) ? $param[$key] : '';
        }
        return $this->weiboapi->checkSignMsg($pay_params);
    }

}
