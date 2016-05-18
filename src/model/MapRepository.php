<?php

namespace model;

require_once("./src/model/Repository.php");

class MapRepository extends base\Repository {

	private static $userID = 'userID';
	private static $latitude = 'lat';
	private static $longitude = 'lng';
	private static $comment = 'comment';

	public function __construct() {

		$this->dbTable = "markers";
	}

	public function getAllMarkersFromDB($user) {

		$db = $this->connection();

		// Start XML file, create parent node
		$dom = new \DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);

		$sql = " SELECT * FROM $this->dbTable WHERE " . self::$userID . " = ?";
    	$query = $db->prepare($sql);
    	$query->execute(array($user));  	
    	
    	if($query->rowCount() > 0) {

			 $results = $query->fetchAll(\PDO::FETCH_ASSOC);
			 // Add to xml dockument node
			 foreach ($results as $result) {

                $node = $dom->createElement("marker");
  				$newnode = $parnode->appendChild($node);
  				$newnode->setAttribute("lat", utf8_encode($result['lat']));
  				$newnode->setAttribute("lng", utf8_encode($result['lng']));
  				$newnode->setAttribute("comment", utf8_encode($result['comment']));
            }

			/**
		 	* Close PDO-connection to the database
		 	*/
			$this->db = null;

			$xmlfile = $dom->saveXML();
			
			echo $xmlfile; 
        } 

        return false;
	}

	public function saveUserMarkerToDB($user, $lat, $lng, $comment) {

		$db = $this->connection();

		$sql = " INSERT INTO $this->dbTable" . "(" . self::$userID . "," . self::$latitude . "," . self::$longitude . "," . self::$comment . ")" . " VALUES (?, ?, ?, ?)";
        $query = $db->prepare($sql);
        $query->execute(array($user, $lat, $lng, $comment));

        if ($query->rowCount() > 0) {

            return true;
        } 

        return false;
	}
}