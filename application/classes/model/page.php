<?php

/**
 * This is the pages model
 */

class Model_Page extends ORM {

	protected $_table_name = "pages";

	protected $_primary_key = "id";

	protected $_has_many = array('content' => array('model' => 'content', 'through' => 'page_content'));


	// state changing

	/**
	 * add_content_block - this function will add a child content block to a page
	 * @param (array) $data - this is the data array that is will be considered when creating the new block
	 */
	public static function add_content_block($data)
	{

		if (!is_array($data) || !isset($data['page_id'])) return false;

		// load the page object
		$page = ORM::factory('page')->where('id', '=', $data['page_id']);

		// create the new content block by loading the object
		$content = ORM::factory('content');

		if (isset($data['name']))
		{
			$content->name = $data['name'];
		}
		else if (isset($data['content'])) {
			$content->content = $data['content'];
		}

		$content->modified = time();

		$content->save();

		$page->add('content', $content);

		return $page;

	}

}

?>
