<?php

/**
 * This is the template controller that gives us consistent layouts and defaults... BITCH
 */
abstract class Abstract_Controller extends Controller {
	
	protected $title = 'Komanage | ';
	protected $front = 'templates/layout';
	protected $back = 'templates/admin';
	
	public function before()
	{
		parent::before();

		// Load in the template view
		$this->template = View::factory($this->view);
		
		// Set defaults for title and content
		$this->template->content = '';
		$this->template->title = $this->title;

		// init the included javascript
		$this->template->scripts = array();
		
		// init the stylesheets
		$this->template->stylesheets = array();
		
		// Set the currently executing controller
		$this->template->controller = $this->request->controller();

		// laziness.........
		// Set a refrence to the content for ease of access
		//$this->content =& $this->template->content;
	}
	
	public function after()
	{
		parent::after();

		// Render the main website template
		$this->response->body($this->template->render());
	}
	
}