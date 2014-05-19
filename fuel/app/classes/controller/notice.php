<?php
class Controller_Notice extends Controller_Frontend{

    public function action_index()
    {

        $currentPage = intval($this->param('page')) ? intval($this->param('page')) : 1;

        $total = Model_Notice::count(['where' => ['is_delete' => 0]]);

        $pagesize = 10;
        $offset = ($currentPage - 1) * $pagesize;
        $notices = Model_Notice::find('all',
                        ['where'   =>['is_delete'=>0],
                        'order_by' =>['is_top' => 'desc', 'id' => 'desc'],
                        'offset'   => $offset,
                        'limit'    => $pagesize,
                        ]);

        $url = Uri::create('notice/p');
        $page = new \Helper\Page();
        $config = $page->setPagesizeConfig($url, $total, 3, $pagesize);
        $pagination = Pagination::forge('mypagination', $config);

        $view = View::forge('notice/index', '', false);
        $view->set('notices', $notices);
        $view->set('pagination', $pagination);
        $this->template->title = "乐乐淘公告";
        $this->template->layout = $view;

    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('notice');

        if ( ! $notice = Model_Notice::find($id))
        {
            Session::set_flash('error', 'Could not find notice #'.$id);
            Response::redirect('notice');
        }

        $view = View::forge('notice/view');
        $view->set('notice', $notice);
        $this->template->title = $notice->title;
        $this->template->layout = $view;
    }
}
