<?php

class Controller_Help extends Controller_Frontend
{

    public function before(){
        parent::before();
        $this->template->layout = View::forge('help/layout');
    }
    // 新手指南
    public function action_page($page = 'new')
    {
        Config::load('common');
        $pagesMap = Config::get('helppages');
        if (!array_key_exists($page, $pagesMap)){
            Response::redirect('404');
        }
        $pageInfo = $pagesMap[$page];
        $this->template->title = $pageInfo['title'];
        $this->template->layout->content = View::forge($pageInfo['page']);
    }
    /*
    * 添加反馈
    */
    public function action_addSuggest(){
        !Input::method() == 'POST' and Response::redirect('/h/suggest');
        $val = Validation::forge();
        $val->add_field("type", '主题', 'required');
        $val->add_field('email', 'E-mail', 'required|valid_email');
        $val->add_field("text", '反馈内容', 'required');
        
        if (!Captcha::forge()->check()){
            Session::set_flash('info', e('验证码错误'));
            Session::set_flash('input', Input::all());
            Response::redirect('/h/suggest');
        }
        
        if ($val->run()){
            $suggest = new Model_Suggest;
            $suggest->title = '';
            if ($this->auth->check()){
                 $suggest->user_id = $this->current_user->id;
                 $suggest->user_name = $this->current_user->username;
            }else{
                $suggest->user_id = '';
                $suggest->user_name = '';
            }
            $suggest->type = trim(Input::post('type'));
            $suggest->email = trim(Input::post('email'));
            $suggest->text = trim(Input::post('text'));
            $suggest->nickname = trim(Input::post('nickname', ''));
            $suggest->mobile = trim(Input::post('mobile', ''));
            $suggest->save();           
            Session::set_flash('info', e('提交成功'));
        }else{
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('valid_email', ':label 格式不正确.');
            Session::set_flash('error', $val->show_errors());
            Session::set_flash('input', Input::all());
        }       
        Response::redirect('/h/suggest');
    }
}
