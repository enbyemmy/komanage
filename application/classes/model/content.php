<?php defined('SYSPATH') or die('No direct script access');

class Model_Content extends ORM {

	protected $_table_name = "content";

	protected $_has_many = array('page', array('model' => 'page', 'through' => 'pages_content'));

}

?>
