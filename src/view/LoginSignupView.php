<?php

namespace view;

class LoginSignupView {

	private $loginSignupModel;
	private $loginName;
	private $signupName;
	private $message = "";
	private static $userName = 'Username';
	private static $password = 'Password';
	private static $signupUserName = 'signupUsername';
	private static $signupPassword = 'signupPassword';
	private static $confirmedPassword = 'confirmedPassword';
	public static $actionLoginSignupPage = 'loginsignuppage'; 
	public static $actionLogin = 'login';
	public static $actionLogout = 'logout';
	public static $actionCancelLogin = 'cancelLogin';
	public static $actionSignUp = "signup";
	const MESSAGE_ERROR_USERNAME_PASSWORD = 'Wrong username and/or password';
	const MESSAGE_ERROR_USERNAME = 'Username is missing';
	const MESSAGE_EMPTY_PASSWORD = 'Password is missing';
	const MESSAGE_ERROR_PASSWORD = 'Password is not correct';
	const MESSAGE_SUCCESS_LOGIN = 'You are now logged in. Welcome to TripShotsmapper!';
	const MESSAGE_ERROR_USERNAME_TOO_SHORT = 'Username needs to have a minimum of 3 characters';
	const MESSAGE_ERROR_USERNAME_INVALID_CHARACTERS = 'Username has invalid characters. Only letters, numbers and underscore are accepted characters';
	const MESSAGE_ERROR_PASSWORD_INVALID_CHARACTERS = 'Password has invalid characters. Only letters, numbers and underscore are accepted characters';
	const MESSAGE_ERROR_USERNAME_ALREADY_EXISTS = 'Username already exists';
	const MESSAGE_ERROR_PASSWORD_TOO_SHORT = 'Password needs to have a minimum of 6 characters';
	const MESSAGE_SUCCESS_SIGNUP = 'You are now signed up. Welcome to TripShotsmapper!';
	const MESSAGE_ERROR_PASSWORD_NO_MATCH = 'Confirmed password does not match password';
	const MESSAGE_ERROR_USERNAME_PASSWORD_MISSING = 'Username needs to have a minimum of 3 characters and Password needs to have a minimum of 6 characters';
	const MESSAGE_ERROR_SIGNUP = 'Something went wrong! Please try again';
	const MESSAGE_SUCCESS_LOGOUT = 'You are now signed out. Visit us again soon!';

	public function __construct(\model\LoginSignupModel $loginSignupModel) {
		
		$this->loginSignupModel = $loginSignupModel;
		$this->loginName = isset($_POST[self::$userName]) ? $_POST[self::$userName] : '';
		$this->signupName = isset($_POST[self::$signupUserName]) ? $_POST[self::$signupUserName] : '';

	}

	public function getAction() {

		switch (key($_GET)) {

			case self::$actionLoginSignupPage:
				$action = self::$actionLoginSignupPage;
				return $action;
				break; 

			case self::$actionLogin:
				$action = self::$actionLogin;
				return $action;
				break;

			case self::$actionSignUp:
				$action = self::$actionSignUp;
				return $action;
				break;

			case self::$actionCancelLogin:
				$action = self::$actionCancelLogin;
				return $action;
				break;

			default:
				$action = "";
		}
	}

	public function getMessage() {

        return $this->message;
    }

    public function getConfirmedPassword() {

        if (empty($_POST[self::$confirmedPassword])) {

    		return "";

    	} else {
        
        	return strip_tags($_POST[self::$confirmedPassword]);
        }
    }

    public function getPostedUserName() {

	 	if (empty($_POST[self::$userName])) {

	 		return "";

	 	} else {

       		return strip_tags($_POST[self::$userName]);
    	}
    }

    public function getPostedPassword() {

    	if (empty($_POST[self::$password])) {

    		return "";

    	} else {
        
        	return strip_tags($_POST[self::$password]);
        }
   }

   public function getPostedSignupUserName() {

	 	if (empty($_POST[self::$signupUserName])) {

	 		return "";

	 	} else {

       		return strip_tags($_POST[self::$signupUserName]);
    	}
    }

    public function getPostedSignupPassword() {

    	if (empty($_POST[self::$signupPassword])) {

    		return "";

    	} else {
        
        	return strip_tags($_POST[self::$signupPassword]);
        }
   }


    public function setMessage($msg) {

		$this->message = '<span class="label label-info">' . $msg . '</span>';
	}

	public function showLoginSignupPage() {

		$html = "<div class='top-content'>       	
            		<div class='inner-bg'>
            			<a href='?cancelLogin'><button type ='button' class ='close' aria-hidden='true'>&times;</button></a>
                		<div class='container'>
                
		";

		if($this->getMessage() !== null) {

			$html .= "<div class='loginMsg'>$this->message</div>";

		};

		$html .= "	<div class='row'>
                        <div class='col-sm-5'>
                        	<div class='form-box'>
	                        	<div class='form-top'>
	                        		<div class='form-top-left'>
	                        			<h3>Login to our site</h3>
	                            		<p>Enter username and password to log on:</p>
	                        		</div>
	                        		<div class='form-top-right'>
	                        			<i class='fa fa-key'></i>
	                        		</div>
	                            </div>
	                            <div class='form-bottom'>
				                    <form role='form' name='login' action='?login' method='post' class='login-form' accept-charset='utf-8' >
				                    	<div class='form-group'>
				                    		<label class='sr-only' for='form-username'>Username</label>
				                        	<input type='text' name='Username' placeholder='Username...' class='form-username form-control' id='form-username' value='$this->loginName'>
				                        </div>
				                        <div class='form-group'>
				                        	<label class='sr-only' for='form-password'>Password</label>
				                        	<input type='password' name='Password' placeholder='Password...' class='form-password form-control' id='form-password'>
				                        </div>
				                        <button type='submit' class='btn'>Sign in!</button>
				                    </form>
			                    </div>
		                    </div>
		                </div>
		                <div class='col-sm-1 middle-border'></div>
                        <div class='col-sm-1'></div>
                        	
                        <div class='col-sm-5'>
                        	
                        	<div class='form-box'>
                        		<div class='form-top'>
	                        		<div class='form-top-left'>
	                        			<h3>Sign up now</h3>
	                            		<p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class='form-top-right'>
	                        			<i class='fa fa-pencil'></i>
	                        		</div>
	                            </div>
	                            <div class='form-bottom'>
				                    <form role='form' name='signup' action='?signup' method='post' class='registration-form' accept-charset='utf-8'>
				                    	<div class='form-group'>
				                    		<label class='sr-only' for='form-username'>Username</label>
				                        	<input type='text' name='signupUsername' placeholder='Username...'  class='form-username form-control' id='form-username' value='$this->signupName'>				    
				                        </div>
				                         <div class='form-group'>
				                        	<label class='sr-only' for='form-password'>Password</label>
				                        	<input type='password' name='signupPassword' placeholder='Password...' class='form-password form-control' id='form-password'>
				                        </div>
				                        <div class='form-group'>
				                        	<label class='sr-only' for='form-password'>Password</label>
				                        	<input type='password' name='confirmedPassword' placeholder='Confirm password...' class='form-password form-control' id='form-confirmPassword'>
				                        </div>
				                        <button type='submit' class='btn'>Sign me up!</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>           
		";

		return $html;

	}
}