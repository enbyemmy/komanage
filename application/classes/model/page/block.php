<?php

class Model_Page_Block extends ORM {
	
	protected $_table_name = 'pages_blocks';

	protected $_belongs_to = array(
		'page' => array(),
		'block' => array(),
	);

}
