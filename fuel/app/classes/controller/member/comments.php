<?php

class Controller_Member_Comments extends Controller_Center
{

    public function action_create($pid=null)
    {
        !Input::method() == 'POST' and Response::redirect('');
        is_null($pid) and Response::redirect('');
        $val = Model_Comment::validate('create');
        if ($val->run())
        {
            $comment = Model_Comment::forge(array(
                'member_id' => $this->current_user->id,
                'text' => Input::post('text'),
                'pid' => $pid,
            ));
            if ($comment and $comment->save())
            {
                return;
            }
        }
    }

}