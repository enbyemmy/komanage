<?php defined('SYSPATH') or die('No direct script access');

class Model_Content extends ORM {

	protected $_table_name = "content";

	protected $_has_many = array('page' => array('model' => 'page', 'through' => 'pages_content'));

/*	public static function get_all()
	{

		$contents = ORM::factory('content')->find_all();
		return $contents;
	}

	public static function by_page($uri=null)
	{

		if (is_null($uri)) return false;
	
		$contents = ORM::factory('page')->where('uri', '=', $uri)->content->find_all();

		return $contents;
	}

	public static function edit($name, $content, $content_id=null)
	{
		
		$mode = (is_null($content_id)) ? 'add' : 'edit';

		$content = ORM::factory('content', $content_id);

		$content->name = $name;
		$content->content = $content;
		$content->modified = time();

		$content->save();
	
		return $content;

	}
*/



}

?>
