<?php

class Model_Block extends ORM {

	protected $_has_many = array(
		'pages' => array(
			'model' => 'page',
			'through' => 'pages_blocks'
		),
		'content' => array(
			'model' => 'content',
			'foreign_key' => 'block_id',
		),
	);



}
