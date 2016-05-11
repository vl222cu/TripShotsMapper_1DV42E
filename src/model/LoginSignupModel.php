<?php

namespace model;

require_once("./src/helper/SessionHandler.php");
require_once("./src/model/LoginSignupRepository.php");

class LoginSignupModel {

	private $userName;
    private $password;
    private $loggedIn;
    private $userAgent;
    private $loginSignupRepository;
    private static $HTTPUserAgent = 'HTTP_USER_AGENT';

    public function __construct() {

        $this->userName = null;
        $this->password = null;
        $this->loggedIn = false;
        $this->userAgent = null;
        $this->loginSignupRepository = new LoginSignupRepository();

    }
    
    public function authenticateUser($userName, $password) {

        $user = $this->loginSignupRepository->getUserCredentialsFromDB($userName, $password);

        if ($user) {
 
            return true;

        } else {

            return false;
        }
    }

    public function authenticateUserSignUp($userName, $password) {

        $newUser = $this->loginSignupRepository->setUserCredentialsInDB($userName, $password);

        if ($newUser) {
 
            return true;

        } else {

            return false;
        }
    }

   	public function setSessionVariables($userName) {

		$_SESSION[$this->loggedIn] = true;
        $_SESSION[$this->userName] = $userName;
        $_SESSION[$this->userAgent] = $_SERVER[self::$HTTPUserAgent];
    }

    public function getSessionUsername() {

        if(isset($_SESSION[$this->userName])) {

            return $_SESSION[$this->userName];
        }
    }

    public function userIsLoggedIn() {

		if (isset($_SESSION[$this->loggedIn]) && $_SESSION[$this->loggedIn]) {

			return true;		
		}

		return false;
	}

	public function getSessionControl() {

		if ($_SESSION[$this->userAgent] === $_SERVER[self::$HTTPUserAgent]) {

			return true;
		}

		return false;
	}

	public function logOut() {
        
        // Unset all session values 
        $_SESSION = array();
 
                // get session parameters 
        $params = session_get_cookie_params();
         
        // Delete the actual cookie. 
        setcookie(session_name(),
                '', time() - 42000, 
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);

        session_destroy();
	}
}