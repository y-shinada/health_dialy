<?php
class Controller_Foods extends Controller_Template
{

	public function action_index()
	{
		$data['foods'] = Model_Food::find('all');
		$this->template->title = "Foods";
		$this->template->content = View::forge('foods/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('foods');

		if ( ! $data['food'] = Model_Food::find($id))
		{
			Session::set_flash('error', 'Could not find food #'.$id);
			Response::redirect('foods');
		}

		$this->template->title = "Food";
		$this->template->content = View::forge('foods/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Food::validate('create');

			if ($val->run())
			{
				$food = Model_Food::forge(array(
					'name' => Input::post('name'),
					'deleted_at' => Input::post('deleted_at'),
					'deleted' => Input::post('deleted'),
				));

				if ($food and $food->save())
				{
					Session::set_flash('success', 'Added food #'.$food->id.'.');

					Response::redirect('foods');
				}

				else
				{
					Session::set_flash('error', 'Could not save food.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Foods";
		$this->template->content = View::forge('foods/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('foods');

		if ( ! $food = Model_Food::find($id))
		{
			Session::set_flash('error', 'Could not find food #'.$id);
			Response::redirect('foods');
		}

		$val = Model_Food::validate('edit');

		if ($val->run())
		{
			$food->name = Input::post('name');
			$food->deleted_at = Input::post('deleted_at');
			$food->deleted = Input::post('deleted');

			if ($food->save())
			{
				Session::set_flash('success', 'Updated food #' . $id);

				Response::redirect('foods');
			}

			else
			{
				Session::set_flash('error', 'Could not update food #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$food->name = $val->validated('name');
				$food->deleted_at = $val->validated('deleted_at');
				$food->deleted = $val->validated('deleted');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('food', $food, false);
		}

		$this->template->title = "Foods";
		$this->template->content = View::forge('foods/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('foods');

		if ($food = Model_Food::find($id))
		{
			$food->delete();

			Session::set_flash('success', 'Deleted food #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete food #'.$id);
		}

		Response::redirect('foods');

	}

}
