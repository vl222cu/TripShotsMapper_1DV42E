<?php

namespace model;
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");*/

require_once("C:TripShotsMapper_1DV42E/src/model/Repository.php");

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

    	//	header("Content-type: text/xml");

    		// Iterate through the rows, adding XML nodes for each
    	/*    while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
    	    	var_dump($row);
				// ADD TO XML DOCUMENT NODE
  				$node = $dom->createElement("marker");
  				$newnode = $parnode->appendChild($node);
  				$newnode->setAttribute("lat", $row['lat']);
  				$newMarker->setAttribute("lng", $row['lng']);
  				$newMarker->setAttribute("comment", $row['comment']);
			}*/

			 $results = $query->fetchAll(\PDO::FETCH_ASSOC);

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

/*			$xmlfile = $dom->saveXML();
			
			echo $xmlfile; */

			file_put_contents('./src/helper/getMarkers.xml',$dom->saveXML());
        } 

        return false;
	}

	public function saveAllMarkersToDB($user, $lat, $lng, $comment) {

		$db = $this->connection();

		$sql = " INSERT INTO $this->dbTable" . "(" . self::$userID . "," . self::$latitude . "," . self::$longitude . "," . self::$comment . ")" . " VALUES (?, ?)";
        $query = $this->db->prepare($sql);
        $query->execute(array($user, $lat, $lng, $comment));

        if ($query->rowCount() > 0) {

            return true;
        } 

        return false;
	}
}