<?php

namespace view;

class LoginView {

	private $loginModel;
	private $name;
	private $message = "";
	private static $userName = 'Username';
	private static $password = 'Password';
	private static $confirmedPassword = 'confirmedPassword';
	public static $actionLoginPage = "loginpage";
	public static $actionLogin = "login";
	public static $actionLogout = "logout";
	public static $actionSignUpPage = "signuppage";
	public static $actionSignUp = "signup";
	const MESSAGE_ERROR_USERNAME_PASSWORD = 'Wrong username and/or password';
	const MESSAGE_ERROR_USERNAME = 'Username is missing';
	const MESSAGE_ERROR_PASSWORD = 'Password is missing';
	const MESSAGE_SUCCESS_LOGIN = 'You are logged in!';
	const MESSAGE_ERROR_USERNAME_TOO_SHORT = 'Username needs to have a minimum of 3 characters';
	const MESSAGE_ERROR_USERNAME_INVALID_CHARACTERS = 'Username has invalid characters';
	const MESSAGE_ERROR_PASSWORD_INVALID_CHARACTERS = 'Password has invalid characters';
	const MESSAGE_ERROR_USERNAME_ALREADY_EXISTS = 'Username already exists';
	const MESSAGE_ERROR_PASSWORD_TOO_SHORT = 'Password needs to have a minimum of 6 characters';
	const MESSAGE_SUCCESS_SIGNUP = 'You are now signed up';
	const MESSAGE_ERROR_PASSWORD_NO_MATCH = 'Confirmed password does not match password';
	const MESSAGE_ERROR_USERNAME_PASSWORD_MISSING = 'Username needs to have a minimum of 3 characters and Password needs to have a minimum of 6 characters';

	public function __construct(\model\LoginModel $loginModel) {
		
		$this->loginModel = $loginModel;
		$this->name = isset($_POST[self::$userName]) ? $_POST[self::$userName] : '';

	}

	public function getAction() {

		switch (key($_GET)) {

			case self::$actionLoginPage:
				$action = self::$actionLoginPage;
				return $action;
				break;

			case self::$actionLogin:
				$action = self::$actionLogin;
				return $action;
				break;

			case self::$actionSignUpPage:
				$action = self::$actionSignUpPage;
				return $action;
				break;

			case self::$actionSignUp:
				$action = self::$actionSignUp;
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

    public function setMessage($msg) {

		$this->message = '<p>' . $msg . '</p>';
	}

	public function showLoginPage() {

		$html = "
				 <form role='form' name='login' method='post' accept-charset='utf-8' action='?login'>			
					<p>Login - Enter your username and password</p>";

		if($this->getMessage() !== null) {

			$html .= "<div class='loginmsg'>$this->message</div>";
		};

	    $html .= "
	    				<div class='form-group'>
							<label for='username'>Username:</label>
							<input type='username' name='Username' class='form-control' id='nameinput' value='$this->name'></p>
						</div>
						<div class='form-group'>
							<label for='password'>Password:</label>
							<input type='password' name='Password' class='form-control' id='passwordinput'></p>
						</div>
						<button type='submit' name='submit' class='btn btn-default'>Submit</button>			
					</form>
			";

			return $html;
	}

	public function LoginMainPage() {

		return "<nav class='navbar navbar-default navbar-custom'>
                            <div class='container'>
                                <div class='navbar-header'>
                                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavBar'>
                                        <span class='sr-only'>Toggle navigation</span>
                                        <span class='icon-bar'></span>
                                        <span class='icon-bar'></span>
                                        <span class='icon-bar'></span>
                                    </button>
                                </div>
                                <div class='collapse navbar-collapse' id='myNavBar'>
                                    <ul class='nav navbar-nav navbar-right'>
                                        <li><a href='?loginpage'><span class='glyphicon glyphicon-log-in'></span>Sign In</a></li>
                                        <li><a href='?signuppage'><span class='glyphicon glyphicon-user'></span>Sign up</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>";
	}

	public function showSignUpPage() {

		$html = "<div class='container'>
    				<div class='row'>
        				<form role='form' name='signup' method='post' accept-charset='utf-8' action='?signup'>";

        if($this->getMessage() !== null) {

			$html .= "<div class='loginmsg'>$this->message</div>";
		};

        $html .=    		"<div class='col-lg-6'>
                				<div class='well well-sm'><strong><span class='glyphicon glyphicon-asterisk'></span>Required Field</strong></div>
                				<div class='form-group'>
                    				<label for='InputName'>Enter Username</label>
                    				<div class='input-group'>
                        				<input type='text' class='form-control' name='Username' id='InputName' placeholder='Enter Username' value='$this->name'>
                        				<span class='input-group-addon'><span class='glyphicon glyphicon-asterisk'></span></span>
                    				</div>
                				</div>
                				<div class='form-group'>
                    				<label for='InputPassword'>Enter Password</label>
                    				<div class='input-group'>
                        				<input type='password' class='form-control' id='InputPasswordFirst' name='Password' placeholder='Enter Password'>
                        				<span class='input-group-addon'><span class='glyphicon glyphicon-asterisk'></span></span>
                    				</div>
                				</div>
                				<div class='form-group'>
                    				<label for='InputPassword'>Confirm Password</label>
                    				<div class='input-group'>
                        				<input type='password' class='form-control' id='InputPasswordSecond' name='confirmedPassword' placeholder='Confirm Password'>
                        				<span class='input-group-addon'><span class='glyphicon glyphicon-asterisk'></span></span>
                    				</div>
                				</div>
                				<input type='submit' name='submit' id='submit' value='Submit' class='btn btn-info pull-right'>
            				</div>
        				</form>
    				</div>
				</div>";

		return $html;				 
	}
}