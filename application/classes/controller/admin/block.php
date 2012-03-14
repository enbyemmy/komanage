<?php defined('SYSPATH') or die('No direct script access');

class Controller_Admin_Block extends Abstract_Back_Process {



	public function action_edit()
	{

		$mode = ($this->request->param('id')) ? 'edit' : 'add';
		$referrer = explode('/', $this->request->referrer());
		$page_id = ($this->request->method() != HTTP_Request::POST) ? Arr::get($referrer, (count($referrer) - 1)) : $this->request->post('page_id');
		$page = ORM::factory('page', $page_id);
		switch($mode) {
			case 'edit':
				$block = ORM::factory('block', $this->request->param('id'));
				$content = $block->content->find();
				break;
			case 'add':
				$block = ORM::factory('block');
				$content = ORM::factory('content');	
				break;
		}
		
		if ($this->request->method() == HTTP_Request::POST)
		{
			// load hte page
			if ($block->loaded())
			{
				//$block->sort = $this->request->post('sort');
			
			}
			else
			{
				// create the block
				$sort = ORM::factory('block')->order_by('id', 'DESC')->find()->id;
				$block->type = $this->request->post('type');
				$block->sort = $sort;
			}
			$block->save();

			switch($this->request->post('type')) {
				case 'content':
					$content->block_id = $block->id;
					$content->name = $this->request->post('name');
					$content->content = $this->request->post('content');
					$content->modified = time();

					$content->save();
					break;
				case 'module':


					break;

			}

			if ($page->loaded()) {
				// attempt to add this block to the page
				$page->add('blocks', $block);

			}

		}


		switch($mode) {

			case 'add':
				$this->template->content = View::factory('back/block/interfaces/edit')
					->set('page_id', $page_id);
				break;
			case 'edit':

				$this->template->content = View::factory('back/block/interfaces/edit')
					->set('page_id', $page_id)
					->set('block', $block)
					->set('content', $content);
				break;
		}

	}


	public function action_delete()
	{

		$block = ORM::factory('block', $this->request->param('id'));
		
		$block->deleted = time();
		$block->save();
		return $block;

	}

}
