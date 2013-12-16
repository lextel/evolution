<?php

class Controller_Friends extends Controller_Center
{

	public function action_list()
	{
		$data["subnav"] = array('list'=> 'active' );
		$this->template->title = 'Friend &raquo; List';
		$this->template->content = View::forge('friend/list', $data);
	}

	public function action_follow()
	{
		$data["subnav"] = array('follow'=> 'active' );
		$this->template->title = 'Friend &raquo; Follow';
		$this->template->content = View::forge('friend/follow', $data);
	}

	public function action_unfollow()
	{
		$data["subnav"] = array('unfollow'=> 'active' );
		$this->template->title = 'Friend &raquo; Unfollow';
		$this->template->content = View::forge('friend/unfollow', $data);
	}

}
