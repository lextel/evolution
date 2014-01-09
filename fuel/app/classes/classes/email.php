<?php
/**
 * 邮件发送模块
 *
 */

namespace Classes;

use Fuel\core\Config;
use Fuel\core\Log;

class SendEmail {

    /*
    * @return array 分类数组 如[1' => '手机', '2' => '其他']
    */
    public static function send($toemails) {
        $email = Email::forge();
       
        $email->to('398667606@qq.com', '王大麦子');
        $email->subject('这事个测试数据哈');
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
