<?php

class Model_Friend extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'mid',
        'fid',
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

    protected static $_table_name = 'friends';

    /**
     * 好友列表
     */
    public static function myFriends($mid) {
        $rs = Model_Friend::find('all', ['where' => ['mid' => $mid]]);
        return $rs;
    }

    /**
     * 检查是否已经关注
     *
     * @param $mid integer 用户ID
     *
     * @return boolean 是否已关注
     */
    public static function check($mid, $fid) {
        $rs = Model_Friend::find('first', ['where' => ['mid' => $mid, 'fid' => $fid]]);
        return !empty($rs);
    }

    /**
     * 关注用户
     *
     * @param $mid integer 用户ID
     *
     * @return boolean 是否成功
     */
    public static function follow($mid, $fid) {
        $data = ['mid' => $mid, 'fid' => $fid];
        $friend = new Model_Friend($data);
        return $friend->save();
    }

    /**
     * 取消关注
     *
     * @param $mid integer 用户ID
     *
     * @return boolean 是否成功
     */
    public static function unfollow($mid, $uid) {
        $friends = Model_Friend::find('first', ['where' => ['mid' => $mid, 'fid' => $fid]]);
        return $friends->delete();
    }

}
