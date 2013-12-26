<?php
class Controller_Admin_Notices extends Controller_Admin{

    public function action_index()
    {

        $breads = [['name' => '公告管理', 'href' => 'javascript:void(0);'], ['name' => '公告列表', 'href'=> 'javascript:void(0);']];

        $view = View::forge('admin/notices/index');
        $view->set('notices', Model_Notice::find('all'));
        $breadcrumb = new Helper\Breadcrumb();
        $view->set('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "公告列表";
        $this->template->content = $view;

    }

    public function action_view($id = null)
    {
        $data['notice'] = Model_Notice::find($id);

        $this->template->title = "Notice";
        $this->template->content = View::forge('admin/notices/view', $data);

    }

    public function action_create()
    {
        $breads = [
            ['name' => '公告管理', 'href' => 'javascript:void(0);'],
            ['name' => '公告列表', 'href' => Uri::create('admin/notices')],
            ['name' => '发布公告', 'href'=> 'javascript:void(0);']
           ];

        if (Input::method() == 'POST')
        {
            $val = Model_Notice::validate('create');

            if ($val->run())
            {
                $notice = Model_Notice::forge(array(
                    'title' => Input::post('title'),
                    'summary' => Input::post('summary'),
                    'desc' => Input::post('desc'),
                ));

                if ($notice and $notice->save())
                {
                    Session::set_flash('success', e('Added notice #'.$notice->id.'.'));

                    Response::redirect('admin/notices');
                }

                else
                {
                    Session::set_flash('error', e('Could not save notice.'));
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $view = View::forge('admin/notices/create');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "添加公告";
        $this->template->content = $view;

    }

    public function action_edit($id = null)
    {
        $notice = Model_Notice::find($id);
        $val = Model_Notice::validate('edit');

        if ($val->run())
        {
            $notice->title = Input::post('title');
            $notice->summary = Input::post('summary');
            $notice->desc = Input::post('desc');

            if ($notice->save())
            {
                Session::set_flash('success', e('Updated notice #' . $id));

                Response::redirect('admin/notices');
            }

            else
            {
                Session::set_flash('error', e('Could not update notice #' . $id));
            }
        }

        else
        {
            if (Input::method() == 'POST')
            {
                $notice->title = $val->validated('title');
                $notice->summary = $val->validated('summary');
                $notice->desc = $val->validated('desc');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('notice', $notice, false);
        }

        $this->template->title = "Notices";
        $this->template->content = View::forge('admin/notices/edit');

    }

    public function action_delete($id = null)
    {
        if ($notice = Model_Notice::find($id))
        {
            $notice->delete();

            Session::set_flash('success', e('Deleted notice #'.$id));
        }

        else
        {
            Session::set_flash('error', e('Could not delete notice #'.$id));
        }

        Response::redirect('admin/notices');

    }


}
