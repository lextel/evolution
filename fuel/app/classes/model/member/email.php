<?php
use Orm\Model;

class Model_Member_Email extends Model
{
    /*
    * type email为验证邮件 password为找回密码
    * deadtime 为有效时间 时间有效为 3600 * 24 * 3 3天有效
    * status = 1 为已经使用过 = 0 为未使用过
    *
    */
    protected static $_properties = array(
        'id',
        'email',
        'member_id',
        'key',
        'status',
        'type',
        'is_delete',
        'deadtime',
        'created_at',
        'updated_at',
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => false,
        ),
    );

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
        $val->add_field('member_id', 'Member Id', 'required|valid_string[numeric]');
        $val->add_field('key', 'Key', 'required|max_length[255]');
        $val->add_field('status', 'Status', 'required|valid_string[numeric]');
        $val->add_field('type', 'Type', 'required|max_length[255]');
        $val->add_field('is_delete', 'Is Delete', 'required|valid_string[numeric]');
        $val->add_field('deadtime', 'Deadtime', 'required|valid_string[numeric]');

        return $val;
    }

    /*
    * 添加到数据库记录
    */
    public static function add($member_id, $data)
    {
        Config::load('common');
        $mail = Model_Member_Email::forge([
            "member_id"=>$member_id,
            "key"=>$data['key'],
            "type"=>$data['type'],
            "email"=>$data['email'],
            "deadtime" => time() + Config::get('email_deadtime'),
            "status" => 0,
            "is_delete" => 0,
            ]);
       if ($mail->save()){
            return true;
       }
       return false;       
    }
    
    /*
    * 发送邮件
    * 输入 data集合, 用户ID
    $data = ["email"=>$email,
                   'key' => $key,
                   'uri' => 'emaiok',
                   'view'=>'member/email/emailok',
                   'type'=>'email',                   
                   "subject"=>"乐乐淘用户邮箱验证"];
    */
    public static function sendEmail($data, $member_id=0)
    {
        $data['key'] = Model_Member_Email::email_key($data['email']);
        if (!self::add($member_id,$data)){
            return false;
        }
        $data['href'] = Uri::create($data['uri'], [], ['key'=>$data['key']]);
        $send =  \Classes\Email::checkemail($data);
        return true;
    }

    /*
    * 生成key
    */
    public static function email_key($email)
    {
        Config::load('common');
        $key = Crypt::encode(md5($email + time()), Config::get('email_key'));
        return $key;
    }
    
    /*
    * 验证解密完整KEY
    */
    public static function decode_key($key)
    {
        Config::load('common');
        try{
            $key = Crypt::decode($key, Config::get('email_key'));
            return true;
        }catch(Exception $e){
            Log::error($e);
            return false;
        }
    }
    
    /*
    * 检测KEY的真实性 先验证加密正确性，然后查询数据库是否有，有是否过期，或者使用过, 如果未使用过，则把status修改为1
    */
    public static function check_key($key, $type)
    {
        if (!self::decode_key($key))
        {
            return false;
        }
        $key = Model_Member_Email::find_by_key($key, ['where'=>['status'=>0, 
                                          'type'=> $type, 
                                          'and'=>['deadtime', '>=', time()]
                                          ]]);
        if ($key)
        { 
           //$key->status = 1;
           //$key->save();
           return true;
        }
        return false;
        
    }
    
    /*
    * 检测用户邮箱是否已经验证过了，验证过了就不在发送邮件了,只针对type = email的
    * 
    */
    public static function check_emailok($email)
    {
       $email = Model_Member_Email::find_by_email($email, ['where'=>['status'=>1, 
                                          'type'=>'email',
                                          'is_delete'=> 0,
                                          ]]);
       if ($email)
       {
          return true;
       }
       return false;
   }
   
   /*
   * 如果数据库里已经有发送过的数据了则清掉再发
   */
   public static function check_emailsend($email)
   {
       $email = Model_Member_Email::find_by_email($email, ['where'=>['status'=>0, 
                                          'type'=> 'email',
                                          'is_delete'=>0,
                                          ]]);
       if ($email)
       {
          $email->is_delete = 1;
          $email->save();
       }
       return false;
   }

}
