<?php
class Model_Item extends \Orm\Model {

    const OFF_SELF  = 0;      // 下架
    const ON_SELF   = 1;      // 上架
    const ITEM_TASK = 1;      // 商品工作流类型

    protected static $_properties = array(
        'id',
        'title',
        'image',
        'images',
        'desc',
        'price',
        'cate_id',
        'status',
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

    public static function validate($factory)    {
        $val = Validation::forge($factory);
        $val->add_field('title', '标题', 'required|max_length[255]');
        $val->add_field('images', '图片', 'required');
        $val->add_field('desc', '描述', 'required');
        $val->add_field('price', '价格', 'required|valid_string[numeric]');
        $val->add_field('cate_id', '分类', 'required|valid_string[numeric]');

        return $val;
    }

    /**
     * 添加商品
     *
     * @return boolean 是否添加成功
     */
    public function add() {

        $val = $this->validate('create');

        $result = false;
        if ($val->run()) {
            $image = Input::post('images')[0];
            $data = [
                  'title' => Input::post('title'),
                  'desc' => Input::post('desc'),
                  'price' => Input::post('price'),
                  'cate_id' => Input::post('cate_id'),
                  'image' => $image,
                  'images' => serialize(Input::post('images')),
                  'status' => self::OFF_SELF,
                ];

            $item = new Model_Item($data);

            if ($item and $item->save()) {
                Session::set_flash('success', e('添加成功 #'.$item->id.'.'));
                $this->_addTask($item->id, 'add');
                $result = true;
            } else {
                Session::set_flash('error', e('保存失败.'));
            }
        } else {
            Session::set_flash('error', $val->error());
        }

        return $result;
    }

    /**
     * 商品编辑
     *
     * @param $id integer 商品ID
     *
     * @return boolean 是否更新成功
     */
    public function edit($id) {

        $item = Model_Item::find($id);
        $val  = Model_Item::validate('edit');

        $result = false;
        if ($val->run()) {
            $image = Input::post('images')[0];
            $item->title = Input::post('title');
            $item->desc = Input::post('desc');
            $item->price = Input::post('price');
            $item->cate_id = Input::post('cate_id');
            $item->image = $image;
            $item->images = serialize(Input::post('images'));

            if ($item->save()) {
                Session::set_flash('success', e('更新成功 #' . $id));
                $this->_addTask($item->id, 'edit');
                $result = true;
            } else {
                Session::set_flash('error', e('更新失败 #' . $id));
            }
        } else {
            if (Input::method() == 'POST') {
                $item->title = $val->validated('title');
                $item->desc = $val->validated('desc');
                $item->price = $val->validated('price');
                $item->cate_id = $val->validated('cate_id');
                $item->images = $val->validated('images');

                Session::set_flash('error', $val->error());
            }
        }

        return $result;
    }

    /**
     * 商品删除
     *
     * @param $id integer 商品ID
     *
     * @return boolean 是否成功
     */
    public function remove($id) {

        if ($item = Model_Item::find($id)) {
            $item->delete();
            Session::set_flash('success', e('删除成功 #'.$id));
            $this->_addTask($item->id, 'remove');
            $result = true;
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
            $result = false;
        }

        return $result;
    }

    /**
     * 上传商品图片
     *
     * @param $file $_FILES数组
     *
     * @reutrn array 上传的文件数组
     */
    public function upload() {

        $upload  = new Classes\Upload('item');
        $success = $upload->upload();

        $rs = [];
        if($success) {
            $rs =  $upload->getFiles();
            $image = new Classes\Image();
            foreach($rs as $key => $val) {
                $rs[$key]['path'] = $this->thumb($val['path'], '60x60');
                $rs[$key]['image'] = $image->path2url($val['path']);
            }
        }

        return $rs;
    }

    /**
     * 缩略图
     *
     * @param $path string 图片路径
     * @param $size string 大小 60x60
     *
     * @return 返回缩略图路径
     */
    public function thumb($path, $size) {

        $image = new Classes\Image();
        $link = $image->path2url($path);
        $thumb = $image->resize($link, $size);

        return $thumb;
    }

    /**
     * 上下架操作
     *
     * @return array 返回ajax结果
     */
    public function operate() {
        
        $id = Input::post('id', 0);

        $operate = Input::post('operate', 'down');
        $status  = $operate == 'up' ? 1 : 0;

        $item = Model_Item::find($id);
        $item->status = $status;
        $item->save();

        $this->_addTask($id, $operate);

        $data = ['status' => 'success', 'operate' => $status == 1 ? 'down' : 'up'];

        return $data;
    }

    /**
     * 工作流
     *
     * @param $id   integer 商品ID
     * @param $type string  操作类型
     *                      add    添加
     *                      edit   编辑
     *                      remove 删除
     *
     * @return void
     */
    private function _addTask($id, $type) {

        $action = $this->_handleType($type);
        $taskModel = new Model_Task();
        $taskModel->add($action, self::ITEM_TASK, $id);
    }

    /**
     * 处理任务action
     * 
     * @param $type string 任务类型
     *
     * @return string 操作名称
     */
    private function _handleType($type) {

        switch ($type) {
            case 'add':
                $action = '添加';
                break;
            case 'edit':
                $action = '编辑';
                break;
            case 'remove':
                $action = '删除';
                break;
            case 'up':
                $action = '上架';
                break;
            case 'down':
                $action = '下架';
                break;
            default :
                $action = '未知操作';
                break;
        }

        return $action;
    }

}
