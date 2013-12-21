<?php
class Controller_Comment extends Controller_Template{

    public function action_index($pid=null, $page=0)
    {
        var_dump($pid);
        //is_null($pid) and Response::redirect('');
        $data['comments'] = Model_Comment::find_by('pid', $pid);
        $this->template->title = "Comments";
        $this->template->content = View::forge('comment/index', $data);
    }
}
