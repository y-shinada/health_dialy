<?php
class Controller_Users extends Controller_Template
{

	public function action_index()
	{
		$data['users'] = Model_User::find('all');
		$this->template->title = "Users";
		$this->template->content = View::forge('users/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('users');

		if ( ! $data['user'] = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find user #'.$id);
			Response::redirect('users');
		}

		$this->template->title = "User";
		$this->template->content = View::forge('users/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('create');

			if ($val->run())
			{
				$user = Model_User::forge(array(
					'login_id' => Input::post('login_id'),
					'password' => Input::post('password'),
					'name' => Input::post('name'),
					'deleted_at' => Input::post('deleted_at'),
					'deleted' => Input::post('deleted'),
				));

				if ($user and $user->save())
				{
					Session::set_flash('success', 'Added user #'.$user->id.'.');

					Response::redirect('users');
				}

				else
				{
					Session::set_flash('error', 'Could not save user.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Users";
		$this->template->content = View::forge('users/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('users');

		if ( ! $user = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find user #'.$id);
			Response::redirect('users');
		}

		$val = Model_User::validate('edit');

		if ($val->run())
		{
			$user->login_id = Input::post('login_id');
			$user->password = Input::post('password');
			$user->name = Input::post('name');
			$user->deleted_at = Input::post('deleted_at');
			$user->deleted = Input::post('deleted');

			if ($user->save())
			{
				Session::set_flash('success', 'Updated user #' . $id);

				Response::redirect('users');
			}

			else
			{
				Session::set_flash('error', 'Could not update user #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user->login_id = $val->validated('login_id');
				$user->password = $val->validated('password');
				$user->name = $val->validated('name');
				$user->deleted_at = $val->validated('deleted_at');
				$user->deleted = $val->validated('deleted');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user', $user, false);
		}

		$this->template->title = "Users";
		$this->template->content = View::forge('users/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('users');

		if ($user = Model_User::find($id))
		{
			$user->delete();

			Session::set_flash('success', 'Deleted user #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete user #'.$id);
		}

		Response::redirect('users');

	}

}
