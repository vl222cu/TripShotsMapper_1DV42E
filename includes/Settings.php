<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

class Settings {

	public static $DB_USERNAME = "root";
	public static $DB_PASSWORD = "";
	public static $DB_CONNECTION = "mysql:host=127.0.0.1;dbname=tripshotsmapper";
	
}