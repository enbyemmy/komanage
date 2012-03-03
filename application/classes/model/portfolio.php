<?php defined('SYSPATH') or die('No direct script access');

class Model_Portfolio extends ORM {

	protected $_table_name = "portfolios";

	protected $_has_many = array(
		'settings' => array('model' => 'portfolio_setting', 'foreign_key', 'portfolio_id'),
		'categories' => array('model' => 'portfolio_category', 'foreign_key' => 'portfolio_id'),
		'tags' 		=> array('model' => 'portfolio_tag', 'foreign_key' => 'portfolio_id'),
		);
	
//	protected $_has_many = array('works' => array('model' => 'portfolio_work', 'foreign_key' => 'id'));


	// state change actions

	/**
	 * Retrieve all active portfolios
	 */
	public static function all()
	{
		$portfolios = ORM::factory('portfolio')->where('deleted', '=', '')->find_all();

		return $portfolios;

	}

	/**
	 * settings - modify application settings
	 * @param (array) $data - the fuzzy input parameters
	 */
	public static function settings($data) {

		if (!is_array($data)) return false;

		// load the object
		$portfolio = ORM::factory('portfolio');

		foreach($data as $key => $value) {

			$p = $portfolio->where('field', '=', $key)->find();

			$p->field = $key;
			$p->value = $value;

			$p->save();

		}

		return $p;

	}


}

?>
