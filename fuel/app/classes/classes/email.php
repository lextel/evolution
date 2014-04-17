<?php
/*
* 邮件发送模块
*
*/

namespace Classes;

use Fuel\core\Log;

use Email\Email as SysEmail;

class Email {
    /*
    * 功能：最终邮件发送
    * @param to 发送目的邮箱
    * @param view 发送模板对象
    * @param subject 发送邮件标题
    * @return boolean 发送成功 true, 发送失败 false
    */
    public static function send($to, $view, $subject) {
        $email = SysEmail::forge();
        $email->to($to);
        $email->subject($subject);
        $email->html_body($view, true, false);
        try
        {
           $email->send();
           return true;
        }
        catch(\EmailValidationFailedException $e)
        {
            Log::error($to.'邮件过滤失败'.$e);
        }
        catch(\EmailSendingFailedException $e)
        {
            Log::error($to.'邮件发送失败'.$e));
        }
        return false;
    }
    /*
    * 功能：发送用户邮箱验证邮件
    * @param $data $data['view'], $data['email'], $data['subject'] 
    * @return boolean
    */
    public static function checkemail($data) {
        $view = \View::forge($data['view'], $data);
        return self::send($data['email'], $view, $data['subject']);
    }
    /*
    * 功能：检测邮箱的DOMAIN
    * @param email 邮箱
    * @return string
    */
    public static function toemail($email){
        if (!$email){
            return '';
        }
        $t=explode('@',$email);
        $t=strtolower($t[1]);
        if($t=='163.com'){
            return 'mail.163.com';
        }else if($t=='vip.163.com'){
            return 'vip.163.com';
        }else if($t=='126.com'){
            return 'mail.126.com';
        }else if($t=='qq.com'||$t=='vip.qq.com'||$t=='foxmail.com'){
            return 'mail.qq.com';
        }else if($t=='gmail.com'){
            return 'mail.google.com';
        }else if($t=='sohu.com'){
            return 'mail.sohu.com';
        }else if($t=='tom.com'){
            return 'mail.tom.com';
        }else if($t=='vip.sina.com'){
            return 'vip.sina.com';
        }else if($t=='sina.com.cn'||$t=='sina.com'){
            return 'mail.sina.com.cn';
        }else if($t=='tom.com'){
            return 'mail.tom.com';
        }else if($t=='yahoo.com.cn'||$t=='yahoo.cn'){
            return 'mail.cn.yahoo.com';
        }else if($t=='tom.com'){
            return 'mail.tom.com';
        }else if($t=='yeah.net'){
            return 'www.yeah.net';
        }else if($t=='21cn.com'){
            return 'mail.21cn.com';
        }else if($t=='hotmail.com'){
            return 'www.hotmail.com';
        }else if($t=='sogou.com'){
            return 'mail.sogou.com';
        }else if($t=='188.com'){
            return 'www.188.com';
        }else if($t=='139.com'){
            return 'mail.10086.cn';
        }else if($t=='189.cn'){
            return 'webmail15.189.cn/webmail';
        }else if($t=='wo.com.cn'){
            return 'mail.wo.com.cn/smsmail';
        }else if($t=='139.com'){
            return 'mail.10086.cn';
        }else {
            return '';
        }
    }

}
