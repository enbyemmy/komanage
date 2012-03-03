<?php defined('SYSPATH') or die('No direct script access.');

/**
 * This is the controller that handles all site configuration (site name, templates, styles, users, etc
 */
class Controller_Admin_Site extends Abstract_Back_Process {

	/**
	 * This is the initial page for the site configuration system
	 */
	public function action_index()
	{

		// we'll probably have some system messages for the site admin here and maybe some stats

		// bind it to the view
		$this->template->content = View::factory('back/site/index');
		


	}

	/**
	 * This controller method deals with the configuration of the website objects parameters e.g. (site name, description, copyright message, ...)
	 */
	public function action_configuration()
	{
		$fields = array(
			'title' => array('label' => 'Website Title', 'bit' => 'This is main name for you website, it will appear in the meta-title, and will be the general naming convention that describes the site as an object. :3'),
			'meta-keywords' => array('label' => 'Meta Keywords', 'bit' => 'Essentially, these are just words will hopefully be searched in google to find your website, so think of them as buzz words, that will lead searchers to your website for the answer to life.  This should be a comma separated list'),
			'meta-description' => array('label' => 'Meta Description', 'bit' => 'We\'ll use this description to explain to someone why this site even belongs on the internet.  Think of it as the website\'s Raison <a href="http://en.wikipedia.org/wiki/Raison_d\'%C3%AAtre">d\'&#234;tre</a>.'),

		);

		// get hte config object and create the array from that
		$config = ORM::factory('configuration')->find_all();
		$configuration = array();
		foreach($config as $obj) {
			$configuration[$obj->key] = $obj->value;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$save = Model_Configuration::edit($this->request->post());

			// route messages to the template alert
			echo ($save) ? 'Saved successfully' : 'There were errors, sorry chap';


		}

		// bind everything to the view
		$this->template->content = View::factory('back/site/configuration')
				->set('fields', $fields)
				->set('config', $configuration);

	}

	public function action_preferences()
	{

		$fields = array(
			

		);

		$prefs = ORM::factory('preferences')->find_all()->as_array();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$save = Model_Preferences::edit($this->request->post());

			echo ($save) ? 'Saved successfully' : 'There were errors, sorry chap';

		}

		// bind it to the view
		$this->template->content = View::factory('back/site/preferences')
				->set('fields', $fields)
				->set('prefs', $prefs);

	}

}
