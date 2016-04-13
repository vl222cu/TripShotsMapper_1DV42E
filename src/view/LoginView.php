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
			<div id='maincontainer'>
				 <h1>TripShotsMapper Loginpage</h1>
				 <p><a href='?return' class='return'>Tillbaka</a></p>
				 <form name='login' method='post' accept-charset='utf-8' action='?login'>			
					<div id='loginwrapper'>
					<p>Login - Skriv in användarnamn och lösenord</p>";

		if($this->getMessage() !== null) {

			$html .= "<div class='loginmsg'>$this->message</div>";
		};

	    $html .= "
						<p><label for='username'>Användarnamn</label>
						<input type='username' name='Username' id='nameinput' value='$this->name'></p>
						<p><label for='password'>Lösenord</label>
						<input type='password' name='Password' id='passwordinput'></p>
						</div>
						<p><input type='submit' name='submit' id='loginButton' value='Logga in'></p>			
					</form>
				</div>
			";

			return $html;
	}
}