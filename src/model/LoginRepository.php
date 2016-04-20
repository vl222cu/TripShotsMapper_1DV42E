<?php

namespace model;

require_once ('./src/model/Repository.php');

class LoginRepository extends base\Repository {

    private $loginModel;
	private static $userName = 'username';
    private static $password = 'password';

    public function __construct() {

    	$this->dbTable = 'users';

    }

    /** 
     * Kontrollerar användaruppgifter i databasen
     */
    public function getUserCredentialsFromDB($user, $pwd) {

    	$db = $this->connection();

    	$sql = " SELECT * FROM $this->dbTable WHERE " . self::$userName . " = ?" . " AND " . self::$password . " = ?";
    	$query = $db->prepare($sql);
    	$query->execute(array($user, $pwd));  	

    	if($query->rowCount() > 0) {

    	    return true;

        } 

        return false;
    }

    public function setUserCredentialsInDB($user, $pwd) {

        $db = $this->connection();

        $sql = " SELECT * FROM $this->dbTable WHERE " . self::$userName . " = ?";
        $query = $db->prepare($sql);
        $query->execute(array($user));  


        if($query->rowCount() > 0) {

            return false;

        } else {

            $sql = " INSERT INTO $this->dbTable" . "(" . self::$userName . "," . self::$password . ")" . " VALUES (?, ?)";
                    $query = $db->prepare($sql);
                    $query->execute(array($user, $pwd));  

            if($query->rowCount() > 0) {

                return true;

            } 

            return false;
        }
    }

}