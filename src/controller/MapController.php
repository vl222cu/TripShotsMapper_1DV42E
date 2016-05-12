<?php

namespace controller;

require_once("./src/model/MapModel.php");
require_once("./src/model/LoginSignupModel.php");
require_once("./src/view/LoginSignupView.php");
require_once("./src/model/LoginSignupRepository.php");
require_once("./src/view/MapView.php");

class MapController {

	private $loginSignupModel;
	private $loginSignupView;
	private $loginSignupRepository;
	private $mapView;
	private static $mode = 'mode';
    private static $get = 'get';

    public function __construct() {

    	$this->loginSignupModel = new \model\LoginSignupModel();
    	$this->loginSignupView = new \view\LoginSignupView($this->loginSignupModel);
        $this->loginSignupRepository = new \model\LoginSignupRepository();
        $this->mapView = new \view\MapView;

        $actionMode = $this->mapView->fetchAction(self::$mode);
        var_dump($actionMode);
        switch($actionMode) {

            case self::$get:
                $this->getUserMarkers();
                break;
        }
    }

    public function getUserMarkers() {

    	if ($this->loginSignupModel->userIsLoggedIn()) {

    		$userHasMarkers = $this->mapModel->getMarkersByUser($this->loginSignupView->getPostedUserName());

    		if ($userHasMarkers == null) {

    			return false;
    		}

    	return $userHasMarkers; 

    	}
    }
}

new MapController();

