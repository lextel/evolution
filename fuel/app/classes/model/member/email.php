<?php
use Orm\Model;

class Model_Member_Email extends Model
{
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

    public static function add($key)
    {

    }

    public static function sendEmail($email){
        $key = self::hash_email($email);

       //$send =  \Classes\Email::send($email);
       return $key;
    }

    public static function hash_email($email)
    {
        Config::load('common');
        $email = Crypt::encode(md5($email), Config::get('email_key'));
        return $email;
    }

}
