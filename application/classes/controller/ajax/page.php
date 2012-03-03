<?php defined('SYSPATH') or die('No direct script access');

class Controller_Ajax_Page extends Controller {

	protected $mode = 'add';

	/**
	 * add /edit page
	 *
	 */
	public function action_edit()
	{
	

		// check the request for the mode
		if ($this->request->param('id')) $this->mode = 'edit';

		$page = ORM::factory('page', $this->request->param('id'));

		// load the rest of the stuff
		$applications = Applications::get_all();

		switch($this->mode) 
		{
			case 'edit':
				// validate

				// set values
				break;
			case 'add':
				
				
				
				break;


		}


		// update the values

		$page->name = $this->request->post('name');
		$page->uri = $this->request->post('uri');
		$page->application = ($this->request->post('application')) ? $this->request->post('application') : '';

		// save
		if ($page->save()) {
			$message = 'Page saved successfully';
		}
		else {
			$error = '';
		}
		
		return $page;


	}


	/** add / edit content blocks attached to a page
	 *
	 */
	public function action_content()
	{
		if ($_SERVER["REQUEST_METHOD"] != "POST") die(false);

		$post = $this->request->post();

		$result = Model_Page::add_content_block($post);

		echo $result;

	}

}
