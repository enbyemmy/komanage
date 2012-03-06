<?php defined('SYSPATH') or die('No direct script access');

class Controller_Admin_Content extends Abstract_Back_Process {



	public function action_index()
	{

		// set up the template
		$this->template->title .= "Content";

		// load the objects
		$content = ORM::factory('content')->where('deleted', '=', '');

		// bind the info to the view
		$this->template->content = View::factory('back/content/index')
				->set('content', $content->find_all())
				->set('totalblocks', $content->count_all());

	}

	public function action_edit()
	{

		$mode = ($this->request->param('id')) ? 'edit' : 'add';
		
		if ($this->request->method() == "POST")
		{

			$content = ORM::factory('content');
			if ($mode == 'edit') $content->where('id', '=', $this->request->param('id'))->find();

			$content->name = $this->request->post('name');
			$content->content = $this->request->post('content');
			$content->modified = time();

			$content->save();
		}


		switch($mode) {

			case 'add':
				$this->template->content = View::factory('back/content/interfaces/edit');
				break;
			case 'edit':

				$this->template->content = View::factory('back/content/interfaces/edit')
					->set('content', $content);
				break;
		}

	}

}
