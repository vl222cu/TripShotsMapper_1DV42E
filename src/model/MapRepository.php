<?php

namespace model;

require_once("./src/model/Repository.php");

class MapRepository extends base\Repository {

	private static $userID = "userID";

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

			file_put_contents('./src/helper/markers.xml',$dom->saveXML());
        } 

        return false;
	}
}