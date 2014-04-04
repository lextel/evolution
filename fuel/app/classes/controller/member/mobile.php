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
        //检测数据库里是否有该电话
        $res = ['code'=>1];
        $time = Session::get('front_time', 0);
        $phone = Session::get('front_mobile');
		$now = time();
	    if (!empty($time) && (($now - $time) <= $this->smsPerTime)){
            $res['code'] = 2;
            $res['msg'] = '获取太频繁了';
            return json_encode($res);
	    }
               
        //生成随机验证码
        $time = time();       
        $code = substr(md5($time.$phone),0, 6);
                		
        // 发送
        $content = "验证码为：".$code;
        $sms = new Classes\Sms;
        $r = 1;//$sms->send($mobile, $content);
        \Log::error(sprintf('短信： %s | %s', $phone, $content));
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
        $val->add_callable(new \Classes\MyRules());
        $val->add_field('code', '密码', 'required|min_length[6]|max_length[6]');
        if (Input::method() == 'POST' && $val->run())
        {
            $pwd = trim(Input::post('code'));
            $phone = Session::get('front_mobile'); 
            $user = Model_Member::find_by_mobile($mobile);
            //检测是否存在 检测是否已经验证过了
            if (!$user){
                $code = Session::get('front_code');
		        $time = Session::get('front_time');
		        $now = time();
		        if ((($now - $time) <= $this->smsPerTime) && ($code == $pwd)){
		            if ($user->mobile == ''){
		                $user->mobile = $phone;
		            }
		            $user->is_mobile = 1;
	                $user->save();
                    Session::delete('front_code');
		            Session::delete('front_time');
		            Session::delete('front_mobile');
                    return Response::redirect('u'); 
		        }else{
		            $this->template->set_global('login_error', '您输入的密码不正确或者已经过期了');
		        }           
            }else{
                $this->template->set_global('login_error', $mobile.'已经存在');
            }
            return Response::redirect('u/mobile/second'.$phone); 
        }
        return Response::redirect('u/mobile/first'); 
    }
}
