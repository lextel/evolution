<?php
class Controller_Admin_Members extends Controller_Admin{

    public function action_index() {
        $data['members'] = Model_Member::find('all');
        $this->template->title = "Members";
        $this->template->content = View::forge('admin/members/index', $data);

    }

    public function action_view($id = null)
    {
        $data['member'] = Model_Member::find($id);

        $this->template->title = "Member";
        $this->template->content = View::forge('admin/members/view', $data);

    }

    public function action_create()
    {
        if (Input::method() == 'POST')
        {
            $val = Model_Member::validate('create');

            if ($val->run())
            {
                $member = Model_Member::forge(array(
                ));

                if ($member and $member->save())
                {
                    Session::set_flash('success', e('Added member #'.$member->id.'.'));

                    Response::redirect('admin/members');
                }

                else
                {
                    Session::set_flash('error', e('Could not save member.'));
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Members";
        $this->template->content = View::forge('admin/members/create');

    }

    public function action_edit($id = null)
    {
        $member = Model_Member::find($id);
        $val = Model_Member::validate('edit');

        if ($val->run())
        {

            if ($member->save())
            {
                Session::set_flash('success', e('Updated member #' . $id));

                Response::redirect('admin/members');
            }

            else
            {
                Session::set_flash('error', e('Could not update member #' . $id));
            }
        }

        else
        {
            if (Input::method() == 'POST')
            {

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('member', $member, false);
        }

        $this->template->title = "Members";
        $this->template->content = View::forge('admin/members/edit');

    }

    public function action_delete($id = null)
    {
        if ($member = Model_Member::find($id))
        {
            $member->delete();

            Session::set_flash('success', e('Deleted member #'.$id));
        }

        else
        {
            Session::set_flash('error', e('Could not delete member #'.$id));
        }

        Response::redirect('admin/members');

    }


}
