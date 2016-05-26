<?php

namespace view;

class ImageView {

	private $imageModel;
	private $message = '';
	public static $actionReturn = 'return';
	public static $actionUploadPage = 'uploadpage';
	private static $trackMarker = 'trackMarker';
	private static $imgFile = 'file';
	private static $imgName = 'name';
	private static $tempName = 'tmp_name';
	private static $imgType = 'type';
	private static $imgSize = 'size';
	private static $deleteFile = "delete_file";

	const MESSAGE_UPLOAD_SUCCESSED = 'The picture has successfully been saved';
	const MESSAGE_ERROR_UPLOAD_FAILED = 'The picture has not been saved. Please verify that the picture type is jpg/jpeg, gif or png and that the total size is not larger than 2MB with maximum width of 800px and maximum length of 800px';
	const MESSAGE_ERROR_UPLOAD_TO_SERVER = 'Something went wrong! The picture could not be saved at this time. Please try again later';
	const MESSAGE_DELETE_SUCCESSED = 'The picture has successfully been deleted';
	const MESSAGE_DELETE_FAILED = 'Something went wrong! The picture could not be saved at this time. Please try again later';


	public function __construct(\model\ImageModel $imageModel) {

		$this->imageModel = $imageModel;

	}

	public function showAllImagesHTML(array $dbImages, $markerId) {

		$html = "
		 	<div class='container'>
		 		<div class='imgUploadContent'>
		 			<div class='page-header'>
		 				<h2>Add pictures to your destination</h2>
		 			</div>
			 			<div id='contentwrapper'>";

		if($this->getImgMessage() !== null) {

			$html .= "<div class=Msgstatus>$this->message</div>";
		}; 

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
						<img src='./images/$imageURL' class='img-responsive' alt='Responsive image'/></a>
						<form action='ActionHandler.php?action=deleteImg' enctype='multipart/form-data' method='post'>
							<input type='hidden' value='$imageURL' name='delete_file'>
							<input type='hidden' value='$markerId' name='trackMarker'>
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

	public function uploadImagePageHTML($markerId) {

		$html = "
		 	<div class='container'>
		 		<div class='imgContent'>
		 			<div class='page-header'>
		 				<h2>Add a picture</h2>
		 			</div>
		 			<form action='ActionHandler.php?action=retImg' method='post' enctype='multipart/form-data'>
						<input type='hidden' value='$markerId' name='trackMarker'>
						 <button type='submit' class='imgBtn'>Return to photo album</button>
					</form>
		 			<div id='uploadwrapper'>";

		if($this->getImgMessage() !== null) {

			$html .= "<div class=Msgstatus>$this->message</div>";
		}; 
		
		$html .= "			
						<div id='formwrapper'>
					 		<form action='ActionHandler.php?action=uploadImg' method='post' enctype='multipart/form-data'>
					 			<input type='hidden' value='$markerId' name='trackMarker'>
						 		<div class='fileinput fileinput-new' data-provides='fileinput'>
	    								<span class='btn btn-default btn-file'><span>Choose file</span><input type='file' name='file' id='file'/></span>
	    								<span class='fileinput-filename'></span><span class='fileinput-new'>No file chosen</span>
								</div>
								<button type='submit' id='uploadBtn'>Upload picture</button>
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

	public function getImage() {

    	if (isset( $_FILES[self::$imgFile]) && !empty($_FILES[self::$imgFile][self::$imgName])) {

    		return $_FILES[self::$imgFile][self::$imgName];
  		}

  		return NULL; 
    }

    public function getTempImage() {

    	if (isset( $_FILES[self::$imgFile]) && !empty($_FILES[self::$imgFile][self::$tempName])) {

    		return $_FILES[self::$imgFile][self::$tempName];
  		}

  		return NULL; 
    }

    public function getImageType() {

    	if (isset( $_FILES[self::$imgFile][self::$imgType]) && !empty( $_FILES[self::$imgFile][self::$imgType])) {

    		return $_FILES[self::$imgFile][self::$imgType];
  		}

  		return NULL;
    }

    public function getImageSize() {

    	if (isset( $_FILES[self::$imgFile][self::$imgSize]) && !empty( $_FILES[self::$imgFile][self::$imgSize])) {

    		return $_FILES[self::$imgFile][self::$imgSize];
  		}

  		return NULL;
    }

    public function setImgMessage($msg) {

		$this->message = '<p>' . $msg . '</p>';
	}

	 public function getImgMessage() {

        return $this->message;
    }

    public function getImageURL() {

		if (isset($_POST[self::$deleteFile])) {

			return $_POST[self::$deleteFile];
		}

		return NULL;
	}
}