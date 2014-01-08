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
    
    /**
     * 会员列表
     *
     * @param $options array 筛选条件
     *
     * @return array 会员数据
     */
    public function index($options) {

        $condition = [];
        $condition['where'] = $this->handleWhere($options);

        if(isset($options['offset']) && isset($options['limit'])) {

            $condition['offset'] = $options['offset'];
            $condition['limit']  = $options['limit'];
        }

        $condition['order_by'] = ['id' => 'desc'];

        return Model_Member::find('all', $condition);
    }

    /**
     * 统计会员
     *
     * @param $options array 筛选条件
     *
     * @return integer 数量
     */
    public function countMember($options) {

        $where = $this->handleWhere($options);

        return Model_Member::count(['where' => $where]);
    }

    /**
     * 处理where条件
     *
     * @param $options array 筛选条件
     *
     * @return array where数组
     */
    public function handleWhere($options) {

        $where = [];
        if(isset($options['member_id']) && $options['member_id'] !== '') {
            $where += ['id' => $options['member_id']];
        }

        if(isset($options['nickname']) && !empty($options['nickname'])) {
            $where += [['nickname', 'LIKE', '%'.$options['nickname']. '%']];
        }

        if(isset($options['email']) && !empty($options['email'])) {
            $where += [['email', 'LIKE', '%'.$options['email']. '%']];
        }

        // $where += ['is_delete' => 0];

        return $where;
    }




    public static function validateProfile($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('nickname', '', 'required');
        $val->add_field('mobile', '', '');
        $val->add_field('bio', '', '');
        return $val;
    }

    public static function validateAvatar($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('avatar', '', 'required');
        return $val;
    }

    public static function validateNickname($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('nickname', '', 'required');
        return $val;
    }

    /*
    *add money points
    */
    public static function addMoney($member_id, $sum)
    {
        $member = Model_Member::find($member_id);
       if(!$member){
           return false;
       }
       $member-> points += intval($sum);
       if ($member->save()){
        return true;
       }
       return false;
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

    /**
     * 上传用户图片
     *
     * @param $file $_FILES数组
     *
     * @reutrn array 上传的文件数组
     */
    public static function  upload() {
        $upload  = new Classes\Upload('avatar');
        $success = $upload->upload();
        $rs = [];
        if($success) {
            $rs =  $upload->getFiles();
        }
        return $rs;
    }

    /**
     * 批量获取用户信息
     *
     * @param $ids     array 会员IDs
     * @param $select  array 获取的字段
     *
     * @return array
     */
    public static function byIds($ids, $select = []) {

        $members = Model_Member::find('all', ['select' => $select, 'where' => [['id', 'IN', $ids]]]);
        $memberInfo = [];
        foreach($members as $member) {
            $memberInfo[$member->id] = $member;
        }

        return $memberInfo;
    }
}
