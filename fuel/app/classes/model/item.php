<?php
class Model_Item extends \Orm\Model {

    const OFF_SELF = 0;

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

                Session::set_flash('error', $val->error());
            }
        }

        return $result;

    }


    /**
     * 上传商品图片
     *
     * @param $file $_FILES数组
     *
     * @reutrn array 
     */
    public function upload() {

        $upload  = new Helper\Upload('item');
        $success = $upload->upload();

        $rs = [];
        if($success) {
            $rs =  $upload->getFiles();
            $image = new Helper\Image();
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
     * @return $link string
     */
    public function thumb($path, $size) {

        $image = new Helper\Image();
        $link = $image->path2url($path);
        $thumb = $image->resize($link, $size);

        return $thumb;
    }

}
