<?php defined('SYSPATH') or die('No direct script access');

class Model_Portfolio_Setting extends ORM {

	protected $_table_name = "portfolios_settings";

	protected $_belongs_to = array('portfolio' => array('foreign_key', 'id'));

}