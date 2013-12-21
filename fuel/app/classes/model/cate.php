<?php
class Model_Cate extends \Orm\Model
{
    const NOT_DELETE = 0;
    const NO_PARENT  = 0;

    protected static $_properties = array(
        'id',
        'parent_id',
        'name',
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
        $val->add_field('name', 'Name', 'required|max_length[255]');

        return $val;
    }

    /**
     * 分类列表
     *
     * @param $options 列表参数
     *                 $options['offset']  // 分页偏移量
     *                 $options['limit']   // 每页记录数
     *
     * @return obj
     */
    public function getCates($options) {

        return Model_Cate::query()->where('is_delete', 0)
                                  ->where('parent_id', 0)
                                  ->offset($options['offset'])
                                  ->limit($options['limit'])
                                  ->order_by(['id' => 'desc'])
                                  ->get();
    }

    /**
     * 品牌列表
     *
     * @param $options 列表参数
     *                 $options['offset']  // 分页偏移量
     *                 $options['limit']   // 每页记录数
     *
     * @return obj
     */
    public function getBrands($options) {

        return Model_Cate::query()->where('is_delete', 0)
                                  ->where('parent_id', '>', 0)
                                  ->offset($options['offset'])
                                  ->limit($options['limit'])
                                  ->order_by(['id' => 'desc'])
                                  ->get();
    }

    /**
     * 统计分类
     *
     * @return integer 数量
     */
    public function countCate() {

        return Model_Cate::query()->where('is_delete', 0)
                                  ->where('parent_id', 0)
                                  ->count();
    }

    /**
     * 统计品牌
     *
     * @return integer 数量
     */
    public function countBrand() {

        return Model_Cate::query()->where('is_delete', 0)
                                  ->where('parent_id', '>', 0)
                                  ->count();
    }

    /**
     * 添加分类
     *
     * @param $post array post数据
     *
     * @return boolean 是否成功
     */
    public function addCate($post) {

        $data = [
            'parent_id' => self::NO_PARENT,
            'name'      => $post['name'],
            'is_delete' => self::NOT_DELETE,
            ];

        $cate = new Model_Cate($data);

        $result = false;
        if($cate && $cate->save()) {
            $result = true;
        }

        return $result;
    }


}
