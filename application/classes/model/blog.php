<?php defined('SYSPATH') or die('No direct script access');

class Model_Blog extends ORM {

	protected $_table_name = "blogs";
	
	protected $_primary_key = "id";
	
	protected $_has_many = array(
		'categories' => array('model' => 'blog_category', 'foreign_key' => 'blog_id'),
		'settings' => array('model' => 'blog_setting', 'foreign_key' => 'blog_id'),
	);

	// state change actions

	/**
	 * Retrieve all active blogs
	 */
	public static function all()
	{
		$blogs = ORM::factory('blog')->where('deleted', '=', '')->find_all();

		return $blogs;

	}

}