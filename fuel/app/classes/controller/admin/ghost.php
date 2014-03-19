<?php
class Controller_Admin_Ghost extends Controller_Admin{
    /*
    *
    */
    public function action_index() {
        Response::redirect('admin/ghost/lists');
    }
    
    /*
    * 特殊用户列表
    */
    public function action_lists() {
        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '马甲列表', 'href'=> Uri::create('admin/ghost')],
            ];

        $get = Input::get();
        $get['type'] = 1;
        $memberModel = new Model_Member();
        $total = $memberModel->countGhost($get);
        $page = new \Helper\Page();
        $url = Uri::create('admin/ghost', 
                ['member_id' => Input::get('member_id'), 'nickname' => Input::get('nickname'), 'email' => Input::get('email')], 
                ['user_id' => ':user_id', 'nickname' => ':nickname', 'email' => ':email']);

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);


        $view = View::forge('admin/ghost/index');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        
        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;
        $view->set('members', $memberModel->index($get));
        $this->template->title = "会员列表 > 用户管理";
        $this->template->content = $view;

    }
    
    /*
    *添加特殊用户
    */
    public function action_create() {
        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '马甲列表', 'href' => Uri::create('admin/ghost')],
                ['name' => '添加马甲'],
            ];

        $view = View::forge('admin/ghost/create');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('admin/ghost/add'));
        $this->template->title = "添加马甲";
        $this->template->content = $view;
    }
    
    /*
    *提交添加特殊用户
    */
    public function action_add() {
        $val = Model_Member::validateGhost('create');
        if ($val->run()) {
            $username = Input::post('username');
            $password = Input::post('password');
            $nickname = Input::post('nickname');
            $avatar = Input::post('avatar');
            $bio = Input::post('bio');
            $created_at = Input::post('created_at');
            $ip = Input::post('ip');
            try {
                $member = new Model_Member();
                $member->username = $username;
                $member->password = Model_Member::aes64($password);
                $member->email = $username;
                $member->nickname = $nickname;
                $member->avatar = $avatar;
                $member->mobile = '';
                $member->bio = $bio;
                $member->created_at = $created_at;
                $member->ip = $ip;
                $member->type = 1;
                $member->points = 0;
                $member->last_login = 0;
                $member->login_hash = 0;
                $member->is_disable = 0;
                $member->is_delete = 0;
                $member->profile_fields = '';
                $member->save();
                $user_id = $member->id;
                Session::set_flash('success', e('添加成功 #'.$user_id.'.'));
                Model_Log::add('添加马甲 #' . $user_id);
                Response::redirect('admin/ghost/lists');
            } catch (Exception $e) {
                Log::error($e);
                Session::set_flash('error', e('添加失败'));
            }
        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('valid_email', ':label 格式不正确.');
            $val->set_message('min_length', ':label 不能少于:param:1个字符.');
            $val->set_message('max_length', ':label 不能超过:param:1个字符.');
            $val->set_message('unique', ':label 已经存在');
            Session::set_flash('error', $val->show_errors());
        }

        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '马甲列表', 'href' => Uri::create('admin/ghost')],
                ['name' => '添加马甲'],
            ];
        $view = View::forge('admin/ghost/create');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('admin/ghost/add'));
        $this->template->title = "添加马甲";
        $this->template->content = $view;
    }
    
    /*
    *获得修改特殊用户
    */
    public function action_getedit($id = null) {
        if (is_null($id)){
           Response::redirect('_404_');
        }
        $member = Model_Member::find($id);
        if (!$member){
           Response::redirect('_404_');
        }
        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '马甲列表', 'href' => Uri::create('admin/ghost')],
                ['name' => '修改马甲'],
            ];
        $view = View::forge('admin/ghost/edit');
        $member->password = Model_Member::des64($member->password);
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('admin/ghost/edit/'.$member->id));
        $view->set_global('user', $member);
        $this->template->title = "修改马甲";
        $this->template->content = $view;
    }
    
    /*
    *提交修改特殊用户
    */
    public function action_edit($id = null) {
        if (is_null($id)){
           Response::redirect('_404_');
        }
        $member = Model_Member::find($id);
        if (!$member){
           Response::redirect('_404_');
        }
        $val = Model_Member::validateGhostEdit('edit');
        $nickname = trim(Input::post('nickname'));
        if ($nickname == $member->nickname){
            $val->add_field('nickname', '用户昵称', 'required|max_length[25]|min_length[3]');
        }else{
            $val->add_field('nickname', '用户昵称', 'required|max_length[25]|min_length[3]|unique[members.nickname]');
        }
        
        if ($val->run()) {
            $password = trim(Input::post('password'));          
            $avatar = trim(Input::post('avatar'));
            $bio = trim(Input::post('bio'));
            $created_at = trim(Input::post('created_at'));
            $ip = trim(Input::post('ip'));
            try {
                $member->password = Model_Member::aes64($password);
                $member->nickname = $nickname;
                $member->avatar = $avatar;
                $member->bio = $bio;
                $member->created_at = $created_at;
                $member->ip = $ip;
                $member->save();
                $user_id = $member->id;
                Session::set_flash('success', e('修改成功 #'.$user_id.'.'));
                Model_Log::add('修改马甲 #' . $user_id);
                Response::redirect('admin/ghost/lists');
            } catch (Exception $e) {
                Model_Log::error($e);
                Session::set_flash('error', e('修改失败'));
            }
        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('valid_email', ':label 格式不正确.');
            $val->set_message('min_length', ':label 不能少于:param:1个字符.');
            $val->set_message('max_length', ':label 不能超过:param:1个字符.');
            $val->set_message('unique', ':label 已经存在');
            Session::set_flash('error', $val->show_errors());
        }

        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '马甲列表', 'href' => Uri::create('admin/ghost')],
                ['name' => '修改马甲'],
            ];
        $view = View::forge('admin/ghost/edit');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('admin/ghost/edit/'.$member->id));
        $view->set_global('user', $member);
        $this->template->title = "修改马甲";
        $this->template->content = $view;
    }
    
    /*
    *特殊用户中奖名单
    */
    public function action_win() {
         $breads = [
                ['name' => '马甲管理'], 
                ['name' => '中奖列表', 'href'=> Uri::create('admin/ghost')],
            ];

        $get = Input::get();
        $get['type'] = 1;
        $memberModel = new Model_Member();
        $phaseModel = new Model_Phase();
        $members = $memberModel->index($get);
        list($memberIds,) = $memberModel->getIds($members, ['id']);
        
        $members = $memberModel->byIds($memberIds);
        $count = $phaseModel->byWinsIdsCount($memberIds, $get);
        $page = new \Helper\Page();
        $url = Uri::create('admin/ghost/win', 
                ['member_id' => Input::get('member_id'), 'nickname' => Input::get('nickname'), 'status' => Input::get('status')], 
                ['member_id' => ':member_id', 'nickname' => ':nickname', 'status' => ':status']);

        $config = $page->setConfig($url, $count, 'page');
        $pagination = Pagination::forge('mypagination', $config);
        
        $view = View::forge('admin/ghost/wins');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;
        $phases = $phaseModel->byWinsIds($memberIds, $get);
        $view->set('phases', $phases);
        $view->set('members', $members);
        $this->template->title = "马甲管理 > 中奖列表";
        $this->template->content = $view;
    }
    
    /*
    *强制登录
    */
    public function action_forcelogin($id=null){
        if (is_null($id)){
           Response::redirect('_404_');
        }
        $member = Model_Member::find($id);
        if (!$member){
           Response::redirect('_404_');
        }
        
        $auth = Auth::instance('Memberauth');
        if($auth->force_login($id)){
             Response::redirect('u');
        }
        Session::set_flash('error', e('登陆失败 #' . $id));
        Response::redirect('admin/ghost/lists');
    }
    
    /*
    *强制跳转到发表晒单列表
    */
    public function action_gopost($id=null){
        if (is_null($id)){
           Response::redirect('_404_');
        }
        $member = Model_Member::find($id);
        if (!$member){
           Response::redirect('_404_');
        }
        
        $auth = Auth::instance('Memberauth');
        if($auth->force_login($id)){
             Response::redirect('u/noposts');
        }
        Session::set_flash('error', e('登陆失败 #' . $id));
        Response::redirect('admin/ghost/lists');
    }
    
    /*
    *特殊用户假删除
    */
    public function action_delete($id=null){
        if (is_null($id)){
           Response::redirect('_404_');
        }
        $member = Model_Member::find($id);
        if (!$member){
           Response::redirect('_404_');
        }
        $memberModel = new Model_Member();
        if ($memberModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #' . $id));
        } else {
            Session::set_flash('error', e('删除失败 #' . $id));
        }

        Response::redirect('admin/ghost/lists');
    }

    // 在拍列表
    public function action_sell() {
        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '在拍列表'],
            ];

        $itemModel = new Model_Item();
        list(, $get) = $itemModel->handleType('active', Input::get());
        $total = $itemModel->countItem($get, false);


        $view = View::forge('admin/ghost/sell');

        $url = Uri::create('admin/ghost/sell');
        $page = new \Helper\Page();
        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $get += [
            'offset'=> $pagination->offset,
            'limit' => $pagination->per_page,
            ];

        $items = $itemModel->lists($get);
        $view->set('items', $items);
        $view->set('pagination', $pagination);
        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "马甲管理 > 在拍列表";
        $this->template->content = $view;
    }

    // 马甲拍下
    public function action_order($id = 0, $num = 0, $mid = 0) {
        Config::load('common');
        $timer = new \Helper\Timer();

        if($id == 0 || $num == 0) {
            return json_encode(['code' => 1, 'msg' => '参数错误']);
        }


        $memberModel = new Model_Member();
        if($mid == 0) {

            $member = $memberModel->randGhost();

            if(empty($member)) {
                return json_encode(['code' => 1, 'msg' => '还没有马甲，添加一个吧']);
            } else {
                $mid = $member[0]['id'];
            }
        }

        $member = Model_Member::find($mid);

        if($member->type == 0) {
            return json_encode(['code' => 1, 'msg' => '这个用户不是马甲']);
        }

        $member->points = $num * Config::get('point');
        $member->save();

        $orderModel = new Model_Order();
        $fetchCodes = $orderModel->buy($id, $num);

        $ip2area = new \Classes\Ip2area(APPPATH . 'qqwry.dat');
        $location = $ip2area->getlocation($member->ip);
        $location['area'] = iconv('GB2312','UTF-8//IGNORE', $location['area']);

        $phase = Model_Phase::find($id);
            $data = [
                'title'      => $phase->title,
                'phase_id'   => $id,
                'member_id'  => $mid,
                'codes'      => serialize($fetchCodes),
                'code_count' => count($fetchCodes),
                'ip'         => $member->ip,
                'area'       => $location['area'],
                'ordered_at' => $timer->millitime(),
                ];

            $orderModel = new Model_Order($data);
            if($orderModel->save()) {

                // 写消费日志
                $perPoint = count($fetchCodes) * Config::get('point');
                Model_Member_Moneylog::buy_log($mid, $perPoint, $id, count($fetchCodes));

                return json_encode(['code' => 0, 'msg' => '乐拍成功', 'data' => ['joined' => $phase->joined], 'codeNum' => count($fetchCodes), 'points' => $perPoint]);
            }

            return json_encode(['code' => 1, 'msg' => '乐拍失败']);
    }
    
    // 上传头像图片
    public function action_avatarUpload()
    {
        $files = Model_Member::upload();
        return json_encode(['files' => $files]);
    }
    // 批量页
    public function action_multi()
    {
        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '批量添加图片'],
            ];

        $view = View::forge('admin/ghost/multi');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('admin/ghost/multiUpload'));
        $this->template->title = "批量添加图片";
        $this->template->content = $view;
    }
    // 批量上传图片
    public function action_multiUpload()
    {
        $response = new Response();
        $response->set_header('Content-Type', 'application/json');
        $files = Model_Member::uploadmulti();
        return $response->body(json_encode(['files' => $files]));
    }
    
    // 导入CSV表格文件
    public function action_csvUpload()
    {
        $response = new Response();
        $response->set_header('Content-Type', 'application/json');
        $files = Model_Member::uploadmulti();
        if (!$files){
            return $response->body(json_encode(['files' => $files, 'msg'=>'格式错误']));
        }
        $csvfile = Model_Member::readcsv($files[0]['path']);
        $res = [];
        foreach($csvfile as $key=>$row){
            if (($key > 0) && Model_Member::checkCsv($row)){
                if (Model_Member::ADDghost($row)){
                   $res[] = $row[1];
                }
            }
        }
        return $response->body(json_encode(['files' => $files, 'msg'=>'上传成功', 'res'=>$res]));
    }
}
