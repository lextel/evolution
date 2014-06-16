<?php
namespace Classes;

class KqResponse  
{  
    /* 
     * __construct()构造函数 
     * 生成19个参数及值，可能有一个参数的值为空，$this->errCode的值可能为空 
     */  
    public function __construct($response){  
        $KeyOrders = array('merchantAcctId','version','language','signType','payType','bankId','orderId','orderTime','orderAmount',  
            'dealId','bankDealId','dealTime','payAmount','fee','ext1','ext2','payResult','errCode', 'signMsg');  
  
        foreach($KeyOrders as $key){  
            $this->{$key} = isset($response[$key]) ? $response[$key] : '';  
        }  
    }  
    /* 
     * 检查签名字符串 
     * 快钱返回的签名字符串是$this->signMsg 
     * 使用base64对前面字符串进行解码 
     * 验证使用快钱给的公钥验证 
     * 快钱那边他们把返回来的参数值不为空的使用私钥加密生成了$this->signMsg 
     * 快钱给了我们私钥对应的公钥，我们使用这个公钥来验证。1成功，0失败，-1错误。 
     */  
    public function checkSignMsg(){  
        $KeyOrders = array('merchantAcctId','version','language','signType','payType','bankId','orderId','orderTime','orderAmount',  
            'dealId','bankDealId','dealTime','payAmount','fee','ext1','ext2','payResult','errCode',);  
        $params = [];
        foreach($KeyOrders as $key){  
            if(''==$this->{$key}){continue;}  
            $params[$key] = $this->{$key};  
        }  
        //$pub_key_id 公钥  
        $pub_key_id = openssl_get_publickey(file_get_contents("99bill.cert.rsa.20140803.cer", "r"));  
        return openssl_verify(urldecode(http_build_query($params)), base64_decode($this->signMsg), $pub_key_id);   
    }  
  
    public function isSuccess(){  
        //$this->payResult成功时10，失败时11  
        return '10'==$this->payResult;  
    }  
  
    public function getOrderId(){  
        return str_replace('LLTAO', '', $this->orderId);  
    }  
}  
