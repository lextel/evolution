<?php
namespace Classes;

class Sms {

    /* --------------------------------
    官方调用示例

    --------------------------------*/
    private $url = 'http://yunpian.com/v1/sms/tpl_send.json';
    private $apiKey  = 'f1ad42a8896cecf5c905dde31b4c6906';

    /**
    * url 为服务的url地址
    * query 为请求串
    */
    public function sock_post($url,$query){
        $info=parse_url($url);
        $fp=fsockopen($info["host"],80,$errno,$errstr,30);
        $head="POST ".$info['path']." HTTP/1.0\r\n";
        $head.="Host: ".$info['host']."\r\n";
        $head.="Referer: http://".$info['host'].$info['path']."\r\n";
        $head.="Content-type: application/x-www-form-urlencoded\r\n";
        $head.="Content-Length: ".strlen(trim($query))."\r\n";
        $head.="\r\n";
        $head.=trim($query);
        $write=fputs($fp,$head);
        $header = "";
        while ($str = trim(fgets($fp,4096))) {
            $header.=$str;
        }
        $data = "";
        while (!feof($fp)) {
            $data .= fgets($fp,4096);
        }

        return $data;
    }

    /**
    * 模板接口发短信
    * apikey 为云片分配的apikey
    * tpl_id 为模板id
    * tpl_value 为模板值
    * mobile 为接受短信的手机号
    */
    public function tpl_send_sms($apikey, $tpl_id, $tpl_value, $mobile){
        $encoded_tpl_value = urlencode("$tpl_value");
        $post_string="apikey=$apikey&tpl_id=$tpl_id&tpl_value=$encoded_tpl_value&mobile=$mobile";

        return $this->sock_post($this->url, $post_string);
    }

    /**
     * 发送短信
     *
     * @param $mobile 手机号码
     * @param $content 验证码
     *
     * @return boolean
     */
    public function send($mobile, $content) {

        $return = $this->tpl_send_sms($this->apiKey, 1, '#code#='.$content.'&#company#=乐乐淘', $mobile);

        $info = json_decode($return, true);
        if($info['code'] != 0) {
            \Log::error(sprintf('短信： %s | %s | %s', $mobile, $content, '原因：'.$info['msg']));
        }

        return (isset($info['code']) && $info['code'] == 0);
    }
}
