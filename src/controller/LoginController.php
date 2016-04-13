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

				default: 
					return $this->loginView->showLoginPage();
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
}