<?php
class Controller_V2admin_Gift extends Controller_V2admin{

    public function action_index()
    {
        $breads = [
                ['name' => '用户管理'],
                ['name' => '乐淘奖品'],
            ];

        $total = Model_Gift::count(['where'=>['is_delete' => 0]]);
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/gift');

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);
        $codes = Model_Gift::find('all', ['where'=>['is_delete' => 0],
                                    'order_by'=>['id' => 'desc'],
                                    'rows_limit'=>$pagination->per_page,
                                    'rows_offset'=>$pagination->offset]);
        $view = ViewModel::forge('v2admin/gifts/index');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set('codes', $codes);
        $view->set('pagination', $pagination);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "用户管理 > 乐淘奖品";
        $this->template->content = $view;

    }


    public function action_create()
    {
        if (Input::method() == 'GET')
        {
            $breads = [
                ['name' => '用户管理'],
                ['name' => '乐淘奖品'],
                ['name' => '添加'],
            ];
            $games = Model_Giftgame::find('all', ['select' => ['id', 'name'], 'where' => ['is_delete' => 0]]);
            $gamesTmp = [];
            foreach($games as $game){
                $gamesTmp[$game->id] = $game->name;
            }
            $view = View::forge('v2admin/gifts/create');
            $this->template->set_global('games', $gamesTmp);
            $this->template->title = "用户管理 > 乐淘奖品 > 添加";
            $breadcrumb = new Helper\Breadcrumb();
            $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
            $this->template->content = $view;
            return;
        }
        $val = Model_Gift::validate('create');
        if ($val->run()){
            $codes = Input::post('codes');
            $game_ID = Input::post('game_ID');
            $end_time = Input::post('end_time');
            $codeArr = explode("\n", $codes);
            foreach($codeArr as $index){
                if (empty(trim($index))) continue;
                $gift = Model_Gift::forge([
                'project' => '',
                'code' => $index,
                'mark' => '',
                'status' => 0,
                'member_id' => 0,
                'member_code' => 0,
                'game_id' => $game_ID,
                'is_delete' => 0,
                'end_time' => strtotime($end_time),
                ]);

                if ($gift and $gift->save()){
                    Model_Log::add('添加 乐淘奖品 #'.$gift->id);
                    Session::set_flash('success', e('添加 乐淘奖品 成功'));
                }else{
                    Session::set_flash('error', e('保存失败'));
                }
            }
            Session::set_flash('success', e('添加 乐淘奖品 成功'));
            Response::redirect('v2admin/gift');
        }
        Session::set_flash('error', e('保存失败'));
        Response::redirect('v2admin/gift');
    }
    public function action_delete($id = null)
    {
        if ($gift = Model_Gift::find($id))
        {
            $gift->is_delete = -1;
            $gift->save();
            Model_Log::add('删除 乐淘奖品 #'.$id);
            Session::set_flash('success', e('删除 礼物 #'.$id));
        }
        else
        {
            Session::set_flash('error', e('不存在 #'.$id));
        }

        Response::redirect('v2admin/gift');

    }


}
