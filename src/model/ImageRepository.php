<?php

namespace model;

require_once ('./src/model/Repository.php');
require_once ('./src/model/ImageModel.php');

class ImageRepository extends base\Repository {

	private $imageModel;
	private static $strImage = 'image';
	private static $markerId = 'markerID';
	private $imageFolder = './images/';
	private static $dateAdded = 'dateAdded';
	private static $imgId = 'imgID';

	 public function __construct() {

    	$this->dbTable = 'images';
    	$this->imageModel = new \model\ImageModel();

    }

    public function saveImage($marker, $img) {

		/**
		 *	Folder on the server where the images are stored
		 */
		$targetImg = $this->imageFolder;
		$targetImg = $targetImg . basename($img);
		$targetImg = explode(".", $targetImg);

		/** Time is used as a part of the image name to prevent
		 *	that images with the same name will be overwritten
		 */
		$targetImg = time().'.'.array_pop($targetImg);

		/**
		* Check if the image file is saved to the server...
		*/
		if (move_uploaded_file(\model\ImageModel::$imgInfo, $this->imageFolder . $targetImg)) {

			/**
			* ...then save to the database
			*/
			$db = $this->connection();

		    $sql = "INSERT INTO $this->dbTable (" . self::$markerId . ", " . self::$strImage . ") VALUES (?, ?)";
		    $query = $db->prepare($sql);
		    $params = array($marker, $targetImg);
		    $statement = $query->execute($params); 

		   	/**
		   	* Close the PDO-connection to the database 
		   	*/
		    $this->db = null;

		    if ($statement) {

		    	chmod($this->imageFolder . $targetImg, 0644);

		        return true;

		    } else {

		        return false;
		    }

	    } else {

	    	return false;
	    }
	}

	public function getAllImagesFromDB($marker) {

		$db = $this->connection();
		$dateImages = array();

		$sql = "SELECT * FROM $this->dbTable WHERE markerID = ? ORDER BY dateAdded DESC, imgID DESC";
//		$sql = "SELECT * FROM $this->dbTable WHERE " . self::$markerId . " = ? ORDER BY " . self::$dateAdded . "DESC, " . self::$imgId . "DESC";
		$query = $db->prepare($sql);
		$query->execute(array($marker));

		while ($result = $query->fetch(\PDO::FETCH_ASSOC)) {

			$dateImages[$result[self::$dateAdded]][] = $result;
		}
		
		/**
		* Close the PDO-connection to the database 
		*/
		$this->db = null;

		return $dateImages;
	}

	public function deleteImageFromDB($displayedImg) {

		if (@unlink($this->imageFolder . $displayedImg)) {

			$db = $this->connection();

			$sql = "DELETE FROM $this->dbTable WHERE " . self::$strImage . " = ?";
			$query = $db->prepare($sql);
			$params = array($displayedImg);
			$statement = $query->execute($params); 

			/**
			* Close the PDO-connection to the database 
			*/
		    $this->db = null;

			return true;

		} else {

			return false;
		}
	}
}