<?php

namespace model;

require_once("./src/model/MapRepository.php");
require_once("./src/model/LoginSignupRepository.php"); 

class MapModel {

    private $mapRepository;
    private $loginSignupRepository;
/*    private static $mode = 'mode';
    private static $get = 'get'; */

    public function __construct() {

        $this->mapRepository = new \model\MapRepository();
        $this->loginSignupRepository = new \model\LoginSignupRepository();


/*        $actionMode = $this->fetch(self::$mode);

        switch($actionMode) {

            case self::$get:
                $this->getMarkersByUser();
                break;
        } */
    }

    public function getMarkersByUser($user) {

    	$userMarkers = $this->mapRepository->getAllMarkersFromDB($user);

    	if ($userMarkers) {
 
             return true;
       	}

        return false;        
    }

    
}