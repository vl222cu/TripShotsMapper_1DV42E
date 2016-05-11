<?php
/*
namespace helper;

require_once("MarkerRepository.php");
require_once("../src/model/LoginRepository.php");
require_once("../src/model/LoginModel.php");
require_once("../src/view/LoginView.php");
 	
$markerRepository = new \model\MarkerRepository();
$loginRepository = new \model\loginRepository();
$loginModel = new \model\LoginModel();
$loginView = new \view\LoginView($loginModel); */

if(isset($_GET["action"])) {
 
	switch ($_GET['action']) {

/* 	    case 'markers':
 	    	header('Content-Type: application/xml');
 	      echo $markerRepository->getAllMarkersFromDB($loginRepository->getUserId($loginView->getPostedUserName()));	
 	      exit;
 	    break;	*/
 
 	    case 'markers':
 	    header('Content-Type: application/xml');
 	     $file = file_get_contents('markers.xml');
 	      echo $file;	
 	      exit;
 	    break; 
 	}
 }