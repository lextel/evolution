<?php
class Model_Item extends \Orm\Model {

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
        'reason',
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

        $where = $this->handleWhere($options, true);
        $orderBy = $this->handleOrderBy($options);

        $phases = Model_Phase::query()->where($where)->order_by($orderBy)->get();

        $limit = \Helper\Page::PAGESIZE;
        $offset = ($options['page'] - 1) * $limit;
        $phases = array_slice($phases, $offset, $limit);

        $items = [];
        foreach($phases as $key => $phase) {
            $items[] = $this->itemInfo($phase);
        }

        return $items;
    }

    /**
     * 上一期获奖者
     *
     * @param $item object 当前期信息
     *
     * @return array 上一期信息
     */
    public function prevWinner($item) {

        $phaseId = $item->phase->phase_id -1;
        $where = ['item_id' => $item->id, ['phase_id', '=', $phaseId], ['member_id', '!=', 0]];
        $orderBy = ['phase_id' => 'desc'];

        return Model_Phase::find('first', ['where' => $where, 'order_by' => $orderBy]);
    }

    /**
     * 统计期数
     *
     * @param $id integer 商品ID
     *
     * @return integer
     */
    public function phaseCountByid($id) {

        return Model_Phase::count(['where' => ['item_id' => $id]]);
    }

    /**
     * 期数信息
     *
     * @param $get array GET数据
     *
     * @return array
     */
    public function phases($get) {

        if(!isset($get['page']) && !isset($get['itemId'])) return [];

        $offset = ($get['page'] - 1)*\Helper\Page::PAGESIZE;

        $where   = ['item_id' => $get['itemId']];
        $orderBy = ['id' => 'desc']; 

        $phases = Model_Phase::find('all', ['where' => $where, 'order_by' => $orderBy, 'offset' => $offset, 'limit' => \Helper\Page::PAGESIZE]);

        $data = [];
        foreach($phases as $phase) {
            if($phase->member_id) {
                $member = Model_Member::find($phase->member_id);
                $data[] = [
                        'phase'    => Html::anchor(Uri::create('w/'.$phase->id), "第{$phase->phase_id}期"),
                        'code'     => $phase->code,
                        'total'    => $phase->code_count,
                        'member'   => Html::anchor(Uri::create('u/'.$member->id), $member->nickname),
                        'opentime' => date('Y-m-d H:i:s', $phase->opentime),
                    ];
            } elseif($phase->opentime) {
                $data[] = [
                        'phase' => Html::anchor(Uri::create('m/'.$phase->id), "第{$phase->phase_id}期"), 
                        'opentime' =>date('Y-m-d H:i:s', $phase->opentime)
                        ];
            } else {
                $data[] = ['phase' => Html::anchor(Uri::create('m/'.$phase->id), "第{$phase->phase_id}期")];
            }
        }

        return $data;

    }

    /**
     * 后台列表
     *
     * @param $get array GET参数
     *
     * @return array 商品列表
     */
    public function lists($get) {

        $get['page'] = isset($get['page']) ? $get['page'] : 1;

        $where = $this->handleWhere($get, false);
        $query = Model_Phase::query();
        if(!empty($where)) {
            $query->where($where);
        }

        $query->order_by(['id' => 'desc']);
        $phases = $query->get();

        $limit = \Helper\Page::PAGESIZE;
        $offset = ($get['page'] - 1) * $limit;
        $phases = array_slice($phases, $offset, $limit);

        $items = [];
        foreach($phases as $key => $phase) {
            $items[] = $this->itemInfo($phase);
        }

        return $items;
    }

    /**
     * 审核
     * 
     * @param $id   integer 商品ID
     * @param $post array post数据
     *
     * @return boolean 是否操作成功
     */
    public function check($id, $post) {

        $item = Model_Item::find($id);
        $item->status = $post['status'];
        $item->reason = $post['reason'];
        $rs = $item->save();

        DB::update('phases')->value('status', $post['status'])
                            ->where('item_id', $id)
                            ->execute();

        return $rs;
    }

    /**
     * 快速审核通过
     *
     * @param $id integer 商品ID
     *
     * @return boolean 是否审核成功
     */
    public function pass($id) {

        $item = Model_Item::find($id);
        $item->status = \Helper\Item::IS_CHECK;
        $rs = $item->save();

        DB::update('phases')->value('status', \Helper\Item::IS_CHECK)
                            ->where('item_id', $item->id)
                            ->execute();

        return $rs;
    }

    /**
     * 快速审核不通过
     *
     * @param $id integer 商品ID
     *
     * @return boolean 是否审核成功
     */
    public function notPass($id) {

        $item = Model_Item::find($id);
        $item->status = \Helper\Item::NOT_PASS;
        $rs = $item->save();

        DB::update('phases')->value('status', \Helper\Item::NOT_PASS)
                            ->where('item_id', $item->id)
                            ->execute();

        return $rs;
    }


    /**
     * 处理后台列表类型
     *
     * @param $type string 类型
     *
     *
     * @return array ['名称', '筛选条件数组']
     */
    public function handleType($type, $get) {

        $name = '';
        switch ($type) {
            case 'uncheck':
                $name = '待审核商品';
                $get['status'] = \Helper\Item::NOT_CHECK;
                break;
            case 'active':
                $name = '进行中商品';
                $get['status'] = \Helper\Item::IS_CHECK;
                break;
            case 'open':
                $name = '已揭晓商品';
                $get['opentime'] = \Helper\Item::IS_OPEN;
                break;
            case 'unpass':
                $name = '审核不通过';
                $get['status'] = \Helper\Item::NOT_PASS;
                break;
        }

        return [$name, $get];
    }

    /**
     * 处理前台URL
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
     * 统计前台url参数个数
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
     * @param $options     筛选条件 & 排序条件
     * @param $isFrontEnd  是否是前台
     *
     * @return integer
     */
    public function countItem($options, $isFrontEnd) {

        $itemModel = new Model_Item();
        $where = $itemModel->handleWhere($options, $isFrontEnd);

        $query = Model_Phase::query()->where($where);

        return $query->count();
    }

    /**
     * 解析options获得where条件
     *
     * @param $options     筛选条件 & 排序条件
     * @param $isFrontEnd  是否是前台调用
     *
     * @return array where && where
     */
    public function handleWhere($options, $isFrontEnd) {

        $where  = [];

        // 分类
        if(isset($options['cateId']) && !empty($options['cateId'])) {
            $where += ['cate_id' => $options['cateId']];
        }

        // 品牌
        if(isset($options['brandId']) && !empty($options['brandId'])) {
            $where += ['brand_id' => $options['brandId']];
        }

        // 标题
        if(isset($options['title']) && !empty($options['title'])) {
            $where += [['title', 'LIKE', '%'.$options['title'].'%']];
        }

        // 发布时间
        if(isset($options['start']) && isset($options['end'])) {
            $where += [['item_created_at', '>=', strtotime($options['start'])]];
            $where += [['item_created_at', '<=', strtotime($options['end'])]];
        }

        // 商品状态
        if(isset($options['status']) && $options['status'] !== '') {
            $where += ['status' => $options['status']];
        }

        if($isFrontEnd) {
            $where += [
                    'status'    => \Helper\Item::IS_CHECK,
                    ];
        }

        if(!isset($options['opentime'])) {
            $where += ['opentime' => \Helper\Item::NOT_OPEN];
        } else {
            $where += [['opentime', '>', 0]];
        }

        
        $where += ['is_delete' => \Helper\Item::NOT_DELETE];

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

        $phase->hots = $phase->hots+1;
        $phase->save();

        return $item;
    }

    /**
     * 获取商品信息
     *
     * @param $phase   object 单个期数对象
     *
     * @return obj 带期数的商品对象
     *             $item->phase
     */
    public function itemInfo($phase) {

        $item = [];
        if($phase) {
            $item = Model_Item::find($phase->item_id);
            if($item) {
                $item->phase = $phase;
            }
        }

        return $item;
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
              'title'     => $post['title'],
              'desc'      => $post['desc'],
              'price'     => $post['price'],
              'cate_id'   => $post['cate_id'],
              'brand_id'  => $post['brand_id'],
              'image'     => $image,
              'images'    => serialize($post['images']),
              'status'    => \Helper\Item::NOT_CHECK,
              'reason'    => '',
              'is_delete' => \Helper\Item::NOT_DELETE,
            ];

        $item = new Model_Item($data);

        $result = false;
        if ($item && $item->save()) {
            $phaseModel = new Model_Phase();
            $phaseModel->add($item);
            $result = true;
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

        $image = $post['images'][0];
        $item = Model_Item::find($id);

        $result = false;
        $item->title    = $post['title'];
        $item->desc     = $post['desc'];
        $item->price    = $post['price'];
        $item->cate_id  = $post['cate_id'];
        $item->brand_id = $post['brand_id'];
        $item->image    = $image;
        $item->images   = serialize($post['images']);

        if ($item->save()) {
            $result = true;
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

        $result = false;
        if ($item = Model_Item::find($id)) {
            $item->is_delete = \Helper\Item::IS_DELETE;
            $item->save();

            DB::update('phases')->value('is_delete', \Helper\Item::IS_DELETE)
                                ->where('item_id', $item->id)
                                ->execute();
            $result = true;
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
        }

        return $rs;
    }

    /**
     * 编辑器上传图片
     *
     * @param $file $_FILES 一维数组
     * 
     * @return array 上传的文件数组
     */
    public function editorUpload() {

        $upload = new Classes\Upload('editor');
        $success = $upload->upload();

        $rs = [];
        if($success) {
            $rs = $upload->getFiles();
        }

        return $rs;
    }

}
