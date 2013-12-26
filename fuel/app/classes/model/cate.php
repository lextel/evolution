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
    public function getCates($options = []) {

        $query = Model_Cate::query();
        $query->where('is_delete', 0)
              ->where('parent_id', 0);

        if(isset($options['offset'])) {
            $query->offset($options['offset']);
        }

        if(isset($options['limit'])) {
            $query->limit($options['limit']);
        }

        $query->order_by(['id' => 'desc']);

        return $query->get();
    }

    /**
     * 获取分类一维数组
     *
     * @return array
     */
    public function cates() {

        $cates = $this->getCates();

        $data = [];
        foreach($cates as $cate) {
            $data[$cate->id] = $cate->name;
        }

        return $data;
    }

    /**
     * 品牌列表
     *
     * @param $options 列表参数
     *                 $options['parentId'] // 分类ID
     *                 $options['offset']   // 分页偏移量
     *                 $options['limit']    // 每页记录数
     *
     * @return obj
     */
    public function getBrands($options = []) {

        $query = Model_Cate::query();

        $query->where('is_delete', 0);

        if(isset($options['parentId'])) {
            $query->where('parent_id', $options['parentId']);
        } else {
            $query->where('parent_id', '>', 0);
        }

        if(isset($options['offset'])) {
            $query->offset($options['offset']);
        }

        if(isset($options['limit'])) {
            $query->limit($options['limit']);
        }

        $query->order_by(['id' => 'desc']);

        return $query->get();
    }

    /**
     * 根据分类获取品牌
     *
     * @param $id integer 分类ID
     *
     * @return array
     */
    public function brands($id) {
        
        $brands =  $this->getBrands(['parentId' => $id]);

        $data = [];
        foreach($brands as $brand) {
            $data[$brand->id] = $brand->name;
        }

        return $data;
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

    /**
     * 添加品牌
     *
     * @param $post array post数据
     *
     * @return boolean 是否成功
     */
    public function addBrand($post) {

        $data = [
                'parent_id' => $post['parent_id'],
                'name'      => $post['name'],
                'is_delete' => self::NOT_DELETE,
            ];

        $brand = new Model_Cate($data);
        $result = false;
        if($brand && $brand->save()) {
            $result = true;
        }

        return $result;
    }


}
