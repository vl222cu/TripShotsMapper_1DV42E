<?php
include_once("C:/TripShotsMapper_1DV42E/includes/Settings.php");
/**
* Source: http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
*/
function sec_session_start() {
        $session_name = 'vivis_kaka'; // Set a custom session name
        $secure = false; // Set to true if using https.
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params(3600, $cookieParams["path"], $cookieParams["domain"], $secure, false);
        $httponly = true; // This stops javascript being able to access the session id.
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.
}
