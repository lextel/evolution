<?php
class Model_Notice extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'user_id',
        'is_top',
        'title',
        'summary',
        'desc',
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
        $val->add_field('title', '标题', 'required|max_length[255]');
        $val->add_field('summary', '概要', 'required|max_length[255]');
        $val->add_field('desc', '内容', 'required');

        return $val;
    }

    /**
     * 公告列表
     *
     * @param $options array 筛选条件
     *
     * @return array 公告数据
     */
    public function index($options) {

        $condition = [];
        $condition['where'] = $this->handleWhere($options);

        if(isset($options['offset']) && isset($options['limit'])) {

            $condition['offset'] = $options['offset'];
            $condition['limit']  = $options['limit'];
        }

        $condition['order_by'] = ['id' => 'desc'];

        return Model_Notice::find('all', $condition);
    }

    /**
     * 添加公告
     *
     * @param $userId integer 用户ID
     * @param $post   array   post数据
     *
     * @return boolean 是否成功
     */
    public function add($userId, $post) {

        $data = [
            'title'     => $post['title'],
            'summary'   => $post['summary'],
            'desc'      => $post['desc'],
            'is_top'    => $post['is_top'],
            'user_id'   => $userId,
            'is_delete' => 0,
            ];

        $notice = Model_Notice::forge($data);

        $result = false;
        if($notice && $notice->save()) {
            Model_Log::add('添加公告 #' . $notice->id);
            $result = true;
        }

        return $result;
    }

    /**
     * 编辑公告
     *
     * @param $id   integer 公告ID
     * @param $post array post数据
     *
     * @return boolean 是否成功
     */
    public function edit($id, $post) {

        $notice = Model_Notice::find($id);

        $notice->title   = $post['title'];
        $notice->summary = $post['summary'];
        $notice->desc    = $post['desc'];
        $notice->is_top  = $post['is_top'];

        Model_Log::add('编辑公告 #' . $notice->id);

        return $notice->save();
    }

    /**
     * 删除公告
     *
     * @param $id integer 公告ID
     *
     * @return boolean 是否成功
     */
    public function remove($id) {

        $notice = Model_Notice::find($id);
        $notice->is_delete = 1;

        Model_Log::add('删除公告 #' . $notice->id);

        return $notice->save();
    }

    /**
     * 统计公告
     *
     * @param $options array 筛选条件
     *
     * @return integer 数量
     */
    public function countNotice($options) {

        $where = $this->handleWhere($options);

        return Model_Notice::count(['where' => $where]);
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
        if(isset($options['user_id']) && $options['user_id'] !== '') {
            $where += ['user_id' => $options['user_id']];
        }

        if(isset($options['title']) && !empty($options['title'])) {
            $where += [['title', 'LIKE', '%'.$options['title']. '%']];
        }

        $where += ['is_delete' => 0];

        return $where;
    }

    /**
     * 编辑器上传图片
     *
     * @param $file $_FILES 一维数组
     * 
     * @return array 上传的文件数组
     */
    public function editorUpload() {

        $upload = new Classes\Upload('notice');
        $success = $upload->upload();

        $rs = [];
        if($success) {
            $rs = $upload->getFiles();
            Model_Log::add('上传公告图片 ' . $rs[0]['name']);
        }

        return $rs;
    }

}
