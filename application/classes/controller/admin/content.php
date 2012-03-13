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
		$referrer = explode('/', $this->request->referrer());
		$page_id = Arr::get($referrer, (count($referrer) - 1));

		$mode = ($this->request->param('id')) ? 'edit' : 'add';
		
		switch($mode)
		{
			case 'edit':
				$content = ORM::factory('content', $this->request->param('id'));
				break;
			case 'add':
				$content = ORM::factory('content');
				break;
		}

		if ($this->request->method() == "POST")
		{
			// load hte page
			$page = ORM::factory('page', $this->request->post('page_id'));
			
			// create the block
			switch($mode) {
				case 'add':
					$sort = ORM::factory('block')->order_by('id', 'DESC')->find()->id;
					$block = ORM::factory('block');
					$block->sort = $sort;
					$block->save();
					break;	
				case 'edit':
					$block = ORM::factory('block', $content->block->find()->id);
//					$block->sort = $this->request->post('sort');
					$block->save();
					break;
			}

			// add the content and assign it to the block 
			$content->block_id = $block->id;
			$content->name = $this->request->post('name');
			$content->content = $this->request->post('content');
			$content->modified = time();
			$content->save();

			if ($page->loaded())
			{
				// attempt to add this block to the page
				$page->add('block', $block);
			}
		}
		switch($mode)
		{
			case 'add':
				$this->template->content = View::factory('back/content/interfaces/edit')
					->set('page_id', $page_id);
				break;
			case 'edit':
				$this->template->content = View::factory('back/content/interfaces/edit')
					->set('page_id', $page_id)
					->set('content', $content);
				break;
		}
	}
}
