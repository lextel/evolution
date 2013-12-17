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
    public function myFriends() {
        
        list(, $myId) = Auth::get_user_id();

        $rs = Model_Friend::find('all', ['where' => ['mid' => $myId]]);

        return $rs;
    }

    /**
     * 检查是否已经关注
     *
     * @param $mid integer 用户ID
     *
     * @return boolean 是否已关注
     */
    public function check($mid) {

        list(, $myId) = Auth::get_user_id();

        $rs = Model_Friend::find('first', ['where' => ['mid' => $myId, 'fid' => $mid]]);

        return !empty($rs);
    }

    /**
     * 关注用户
     *
     * @param $mid integer 用户ID
     *
     * @return boolean 是否成功
     */
    public function follow($mid) {

        list(, $myId) = Auth::get_user_id();
        $data = ['mid' => $myId, 'fid' => $mid];

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
    public function unfollow($mid) {

        list(, $myId) = Auth::get_user_id();
        $friends = Model_Friend::find('first', ['where' => ['mid' => $myId, 'fid' => $mid]]);

        return $friends->delete();
    }

}
