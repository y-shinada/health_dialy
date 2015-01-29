<?php
class Controller_Timelines extends Controller_Template
{

	public function action_index()
	{
		$data['timelines'] = Model_Timeline::find('all');
		$this->template->title = "Timelines";
		$this->template->content = View::forge('timelines/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('timelines');

		if ( ! $data['timeline'] = Model_Timeline::find($id))
		{
			Session::set_flash('error', 'Could not find timeline #'.$id);
			Response::redirect('timelines');
		}

		$this->template->title = "Timeline";
		$this->template->content = View::forge('timelines/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Timeline::validate('create');

			if ($val->run())
			{
				$timeline = Model_Timeline::forge(array(
					'user_id' => Input::post('user_id'),
					'food_id' => Input::post('food_id'),
					'ate_at' => Input::post('ate_at'),
					'calorie' => Input::post('calorie'),
					'price' => Input::post('price'),
					'deleted_at' => Input::post('deleted_at'),
					'deleted' => Input::post('deleted'),
				));

				if ($timeline and $timeline->save())
				{
					Session::set_flash('success', 'Added timeline #'.$timeline->id.'.');

					Response::redirect('timelines');
				}

				else
				{
					Session::set_flash('error', 'Could not save timeline.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Timelines";
		$this->template->content = View::forge('timelines/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('timelines');

		if ( ! $timeline = Model_Timeline::find($id))
		{
			Session::set_flash('error', 'Could not find timeline #'.$id);
			Response::redirect('timelines');
		}

		$val = Model_Timeline::validate('edit');

		if ($val->run())
		{
			$timeline->user_id = Input::post('user_id');
			$timeline->food_id = Input::post('food_id');
			$timeline->ate_at = Input::post('ate_at');
			$timeline->calorie = Input::post('calorie');
			$timeline->price = Input::post('price');
			$timeline->deleted_at = Input::post('deleted_at');
			$timeline->deleted = Input::post('deleted');

			if ($timeline->save())
			{
				Session::set_flash('success', 'Updated timeline #' . $id);

				Response::redirect('timelines');
			}

			else
			{
				Session::set_flash('error', 'Could not update timeline #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$timeline->user_id = $val->validated('user_id');
				$timeline->food_id = $val->validated('food_id');
				$timeline->ate_at = $val->validated('ate_at');
				$timeline->calorie = $val->validated('calorie');
				$timeline->price = $val->validated('price');
				$timeline->deleted_at = $val->validated('deleted_at');
				$timeline->deleted = $val->validated('deleted');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('timeline', $timeline, false);
		}

		$this->template->title = "Timelines";
		$this->template->content = View::forge('timelines/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('timelines');

		if ($timeline = Model_Timeline::find($id))
		{
			$timeline->delete();

			Session::set_flash('success', 'Deleted timeline #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete timeline #'.$id);
		}

		Response::redirect('timelines');

	}

}
