<?php

namespace model\base;
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");*/

require_once("C:/TripShotsMapper_1DV42E/includes/Settings.php");

abstract class Repository {

	protected $dbConnection;

	/**
	 * PDO-uppkoppling mot databasen
	 */
	protected function connection() {

		try {

			$this->dbConnection = new \PDO(\Settings::$DB_CONNECTION, \Settings::$DB_USERNAME, \Settings::$DB_PASSWORD,
				 array(\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

			return $this->dbConnection;	

		} catch (PDOException $e) {

			echo $e->getMessage();
		}	
	}
}