<?php
/**
 * 财付通支付
 *
 * @copyright : www.lltao.com
 */

namespace Classes;

use Fuel\core\Config;
use Fuel\core\Log;

class Tenpay {
    //支付发送接口
    // param @ order_no, product_name, order_price,log_id,ip,action,
    public function pay($param)
    {
        require_once ("paymentLib/tenpay/RequestHandler.class.php");
        Config::load('common');
        //签名密钥
        $key = Config::get('tenpay.key');
        //商户号
        $partner = Config::get('tenpay.partner');
        //返回页面
        $returnUrl = Config::get('tenpay.returnurl');
        //后台服务器回调
        $notifyUrl = Config::get('tenpay.notifyurl');
        /* 获取提交的订单号 */
        $outTradeNo = $param["order_no"];
        /* 获取提交的商品名称 */
        $productName = $param["product_name"];
        /* 获取提交的商品价格 */
        $orderPrice = $param["order_price"];
        /* 获取提交的备注信息 */
        $remarkExplain = $param['log_id'];
        /* 商品价格（包含运费），以分为单位 */
        $totalFee = intval($orderPrice) * 100;

        /* 商品名称 */
        $desc = "乐乐淘".$productName."_".$remarkExplain;
        /* 创建支付请求对象 */
        $reqHandler = new RequestHandler();
        $reqHandler->init();
        $reqHandler->setKey($key);
        $reqHandler->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");
        $datas = [
              'partner' => $partner,
              'out_trade_no' => $outTradeNo,
              'total_fee' => $totalFee,
              'return_url' => $returnUrl,
              'notify_url' => $notifyUrl,
              'input_charset' => 'utf-8',
              'sign_type' => 'MD5',
              'fee_type' => '1',
              'body' => $desc,
              'subject' => $desc,
              'spbill_create_ip' => $param['ip'],
              'time_start' => date("YmdHis"),
              'bank_type' => 1001,//$param['bankID'],
              'attach' => $param['action'].'_'.$remarkExplain,
        ];
        foreach($datas as $k=>$val){
            $reqHandler->setParameter($k, $val);
        }
        $reqUrl = $reqHandler->getRequestURL();
        $debugInfo = $reqHandler->getDebugInfo();
        Log::error($debugInfo);
        return $reqUrl;
    }
    //
    public function notify($param)
    {
    }

    //
    public function response()
    {
        require_once ("paymentLib/tenpay/ResponseHandler.class.php");
        $res = new ResponseHandler();
        return $res;
    }

}
