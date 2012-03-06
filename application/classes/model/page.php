<?php

/**
 * This is the pages model
 */

class Model_Page extends ORM {

	protected $_table_name = "pages";

	protected $_primary_key = "id";

	protected $_has_many = array('content' => array('model' => 'content', 'through' => 'page_content'));

}

?>
