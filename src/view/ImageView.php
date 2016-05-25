<?php

namespace view;

class ImageView {

	private $imageModel;
	public static $actionReturn = 'return';
	public static $actionUploadPage = 'uploadpage';
	private static $trackMarker = "trackMarker";


	public function __construct(\model\ImageModel $imageModel) {

		$this->imageModel = $imageModel;

	}

	public function showAllImagesHTML(array $dbImages, $markerId) {

		$html = "
		 	<div class='container'>
		 		<div class='imgContent'>
		 			<h2>Add pictures to your destination</h2>
			 		<div id='contentwrapper'>";

/*		if($this->getMessage() !== null) {

			$html .= "<div class=Msgstatus>$this->message</div>";
		}; */

		$html .= "
			<p><a href='ActionHandler.php?action=return'>Return to map</a></p>
			<form enctype='multipart/form-data' method='post' action='ActionHandler.php?action=addImg'>
			<input type='hidden' value='$markerId' name='trackMarker'>
			 	<button type='submit' class='imgBtn'>Add picture</button>
			</form>";

		foreach ($dbImages as $date => $images) {
		
			foreach ($images as $image) {

				$imageURL = $image["image"];

				$html .= "
					<div class='image'>
						<a title='tripShotsMapper' href='./images/$imageURL'>
						<img src='./images/$imageURL' alt='img'/></a>
						<form action='?delete' enctype='multipart/form-data' method='post'>
							<input type='hidden' value='$imageURL' name='delete_file'>
						 	<button type='submit' class='imgBtn'>Delete picture</button>
						</form>
					</div>";

			}
		}

		$html .= "
							</div>
						</div>
					</div>
				";

		return $html;
	}

	public function addImagePageHTML($markerId) {

		$html = "
		 	<div class='container'>
		 		<div class='imgContent'>
		 			<h2>Add a picture</h2>
		 			<form action='ActionHandler.php?action=retImg' enctype='multipart/form-data' method='post'>
						<input type='hidden' value='$markerId' name='trackMarker'>
						 <button type='submit' class='imgBtn'>Return to photo album</button>
					</form>
		 			<div id='uploadwrapper'>";

/*		if($this->getMessage() !== null) {

			$html .= "<div class=Msgstatus>$this->message</div>";
		}; */
		
		$html .= "			
						<div id='formwrapper'>
					 		<form action='?upload' method='post' enctype='multipart/form-data'>
								Chose a picture and upload it to your photo album: 
								<p><input type='file' name='file' id='file' /></p>  
								<input type='submit' name='submit' id='uploadButton' value='Upload picture' />
							</form>
						</div>
					</div>
				</div>
		 	</div>";

		return $html;
	} 

	public function getMarkerId() {

		if (isset($_POST[self::$trackMarker])) {

			return $_POST[self::$trackMarker];
		}

		return NULL;
	}

/*	public function getUserAction() {

		switch (key($_GET)) {

			case self::$actionReturn:
				$action = self::$actionReturn;
				return $action;
				break;

			case self::$actionUploadPage:
				$action = self::$actionUploadPage;
				return $action;
				break;

			default:
				$action = "";
		}
	}*/
}