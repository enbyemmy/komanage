<?php defined('SYSPATH') or die ('No direct script access');

class Model_Portfolio_Work extends ORM {

	protected $_table_name = "portfolios_works";

	protected $_has_many = array(
		"categories" => array(
			"model" => "portfolio_category",
			"through" => "portfolio_category_work"
		),
		"tags" => array(
			"model" => "portfolio_tag",
			"through" => "portfolio_work_tag",
		),
	);

}

?>
