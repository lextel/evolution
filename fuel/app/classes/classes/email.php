<?php
/*
* 邮件发送模块
*
*/

namespace Classes;

use Fuel\core\Log;
use Fuel\core\Config;

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
            Log::error($to.'邮件发送失败'.$e);
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
        Config::load('email');
        $mailHosts = Config::get('mailHost');
        $t=explode('@',$email);
        $t=strtolower($t[1]);
        if (array_key_exists($t, $mailHosts)){
            return $mailHosts[$t];
        }
        return '';
    }

}
