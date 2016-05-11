<?php

namespace controller;

require_once("./src/controller/LoginSignupController.php");

class MasterController {

	private $view;

	public function handleInput() {

		$user = new \controller\LoginSignupController();

		$this->view = $user->doLoginSignup(); 
	}

	public function generateOutput() {
		
		return $this->view;	
	} 
}