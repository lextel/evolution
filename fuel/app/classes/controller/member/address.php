<?php
class Controller_Member_Address extends Controller_Center{

     //public $template = 'memberlayout';
     /*
    *获得当前收货地址列表
    */
    public function action_index()
    {
        $address = Model_Member_Address::find_by('member_id', $this->current_user->id);
        $view = ViewModel::forge('member/address', 'view');
        $view->set('list', $address, false);
        $this->template->title = '用户修改收获地址';
        $this->template->layout->content = $view;
    }

    /*
    *获得当前快递地址return json
    */
    public function action_view($id=null)
    {
        if (is_null($id))
        {
            Response::redirect('/u/address');
        }
        $response = new Response();
        $response->set_header('Content-Type', 'application/json');
        $data = ['code'=>-1, 'msg'=>'address_id is valid'];
        $address = Model_Member_Address::find($id,
                                                       [
                                                       'select' => ['id', 'postcode', 'address', 'name', 'mobile'],
                                                       'where' => ['member_id'=>$this->current_user->id]
                                                       ]);
        if ($address)
        {
            $data['code'] = 0;
            $data['msg'] = 'OK';
            $data['address'] = $address->to_array();
            $data['address']['address'] = unserialize( $data['address']['address']);
         }
        return $response->body(json_encode($data));
    }

    /*
    *添加快递地址
    */
    public function action_add()
    {
        if (!Input::method() == 'POST')
        {
            Response::redirect('/u/address');
        }
        $address[] = Input::post('province');
        $address[] = Input::post('city');
        $address[] = Input::post('county');
        $address[] = Input::post('address');
        $myaddress = Model_Member_Address::forge([
            'member_id' => $this->current_user->id,
            'address' => serialize($address),
            'postcode' => Input::post('postcode'),
            'mobile' => Input::post('phone'),
            'name' =>  Input::post('name'),
            'rate' => 0,
            'is_delete' => 0]
            );
        $myaddress -> save();
        Response::redirect('/u/address');
    }

    /*
    *更新用户快递地址
    */
    public function action_edit($id)
    {
        !Input::method() == 'POST' and Response::redirect('/u/address');
        $val = Model_Member_Address::validate('edit');
        if ($val->run())
        {
            $post = Model_Member_Address::find_by('member_id', $this->current_user->id);
            if (!$post)
            {
                $post = Model_Member_Address::add($this->current_user->id);
            }
            $post->address = Input::post('address');
            if ($post and $post->save())
            {
                Session::set_flash('success', e('修改地址成功, '));
                Response::redirect('/u');
            }
        }
        $this->template->set_global('error', '修改地址失败，请核对输入');
        Response::redirect('/u/address');
    }
    /*
    *删除用户快递地址
    */
    public function action_delete($id)
    {
       if ($post = Model_Member_Address::find($id, ['where'=>['is_delete'=>0]]))
        {
            $post->is_delete = 1;
            $post->save();
            Session::set_flash('info', e('删除成功'));
        }
        else
        {
            Session::set_flash('info', e('删除失败'));
        }
        Response::redirect('u/address');
     }
}
?>
