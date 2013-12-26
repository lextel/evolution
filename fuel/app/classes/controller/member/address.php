<?php
class Controller_Member_Address extends Controller_Center{

     //public $template = 'memberlayout';
     /*
    *获得当前收货地址列表
    */
    public function action_index()
    {
        $address = Model_Member_Address::find_by('member_id', $this->current_user->id);
        $data['list'] = $address;
        $this->template->title = '用户修改收获地址';
        $this->template->layout->content = View::forge('member/myaddress', $data);
    }

    /*
    *获得当前快递地址
    */
    public function action_view($id=null)
    {
        $address = Model_Member_Address::find($id);
        $data['address'] = $address;
        $this->template->title = '用户修改收获地址';
        $this->template->content = View::forge('member/address', $data);
    }

    /*
    *添加快递地址
    */
    public function action_add()
    {
        $data = [];
        $this->template->title = '用户修改收获地址';
        $this->template->content = View::forge('member/address/add', $data);
    }

    /*
    *更新用户快递地址
    */
    public function action_edit($id)
    {
        !Input::method() == 'POST' and Response::redirect('/u/getaddress');
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
        Response::redirect('/u/getaddress');
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
