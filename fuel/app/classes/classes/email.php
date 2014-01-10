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

    public static function send($to) {
        $email = SysEmail::forge();

        $email->to($to);
        $email->subject('ceshi ');
        //$email->to([
        //  ]);

        $email->body('This is my message');
        $email->body('This is my message');
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

}
