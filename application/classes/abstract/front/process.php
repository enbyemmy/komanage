<?php

/**
 * This is the abstract class that runs the frontend page processes, i.e. functions ran on all pages
 */
abstract class Abstract_Front_Process extends Abstract_Controller {

	public function before()
	{
		parent::before();

		// @todo: finish this fontend page process


		// set the js references
		$this->template->scripts = array(

		);

		// set the stylesheet references
		$this->template->scripts = array(

		);
		
	}
	
}