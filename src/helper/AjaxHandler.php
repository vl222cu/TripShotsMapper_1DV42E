<?php

/*
require_once("C:/TripShotsMapper_1DV42E/src/model/MapRepository.php");
require_once("C:/TripShotsMapper_1DV42E/src/model/LoginRepository.php");
require_once("C:/TripShotsMapper_1DV42E/src/model/LoginModel.php");
require_once("C:/TripShotsMapper_1DV42E/src/view/LoginView.php");
 	
$mapRepository = new \model\MapRepository();
$loginRepository = new \model\loginRepository();
$loginModel = new \model\LoginModel();
$loginView = new \view\LoginView($loginModel); */

if(isset($_GET["action"])) {

	switch ($_GET['action']) {
		
/* 	    case 'markers':
 	    	header('Content-Type: application/xml');
 	    	$userMarkers = $mapRepository->getAllMarkersFromDB();
 	     	echo $userMarkers;	
 	      exit;
 	    break;	*/
 
 	   case 'markers':
 	    header('Content-Type: application/xml; charset=ISO-8859-1');
 	     $file = file_get_contents('markers.xml');
 	      echo $file;	
 	      exit;
 	    break; 
 	}
 }