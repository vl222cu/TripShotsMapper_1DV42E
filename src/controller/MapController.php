<?php

namespace controller;
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");*/
    
require_once("./src/model/mapRepository.php");
require_once("./src/model/LoginSignupModel.php");
require_once("./src/view/LoginSignupView.php");
require_once("./src/model/LoginSignupRepository.php");
require_once("./src/view/MapView.php"); 

class MapController {

	private $loginSignupModel;
	private $loginSignupView;
	private $loginSignupRepository;
	private $mapView;
	private $mapRepository;
	private static $mode = 'mode';
    private static $get = 'get';

    public function __construct() {

    	$this->mapRepository = new \model\MapRepository();
    	$this->loginSignupModel = new \model\LoginSignupModel();
    	$this->loginSignupView = new \view\LoginSignupView($this->loginSignupModel);
        $this->loginSignupRepository = new \model\LoginSignupRepository();
        $this->mapView = new \view\MapView;

/*        $actionMode = $this->mapView->fetchAction(self::$mode);
        var_dump($actionMode);
        switch($actionMode) {

            case self::$get:
                $this->getUserMarkers();
                break;
        }*/
    }

   public function getUserMarkers() {    	

    	$userHasMarkers = $this->mapRepository->getAllMarkersFromDB($this->loginSignupRepository->getUserId($this->loginSignupView->getPostedUserName()));

    	return $userHasMarkers; 
    	
    } 
}


