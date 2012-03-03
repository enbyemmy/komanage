<?php defined('SYSPATH') or die('No direct script access');

class Model_Preferences extends ORM {

	protected $_table_name = "preferences";

	protected $_primary_key = "key";

	public static function edit($post) {

		foreach($post as $field => $value) {

			$obj = ORM::factory('preferences');

			$obj->key = $field;
			$obj->value = $value;

			$obj->save();
		}

		return $obj;

	}


}

?>
