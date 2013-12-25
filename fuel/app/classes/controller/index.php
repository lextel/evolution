<?php

class Controller_Index extends Controller_Frontend {

    public function action_index() {

        $this->template->title = '乐乐淘';
        $this->template->layout = View::forge('index/index');
    }

}
