<?php
class Controller_Posts extends Controller_Template{

	public function action_index()
	{
		$data['posts'] = Model_Post::find('all');
		$this->template->title = "Posts";
		$this->template->content = View::forge('posts/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('posts');

		if ( ! $data['post'] = Model_Post::find($id))
		{
			Session::set_flash('error', 'Could not find post #'.$id);
			Response::redirect('posts');
		}

		$this->template->title = "Post";
		$this->template->content = View::forge('posts/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Post::validate('create');
			
			if ($val->run())
			{
				$post = Model_Post::forge(array(
					'title' => Input::post('title'),
					'desc' => Input::post('desc'),
					'status' => Input::post('status'),
					'item_id' => Input::post('item_id'),
					'user_id' => Input::post('user_id'),
					'type_id' => Input::post('type_id'),
					'phase_id' => Input::post('phase_id'),
					'topimage' => Input::post('topimage'),
					'images' => Input::post('images'),
				));

				if ($post and $post->save())
				{
					Session::set_flash('success', 'Added post #'.$post->id.'.');

					Response::redirect('posts');
				}

				else
				{
					Session::set_flash('error', 'Could not save post.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Posts";
		$this->template->content = View::forge('posts/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('posts');

		if ( ! $post = Model_Post::find($id))
		{
			Session::set_flash('error', 'Could not find post #'.$id);
			Response::redirect('posts');
		}

		$val = Model_Post::validate('edit');

		if ($val->run())
		{
			$post->title = Input::post('title');
			$post->desc = Input::post('desc');
			$post->status = Input::post('status');
			$post->item_id = Input::post('item_id');
			$post->user_id = Input::post('user_id');
			$post->type_id = Input::post('type_id');
			$post->phase_id = Input::post('phase_id');
			$post->topimage = Input::post('topimage');
			$post->images = Input::post('images');

			if ($post->save())
			{
				Session::set_flash('success', 'Updated post #' . $id);

				Response::redirect('posts');
			}

			else
			{
				Session::set_flash('error', 'Could not update post #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$post->title = $val->validated('title');
				$post->desc = $val->validated('desc');
				$post->status = $val->validated('status');
				$post->item_id = $val->validated('item_id');
				$post->user_id = $val->validated('user_id');
				$post->type_id = $val->validated('type_id');
				$post->phase_id = $val->validated('phase_id');
				$post->topimage = $val->validated('topimage');
				$post->images = $val->validated('images');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('post', $post, false);
		}

		$this->template->title = "Posts";
		$this->template->content = View::forge('posts/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('posts');

		if ($post = Model_Post::find($id))
		{
			$post->delete();

			Session::set_flash('success', 'Deleted post #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete post #'.$id);
		}

		Response::redirect('posts');

	}


}
