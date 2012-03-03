<?php

/**
 * This is the template controller that gives us consistent layouts and defaults... BITCH
 */
abstract class Abstract_Controller extends Controller {
	
	protected $title;
	protected $meta_description;
	protected $template;
	
	public function before()
	{
		parent::before();

		// set the dir for logic
		$dir = $this->request->directory();
		$template = ($dir == 'admin') ? 'back' : 'front';

		$is_ajax = ($this->request->is_ajax()) ? true : false;

		$this->template = View::factory($template);
		$this->template->is_ajax = $is_ajax;
		$this->template->navigation = View::factory($template . '/shared/navigation');

		// Set defaults for title and content
		$this->template->content = '';
		$this->template->title = ORM::factory('configuration', 'title')->value . ' | ' . $this->title . ' ';
		$this->template->meta_description = $this->meta_description;

		// init the included javascript
		$this->template->scripts = array();

		// init the stylesheets
		$this->template->stylesheets = array();

		// Set the currently executing controller
		$this->template->controller = $this->request->controller();

		$this->template->config = Model_Configuration::get_as_array();


	}
	
	public function after()
	{
		parent::after();

		// Render the main website template
		$this->response->body($this->template->render());
	}
	
}
