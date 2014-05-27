<?php
/**
 * 支付宝支付
 *
 * @author    : weelion <weelion@qq.com>
 * @copyright : www.lltao.com
 */

namespace Classes;

class Alipay {

    private $notify;
    private $return;
    private $config;

    public function __construct($notify, $return, $config) {

        $this->notify = $notify;
        $this->return = $return;
        $this->config = $config;
    }


    //直接支付
    public function pay($userId, $money, $action = 'pay') {

        require('paymentLib/alipay/alipay_submit.class.php');

        //支付类型
        $payment_type = "1";
        $notify_url = $this->notify;
        $return_url = $this->return;
        $seller_email = 'lltao@lltao.com';
        $out_trade_no = 'LLT' . str_replace('.', '', microtime(true));
        $total_fee = $money;
        $subjects = ['pay'=>'乐乐淘商品', 'recharge'=>'乐乐淘充值'];
        
        $bodys = [
                 'pay' => '购买' . intval($money) . '个幸运码', 
                 'recharge'=> '充值' . intval($money) . '个元宝'];
        $body = isset($bodys[$action]) ? $bodys[$action] : $bodys['pay'];
        $subject = isset($subjects[$action]) ? $subjects[$action] : $subjects['pay'];;
        $show_url = 'http://www.lltao.com'; // 商品展示地址
        $anti_phishing_key = "";
        $exter_invoke_ip = "";

        $alipay_config = [
            'partner'       => $this->config['id'],
            'key'           => $this->config['key'],
            'sign_type'     => strtoupper('MD5'),
            'input_charset' => 'utf-8',
            'cacert'        => getcwd().'\\paymentLib\\alipay\\cacert.pem',
            'transport'     => 'http',
        ];
        //用户名，操作，支付源
        $extra_param = implode('_', [$userId, $action, '支付宝']);
        $parameter = [
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type"	=> $payment_type,
            "notify_url"	=> $notify_url,
            "return_url"	=> $return_url,
            "seller_email"	=> $seller_email,
            "out_trade_no"	=> $out_trade_no,
            "subject"	=> $subject,
            "total_fee"	=> $total_fee,
            "body"	=> $body,
            "show_url"	=> $show_url,
            "anti_phishing_key"	=> $anti_phishing_key,
            "extra_common_param" => $extra_param,
            "exter_invoke_ip"	=> $exter_invoke_ip,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        ];
        
        //建立请求
        header("Content-type: text/html; charset=utf-8");
        $alipaySubmit = new AlipaySubmit($alipay_config);
        
        return $alipaySubmit->buildRequestForm($parameter, "get", "确认");
    }
}
