<?php
/**
 * This is a helper class for applications
 */
class Applications {


	public static function get_all()
	{

		// get all the currently active app instances
		$portfolios = ORM::factory('portfolio')->all();
		$blogs = ORM::factory('blog')->all();


		return array(
			'portfolio' => $portfolios,
			'blog'		=> $blogs,
		);

	}

}

?>
