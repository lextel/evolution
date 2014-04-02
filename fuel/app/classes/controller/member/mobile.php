<?php

class Controller_Member_Mobile extends Controller_Center
{
    public $smsPerTime = 60;
    /*
    * 开始验证手机页面
    */
    public function action_first(){
        $view = View::forge('member/mobile/first');
        $this->template->title = '手机验证';
        $this->template->layout->content = $view;
    }
    
    /*
    * 下一步验证手机页面
    */
    public function action_second($mobile){
        $view = View::forge('member/mobile/second');
        $view->set('mobile', $mobile);
        $this->template->title = '手机验证';
        $this->template->layout->content = $view;
    }
    
    /*
    * 获取手机发送验证码
    * 输入 手机号码，返回短信验证
    */
    public function action_getcode(){
        $mobile = trim(Input::post('mobile'));
        //检测数据库里是否有该电话
        $res = ['code'=>1];
        $time = Session::get('front_time', 0);
        $phone = Session::get('front_mobile');
		$now = time();
		if ($phone == $mobile){
	        if (!empty($time) && (($now - $time) <= $this->smsPerTime)){
	            $res['code'] = 2;
	            $res['msg'] = $mobile.'获取太频繁了';
	            return json_encode($res);
	        }
		}
               
        //生成随机验证码
        $time = time();       
        $code = substr(md5($time.$mobile),0, 6);
                		
        // 发送
        $content = "验证码为：".$code;
        $sms = new Classes\Sms;
        $r = 1;//$sms->send($mobile, $content);
        \Log::error(sprintf('短信： %s | %s', $mobile, $content));
        if ($r)
        {
            $res['code'] = 0;
            $res['msg'] = '已发送';
            Session::set('front_code', $code);
		    Session::set('front_time', $time);
		    Session::set('front_mobile', $mobile);
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
        $val->add_field('mobile', '手机', 'required|is_mobile');
        if (Input::method() == 'POST' && $val->run())
        {
            $mobile = trim(Input::post('mobile'));
            $pwd = trim(Input::post('code'));
            $phone = Session::get('mobile'); 
            $user = Model_User::find_by_mobile($mobile);
            if ($mobile == Session::get('front_mobile') && $user){
                $code = Session::get('front_code');
		        $time = Session::get('front_time');
		        $now = time();
		        if ((($now - $time) <= $this->smsPerTime) && ($code == $pwd)){
		            $this->auth->force_login($user->id);
                    Session::delete('mcode');
		            Session::delete('mtime');
		            Session::delete('mmobile');
                    return Response::redirect('u'); 
		        }else{
		            $this->template->set_global('login_error', '您输入的密码不正确或者已经过期了');
		        }           
            }else{
                $this->template->set_global('login_error', $mobile.'不存在');
            }
        }
        return Response::redirect('u'); 
    }
}
