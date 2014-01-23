<?php

class Controller_Help extends Controller_Frontend
{

    public function before(){
        parent::before();
        $this->template->layout = View::forge('help/layout');
    }
    // 新手指南
    public function action_page($page = 'new')
    {
        Config::load('common');
        $pagesMap = Config::get('helppages');
        if (!array_key_exists($page, $pagesMap)){
            Response::redirect('404');
        }
        $pageInfo = $pagesMap[$page];
        $this->template->title = $pageInfo['title'];
        $this->template->layout->content = View::forge($pageInfo['page']);
    }

}
