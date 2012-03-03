<?php
/*
 * This is the admin page controller
 */

class Controller_Admin_Pages extends Abstract_Back_Process {

	protected $mode = 'add';

	public $title = "Edit Pages";

	public function action_index()
	{

		// set up the template
		$this->template->title .= "Pages";

		// load the objects
		$pages = ORM::factory('page')->where('deleted', '=', '');

		// bind the info to the view
		$this->template->content = View::factory('back/pages/index')
				->set('pages', $pages->find_all())
				->set('totalpages', $pages->count_all());

	}

	public function action_edit() {

		// check the request for the mode
		if ($this->request->param('id')) $this->mode = 'edit';

		$page = ORM::factory('page', $this->request->param('id'));

		// load the rest of the stuff
		$applications = Applications::get_all();

		$this->template->title .= "> $page->name";

		switch($this->mode) 
		{
			case 'edit':
				// validate

				// set values
				break;
			case 'add':
				
				
				
				break;


		}

		if ($this->request->method() == "POST") {
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

		}
		// bind to the template
		$this->template->content = View::factory('back/pages/edit')
				->set('page', $page)
				->set('applications', $applications)
				->bind('message', $message);

		if (@$error) {
			$this->template->content->bind('error', $error);
		}

	}

	public function action_delete()
	{

			// validate
			if (!$this->request->param('id')) $this->request->redirect('/error');

			// set some vars
			$page_id = $this->request->param('id');

			// check to see if the page we're trying to delete exists
			$pages = ORM::factory('page')->where('id', '=', $page_id);
			if (!$pages->count_all()) $this->request->redirect('/error');

			// load the page
			$page = $pages->find();

			// tag it as deleted
			$page->deleted = time();

			// save
			if ($page->save()) {
				$message = "$page->name has been flagged as deleted";
			}
			else {
				$error = "There was an error deleting this page, please try again";
			}

			$this->request->redirect('admin/pages/');

	}

}

?>
