<?php

if($_GET["action"]) {
 
	switch ($_GET['action']) {
 
 	    case 'markers':
 /*	    	header('Content-Type: application/xml');
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