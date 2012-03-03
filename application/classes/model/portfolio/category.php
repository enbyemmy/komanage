<?php defined('SYSPATH') or die('No direct script access');

class Model_Portfolio_Category extends ORM {

	protected $_table_name = "portfolios_categories";

	protected $_belongs_to = array('portfolio' => array('model' => 'portfolio', 'foreign_key' => 'id'));

	protected $_has_many = array("works" => array("model" => "portfolio_work", "through" => "portfolio_category_work"));

}

?>
