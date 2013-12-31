<?php
class Controller_Comment extends Controller_Rest{
    /*
    *获得晒单的评论列表
    */
    public $format = 'json';
    public function action_index($pid=null, $pagenum=1)
    {
        $this->response->set_header('Content-Type','application/json');
        $data = ['code'=>-1, 'msg'=>'pid is null'];
        is_null($pid) and $this->response($data);
        $count = Model_Comment::count(['where'=>['pid'=>$pid]]);
        $page = new \Helper\Page();
        $config = $page->setAjaxConfig('cpage', $count, $pagenum);
        $pagination = Pagination::forge('commentpage', $config);

        $response = new Response();
        $comments = Model_Comment::find('all', [
                                'where'=>['pid'=>$pid],
                                'order_by' =>['id'=>'desc'],
                                'rows_limit'=>$pagination->per_page,
                                'rows_offset'=>$pagination->offset,]);
        if ($comments)
        {
            foreach($comments as $c)
            {
                $member = Model_Member::find($c->member_id);
                $data['list'][] = ["member"=>[
                    'id'=>$c->id,
                    'userid'=>$c->member_id,
                    'avatar'=>$member->avatar,
                    'nickname'=>$member->nickname,
                    'text'=>$c->text,
                    'date'=>$c->created_at]
                    ];
            }
            $data['page'] =Pagination::instance('commentpage')->render();
            $data['code'] = 0;
            $data['msg'] = 'ok';
            return $this->response($data);
        }
        $data['code'] = -1;
        $data['msg'] = 'pid is valid';
        return $this->response($data);
    }
}
