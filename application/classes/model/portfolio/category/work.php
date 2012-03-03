<?php defined('SYSPATH') or die('No direct script access');

class Model_Portfolio_Category_Work extends ORM {

	protected $_table_name = "portfolios_categories_works";

	protected $_belongs_to = array("portfolio_work" => array(), "portfolio_category" => array());

}

?>
