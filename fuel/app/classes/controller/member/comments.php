<?php

class Controller_Member_Comments extends Controller_Center
{

    public function action_add($pid=null)
    {
        $response = new Response();
        $response->set_header('Content-Type', 'application/json');
        $data = ['code'=>-1, 'msg'=>'Mehtod is error'];
        if (!(Input::method() == 'POST'))
        {
           return $response->body(json_encode($data));
        }
        $data['msg'] = 'pid is null';
        is_null($pid) and $response->body(json_encode($data));
        $val = Model_Comment::validateComment('create');
        if ($val->run())
        {
            $comment = Model_Comment::forge(array(
                'member_id' => $this->current_user->id,
                'text' => Input::post('text'),
                'pid' => $pid,
                'status'=>0,
                'is_deleted'=>0,
            ));
            if ($comment and $comment->save())
            {
                $post = Model_Post::find($pid);
                $post->comment_count +=1;
                $post->save();
                $data['code'] = 0;
                $data['msg'] = 'ok';
                $data['member']['date'] = \Helper\Timer::friendlyDate($comment->created_at);
                $data['member']['text'] = Input::post('text');
                $member = Model_Member::find($this->current_user->id);
                $data['member']['userid'] = $member->id;
                $data['member']['avatar'] = $member->avatar;
                $data['member']['nickname'] = $member->nickname;
                return $response->body(json_encode($data));
            }
        }
        $data['msg'] = 'data is error';
        return $response->body(json_encode($data));
    }

}
