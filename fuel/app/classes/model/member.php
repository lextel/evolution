<?php
class Model_Member extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'username',
        'password',
        'nickname',
        'avatar',
        'bio',
        'mobile',
        'points',
        'last_login',
        'email',
        'login_hash',
        'profile_fields',
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
        $val->add_field('username', 'Username', 'required|max_length[255]');
        $val->add_field('password', 'Password', 'required|max_length[255]');
        $val->add_field('nickname', 'Nickname', 'required|max_length[255]');
        $val->add_field('avatar', 'Avatar', 'required|max_length[255]');
        $val->add_field('bio', 'Bio', 'required|max_length[255]');
        $val->add_field('mobile', 'Mobile', 'required|max_length[255]');
        $val->add_field('points', 'Points', 'required|valid_string[numeric]');
        $val->add_field('last_login', 'Last Login', 'required|valid_string[numeric]');
        $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
        $val->add_field('login_hash', 'Login Hash', 'required|max_length[255]');
        $val->add_field('profile_fields', 'Profile Fields', 'required');

        return $val;
    }
    /*
    *检测用户昵称
    */
    public static function checkNickname($nickname)
    {
        $member = Model_Member::find_by_nickname($nickname);
        if (!$member)
        {          
            return true;
        }       
        return false;
    }
    /*
    *更新用户昵称
    */
    public static function updateNickname($member_id, $nickname, $bio)
    {
        $member = Model_Member::find_by_id($member_id);
        $member->nickname = $nickname;
        $member->bio = $bio;
        return $member->save();
    }
  
}
