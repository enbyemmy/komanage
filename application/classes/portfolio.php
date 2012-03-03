<?php defined('SYSPATH') or die('No direct script access');

class Portfolio {
/**
 * Helper class for the portfolio application
 *
 */

	/**
	 * Returns the tags for a work if id is set, other wise returns all tags
	 * NOTE - portfolio id is required or else you will return multiple portfolios tags
 	 */
	public static function get_tags($portfolio_id, $id=null)
	{

		$method = (!is_null($id)) ? 'id' : 'all';

		switch($method) {

			case 'id':
				$tags = ORM::factory('portfolios_works')->where('id', '=' $id)->and_where('portfolio_id', '=', $portfolio_id)->tags->find_all();
				break;

			case 'all':
				$tags = ORM::factory('portfolios_tags')->where('portfolio_id', '=' $portfolio_id)->find_all();
				break;

		}

		return $tags;	

	}


}
