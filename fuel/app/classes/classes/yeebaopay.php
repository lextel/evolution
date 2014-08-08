<?php
/**
 * 易宝支付
 *
 * @copyright : www.lltao.com
 */

namespace Classes;

class Yeebaopay {
    //支付接口发送
    public function pay($params){
        require_once('paymentLib/yeebao/' . 'yeepayCommon.php');
        #   商家设置用户购买商品的支付信息.
        ##易宝支付平台统一使用GBK/GB2312编码方式,参数如用到中文，请注意转码

        #   商户订单号,选填.
        ##若不为""，提交的订单号必须在自身账户交易中唯一;为""时，易宝支付会自动生成随机的商户订单号.
        $p2_Order                   = $params['p2_Order'];

        #   支付金额,必填.
        ##单位:元，精确到分.
        $p3_Amt                     = $params['p3_Amt'];

        #   交易币种,固定值"CNY".
        $p4_Cur                     = "CNY";

        #   商品名称
        ##用于支付时显示在易宝支付网关左侧的订单产品信息.
        $p5_Pid                     = $params['p5_Pid'];

        #   商品种类
        $p6_Pcat                    = '';

        #   商品描述
        $p7_Pdesc                   = '';

        #   商户接收支付成功数据的地址,支付成功后易宝支付会向该地址发送两次成功通知.
        $p8_Url                     = $params['p8_Url'];

        #   商户扩展信息
        ##商户可以任意填写1K 的字符串,支付成功时将原样返回.
        $pa_MP                      = $params['pa_MP'];

        #   支付通道编码
        ##默认为""，到易宝支付网关.若不需显示易宝支付的页面，直接跳转到各银行、神州行支付、骏网一卡通等支付页面，该字段可依照附录:银行列表设置参数值.
        $pd_FrpId                   = '';

        #   应答机制
        ##默认为"1": 需要应答机制;
        $pr_NeedResponse    = "1";

        #调用签名函数生成签名串
        $hmac = getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse);
        \Config::load("common");
        $p1_MerId           = \Config::get('yeebao.p1_MerId');
        return [
                 'p0_Cmd' => "Buy", 'p1_MerId'=>$p1_MerId,
                 'p2_Order'=>$p2_Order, 'p3_Amt'=>$p3_Amt, 'p4_Cur'=>$p4_Cur,
                 'p5_Pid'=>$p5_Pid, 'p6_Pcat'=>$p6_Pcat, 'p7_Pdesc'=>$p7_Pdesc,
                 'p8_Url'=>$p8_Url, 'p9_SAF'=>'0', 'pa_MP'=>$pa_MP, 'pd_FrpId'=>$pd_FrpId,
                 'pr_NeedResponse'=>$pr_NeedResponse, 'hmac'=>$hmac];

    }

    //支付状态回调
    public function callback(){
        require_once('paymentLib/yeebao/' . 'yeepayCommon.php');
        $return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);

        #   判断返回签名是否正确（True/False）
        $bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
        #   以上代码和变量不需要修改.
        #   校验码正确.
        if($bRet){
            if($r9_BType=="1"){
                //echo "交易成功";
                //echo  "<br />在线支付页面返回";
                return 1;
            }elseif($r9_BType=="2"){
                #如果需要应答机制则必须回写流,以success开头,大小写不敏感.
                //echo "success";
                //echo "<br />交易成功";
                //echo  "<br />在线支付服务器返回";
                return 2;
            }
        }
        //错误
        return 0;
    }

}
