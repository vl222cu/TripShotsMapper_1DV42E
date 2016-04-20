<?php

namespace controller;

require_once("./src/model/LoginModel.php");
require_once("./src/controller/LoginController.php");

class MasterController {

	private $loginModel;
	private $view;

	public function __construct() {

		$this->loginModel = new \model\LoginModel();
	}

	public function handleInput() {

		if ($this->loginModel->UserIsLoggedIn()) {
			
			echo "User is logged in!";
		} else {
			$user = new \controller\LoginController();

			$this->view = $user->doLogin(); 
		}
	}

	public function generateOutput() {
		
		return $this->view;
	}
}