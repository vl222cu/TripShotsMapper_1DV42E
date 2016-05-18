<?php

require_once("src/controller/MapController.php");
require_once("src/helper/SessionHandler.php");

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
			$comment = $_GET['comment'];

 	    	$mapController = new \controller\MapController();
 	     	echo $mapController->saveUserMarker($lat, $lng, $comment);
 	      	exit;
 	    break;
 	} 
 }
