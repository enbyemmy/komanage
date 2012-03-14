<?php

/**
 * This is the pages model
 */

class Model_Page extends ORM {

	protected $_table_name = "pages";

	protected $_primary_key = "id";

	protected $_has_many = array('blocks' => array('model' => 'block', 'through' => 'pages_blocks'));

}

?>
