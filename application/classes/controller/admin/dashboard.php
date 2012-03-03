<?php

/**
 * Default admin controller
 */

class Controller_Admin_Dashboard extends Abstract_Back_Process {

	public function action_index()
	{

		$this->template->title .= "Administration";
		$this->template->content = View::factory('back/dashboard');

	}

}

?>
