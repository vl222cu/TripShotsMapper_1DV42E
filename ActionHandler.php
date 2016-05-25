<?php
/**
 * @todo temporary solution with this file, want to find another way to solve
 * the routing of actions
 */
require_once("src/controller/LoginSignupController.php");
require_once("src/controller/MapController.php");
require_once("src/controller/ImageController.php");
require_once("src/model/Imagemodel.php");
require_once("src/helper/SessionHandler.php");
require_once("src/view/HTMLView.php");
require_once("src/view/MapView.php");
require_once("src/view/ImageView.php");

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

 	    case 'img':
			$markerId = $_GET['id']; 

 	    	$imageController = new \controller\ImageController();
 	    	$htmlBody = $imageController->showAllImages($markerId);
 	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	      	exit;
 	    break;

 	    case 'return':
 	    	$mapView = new \view\MapView();
 	    	$htmlBody = $mapView->showMapView();
 	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	      	exit;
 	    break;

 	     case 'logout':
 	    	$loginSignupController = new \controller\LoginSignupController();
 	    	$htmlBody = $loginSignupController->logoutUser();
	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	      	exit;
 	    break;

 	    case 'addImg':
 	    	$imageController = new \controller\ImageController();
 	    	$imageModel = new \model\ImageModel();
 	    	$imageView = new \view\ImageView($imageModel);
 	    	$markerId = $imageView->getMarkerId();
 	    	$htmlBody = $imageController->showAddImagePage($markerId);
 	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	      	exit;
 	    break;

 	    case 'retImg':
 			$imageModel = new \model\ImageModel();
 	    	$imageView = new \view\ImageView($imageModel);
 	    	$markerId = $imageView->getMarkerId();
 	    	$imageController = new \controller\ImageController();
 	    	var_dump($markerId);
 	    	$htmlBody = $imageController->showAllImages($markerId);
 	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	      	exit;
 	    break;


 	    case 'uploadImg':
 			$imageModel = new \model\ImageModel();
 	    	$imageView = new \view\ImageView($imageModel);
 	    	$markerId = $imageView->getMarkerId();
 	    	$imageController = new \controller\ImageController();
 	    	$htmlBody = $imageController->uploadImage($markerId);
 	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	      	exit;
 	    break;

 	    case 'deleteImg':
 	    	$imageModel = new \model\ImageModel();
 	    	$imageView = new \view\ImageView($imageModel);
 	    	$markerId = $imageView->getMarkerId();
 	    	$imageController = new \controller\ImageController();
 	    	$htmlBody = $imageController->deleteImage($markerId);
 	    	$htmlView = new \view\HTMLView();
 	     	$htmlView->showHTML("TripShotsMapper", $htmlBody);
 	    	exit;
 	    break;

 	}
} 