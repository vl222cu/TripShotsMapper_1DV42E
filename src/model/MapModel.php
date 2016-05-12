<?php

namespace model;

require_once("./src/model/MapRepository.php");
require_once("./src/model/LoginSignupRepository.php");

class MapModel {

    private $markerRepository;
    private $loginSignupRepository;
/*    private static $mode = 'mode';
    private static $get = 'get'; */

    public function __construct() {

        $this->markerRepository = new \model\MapRepository();
        $this->loginSignupRepository = new \model\LoginSignupRepository();

/*        $actionMode = $this->fetch(self::$mode);

        switch($actionMode) {

            case self::$get:
                $this->getMarkersByUser();
                break;
        } */
    }

    public function getMarkersByUser($user) {

    	$userMarkers = $this->markerRepository->getAllMarkersFromDB($this->loginSignupRepository->getUserId($user));

    	if ($userMarkers) {
 
            return true;

        } else {

            return false;
        }
    }
}