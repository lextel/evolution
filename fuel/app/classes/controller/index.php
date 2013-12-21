<?php

class Controller_Index extends Controller_Template {

    public function action_index() {

        $this->template->title = '乐乐淘';
        $this->template->content = View::forge('index/index');
    }

}
