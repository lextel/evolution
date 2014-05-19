<?php

class Controller_Member_Mobile extends Controller_Center
{
    public $smsPerTime = 100;
    /*
    * 开始验证手机页面
    */
    public function action_first(){
        $user = $this->current_user;
        $view = View::forge('member/mobile/first');
        $view->set('user', $user);
        $this->template->title = '手机验证';
        $this->template->layout->content = $view;
    }

    /*
    * 下一步验证手机页面
    */
    public function action_second($mobile){
        $view = View::forge('member/mobile/second');
        Session::set('front_mobile', $mobile);
        $view->set('mobile', $mobile);
        $this->template->title = '手机验证';
        $this->template->layout->content = $view;
    }

    /*
    * 获取手机发送验证码
    * 输入 手机号码，返回短信验证
    */
    public function action_getcode(){
        $res = ['code'=>1];
        $time = Session::get('front_time', 0);
        $mobile = Session::get('front_mobile');
        $now = time();
        //检测发送频率
        if (!empty($time) && (($now - $time) <= $this->smsPerTime)){
            $res['code'] = 2;
            $res['msg'] = '获取太频繁了';
            return json_encode($res);
        }
        //检测是否绑定过
        $user = Model_Member::find('all', ['where'=>['mobile'=>$mobile,
                            'is_mobile'=>'1']]);
        if ($user){
            $res['code'] = 3;
            $res['msg'] = '手机已经被绑定过了';
            return json_encode($res);
        }
        //生成随机验证码
        $time = time();
        $code = substr(crc32($time.$mobile),0, 6);

        // 发送
        $content = $code;
        $sms = new \Classes\Sms();
        $r = $sms->send($mobile, $content);
        \Log::error(sprintf('个人发送短信： %s | %s', $mobile, $content));
        if ($r)
        {
            $res['code'] = 0;
            $res['msg'] = '已发送';
            Session::set('front_code', $code);
            Session::set('front_time', $time);
            return json_encode($res);
        }
        
        $res['msg'] = '发送失败';
        return json_encode($res);
    }

    /*
    * 检测短信验证码
    */
    public function action_check(){
        $val = Validation::forge();
        $val->add_field('code', '验证码', 'required|min_length[6]|max_length[6]');
        if (Input::method() == 'POST' && $val->run())
        {
            $pwd = trim(Input::post('code'));
            $mobile = Session::get('front_mobile');
            $user = Model_Member::find('all', ['where'=>['mobile'=>$mobile,
                            'is_mobile'=>'1']]);
            //检测是否存在 检测是否已经验证过了
            if (!$user){
                $code = Session::get('front_code');
                $time = Session::get('front_time');
                $now = time();
                //
                if ((($now - $time) <= $this->smsPerTime) && ($code == $pwd)){
                    $user = $this->current_user;
                    $user->mobile = $mobile;
                    $user->is_mobile = 1;
                    $user->save();
                    Session::delete('front_code');
                    Session::delete('front_time');
                    Session::delete('front_mobile');
                    Session::set_flash('success', "绑定手机成功");
                    return Response::redirect('invit');
                }else{
                    Session::set_flash('login_error', '您输入的密码不正确或者已经过期了');
                }
            }else{
                Session::set_flash('login_error', '手机已经被绑定');
            }
            return Response::redirect('u/mobile/second/'.$mobile);
        }
        return Response::redirect('u/mobile/first');
    }
}
