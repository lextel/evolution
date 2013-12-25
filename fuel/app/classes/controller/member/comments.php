<?php

class Controller_Member_Comments extends Controller_Center
{

    public function action_add($pid=null)
    {
        $response = new Response();
        $data = ['code'=>-1, 'msg'=>'Mehtod is error'];
        if (!(Input::method() == 'POST'))
        {
           return $response->body(json_encode($data));
        }
        $data['msg'] = 'pid is null';
        is_null($pid) and $response->body(json_encode($data));
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
                $data['code'] = 0;
                $data['msg'] = 'ok';
                return $response->body(json_encode($data));
            }
        }
        $data['msg'] = 'data is error';
        return $response->body(json_encode($data));
    }

}
