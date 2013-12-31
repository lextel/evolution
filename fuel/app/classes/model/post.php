<?php
class Model_Post extends \Orm\Model
{

    /**
     * @def 已审核
     */
    const IS_PASS    = 1;

    /**
     * @def 已删除
     */
    const IS_DELETE  = 1;

    /**
     * @def 未删除
     */
    const NOT_DELETE = 0;


    //protected static $_belongs_to = array('user', 'item', 'phase');
    protected static $_table_name = 'posts';

    protected static $_properties = array(
        'id',
        'title',
        'desc',
        'status',
        'item_id',
        'member_id',
        'type_id',
        'phase_id',
        'lottery_id',
        'created_at',
        'updated_at',
        'topimage',
        'images',
        'up',
        'comment_count',
        'comment_top',
        'is_delete',
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
        $val->add_field('title', 'Title', 'required|max_length[255]');
        $val->add_field('desc', 'Desc', 'required');
        $val->add_field('status', 'Status', 'required|valid_string[numeric]');
        $val->add_field('item_id', 'Item Id', 'required|valid_string[numeric]');
        $val->add_field('member_id', 'Member Id', 'required|valid_string[numeric]');
        $val->add_field('type_id', 'Type Id', 'required|valid_string[numeric]');
        $val->add_field('phase_id', 'Phase Id', 'required|valid_string[numeric]');
        $val->add_field('topimage', 'Topimage', 'required');
        $val->add_field('images', 'Images', 'required');
        return $val;
    }

    /**
     * 统计商品的晒单数目
     *
     * @param $itemId integer 商品ID
     *
     * @return integer
     */
    public function countByItemId($itemId) {

        $where = ['item_id' => $itemId, 'status' => self::IS_PASS, 'is_delete' => self::NOT_DELETE];

        return Model_Post::count(['where' => $where]);
    }


    /**
     * 商品详情晒单列表
     *
     * @param $get array get参数
     *
     * @return array
     */
    public function posts($get) {

        if(!isset($get['page']) && !isset($get['itemId'])) return [];

        $offset = ($get['page'] - 1)*\Helper\Page::PAGESIZE;

        $where   = ['item_id' => $get['itemId'], 'status' => self::IS_PASS, 'is_delete' => self::NOT_DELETE];
        $orderBy = ['id' => 'desc']; 

        $posts = Model_Post::find('all', ['where' => $where, 'order_by' => $orderBy, 'offset' => $offset, 'limit' => \Helper\Page::PAGESIZE]);

        foreach($posts as $key => $post) {
            $member = Model_Member::find($post->member_id);
            $posts[$key] = [
                    'title' => $post->title,
                    'desc'  => $post->desc,
                    'images' => unserialize($post->images),
                    'up' => $post->up,
                    'count' => $post->comment_count,
                    'link' => Uri::create('u/'.$member->id),
                    'avatar' => Uri::create($member->avatar),
                    'nickname' => $member->nickname,
                    'created_at' => date('Y-m-d H:i:s', $post->created_at),
                ];
        }

        return $posts;

    }

}
