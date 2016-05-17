<?php

namespace controller;
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");*/

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