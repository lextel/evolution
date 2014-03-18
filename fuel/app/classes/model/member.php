<?php
class Model_Member extends \Classes\Model
{
    protected static $_properties = array(
        'id',
        'username',
        'password',
        'type',
        'nickname',
        'avatar',
        'bio',
        'mobile',
        'points',
        'last_login',
        'ip',
        'email',
        'login_hash',
        'profile_fields',
        'is_disable',
        'is_delete',
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
     * 冻结会员列表
     *
     * @param $options array 筛选条件
     *
     * @return array 会员数据
     */
    public function black($options) {

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
     * 统计马甲会员

     *
     * @param $options array 筛选条件
     *
     * @return integer 数量
     */
    public function countGhost($options) {

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

        if(isset($options['is_disable']) && $options['is_disable'] !== '') {
            $where += ['is_disable' => $options['is_disable']];
        }

        if(isset($options['nickname']) && !empty($options['nickname'])) {
            $where += [['nickname', 'LIKE', '%'.$options['nickname']. '%']];
        }

        if(isset($options['email']) && !empty($options['email'])) {
            $where += [['email', 'LIKE', '%'.$options['email']. '%']];
        }
        
        if(isset($options['type']) && !empty($options['type'])) {
            $where += ['type' => $options['type']];
        }

        $where += ['is_delete' => 0];

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
        $val->add_field('nickname', '', 'required|min_length[3]|max_length[18]');
        return $val;
    }
    
    
    /*
    * 检测用户登陆协议
    */
    public static function validateSignin($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('username', '用户名|邮箱', 'required|valid_email');            
        $val->add_field('password', '用户密码', 'required|min_length[6]|max_length[18]');
        return $val;
    }
    
    /*
    * 检测马甲用户字段
    */
    public static function validateGhost($factory)
    {
        $val = Validation::forge($factory);
        $val->add_callable(new \Classes\MyRules());
        $val->add_field('username', '用户邮箱', 'required|valid_email|max_length[256]|unique[members.username]');
        $val->add_field('nickname', '用户昵称', 'required|max_length[25]|min_length[3]|unique[members.nickname]');
        $val->add_field('password', '用户密码', 'required|max_length[255]|min_length[6]');        
        $val->add_field('avatar', '用户头像', 'required');
        $val->add_field('bio', '用户签名', 'required');
        $val->add_field('created_at', '用户注册日期', 'required');
        $val->add_field('ip', '用户注册IP', 'required');
        return $val;
    }
    
    /*
    * 检测编辑马甲用户字段
    */
    public static function validateGhostEdit($factory)
    {
        $val = Validation::forge($factory);
        $val->add_callable(new \Classes\MyRules());
        $val->add_field('password', '用户密码', 'required|max_length[255]|min_length[6]');        
        $val->add_field('avatar', '用户头像', 'required');
        $val->add_field('bio', '用户签名', 'required');
        $val->add_field('created_at', '用户注册日期', 'required');
        $val->add_field('ip', '用户注册IP', 'required');
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
     * 上传CSV
     *
     * @param $file $_FILES数组
     *
     * @reutrn array 上传的文件数组

     */
    public static function  uploadcsv() {
        $upload  = new Classes\Upload('mutilcsv');
        $success = $upload->upload();
        $rs = [];
        if($success) {
            $rs =  $upload->getFiles();
        }
        return $rs;
    }
    
    /**
     * 冻结用户
     *
     * @param $id integer 用户ID
     *
     * @return boolean 是否成功
     */
    public function disable($id) {

        $result = false;
        if ($member = Model_Member::find($id)) {
            $member->is_disable = 1;
            $member->save();

            Model_Log::add('冻结会员 #' . $member->id);
            $result = true;
        }

        return $result;
    }

    /**
     * 解冻用户
     *
     * @param $id integer 用户ID
     *
     * @return boolean 是否成功
     */
    public function enable($id) {

        $result = false;
        if ($member = Model_Member::find($id)) {
            $member->is_disable = 0;
            $member->save();

            Model_Log::add('解冻会员 #' . $member->id);
            $result = true;
        }

        return $result;
    }

    /**
     * 删除
     *
     * @param $id integer 用户ID
     *
     * @return boolean 是否成功
     */
    public function remove($id) {

        $result = false;
        if ($member = Model_Member::find($id)) {
            $member->is_delete = 1;
            $member->save();

            Model_Log::add('删除会员 #' . $member->id);
            $result = true;
        }

        return $result;
    }

    /**
     * 随机获取一个马甲
     *
     */
    public function randGhost() {

        return DB::query('SELECT id FROM `members` where type = 1 order by rand() limit 1')->execute()->as_array();
    }
    
    /*
    * 加密方式
    */
    public static function aes64($input) {
        
        $output = base64_encode($input);
        return $output;
    }
    
    /*
    * 解密方式
    */
    public static function des64($input) {
        $output = base64_decode($input);
        return $output;
    }
    
}
