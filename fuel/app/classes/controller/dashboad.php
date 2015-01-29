<?php

class Controller_Dashboad extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Dashboard &raquo; Index';
		$this->template->content = View::forge('dashboad/index', $data);


	}

	public function action_add()
	{
		$data["subnav"] = array('add'=> 'active' );
		$this->template->title = 'Dashboard &raquo; Add';
		$this->template->content = View::forge('dashboad/add', $data);
	}

}
