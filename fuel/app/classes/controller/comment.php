<?php
class Controller_Comment extends Controller_Rest{
    /*
    *获得晒单的评论列表
    */
    public function action_index($pid=null, $page=1)
    {
        $this->response->set_header('Content-Type','application/json');
        $data = ['code'=>-1, 'msg'=>'pid is null'];
        is_null($pid) and $this->response(json_encode($data));
        $count = Model_Comment::count(['where'=>['pid'=>$pid]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/comment/'.$pid.'/p', $count, 4, 4);
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
                $data['list'][] = [
                    'id'=>$c->id,
                    'member_id'=>$c->member_id,
                    'text'=>$c->text,
                    'created_at'=>$c->created_at];
            }
            $data['code'] = 0;           
            $data['msg'] = 'ok';
            return $this->response(json_encode($data));
        }
        $data['code'] = -1;
        $data['msg'] = 'pid is valid';
        return $this->response(json_encode($data));
    }
}
