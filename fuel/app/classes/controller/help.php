<?php

class Controller_Help extends Controller_Frontend
{

    // 新手指南
    public function action_new()
    {
        $this->template->title = '新手指南';
        $this->template->layout = View::forge('help/new');
    }

}
