<?php
class Controller_V2admin_Giftgame extends Controller_V2admin{

    public function action_index()
    {
        $breads = [
                ['name' => '用户管理', 'href' => Uri::create('v2admin')],
                ['name' => '乐淘奖品', 'href' => Uri::create('v2admin/gift')],
                ['name' => '乐淘游戏列表', 'href' => Uri::create('v2admin/giftgame')],
            ];

        $total = Model_Giftgame::count();
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/giftgame');

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);
        $games = Model_Giftgame::find('all', ['where'=>['is_delete' => 0],
                            'order_by' => ['id' => 'desc'],
                            'rows_limit' => $pagination->per_page,
                            'rows_offset' => $pagination->offset]);
        $view = View::forge('v2admin/giftgames/index');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set('games', $games);
        $view->set('pagination', $pagination);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "用户管理 > 乐淘奖品 > 乐淘游戏列表";
        $this->template->content = $view;

    }

    public function action_create()
    {
        if (Input::method() == 'GET')
        {
            $breads = [
                ['name' => '用户管理'],
                ['name' => '乐淘奖品'],
                ['name' => '添加游戏'],
            ];
            $this->template->title = "用户管理 > 乐淘奖品 > 添加游戏";
            $breadcrumb = new Helper\Breadcrumb();
            $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
            $this->template->content = View::forge('v2admin/giftgames/create');
            return;
        }
        $val = Model_Giftgame::validate('create');
        if ($val->run()){
            $name = Input::post('name');
            $game = new Model_Giftgame([
                'name' => $name,
                'status' => 0,
                'is_delete' => 0,
            ]);
            if ($game and $game->save()){
                Model_Log::add('添加 乐淘奖品游戏 #'.$game->id);
                Session::set_flash('success', e('添加 乐淘奖品游戏 成功'));
            }
            Session::set_flash('success', e('添加 乐淘奖品游戏 成功'));
            Response::redirect('v2admin/giftgame');
        }
        Session::set_flash('error', e('保存失败'));
        Response::redirect('v2admin/giftgame/create');        
    }


    public function action_delete($id = null)
    {
        Session::set_flash('error', e('不存在 #'.$id));
        if ($game = Model_Giftgame::find($id))
        {
            $game->is_delete = -1;
            $game->save();
            Model_Log::add('删除 乐淘奖品游戏 #'.$id);
            Session::set_flash('success', e('删除 乐淘奖品游戏 #'.$id));
        }
        Response::redirect('v2admin/gift');

    }


}
