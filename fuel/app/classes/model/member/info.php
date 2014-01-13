<?php

class Model_Member_Info extends \Classes\Model
{
    //protected static $_table_name = 'member_infos';

    protected static $_properties = array(
        'id',
        'member_id',
        'nickname',
        'local',
        'address',
        'gender',
        'birth',
        'qq',
        'horoscope',
        'salary',
        'created_at',
        'updated_at',
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );


    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('nickname', '', 'required|max_length[255]');
        $val->add_field('local', '', 'required');
        $val->add_field('gender', '', 'required');
        return $val;
    }

   /*
   *检测是否存在用户数据
   */
   public static function checkInfo($memberid)
   {
       $member = Model_Member_Info::find_by_member_id($memberid);
       if (!$member)
       {
            $member = $this->add($memberid);
       }
       return $member;
   }

   /*
   *给用户信息一个默认的值
   */
   public static function add($memberid)
    {
        $val = Model_Member_Info::forge([
                'member_id'=>$memberid,
                'nickname'=>'',
                'local'=>'',
                'address'=>'',
                'gender'=>'',
                'birth'=>'',
                'qq'=>'',
                'horoscope'=>'',
                'salary'=>'',
            ]);
        $val->save();
        $post = Model_Member_Info::find_by_member_id($memberid);
        return $post;
    }
}
