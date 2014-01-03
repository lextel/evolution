<?php

class Model_Ad extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'title',
        'zone',
        'type',
        'sort',
        'start_at',
        'end_at',
        'image',
        'link',
        'status',
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
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );
    protected static $_table_name = 'ads';

    /**
     * 验证设置
     */
    public static function validate($factory)    {
        $val = Validation::forge($factory);
        $val->add_field('title', '标题', 'required|max_length[255]');
        $val->add_field('zone', '区域', 'required');
        $val->add_field('image', '图片', 'required');
        $val->add_field('link', '超链接', 'required');
        $val->add_field('start_at', '开始时间', 'required');
        $val->add_field('end_at', '结束时间', 'required');
        $val->add_field('status', '启用状态', 'required');

        return $val;
    }

    /**
     * 首页广告
     *
     */
    public function indexAds() {
        return Model_ad::find('all', ['where' => ['zone' => 1, 'is_delete' => 0]]);
    }

    /**
     * 商品页广告
     *
     */
    public function  itemAds() {
        return Model_ad::find('all', ['where' => ['zone' => 2, 'is_delete' => 0]]);
    }

    /**
     * 上传广告图片
     *
     * @param $file $_FILES数组
     *
     * @reutrn array 上传的文件数组
     */
    public function upload() {

        $upload  = new Classes\Upload('ad');
        $success = $upload->upload();

        $rs = [];
        if($success) {
            $rs =  $upload->getFiles();

            Model_Log::add('上传广告图片 ' . $rs[0]['name']);
        }

        return $rs;
    }

    /**
     * 添加广告
     *
     * @param $post array 表单数据
     *
     * @return boolean 是否添加成功
     */
    public function add($post) {

        $data = [
              'title'     => $post['title'],
              'zone'      => $post['zone'],
              'type'      => $post['type'],
              'sort'      => $post['sort'],
              'start_at'  => strtotime($post['start_at']),
              'end_at'    => strtotime($post['end_at']),
              'image'     => $post['image'],
              'link'      => $post['link'],
              'status'    => $post['status'],
              'is_delete' => 0,
            ];

        $ad = new Model_Ad($data);

        $result = false;
        if ($ad && $ad->save()) {
            Model_Log::add('添加广告 #' . $ad->id);
            $result = true;
        }

        return $result;
    }

    /**
     * 广告编辑
     *
     * @param $id   integer 广告ID
     * @param $post array   表单数据
     *
     * @return boolean 是否更新成功
     */
    public function edit($id, $post) {

        $ad = Model_Ad::find($id);

        $result = false;
        $ad->title    = $post['title'];
        $ad->zone     = $post['zone'];
        $ad->type     = $post['type'];
        $ad->sort     = $post['sort'];
        $ad->start_at = strtotime($post['start_at']);
        $ad->end_at   = strtotime($post['end_at']);
        $ad->image    = $post['image'];
        $ad->link     = $post['link'];
        $ad->status   = $post['status'];

        if ($ad->save()) {
            Model_Log::add('编辑广告 #' . $ad->id);
            $result = true;
        }

        return $result;
    }

    /**
     * 广告删除
     *
     * @param $id integer 商品ID
     *
     * @return boolean 是否成功
     */
    public function remove($id) {

        $result = false;
        if ($ad = Model_Ad::find($id)) {
            $ad->is_delete = 1;
            $ad->save();

            Model_Log::add('删除广告 #' . $ad->id);
            $result = true;
        }

        return $result;
    }
    
}


