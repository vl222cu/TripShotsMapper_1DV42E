<?php

namespace controller;

require_once("./src/model/LoginModel.php");
require_once("./src/model/MarkerRepository.php");
require_once("./src/model/LoginRepository.php");
require_once("./src/view/LoginView.php");
require_once("./src/view/StartView.php");
require_once("./src/view/MapView.php");

class LoginController {

	private $loginModel;
	private $markerModel;
	private $loginRepository;
	private $loginView;
	private $startView;
	private $mapView;
	private $user;

	public function __construct() {

		$this->loginModel = new \model\LoginModel();
		$this->markerRepository = new \model\MarkerRepository();
		$this->loginRepository = new \model\LoginRepository();
		$this->loginView = new \view\LoginView($this->loginModel);
		$this->startView = new \view\StartView();
		$this->mapView = new \view\MapView();
		$this->user = null;
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

				case \view\LoginView::$actionSignUp:
					return $this->signUpNewUser();
					break;

				case \view\LoginView::$actionCancelLogin:
					return $this->startView->showStartView();
					break;

				default: 
					return $this->startView->showStartView();
					break;
			}

		} catch (\Exception $e) {

			echo $e;
		} 
	}

	public function loginUser() {

		if ($this->loginModel->authenticateUser($this->loginView->getPostedUserName(), $this->loginView->getPostedPassword())) {

			$this->loginModel->setSessionVariables($this->loginView->getPostedUserName());
			$this->markerRepository->getAllMarkersFromDB($this->loginRepository->getUserId($this->loginView->getPostedUserName()));
			$this->loginView->setMessage(\view\loginView::MESSAGE_SUCCESS_LOGIN);							

			return $this->mapView->showMapView();

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

		if ($this->loginView->getPostedUserName() == "" && $this->loginView->getPostedPassword() == "" && $this->loginView->getConfirmedPassword() == "") {

			$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_PASSWORD_MISSING);

		} elseif ($this->loginView->getPostedUserName() == "" || strlen($this->loginView->getPostedUserName()) < 3) {

			$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_TOO_SHORT);

		} elseif ($this->loginView->getPostedPassword() == "" || strlen($this->loginView->getPostedPassword()) < 6) {

			$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_PASSWORD_TOO_SHORT);

		} elseif (preg_match('[\W]', $this->loginView->getPostedUserName())) {

			$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_INVALID_CHARACTERS);

		} elseif (preg_match('[\W]', $this->loginView->getPostedPassword())) {

			$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_PASSWORD_INVALID_CHARACTERS);

		} elseif ($this->loginView->getPostedPassword() !== $this->loginView->getConfirmedPassword()) {

			$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_PASSWORD_NO_MATCH);

		} elseif (($this->loginView->getPostedUserName() && $this->loginView->getPostedPassword() && $this->loginView->getConfirmedPassword()) !== null) {

			$isUserRegistrationValid = $this->loginModel->authenticateUserSignUp($this->loginView->getPostedUserName(), $this->loginView->getPostedPassword());

			if($isUserRegistrationValid == true) {

				$this->loginView->setMessage(\view\loginView::MESSAGE_SUCCESS_SIGNUP);	
                return $this->loginView->showLoginPage(); /*TODO: skapa inloggad sida med karta**/

            } else {

            	$this->loginView->setMessage(\view\loginView::MESSAGE_ERROR_USERNAME_ALREADY_EXISTS);
            	return $this->loginView->showLoginPage();	
            }
		} 

		return $this->loginView->showLoginPage();		
	}
}