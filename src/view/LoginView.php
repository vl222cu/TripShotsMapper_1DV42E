<?php

namespace view;

class LoginView {

	private $loginModel;
	private $name;
	private $message = "";
	private static $userName = 'Username';
	private static $password = 'Password';
	public static $actionLoginPage = "loginpage";
	public static $actionLogin = "login";
	public static $actionLogout = "logout";
	const MESSAGE_ERROR_USERNAME_PASSWORD = 'Wrong username and/or password';
	const MESSAGE_ERROR_USERNAME = 'Username is missing';
	const MESSAGE_ERROR_PASSWORD = 'Password is missing';
	const MESSAGE_SUCCESS_LOGIN = 'You are logged in!';

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

			default:
				$action = "";
		}
	}

	public function getMessage() {

        return $this->message;
    }

       public function getPostedUserName() {

	 	if (empty($_POST[self::$userName])) {

	 		return "";

	 	} else {

       		return $_POST[self::$userName];
    	}
    }

    public function getPostedPassword() {

    	if (empty($_POST[self::$password])) {

    		return "";

    	} else {
        
        	return $_POST[self::$password];
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
}