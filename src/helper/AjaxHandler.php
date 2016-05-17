<?php

/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");*/

/*
require_once("C:TripShotsMapper_1DV42E/src/model/MapRepository.php");
require_once("C:TripShotsMapper_1DV42E/src/model/LoginRepository.php");
require_once("C:TripShotsMapper_1DV42E/src/model/LoginModel.php");
require_once("C:TripShotsMapper_1DV42E/src/view/LoginView.php");
 	
$mapRepository = new \model\MapRepository();
$loginRepository = new \model\loginRepository();
$loginModel = new \model\LoginModel();
$loginView = new \view\LoginView($loginModel); */

if(isset($_GET['action'])) {

	switch ($_GET['action']) {
 
	   	case 'get':
 	    	header('Content-Type: application/xml');
 	     	$file = file_get_contents('getMarkers.xml');
 	     	echo $file;	
 	      	exit;
 	    break; 

 	    case 'add':
 	    	$file = 'addMarkers.xml';
 	    	$file = realpath($file);
 	    	
 	    	$lat = $_GET['lat'];
			$lng = $_GET['lng'];
			$comment = $_GET['comment'];
			var_dump($lat);
			var_dump($lng);
			var_dump($comment);
			$doc = new \DOMDocument("1.0");
			$doc->load($file);

			$root = $doc->createElement('markers');
			$root = $doc->appendChild($root);

			$node = $doc->createElement('marker');
			$node = $root->appendChild($node);

			$latitude = $doc->createElement('lat');
			$latitude = $node->appendChild($latitude);

			$latValue = $doc->createTextNode($lat);
			$latValue = $latitude->appendChild($latValue);

			$longitude = $doc->createElement('lng');
			$longitude = $node->appendChild($longitude);

			$lngValue = $doc->createTextNode($lng);
			$lngValue = $longitude->appendChild($lngValue);

			$content = $doc->createElement('comment');
			$content = $node->appendChild($content);

			$text = $doc->createTextNode($comment);
			$text = $content->appendChild($text);

			$doc->save($file);
 	      	exit;
 	    break; 

/*  	    case 'markers':
 	    	$mapController = new \MapController();
 	     	echo $mapController->getUserMarkers();	
 	      	exit;
 	    break; */
 	} 
 }



