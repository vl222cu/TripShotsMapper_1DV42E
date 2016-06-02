<?php

namespace model;

require_once("./src/model/Repository.php");

class MapRepository extends base\Repository {

	private static $userID = 'userID';
	private static $latitude = 'lat';
	private static $longitude = 'lng';
	private static $comment = 'comment';
	private static $marker = 'marker';
	private static $markers = 'markers';
	private static $markerId = 'markerID';

	public function __construct() {

		$this->dbTable = "markers";
	}

	public function getAllMarkersFromDB($user) {

		$db = $this->connection();

		// Start XML file, create parent node
		$dom = new \DOMDocument("1.0");
		$node = $dom->createElement(self::$markers);
		$parnode = $dom->appendChild($node);

		$sql = " SELECT * FROM $this->dbTable WHERE " . self::$userID . " = ?";
    	$query = $db->prepare($sql);
    	$query->execute(array($user));  	
    	
    	if($query->rowCount() > 0) {

			 $results = $query->fetchAll(\PDO::FETCH_ASSOC);
			 // Add to xml dockument node
			 foreach ($results as $result) {

                $node = $dom->createElement(self::$marker);
  				$newnode = $parnode->appendChild($node);
  				$newnode->setAttribute(self::$markerId, utf8_encode($result[self::$markerId]));
  				$newnode->setAttribute(self::$latitude, utf8_encode($result[self::$latitude]));
  				$newnode->setAttribute(self::$longitude, utf8_encode($result[self::$longitude]));
  				$newnode->setAttribute(self::$comment, utf8_encode($result[self::$comment]));
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

        $this->db = null;

        if ($query->rowCount() > 0) {

            return true;
        } 

        return false;
	}

	public function deleteUserMarkerFromDB($marker) {

		$db = $this->connection();

		$sql = "DELETE FROM $this->dbTable WHERE " . self::$markerId . " = ?";
        $query = $db->prepare($sql);
        $query->execute(array($marker)); 

        $this->db = null;

        if ($query->rowCount() > 0) {

            return true;
        } 

        return false;
	}

	public function getMarkerIdFromDB($user, $lat, $lng) {

        $db = $this->connection();

       $sql = " SELECT " . self::$markerId . " FROM $this->dbTable WHERE " . self::$userID . " = ? AND " . self::$latitude . " = ? AND " . self::$longitude . " = ?";
        $query = $db->prepare($sql);
       	$query->execute(array($user, $lat, $lng)); 

        $result = $query->fetch(\PDO::FETCH_ASSOC);
        
        if(!$result) {

            return false;
        }

        $this->db = null;
        
        return $result[self::$markerId];       
    }
}