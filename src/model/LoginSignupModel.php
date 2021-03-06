<?php

namespace model;

require_once("./library/password_compat-master/lib/password.php");
require_once("./src/model/LoginSignupRepository.php");

class LoginSignupModel {

	private static $userName = 'username';
    private static $password = 'password';
    private static $userAgent = 'userAgent';
    private static $HTTPUserAgent = 'HTTP_USER_AGENT';
    private static $path = 'path';
    private static $domain = 'domain';
    private static $secure = 'secure';
    private static $httponly = 'httponly';
    public static $message = 'message';
    private $loginSignupRepository;

    public function __construct() {

        $this->loginSignupRepository = new \model\LoginSignupRepository();

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

        $_SESSION[self::$userName] = $userName;
        $_SESSION[self::$userAgent] = $_SERVER[self::$HTTPUserAgent];
    }

    public function getSessionUsername() {

        if(isset($_SESSION[self::$userName])) {

            return $_SESSION[self::$userName];
        }
    }

    public function userIsLoggedIn() {

		if (isset($_SESSION[self::$userName]) && $_SESSION[self::$userName]) {

			return true;		
		}

		return false;
	}

	public function getSessionControl() {

		if ($_SESSION[self::$userAgent] === $_SERVER[self::$HTTPUserAgent]) {

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
                $params[self::$path], 
                $params[self::$domain], 
                $params[self::$secure], 
                $params[self::$httponly]);

        session_destroy();
	}

    public function setPasswordhash($password) {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        return $hashedPassword;
    }

    public function verifyUserPassword($user, $pwd) {

        $dbPwd = $this->loginSignupRepository->getUserDBPassword($user);

        if(password_verify($pwd, $dbPwd)) {

            return true;
        }

        return false;
    }

    public function setSessionMessage($msg) {

        $_SESSION[self::$message] = $msg;
    }
}

