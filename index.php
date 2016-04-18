<?php
     
require_once("src/controller/LoginController.php");
require_once("src/view/HTMLView.php");

session_start();

$loginController = new \controller\LoginController();
$htmlBody = $loginController->doLogin();

$view = new \view\HTMLview();
$view->showHTML("TripShotsMapper", $htmlBody);



 