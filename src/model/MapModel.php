<?php

namespace model;
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");*/

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
       	}

        return false;        
    }

    
}