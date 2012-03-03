<?php defined('SYSPATH') or die('No direct script access');

class Controller_Admin_Portfolio extends Abstract_Back_Process {

	protected $title = "Portfolio";

	public function action_index() {

		$p = ORM::factory('portfolio')->where('deleted', '=', '')->find_all();

		$this->template->content = View::factory('back/portfolio/index')
				->set('totalportfolios', ORM::factory('portfolio')->where('deleted', '=', '')->count_all())
				->set('portfolios', $p);
	}

	public function action_edit() {


		// set up the switch input
		$mode = ($this->request->param('id')) ? 'edit' : 'add';

		$interfaces_add_work = array();

		// load the orm objects
		$portfolio = ORM::factory('portfolio');

		switch($mode) {
			case 'add':
				$title = "Add a Portfolio";
				break;
			case 'edit':
				$portfolio = $portfolio->where('id', '=', $this->request->param('id'))->find();
				$title = "Edit $portfolio->name";
		}

		$this->template->title .= "> $title";

		$fields = array(
			'name' => 'text'
		);

		$settings_fields = array(

		);


		if ($this->request->method() == "POST") {

			// validate

			// define the settings array
			$settings = $this->request->post('settings');

			// load hte settings object
			$portfolio_settings = $portfolio->settings->find_all();

			$now = time();

			switch($mode) {
				case 'add':

					$portfolio->name = $this->request->post('name');
					$portfolio->created = $now;
					$portfolio->modified = $now;

					$portfolio->save();

					// update the settings
					Model_Portfolio::settings($settings);

					break;
				case 'edit':

					$portfolio->name = $this->request->post('name');
					$portfolio->modified = $now;

					$portfolio->save();


					break;

				return $portfolio;

			}

		}

		switch($mode) {
			case'add':
				// bind it to the template
				$this->template->content = View::factory('back/portfolio/edit')
						->bind('title', $title)
						->set('settings', $portfolio->settings->find_all())
						->set('settings_fields', $settings_fields)
						->bind('mode', $mode)
						->set('fields', $fields);
				break;
			case 'edit':

				// set the interface params
				foreach($portfolio->categories->find_all() as $category) {
					$interfaces_add_work[$category->id] = View::factory('back/portfolio/interfaces/work')
							->set('category', $category);
					/*$interfaces_category_settings[$category->id] = View::factory('back/portfolio/interfaces/category')
							->set('category', $category);*/
				}

				$this->template->content = View::factory('back/portfolio/edit')
					->bind('title', $title)
					->set('fields', $fields)
					->set('settings', $portfolio->settings->find_all())
					->set('settings_fields', $settings_fields)
					->set('portfolio_categories', $portfolio->categories->find_all())
					->set('tags', Portfolio::get_tags($portfolio->id))
					//->set('interfaces_add_work', $interfaces_add_work)
					//->set('interfaces_category_settings', $interfaces_category_settings)
					->set('totalcategories', $portfolio->categories->count_all())
					->bind('mode', $mode)
					->set('portfolio', $portfolio);


				break;

		}

	}

}

?>
