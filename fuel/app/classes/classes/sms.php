<?php
namespace Classes;

class Sms {

    /* --------------------------------
    官方调用示例
    $http = 'http://api.sms.cn/mt/';        //短信接口
    $uid = 'test';                            //用户账号
    $pwd = 'test';                            //密码
    $mobile     = '13900001111,13900001112,13900001113';    //号码
    $mobileids     = '1390000111112345666688,139000011121112345666688,139000011131112345666688';    //号码唯一编号
    $content = '您的验证码为123123，【博好科技】';        //内容

    //即时发送
    $res = sendSMS($http,$uid,$pwd,$mobile,$content,$mobileids);
    echo $res;

    //定时发送
    $time = '2010-05-27 12:11';
    $res = sendSMS($uid,$pwd,$mobile,$content,$time);
    echo $res;
    --------------------------------*/

    private $http = 'http://api.sms.cn/mtutf8/';
    private $uid  = 'lltao2014';
    private $pwd  = 'llt83210266';
    private $errors = [
            100 => '发送成功',
            101 => '验证失败',
            102 => '短信不足',
            103 => '操作失败',
            104 => '非法字符',
            105 => '内容过多',
            106 => '号码过多',
            107 => '频率过快',
            108 => '号码内容空',
            109 => '账号冻结',
            110 => '禁止频繁单条发送',
            112 => '号码不正确',
            120 => '系统升级',
        ];

    /**
     * 参数
     *
     * @param $mobile  string 手机号
     * @param $content string 短信内容
     *
     * @return array
     */
    private function param($mobile, $content) {
        $pwd = md5($this->pwd . $this->uid);

        return [
                'uid'       => $this->uid,
                'pwd'       => $pwd,
                'mobile'    => $mobile,
                'mobileids' => rand(8000000000, 9000000000),  // 号码唯一编号
                'content'   => $content . '【乐乐淘】',
            ];
    }


    /**
     * 发送短信
     *
     * @param $mobile  string 手机号
     * @param $content string 短信内容
     *
     * @return boolean 是否成功
     */
    public function send($mobile, $content) {

        $params = $this->param($mobile, $content);

        $url = $this->http . '?' . http_build_query($params);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT,30);
        $return = curl_exec($curl);
        curl_close($curl);
        // 返回： sms&stat=100&message=发送成功
        $status = substr($return, 9, 3);

        if($status != 100) {
            \Log::error(sprintf('短信： %s | %s | %s', $mobile, $content, $return));
        }

        return $status == 100 ? true : false;
    }

}
