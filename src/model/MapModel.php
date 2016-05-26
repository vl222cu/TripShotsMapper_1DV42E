<?php

namespace model;

require_once("./src/model/MapRepository.php");

class MapModel {

    private $mapRepository;
    private $loginSignupRepository;

    public function __construct() {

        $this->mapRepository = new \model\MapRepository();
    }

    public function getMarkersByUser($user) {

    	$userMarkers = $this->mapRepository->getAllMarkersFromDB($user);

    	if ($userMarkers) {
 
             return true;
       	}

        return false;        
    }

    public function saveMarkerByUser($user, $lat, $lng, $comment) {

        $savedMarker = $this->mapRepository->saveUserMarkerToDB($user, $lat, $lng, $comment);

        if ($savedMarker) {
 
             return true;
        }

        return false;        
    }

    public function deleteMarkerByUser($user, $lat, $lng) {

        $markerId = $this->mapRepository->getMarkerIdFromDB($user, $lat, $lng);

        $deletedMarker = $this->mapRepository->deleteUserMarkerFromDB($markerId);

        if ($deletedMarker) {
 
             return true;
        }

        return false;        
    }

    public function getSessionMessage() {

        if(!empty($_SESSION['message'])) {

            $message = $_SESSION['message'];

            return $message;
        }
        
        return NULL;
    }

    public function unsetSessionMessage() {

        $_SESSION['message'] = NULL;
    }
    
}