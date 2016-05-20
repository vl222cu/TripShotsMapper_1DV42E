<?php

namespace controller;

require_once("src/model/mapModel.php");
require_once("src/model/mapRepository.php");
require_once("src/model/LoginSignupModel.php");
require_once("src/view/LoginSignupView.php");
require_once("src/model/LoginSignupRepository.php");

class MapController {

    private $mapModel;
	private $loginSignupModel;
	private $loginSignupView;
	private $loginSignupRepository;
	private $mapRepository;

    public function __construct() {

        $this->mapModel = new \model\MapModel();
    	$this->mapRepository = new \model\MapRepository();
    	$this->loginSignupModel = new \model\LoginSignupModel();
    	$this->loginSignupView = new \view\LoginSignupView($this->loginSignupModel);
        $this->loginSignupRepository = new \model\LoginSignupRepository();

/*        $actionMode = $this->mapView->fetchAction(self::$mode);
        var_dump($actionMode);
        switch($actionMode) {

            case self::$get:
                $this->getUserMarkers();
                break;
        }*/
    }

   public function getUserMarkers() {    	

        $postedUserName = $this->loginSignupModel->getSessionUsername();

        $userId = $this->loginSignupRepository->getUserId($postedUserName);
  
        $xmlMarkers = $this->mapModel->getMarkersByUser($userId);

    	return $xmlMarkers; 
    	
    } 

    public function saveUserMarker($lat, $lng, $comment) {      

        $postedUserName = $this->loginSignupModel->getSessionUsername();

        $userId = $this->loginSignupRepository->getUserId($postedUserName);

        $this->mapModel->saveMarkerByUser($userId, $lat, $lng, $comment);
        
    } 

    public function deleteUserMarker($lat, $lng) {      

        $postedUserName = $this->loginSignupModel->getSessionUsername();

        $userId = $this->loginSignupRepository->getUserId($postedUserName);

        $this->mapModel->deleteMarkerByUser($userId, $lat, $lng);

/*        $markerId = $this->mapRepository->getMarkerId($userId, $lat, $lng);

        $this->mapRepository->deleteUserMarkerFromDB($markerId);*/
        
    } 
}


