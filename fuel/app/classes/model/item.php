<?php
class Model_Item extends \Orm\Model {

    /**
     * @def 编辑成员标志
     */
    const EDITER = 1;

    /**
     * @def 未删除
     */
    const NOT_DELETE = 0;

    /**
     * @def 已审核
     */
    const CHECK_PASS = 1;

    /**
     * @def 未开奖
     */
    const NOT_OPEN = 0;

    /**
     * @var related
     */
    protected static $_has_many = ['phases', 'lotteries'];

    /**
     * @var 定义模型属性
     */
    protected static $_properties = array(
        'id',
        'title',
        'image',
        'images',
        'desc',
        'price',
        'cate_id',
        'brand_id',
        'status',
        'is_delete',
        'created_at',
        'updated_at',
    );

    /**
     * @var 定义事件
     */
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

    /**
     * 验证设置
     */
    public static function validate($factory)    {
        $val = Validation::forge($factory);
        $val->add_field('title', '标题', 'required|max_length[255]');
        $val->add_field('images', '图片', 'required');
        $val->add_field('desc', '描述', 'required');
        $val->add_field('price', '价格', 'required|valid_string[numeric]');
        $val->add_field('cate_id', '分类', 'required|valid_string[numeric]');
        $val->add_field('brand_id', '品牌', 'required|valid_string[numeric]');

        return $val;
    }

    /**
     * 首页列表
     *
     * @param $options 筛选条件 & 排序条件
     *
     * @return array 商品列表
     */
    public function index($options = []) {

        $itemModel = new Model_Item();
        $where = $itemModel->handleWhere($options);
        $orderBy = $itemModel->handleOrderBy($options);

        $phases = Model_Phase::query()->where($where)->order_by($orderBy)->get();

        $limit = \Helper\Page::PAGESIZE;
        $offset = ($options['page'] - 1) * $limit;
        $phases = array_slice($phases, $offset, $limit);

        $items = [];
        foreach($phases as $key => $phase) {
            $items[] = $itemModel->itemInfo($phase);
        }

        return $items;
    }


    /**
     * 处理URL
     *
     * @param $options array 筛选条件
     *
     * @return string URL
     */
    public function handleUrl($options) {

        $url = '/m';
        foreach ($options as $key => $val) {
            if($key == 'cateId' && !empty($val)) {
                $url .= '/c/'.$val;
            }

            if($key == 'brandId' && !empty($val)) {
                $url .= '/b/'.$val;
            }
            
            if($key == 'sort' && !empty($val)) {
                $url .= '/s/'.$val;
            }
        }

        return Uri::create($url);
    }

    /**
     * 统计url参数个数
     *
     * @param $options array 筛选条件
     *
     * @return integer
     */
    public function countParam($options) {

        $count = 0;
        foreach($options as $key => $val) {
            if(!empty($val)) {
                $count+=2;
            }
        }

        return $count+1;
    }


    /**
     * 统计商品数目
     *
     * @param $options 筛选条件 & 排序条件
     *
     * @return integer
     */
    public function countItem($options) {

        $itemModel = new Model_Item();
        $where = $itemModel->handleWhere($options);

        $query = Model_Phase::query()->where($where);

        return $query->count();
    }

    /**
     * 解析options获得where条件
     *
     * @param $options 筛选条件 & 排序条件
     *
     * @return array where && where
     */
    public function handleWhere($options) {

        $where  = [];

        if(isset($options['cateId']) && !empty($options['cateId'])) {
            $where += ['cate_id' => $options['cateId']];
        }

        if(isset($options['brandId']) && !empty($options['brandId'])) {
            $where += ['brand_id' => $options['brandId']];
        }

        $where += [
                'is_delete' => self::NOT_DELETE,
                'status'    => self::CHECK_PASS,
                'opentime'  => self::NOT_OPEN,
                ];

        return $where;
    }

    /**
     * 解析options排序获取排序
     *
     * @param $options array 筛选条件
     *
     * @return array
     */
    public function handleOrderBy($options) {

        $sort = $options['sort'];

        $orderBy = ['remain' => 'desc'];
        if($sort) {
            Config::load('sort');
            $sorts = Config::get('item');

            $sortArr = [];
            foreach($sorts as $val) {
                $key = isset($val['alias']) ? $val['alias'] : $val['field'];
                $sortArr[$key] = $val['field'];
            }

            $sort = explode('_', $sort);
            $orders = ['asc', 'desc'];
            if(isset($sort[1]) && in_array($sort[1], $orders)) {
                $orderBy = [$sortArr[$sort[0]] => $sort[1]];
            }
        }

        return $orderBy;
    }

    /**
     * 商品详情
     *
     * @param $phaseId integer 期数ID
     *
     * @return array 商品数据
     */
    public function view($phaseId) {

        $phase = Model_Phase::find($phaseId);
        $itemModel = new Model_Item();
        $item = $itemModel->itemInfo($phase);

        return $item;
    }

    /**
     * 获取商品信息
     *
     * @param $phase   object 单个期数对象
     * @param $options array  筛选条件
     *
     * @return obj 带期数的商品对象
     *             $item->phase
     */
    public function itemInfo($phase, $options = []) {

        $item = [];
        if($phase) {
            $where = [
                'id'        => $phase->item_id, 
                'is_delete' => self::NOT_DELETE, 
                'status'    => self::CHECK_PASS
               ];
            if($options) {
                list($where, ) = $this->handleWhere($options);
                $where = $where + $where;
            }
            $item = Model_Item::find('first', ['where' => $where]);
            if($item) {
                $item->phase = $phase;
            }
        }

        return $item;
    }

    /**
     * 上一期获奖者
     *
     * @param $id integer 商品ID
     *
     * @return array 上一期信息
     */
    public function prevWinner($id) {

        return Model_Item::find('last', ['related' => 'lotteries', 'where' => ['lotteries.item_id' => $id]]);
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
     * 编辑器上传图片
     *
     */
    public function editorUpload() {
        $upload = new Classes\Upload('item');
        $success = $upload->upload();

        $rs = [];
        if($success) {
            $rs = $upload->getFiles();
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
