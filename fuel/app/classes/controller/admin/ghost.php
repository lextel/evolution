<?php
class Controller_Admin_Ghost extends Controller_Admin{
    public function action_index() {
    }
    
    public function action_add() {
        $title = '';
        $url = '';
        return View::forge('admin/ghost/create');;
    }


}
