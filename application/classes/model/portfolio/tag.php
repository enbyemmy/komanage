<?php defined('SYSPATH') or die('No direct script access');

class Model_Portfolio_Tag extends ORM {

	protected $_table_name = "portfolios_tags";
	
	protected $_primary_key = "id";

	protected $_belongs_to = array(
		"portfolio" => array(
			"model" => "portfolio",
			"foreign_key", "portfolio_id",
		)
	);

}
