<?php
class Controller_Member_Address extends Controller_Center{

     //public $template = 'memberlayout';
     /*
    *获得当前收货地址列表
    */
    public function action_index()
    {
        $address = Model_Member_Address::find('all', ['where'=>['is_delete'=>0, 'member_id'=>$this->current_user->id]]);
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
            $data['address']['address'] = unserialize($data['address']['address']);
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
        $val = Model_Member_Address::validate('edit');
        if ($val->run())
        {
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
            $address = Model_Member_Address::find($id, ['where'=>['is_delete'=>0]]);
            if (!$address){
                 Session::set_flash('error', (', '));
                Response::redirect('/u');
            }
            $addresstmp[] = Input::post('province');
            $addresstmp[] = Input::post('city');
            $addresstmp[] = Input::post('county');
            $addresstmp[] = Input::post('address');
            $address->address = serialize($addresstmp);
            $address->postcode = Input::post('postcode');
            $address->name = Input::post('name');
            $address->mobile = Input::post('phone');
            if ($address->save()){
                Session::set_flash('success', ('修改地址成功, '));
                Response::redirect('/u/address');
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

     /*
    *设置成用户默认地址，只能有1个默认地址
    */
    public function action_default($id)
    {
        $data = ['code'=>0, 'msg'=>'ok'];
        if ($post = Model_Member_Address::find($id, ['where'=>['is_delete'=>0, 'rate'=>0]]))
        {
            $check = Model_Member_Address::find('all', ['where'=>['is_delete'=>0, 'rate'=>100]]);
            if (!$check){
                $post->rate = 100;
                $post->save();
                return json_encode($data);
            }
        }
        $data['code'] = -1;
        return json_encode($data);
     }

     /*
    *取消默认地址，只能默认地址转变成非默认地址
    */
    public function action_undefault($id)
    {
        $data = ['code'=>0, 'msg'=>'ok'];
        if ($post = Model_Member_Address::find($id, ['where'=>['is_delete'=>0, 'rate'=>100]]))
        {
            $post->rate = 0;
            $post->save();
            return json_encode($data);
        }
       $data['code'] = -1;
       return json_encode($data);
   }
}
?>
