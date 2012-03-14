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

		// assemble the page uri
		$uri = ($this->request->param('uri') == '/') ? $this->request->param('uri') : "/" . $this->request->param('uri');

		// set the dir for logic
		$dir = $this->request->directory();
		$template = ($dir == 'admin') ? 'back' : 'front';
		
		$is_ajax = ($this->request->is_ajax()) ? true : false;

		$this->template = View::factory($template)
			->set('template', $template)
			->set('pages', ORM::factory('page')->where('deleted', '=', '')->find_all());
		$this->template->is_ajax = $is_ajax;

		// load the site config and preferences
		$this->template->config = ORM::factory('configuration')->find_all()->as_array('key', 'value');
		$this->template->preferences = array();


		// Set defaults for title and content
		$this->template->content = '';
		$this->template->title = $this->template->config['title'] . ' ';

		// load the page
		$page = ORM::factory('page')->where('uri', '=', $uri)->find();

		// load the page blocks
		$this->template->blocks = $page->blocks->where('deleted', '=', '')->find_all();

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
