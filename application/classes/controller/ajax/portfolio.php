<?php defined('SYSPATH') or die('No direct script access');

class Controller_Ajax_Portfolio extends Controller {

	public function action_delete()
	{

		// validate
		if (!$this->request->param('id')) return false;

		// load hte object
		$portfolio = ORM::factory('portfolio')->where('id', '=', $this->request->param('id'))->find();

		$portfolio->deleted = time();

		$portfolio->save();

		echo ($portfolio);

	}

	public function action_category()
	{
		$mode = ($this->request->param('id')) ? 'edit' : 'add';

		switch($mode) {

			case 'edit':
				$cat = ORM::factory('portfolio_category')->where('id', '=', $this->request->param('id'))->find();
				break;
			case 'add':
				$cat = ORM::factory('portfolio_category');
		}

		$cat->category = $this->request->post('category');
		$cat->portfolio_id = $this->request->post('portfolio_id');
		$cat->save();

		echo ($cat);

	}

	public function action_work()
	{
		$mode = ($this->request->param('id')) ? 'edit' : 'add';

		// params
		$now = time();

		// load the work object
		$work = ORM::factory('portfolio_work');

		switch($mode) {

			case 'edit':

				$work->where('id', '=', $this->request->param('id'))->find();

				

				break;
			case 'add':

				// set and save
				$work->name = $this->request->post('name');
				$work->description = $this->request->post('description');
				$work->date = $this->request->post('date');
				$work->created = $now;
				$work->modified = $now;

				if ($work->save()) {
					echo "true";
				}


				break;
		}



	}

	public function action_edit()
	{

		// set up the switch input
		$mode = ($this->request->param('id')) ? 'edit' : 'add';

		$interfaces_add_work = array();

		// load the orm objects

		switch($mode) {
			case 'add':
				$portfolio = ORM::factory('portfolio');
				break;
			case 'edit':
				$portfolio = ORM::factory('portfolio', $this->request->param('id'));
		}

		$fields = array(
			'name' => 'text'
		);

		$settings_fields = array(

		);


		if ($this->request->method() == 'POST') {
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
					$interfaces_category_settings[$category->id] = View::factory('back/portfolio/interfaces/category')
							->set('category', $category);
				}

				$this->template->content = View::factory('back/portfolio/edit')
					->bind('title', $title)
					->set('fields', $fields)
					->set('settings', $portfolio->settings->find_all())
					->set('settings_fields', $settings_fields)
					->set('portfolio_categories', $portfolio->categories->find_all())
					->set('interfaces_add_work', $interfaces_add_work)
					->set('interfaces_category_settings', $interfaces_category_settings)
					->set('totalcategories', $portfolio->categories->count_all())
					->bind('mode', $mode)
					->set('portfolio', $portfolio);


				break;
		}


	}
}
