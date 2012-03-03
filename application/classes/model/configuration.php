<?php defined('SYSPATH') or die('No direct script access');

class Model_Configuration extends ORM {

	protected $_table_name = "configuration";

	protected $_primary_key = "key";

	/**
	 * state interactions
	 */

	public static function edit($post) {

		foreach($post as $field => $value) {

			$check = ORM::factory('configuration');

			if ($check->where('key', '=', $field)->count_all()) {

				$obj = $check->where('key', '=', $field)->find();
			}
			else {
				$obj = $check;
			}

				$obj->key = $field;
				$obj->value = $value;

				$obj->save();
		}

		return $obj;

	}

	public static function get_as_array() {

		// get the obj
		$obj = ORM::factory('configuration')->find_all();

		$return = array();

		foreach($obj as $o) {

			$return[$o->key] = $o->value;

		}

		return $return;

	}


}

?>
