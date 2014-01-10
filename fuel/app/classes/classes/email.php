<?php
/**
 * 邮件发送模块
 *
 */

namespace Classes;

//use Fuel\core\Config;
use Fuel\core\Log;

use Email\Email as SysEmail;
class Email {

    /*
    * 总发送
    */
    public static function send($to, $view, $subject) {
        $subject = $subject;
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
            Log::error($e);
        }
        catch(\EmailSendingFailedException $e)
        {
            Log::error($e);
        }
        return false;
    }
   /*
   * 发送用户邮箱验证邮件
   */
   public static function checkemail($data) {
       $view = \View::forge($data['view'], $data);
       return self::send($data['email'], $view, $data['subject']);
   }

}
