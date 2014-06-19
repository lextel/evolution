<?php
namespace Classes;
use Fuel\Core\Config;

class KqRequest  
{  
    public function __construct($MockOrder){  
        /* 
         * 人民币网关账号。 
         *第一种方式：该账号为11位人民币网关商户编号+01,该参数必填。01对应工商银行。 
         *第二种方式：该账号为16位人民币网关商户 
         */
        Config::load('common');
        $this->merchantAcctId = Config::get('99bill.merchantAcctId');;   
        //服务器接收支付结果的后台地址，该参数务必填写，绝对路径//不能为空.返回地址
        
        $this->bgUrl = Config::get('99bill.returnUrl');  
        //商户订单号，以下采用时间来定义订单号，商户可以根据自己订单号的定义规则来定义该值//不能为空。  
        $this->orderId = 'LLTAO'.sprintf("%09d", $MockOrder['orderId']);  
        //订单金额，金额以“分”为单位，商户测试以1分测试即可，切勿以大金额测试，该参数必填//不能为空  
        $this->orderAmount = $MockOrder['orderAmount'];  
        //订单提交时间，格式：yyyyMMddHHmmss，如：20071117020101//不能为空。  
        $this->orderTime = date("YmdHis", $MockOrder['orderTime']);  
        //支付人姓名,可以为空。  
        $this->payerName= "";   
        //支付人联系类型，1 代表电子邮件方式；2 代表手机联系方式。可以为空。  
        $this->payerContactType =  "";  
        //支付人联系方式，与payerContactType设置对应，payerContactType为1，则填写邮箱地址；payerContactType为2，则填写手机号码。可以为空。  
        $this->payerContact =  "";  
        //商品名称，可以为空。  
        $this->productName= $MockOrder['pName'];  
        //商品数量，可以为空。  
        $this->productNum = "1";  
        //商品代码，可以为空。  
        $this->productId = $MockOrder['ets_license'];  
        //商品描述，可以为空。  
        $this->productDesc = "";  
        //支付方式，一般为00，代表所有的支付方式。如果是银行直连商户，该值为10，必填//不能为空  
        $this->payType = "00";  
        //编码方式，1代表 UTF-8; 2 代表 GBK; 3代表 GB2312 默认为1,该参数必填//不能为空  
        $this->inputCharset = "1";  
        //网关版本，固定值：v2.0,该参数必填//不能为空  
        $this->version =  "v2.0";  
        //语言种类，1代表中文显示，2代表英文显示。默认为1,该参数必填//不能为空  
        $this->language =  "1";  
        //签名类型,该值为4，代表PKI加密方式,该参数必填//不能为空  
        $this->signType =  "4";  
        //接收支付结果的页面地址，该参数一般置为空即可。  
        $this->pageUrl = "";  
        //扩展字段1，商户可以传递自己需要的参数，支付完快钱会原值返回，可以为空。  
        $this->ext1 = $MockOrder['userId'];  
        //扩展自段2，商户可以传递自己需要的参数，支付完快钱会原值返回，可以为空。  
        $this->ext2 = $MockOrder['action'];  
        //银行代码，如果payType为00，该值可以为空；如果payType为10，该值必须填写，具体请参考银行列表。  
        $this->bankId = "";  
        //同一订单禁止重复提交标志，实物购物车填1，虚拟产品用0。1代表只能提交一次，0代表在支付不成功情况下可以再提交。可为空。  
        $this->redoFlag = "1";  
        //快钱合作伙伴的帐户号，即商户编号，可为空。  
        $this->pid = "";  
          
        //快钱提供的request参数。  
        $KeyOrders = array('inputCharset','pageUrl','bgUrl','version','language','signType','merchantAcctId','payerName','payerContactType','payerContact',  
            'orderId','orderAmount','orderTime','productName','productNum','productId','productDesc','ext1','ext2','payType','bankId','redoFlag','pid',);  
          
        //判断快钱提供的request参数的值是否为空，把非空的参数及值重新组建数组  
        foreach($KeyOrders as $key){  
            if(''==$this->{$key}){continue;}  
            $params[$key] = $this->{$key};  
        }
        //常用PKI加密 
        $this->signMsg = $this->getSignMsg(urldecode(http_build_query($params)));  
    }  
      
    //PKI加密技术  
      
    public function getSignMsg($param){  
        //99bill-rsa.pem是快钱的一个CA证书  
        //本地随机生成一个KEY,用此KEY加密数据 KEY为$priv_key_id  
        //$priv_key_id = openssl_get_privatekey(file_get_contents("99bill-rsa.pem", "r"));
        Config::load('common');
        $priv_key_id = openssl_get_privatekey(file_get_contents(Config::get('99bill.prikey'), "r")); 
        //用$priv_key_id给$param数据加密。  
        //计算一个签名字符串$param通过使用SHA1哈希加密，随后$priv_key_id私钥加密。数据本身是不加密的。  
        openssl_sign($param, $signMsg, $priv_key_id, OPENSSL_ALGO_SHA1);  
        //从存储器上释放$priv_key_id  
        openssl_free_key($priv_key_id);  
        //使用base64对数据进行编码  
        return base64_encode($signMsg);  
    }  
}  
