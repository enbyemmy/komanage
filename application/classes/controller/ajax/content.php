<?php defined('SYSPATH') die('No direct script access');

class Controller_Ajax_Content extends Controller {

	public function action_edit()
	{

		$mode = ($this->request->param('id')) ? 'edit' : 'add';

		switch($mode)
		{
			case 'edit':
				$content = Model_Content::edit($this->request->post('name'), $this->request->post('content'), $this->request->param('id'));
				break;
			case 'add':
				$content = Model_Content::edit($this->request->post('name'), $this->request->post('content'));
				break;
		}

		return ($content);
	}


}
