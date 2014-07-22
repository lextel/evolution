<?php
/**
 * 百度钱包支付
 *
 * @copyright : www.lltao.com
 */

namespace Classes;

class Baidupay {
    //支付接口发送
    public function pay($params){
        require_once('paymentLib/baidu/' . 'bfb_sdk.php');
        require_once('paymentLib/baidu/' . 'bfb_pay.cfg.php');
        $bfb_sdk = new bfb_sdk();
        $datas = [
		        'currency' => sp_conf::BFB_INTERFACE_CURRENTCY,
		        'goods_name' => $params['goods_name'],
		        'input_charset' => sp_conf::BFB_INTERFACE_ENCODING,
		        'order_create_time' => $params['order_create_time'],
		        'order_no' => $params['order_no'],
		        'page_url' => $params['page_url'],
		        'pay_type' => 2, //不登录支付
		        'return_url' => $params['return_url'],
		        'service_code' => sp_conf::BFB_PAY_INTERFACE_SERVICE_ID,
		        'sign_method' => sp_conf::SIGN_METHOD_MD5,
		        'sp_no' => sp_conf::SP_NO,
		        'total_amount' => $params['total_amount'],
		        'version' => sp_conf::BFB_INTERFACE_VERSION,
		        'extra' => $params['extra'],		        
        ];
        $order_url = $bfb_sdk->create_baifubao_pay_order_url($datas, sp_conf::BFB_PAY_DIRECT_NO_LOGIN_URL);
        \Log::error($order_url);
        //echo $order_url;
        //exit;
        return \Response::redirect($order_url);
    }
    //支付接口返回结果
    public function baidureturn(){
        require_once('paymentLib/baidu/' . 'bfb_sdk.php');
        $bfb_sdk = new bfb_sdk();
        $bfb_sdk->log(sprintf('百度钱包返回结果：[%s]', print_r($_GET, true)));
        if (false === $bfb_sdk->check_bfb_pay_result_notify()) {
	        $bfb_sdk->log('百度支付不成功');
	        return;
        }
        $bfb_sdk->log('支付成功');
        return $bfb_sdk;
        /*
         * 此处是商户收到百付宝支付结果通知后需要做的自己的具体业务逻辑，比如记账之类的。 只有当商户收到百付宝支付 结果通知后，
         * 所有的预处理工作都返回正常后，才执行该部分
         */
        // 向百付宝发起回执
        //$bfb_sdk->notify_bfb();
    }
    // 返回给百度钱包的处理成功的
    public function notify(){
        require_once('paymentLib/baidu/' . 'bfb_sdk.php');
        $bfb_sdk = new bfb_sdk();
        return $bfb_sdk->notify_bfb();
    }
    // 返回给百度钱包的处理失败的
    public function error(){
        require_once('paymentLib/baidu/' . 'bfb_sdk.php');
        $bfb_sdk = new bfb_sdk();
        return $bfb_sdk->error_bfb();
    }
}
