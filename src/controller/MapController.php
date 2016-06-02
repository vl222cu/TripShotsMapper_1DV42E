<?php

namespace controller;

require_once("src/model/mapModel.php");
require_once("src/model/LoginSignupModel.php");
require_once("src/model/LoginSignupRepository.php");

class MapController {

    private $mapModel;
	private $loginSignupModel;
	private $loginSignupRepository;

    public function __construct() {

        $this->mapModel = new \model\MapModel();
    	$this->loginSignupModel = new \model\LoginSignupModel();
        $this->loginSignupRepository = new \model\LoginSignupRepository();
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
    } 
}


