<?php
class Model_Item extends \Orm\Model {

    /**
     * @def 商品上架状态
     */
    const ON_SELF = 1;

    /**
     * @def 商品下架状态
     */
    const OFF_SELF = 0;

    /**
     * @def 在任务列表
     */
    const IN_TASK = 1;

    /**
     * @def 编辑成员标志
     */
    const EDITER = 1;

    /**
     * @var related
     */
    protected static $_has_many = array('phases');

    protected static $_properties = array(
        'id',
        'title',
        'image',
        'images',
        'desc',
        'price',
        'cate_id',
        'status',
        'in_task',
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
     * @param $post array 表单数据
     *
     * @return boolean 是否添加成功
     */
    public function add($post) {

        $image = $post['images'][0];
        $data = [
              'title'   => $post['title'],
              'desc'    => $post['desc'],
              'price'   => $post['price'],
              'cate_id' => $post['cate_id'],
              'image'   => $image,
              'images'  => serialize($post['images']),
              'status'  => self::OFF_SELF,
              'in_task' => 0
            ];

        $item = new Model_Item($data);

        $result = false;
        if ($item and $item->save()) {
            $phaseModel = new Model_Phase();
            $phaseModel->add($item->id);
            $result = true;
        }

        // 如果是编辑复制到临时表
        $group = Auth::get('group');
        if($group == self::EDITER) {
            $this->_checkTask($item->id);

            $data['id'] = $item->id;
            $sditem = new Model_Sditem($data);
            $result = false;
            if($sditem && $sditem->save()) {
                $this->_addTask($item->id, 'add');
                $result = true;
            }
        }

        return $result;
    }

    /**
     * 商品编辑
     *
     * @param $id   integer 商品ID
     * @param $post array   表单数据
     *
     * @return boolean 是否更新成功
     */
    public function edit($id, $post) {

        $group = Auth::get('group');
        $image = $post['images'][0];
        $item = Model_Item::find($id);
        $result = false;
        if($group == self::EDITER) {
            $this->_checkTask($item->id);

            $data = [
                  'title'   => $post['title'],
                  'desc'    => $post['desc'],
                  'price'   => $post['price'],
                  'cate_id' => $post['cate_id'],
                  'image'   => $image,
                  'images'  => serialize($post['images']),
                  'status'  => $item->status,
                ];

            $sditem = new Model_Sditem($data);
            if ($sditem and $sditem->save()) {
                $this->_addTask($item->id, 'edit');
                $result = true;
            }

        } else {

            $item->title   = $post['title'];
            $item->desc    = $post['desc'];
            $item->price   = $post['price'];
            $item->cate_id = $post['cate_id'];
            $item->image   = $image;
            $item->images  = serialize($post['images']);

            if ($item->save()) {
                $result = true;
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

        $group = Auth::get('group');
        $result = false;
        if($group == self::EDITER) {
            $this->_checkTask($id);
            $this->_addTask($item->id, 'remove');
            $result = true;
        } else {
            if ($item = Model_Item::find($id)) {
                $item->delete();
                $result = true;
            }
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
    public function operate($id, $operate) {
        
        $status  = $operate == 'up' ? 1 : 0;

        $group = Auth::get('group');
        if($group == self::EDITER) {
            $this->_checkTask($id);
            $this->_addTask($id, $operate);
        } else {
            $item = Model_Item::find($id);
            $item->status = $status;
            $item->save();

            $phaseModel = new Model_Phase();
            $phaseModel->add($item->id);
        }


        $data = ['status' => 'success', 'operate' => $operate == 'up' ? 'down' : 'up'];

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
     *                      up     上架
     *                      down   下架
     *
     * @return void
     */
    private function _addTask($id, $type) {

        $item = Model_Item::find($id);
        $item->in_task = self::IN_TASK;
        $item->save();

        $action = $this->_handleType($type);
        $taskModel = new Model_Task();

        $config = Config::load('common');

        $taskModel->noticeAll($action, Config::get('taskType.item.typeId'), $id);
    }

    /**
     * 检查工作流
     *
     * @param $id integer 商品ID
     * 
     * @return void
     */
    private function _checkTask($id) {

        $item = Model_Item::find('first', ['where' => ['id' => $id], 'select' => ['in_task']]);

        if($item['in_task']) {
            Session::set_flash('success', e('商品#'.$id.'任务正在处理中, 不可操作'));
            Response::redirect('admin/items');
        }
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
