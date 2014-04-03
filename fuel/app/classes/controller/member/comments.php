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
        $post = Model_Post::find($pid);
        if (!$post || is_null($pid)){
            $data['msg'] = 'pid is null';
            return $response->body(json_encode($data));
        }

        $val = Model_Comment::validateComment('create');
        if ($val->run())
        {
            $comment = Model_Comment::forge([
                'member_id' => $this->current_user->id,
                'text' => Input::post('text'),
                'pid' => $pid,
                'status'=>1,
                'is_delete'=>0,
                'item_id'=>$post->item_id,
            ]);
            if ($comment and $comment->save())
            {
                $post->comment_count +=1;
                $post->save();
                $data['code'] = 0;
                $data['msg'] = 'ok';
                $data['member']['date'] = \Helper\Timer::friendlyDate($comment->created_at);
                $data['member']['text'] = Input::post('text');
                $member = Model_Member::find($this->current_user->id);
                $data['member']['userid'] = $member->id;
                $data['member']['avatar'] =  \Helper\Image::showImage($member->avatar, '60x60');
                $data['member']['nickname'] = $member->nickname;
                return $response->body(json_encode($data));
            }
        }
        $data['msg'] = 'data is error';
        return $response->body(json_encode($data));
    }

}
