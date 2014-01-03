<?php
class Controller_Notice extends Controller_Frontend{

    public function action_index()
    {
        $data['notices'] = Model_Notice::find('all',
                        ['where'=>['is_delete'=>0],
                        'order_by'=>['is_top', 'id'],
                        'lows_limit'=>'10'
                        ]);
        $this->template->title = "乐乐淘公告列表页";
        $this->template->layout = View::forge('notice/index', $data);

    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('notice');

        if ( ! $data['notice'] = Model_Notice::find($id))
        {
            Session::set_flash('error', 'Could not find notice #'.$id);
            Response::redirect('notice');
        }

        $this->template->title = "Notice";
        $this->template->content = View::forge('notice/view', $data);

    }
}
