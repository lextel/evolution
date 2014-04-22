<?php
class Controller_V2admin_Suggests extends Controller_V2admin{
    //反馈意见列表
    public function action_index()
    {        
        
        $type = [
            '0' => '所有',
            '1' => '投诉建议',
            '2' => '商品配送',
            '3' => '售后服务',
            ];
        $active = trim(Input::get('active', '0'));
        $status = Input::get('status', Null) == 0 ? Null : Input::get('status', Null);
        if ( $active == '0' ){
            $etype = ['status' => $status];
        } else {
            $etype = ['type' => $type[$active], 'status' => $status];
        }
        $page = new \Helper\Page();
        
        $url = Uri::create('v2admin/suggests', ['active'=>$active], ['active' => ':active']);
        $count = Model_Suggest::count(['where' => $etype]);
        $config = $page->setPagesizeConfig($url, $count, 'page', 10);
        $pagination = Pagination::forge('suggestpage', $config);
        $suggests = Model_Suggest::find('all', [
                                                  'where' => $etype,
                                                  'order_by' => array('id' => 'desc'),
                                                  'rows_limit' => $pagination->per_page,
                                                  'rows_offset' => $pagination->offset
                                                  ]
                                         );

        $breads = [['name' => '反馈列表']];

        $breadcrumb = new Helper\Breadcrumb();
        $view = View::forge('v2admin/suggests/index');
        $view->set('suggests', $suggests, false);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "反馈列表";
        $this->template->content = $view;
    }
    // 反馈意见详情
    public function action_view($id=null)
    {
        if (is_null($id)){
            return Response::redirect('/v2admin/suggests');
        }
        $suggest = Model_Suggest::find($id);
        $view = View::forge('v2admin/suggests/view');
        if (!$suggest){
            return Response::redirect('_404_');
        }
        $view->set('suggest', $suggest, false);
        $view->set('url', '/v2admin/suggests/pass/'.$id);
        $this->template->title = "反馈信息";
        $this->template->content = $view;
    }
    // 提交反馈意见
    public function action_pass($id=null)
    {
        if (is_null($id)){
            return Response::redirect('/v2admin/suggests');
        }
        if (!Input::method() == 'POST'){
            return Response::redirect('/v2admin/suggests/view/'.$id);
        }
        $suggest = Model_Suggest::find($id);
        if (!$suggest){
            return Response::redirect('_404_');
        }
        $status = trim(Input::post('status', '1'));
        if ($status == '1'){
            $suggest->status = 1;
            $suggest->save();
        }
        return Response::redirect('/v2admin/suggests');
    }
}
