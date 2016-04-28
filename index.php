<?php
     
require_once("src/controller/MasterController.php");
require_once("src/view/HTMLView.php");

session_start();

$masterController = new \controller\MasterController();
$masterController->handleInput();

$htmlBody = $masterController->generateOutput();
$htmlView = new \view\HTMLView();
$htmlView->showHTML("TripShotsMapper", $htmlBody); 
