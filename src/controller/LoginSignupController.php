<?php

namespace controller;

require_once("./src/model/LoginSignupModel.php");
require_once("./src/model/MapModel.php");
require_once("./src/model/LoginSignupRepository.php");
require_once("./src/view/LoginSignupView.php");
require_once("./src/view/StartView.php");
require_once("./src/view/MapView.php");
require_once("./src/model/MapRepository.php");
require_once("./src/controller/MapController.php"); 

class LoginSignupController {

	private $loginSignupModel;
	private $mapModel;
	private $loginSignupRepository;
	private $loginSignupView;
	private $startView;
	private $mapView;
	private $mapRepository;
	private $user;

	public function __construct() {

		$this->loginSignupModel = new \model\LoginSignupModel();
		$this->mapModel = new \model\MapModel();
		$this->loginSignupRepository = new \model\LoginSignupRepository();
		$this->loginSignupView = new \view\LoginSignupView($this->loginSignupModel);
		$this->startView = new \view\StartView();
		$this->mapView = new \view\MapView();
		$this->mapRepository = new \model\MapRepository();
		$this->mapController = new \controller\MapController();
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

		/** 
		 * Prevent Session hijacking
	 	*/
		if ($this->loginSignupModel->userIsLoggedIn()) {

			if ($this->loginSignupModel->getSessionControl() == false) {

				return $this->loginSignupView->showLoginSignupPage();

			} else {

				return $this->startView->showStartView();
			}

		}
						
		if ($this->loginSignupView->getPostedUserName() == "") {

			$this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_ERROR_USERNAME);

		} elseif ($this->loginSignupView->getPostedPassword() == "") {

			$this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_EMPTY_PASSWORD);

		} elseif (($this->loginSignupView->getPostedUserName() && $this->loginSignupView->getPostedPassword()) !== null) {

			$isUserLoginValid = $this->loginSignupModel->verifyUserPassword($this->loginSignupView->getPostedUserName(), $this->loginSignupView->getPostedPassword());

			if($isUserLoginValid == true) {

				$this->loginSignupModel->setSessionVariables($this->loginSignupView->getPostedUserName());

				$this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_SUCCESS_LOGIN);

//				$this->mapRepository->getAllMarkersFromDB($this->loginSignupRepository->getUserId($this->loginSignupView->getPostedUserName()));

				return $this->mapView->showMapView();

			} else {

	     	    $this->loginSignupView->setMessage(\view\loginSignupView::MESSAGE_ERROR_USERNAME_PASSWORD);

	            return $this->loginSignupView->showLoginSignupPage();				
	        }
	    }

		return $this->loginSignupView->showLoginSignupPage();
	}

	public function signUpNewUser() {

		if ($this->loginSignupView->getPostedSignupUserName() == "" && $this->loginSignupView->getPostedSignupPassword() == "" && $this->loginSignupView->getConfirmedPassword() == "") {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_USERNAME_PASSWORD_MISSING);

		} elseif ($this->loginSignupView->getPostedSignupUserName() == "" || strlen($this->loginSignupView->getPostedSignupUserName()) < 3) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_USERNAME_TOO_SHORT);

		} elseif ($this->loginSignupView->getPostedSignupPassword() == "" || strlen($this->loginSignupView->getPostedSignupPassword()) < 6) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_PASSWORD_TOO_SHORT);

		} elseif (preg_match('[\W]', $this->loginSignupView->getPostedSignupUserName())) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_USERNAME_INVALID_CHARACTERS);

		} elseif (preg_match('[\W]', $this->loginSignupView->getPostedSignupPassword())) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_PASSWORD_INVALID_CHARACTERS);

		} elseif ($this->loginSignupView->getPostedSignupPassword() !== $this->loginSignupView->getConfirmedPassword()) {

			$this->loginSignupView->setMessage(\view\LoginSignupView::MESSAGE_ERROR_PASSWORD_NO_MATCH);

		} elseif (($this->loginSignupView->getPostedSignupUserName() && $this->loginSignupView->getPostedSignupPassword() && $this->loginSignupView->getConfirmedPassword()) !== null) {

			$hashedPassword = $this->loginSignupModel->setPasswordhash($this->loginSignupView->getPostedSignupPassword());

			$isUserRegistrationValid = $this->loginSignupModel->authenticateUserSignUp($this->loginSignupView->getPostedSignupUserName(), $hashedPassword);

			if ($isUserRegistrationValid == true) {

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