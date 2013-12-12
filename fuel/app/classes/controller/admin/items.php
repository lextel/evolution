<?php
class Controller_Admin_Items extends Controller_Admin{

	public function action_index()
	{
		$data['items'] = Model_Item::find('all');
		$this->template->title = "Items";
		$this->template->content = View::forge('admin/items/index', $data);

	}

	public function action_view($id = null)
	{
		$data['item'] = Model_Item::find($id);

		$this->template->title = "Item";
		$this->template->content = View::forge('admin/items/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Item::validate('create');

			if ($val->run())
			{
				$item = Model_Item::forge(array(
					'title' => Input::post('title'),
					'desc' => Input::post('desc'),
					'price' => Input::post('price'),
					'cate_id' => Input::post('cate_id'),
					'status' => Input::post('status'),
				));

				if ($item and $item->save())
				{
					Session::set_flash('success', e('Added item #'.$item->id.'.'));

					Response::redirect('admin/items');
				}

				else
				{
					Session::set_flash('error', e('Could not save item.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Items";
		$this->template->content = View::forge('admin/items/create');

	}

	public function action_edit($id = null)
	{
		$item = Model_Item::find($id);
		$val = Model_Item::validate('edit');

		if ($val->run())
		{
			$item->title = Input::post('title');
			$item->desc = Input::post('desc');
			$item->price = Input::post('price');
			$item->cate_id = Input::post('cate_id');
			$item->status = Input::post('status');

			if ($item->save())
			{
				Session::set_flash('success', e('Updated item #' . $id));

				Response::redirect('admin/items');
			}

			else
			{
				Session::set_flash('error', e('Could not update item #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$item->title = $val->validated('title');
				$item->desc = $val->validated('desc');
				$item->price = $val->validated('price');
				$item->cate_id = $val->validated('cate_id');
				$item->status = $val->validated('status');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('item', $item, false);
		}

		$this->template->title = "Items";
		$this->template->content = View::forge('admin/items/edit');

	}

	public function action_delete($id = null)
	{
		if ($item = Model_Item::find($id))
		{
			$item->delete();

			Session::set_flash('success', e('Deleted item #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete item #'.$id));
		}

		Response::redirect('admin/items');

	}


}