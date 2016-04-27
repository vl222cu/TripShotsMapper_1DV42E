<?php

namespace controller;

require_once("./src/model/LoginModel.php");
require_once("./src/model/LoginRepository.php");
require_once("./src/view/LoginView.php");

class LoginController {

	private $loginModel;
	private $loginRepository;
	private $loginView;

	public function __construct() {

		$this->loginModel = new \model\LoginModel();
		$this->loginRepository = new \model\LoginRepository();
		$this->loginView = new \view\LoginView($this->loginModel);
	}

	public function doLogin() {

		$userAction = $this->loginView->getAction();

		try {

			switch ($userAction) {

				case \view\LoginView::$actionLoginPage:
					return $this->loginView->showLoginPage();
					break;

				case \view\LoginView::$actionLogin:
					return $this->loginUser();
					break;

				case \view\LoginView::$actionSignUpPage:
					return $this->loginView->showSignUpPage();
					break;

				case \view\LoginView::$actionSignUp:
				return $this->signUpNewUser();
				break;

				default: 
					return $this->loginView->LoginMainPage();
			}

		} catch (\Exception $e) {

			echo $e;
		} 
	}

	public function loginUser() {

		if ($this->loginModel->authenticateUser($this->loginView->getPostedUserName(), $this->loginView->getPostedPassword())) {

			$this->loginModel->setSessionVariables();
			$this->loginView->setMessage(\view\loginView::MESSAGE_SUCCESS_LOGIN);							

			return $this->loginView->showLoginPage();

		} else {
						
			if ($this->loginView->getPostedUserName() == "") {

				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME);

			} elseif ($this->loginView->getPostedPassword() == "") {

				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_PASSWORD);

			} else {

				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_PASSWORD);
			} 					
			
			return $this->loginView->showLoginPage();
		}
	}

	public function signUpNewUser() {
		if ($this->loginModel->authenticateUserSignUp($this->loginView->getPostedUserName(), $this->loginView->getPostedPassword())) {
			$this->loginModel->setSessionVariables();
			$this->loginView->setMessage(\view\loginView::MESSAGE_SUCCESS_SIGNUP);							
			return $this->loginView->showSignUpPage();
		} else {
						
			if ($this->loginView->getPostedUserName() == "" || strlen($this->loginView->getPostedUserName()) < 3) {
				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_TOO_SHORT);
			} elseif ($this->loginView->getPostedPassword() == "" || strlen($this->loginView->getPostedPassword()) < 6) {
				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_PASSWORD_TOO_SHORT);
			} elseif ($this->loginView->getPostedUserName() == "" && $this->loginView->getPostedPassword() == "" && $this->loginView->getConfirmedPassword() == "") {
				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_PASSWORD_MISSING);
			} elseif (preg_match('/[^A-Za-z0-9._\-$]/', $this->loginView->getPostedUserName())) {
				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_INVALID_CHARACTERS);
			} elseif (preg_match('/[^A-Za-z0-9._\-$]/', $this->loginView->getPostedPassword())) {
				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_PASSWORD_INVALID_CHARACTERS);
			} elseif ($this->loginView->getPostedPassword() != $this->loginView->getConfirmedPassword()) {
				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_PASSWORD_NO_MATCH);
			} else {
				$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_ALREADY_EXISTS);
			} 					
			
			return $this->loginView->showSignUpPage();
		}
	}
}