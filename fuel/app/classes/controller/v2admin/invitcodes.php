<?php
class Controller_V2admin_Invitcodes extends Controller_V2admin{

    // 管理员列表
    public function action_index() {

        $breads = [
                ['name' => '用户管理'],
                ['name' => '礼品码'],
            ];
        $get = Input::get();
        $codeModel = new Model_Invitcode();
        $total = $codeModel->countCode($get);
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/invitcodes',['code' => Input::get('code')],
                ['code' => ':code']);

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $view = ViewModel::forge('v2admin/invitcodes/index');
        $breadcrumb = new Helper\Breadcrumb();

        $offset = $pagination->offset;
        $limit = $pagination->per_page;

        $codes = $codeModel->lists($get, $offset, $limit);
        $view->set('codes', $codes);
        $view->set('pagination', $pagination);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "用户管理 > 礼品码";
        $this->template->content = $view;
    }

    // 生成礼品码
    public function action_create($num = 0) {

        if(empty($num) || !preg_match('/^\d+$/', $num)) {
            Session::set_flash('error', e('请输入生成数量'));
            Response::redirect('v2admin/invitcodes');
        }
        $award = intval(Input::get("award", 0));
        if (!preg_match('/^\d{1,3}$/', $award)){
            Session::set_flash('error', e('请输入奖励元宝数'));
            Response::redirect('v2admin/invitcodes');
        }

        //导入默认奖励配置
        Config::load('common');
        //$addPoints = Config::get('point') * Config::get('inviteCodeAddPoints');
        $addPoints = $award ? $award : Config::get('inviteCodeAddPoints');
        $ids = [];
        for($i=0; $i<$num; $i++) {
            $code = Str::random('alnum', 8);
            $data = [
                'code' => $code,
                'member_id' => 0,
                'status' => 0,
                'is_delete' => 0,
                'award' => $addPoints,
                ];

            $code = new Model_Invitcode($data);
            $code->save();
            $ids[] = $code->id;
        }

        Model_Log::add('生成礼品码 #ID:' . implode(',', $ids));
        Session::set_flash('success', e('生成成功'));
        Response::redirect('v2admin/invitcodes');

    }

    // 删除礼品码
    public function action_delete($id = null) {

        $invitcodeModel = new Model_Invitcode();
        if ($invitcodeModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }
        Response::redirect('v2admin/invitcodes');
    }
    //打开页面
    public function action_outcodes(){
        $view = View::forge('v2admin/invitcodes/outcsv');
        $breadcrumb = new Helper\Breadcrumb();
        $breads = [
                ['name' => '用户管理'],
                ['name' => '礼品码'],
                ['name' => '批量导出'],
            ];
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "用户管理 > 礼品码 > 批量导出";
        $this->template->content = $view;
    }


    //批量导出礼品码
    public function action_outcsvfile(){
        $startId = intval(Input::get('startId', 0));
        $endId = intval(Input::get('endId', 0));
        if ((empty($startId) && empty($endId)) || ($endId < $startId)) return Response::redirect('v2admin/invitcodes');
        $codes = Model_Invitcode::find('all',
                ['where' => [['id', '<=', $endId],
                ['id', '>=', $startId], 'status' => '0', 'is_delete' => '0']]);
        $datas = [];
        foreach($codes as $i=>$code){
            $datas[] = [$i, $code->code];
        }
        $csv = new Classes\Csv;
        $date = date('Ymd');
        $csvFileName = $date . '_' . $startId . '_' . $endId . '.xls';
        return $csv->output($csvFileName, $datas);
    }
    /*
    // 修改礼品码的奖励
    public function action_modifyAward($id = null) {
        $res = ['code'=>0, 'msg'=>'数据为空'];
        //检测空
        if (is_null($id)) return json_encode($res);
        $invitcode = Model_Invitcode::find('first', ['where' => ['is_delete' => 0, 'id'=>$id]]);
        if (empty($invitcode)) return json_encode($res);
        //检测格式
        $val = Validation::forge();
        $val->add_field('award', 'award', 'required|valid_string[numeric]');
        if (!$val->run()) return json_encode($res);
        //保存更新
        $award = Input::post('award', 0);
        try{
            $invitcode->award = $award;
            $invitcode->save();
            $res['code'] = 1;
            $res['msg'] = '修改成功';
            Model_Log::add('修改礼品码 #' . $id);
        } catch (Exception $e) {
            Log::error('修改奖励失败#'.$id.$e->getMessage());
            $res['msg'] = '修改失败';
        }
        return json_encode($res);
    }
    */

}
