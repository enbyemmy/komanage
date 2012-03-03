<?php

/**
 * This is the abstract class that runs the backend page processes, i.e. functions ran on all pages
 */
abstract class Abstract_Back_Process extends Abstract_Controller {

	public function before()
	{
		parent::before();

		// check if there is an admin level user logged in other wise redirect them to the login form
		

		// @todo write this page process for the backend
		
	}
	
}