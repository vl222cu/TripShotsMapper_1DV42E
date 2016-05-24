<?php

require_once("src/controller/MapController.php");
require_once("src/controller/ImageController.php");
require_once("src/helper/SessionHandler.php");
require_once("src/view/HTMLView.php");
require_once("src/view/MapView.php");

sec_session_start();

if(isset($_GET['action'])) {

	switch ($_GET['action']) {

 	    case 'get':
 	    	$mapController = new \controller\MapController();
 	     	echo $mapController->getUserMarkers();
 	      	exit;
 	    break;

 	    case 'add':
			$lat = $_GET['lat'];
			$lng = $_GET['lng']; 
			$comment = filter_var($_GET['comment'], FILTER_SANITIZE_STRING);

 	    	$mapController = new \controller\MapController();
 	     	echo $mapController->saveUserMarker($lat, $lng, $comment);
 	      	exit;
 	    break;

 	    case 'delete':
			$lat = $_GET['lat'];
			$lng = $_GET['lng']; 

 	    	$mapController = new \controller\MapController();
 	     	echo $mapController->deleteUserMarker($lat, $lng);
 	      	exit;
 	    break;
 	    /**
 		* @todo temporary solution, need to find a better solution
 		*/
 	    case 'img':
			$markerId = $_GET['id']; 

 	    	$imageController = new \controller\ImageController();
 	    	$htmlBody = $imageController->doImage($markerId);
 	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	      	exit;
 	    break;
 	    /**
 		* @todo temporary solution, need to find a better solution
 		*/
 	    case 'return':
 	    	$mapView = new \view\MapView();
 	    	$htmlBody = $mapView->showMapView();
 	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	      	exit;
 	    break;
 	} 
 }
