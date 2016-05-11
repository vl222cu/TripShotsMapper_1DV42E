<?php

namespace controller;

require_once("./src/model/LoginSignupModel.php");
require_once("./src/model/MarkerRepository.php");
require_once("./src/model/LoginSignupRepository.php");
require_once("./src/view/LoginSignupView.php");
require_once("./src/view/StartView.php");
require_once("./src/view/MapView.php");

class LoginSignupController {

	private $loginSignupModel;
	private $markerModel;
	private $loginSignupRepository;
	private $loginSignupView;
	private $startView;
	private $mapView;
	private $user;

	public function __construct() {

		$this->loginSignupModel = new \model\LoginSignupModel();
		$this->markerRepository = new \model\MarkerRepository();
		$this->loginSignupRepository = new \model\LoginSignupRepository();
		$this->loginSignupView = new \view\LoginSignupView($this->loginSignupModel);
		$this->startView = new \view\StartView();
		$this->mapView = new \view\MapView();
		$this->user = null;
	}

	public function doLoginSignup() {

		$userAction = $this->loginSignupView->getAction();

		try {

			switch ($userAction) {

				case \view\LoginSignupView::$actionLoginSignupPage:
					return $this->loginSignupView->showLoginSignupPage();
					break; 

				case \view\LoginSignupView::$actionLogin:
					return $this->loginUser();
					break;

				case \view\LoginSignupView::$actionSignUp:
					return $this->signUpNewUser();
					break;

				case \view\LoginSignupView::$actionCancelLogin:
					return $this->startView->showStartView();
					break;

				case \view\LoginSignupView::$actionLogout:
					return $this->logoutUser();
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

		if ($this->loginSignupModel->authenticateUser($this->loginSignupView->getPostedUserName(), $this->loginSignupView->getPostedPassword())) {

			$this->loginSignupModel->setSessionVariables($this->loginSignupView->getPostedUserName());
		//	$this->markerRepository->getAllMarkersFromDB($this->loginRepository->getUserId($this->loginView->getPostedUserName()));
			$this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_SUCCESS_LOGIN);						
	
			return $this->mapView->showMapView();

		} else {
						
			if ($this->loginSignupView->getPostedUserName() == "") {

				$this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_ERROR_USERNAME);

			} elseif ($this->loginSignupView->getPostedPassword() == "") {

				$this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_ERROR_PASSWORD);

			} else {

				$this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_ERROR_USERNAME_PASSWORD);
			} 					
			
			return $this->loginSignupView->showLoginSignupPage();
		}
	}

	public function signUpNewUser() {

		if ($this->loginSignupView->getPostedUserName() == "" && $this->loginSignupView->getPostedPassword() == "" && $this->loginSignupView->getConfirmedPassword() == "") {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_USERNAME_PASSWORD_MISSING);

		} elseif ($this->loginSignupView->getPostedUserName() == "" || strlen($this->loginSignupView->getPostedUserName()) < 3) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_USERNAME_TOO_SHORT);

		} elseif ($this->loginSignupView->getPostedPassword() == "" || strlen($this->loginSignupView->getPostedPassword()) < 6) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_PASSWORD_TOO_SHORT);

		} elseif (preg_match('[\W]', $this->loginSignupView->getPostedUserName())) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_USERNAME_INVALID_CHARACTERS);

		} elseif (preg_match('[\W]', $this->loginSignupView->getPostedPassword())) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_PASSWORD_INVALID_CHARACTERS);

		} elseif ($this->loginSignupView->getPostedPassword() !== $this->loginSignupView->getConfirmedPassword()) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_PASSWORD_NO_MATCH);

		} elseif (($this->loginSignupView->getPostedUserName() && $this->loginSignupView->getPostedPassword() && $this->loginSignupView->getConfirmedPassword()) !== null) {

			$isUserRegistrationValid = $this->loginSignupModel->authenticateUserSignUp($this->loginSignupView->getPostedUserName(), $this->loginSignupView->getPostedPassword());

			if($isUserRegistrationValid == true) {

				$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_SUCCESS_SIGNUP);	
                return $this->mapView->showMapView();

            } else {

            	$this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_ERROR_USERNAME_ALREADY_EXISTS);
            	return $this->loginSignupView->showLoginSignupPage();	
            }
		} 

		return $this->loginSignupView->showLoginSignupPage();		
	}

	public function logoutUser() {

		$this->loginSignupModel->logout();

		return $this->startView->showStartView();

	}	
}