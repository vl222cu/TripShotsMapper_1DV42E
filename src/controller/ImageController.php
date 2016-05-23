<?php

namespace controller;

require_once("./src/model/ImageModel.php");
require_once("./src/model/ImageRepository.php");
require_once("./src/view/ImageView.php");

class ImageController {

	private $ImageModel;
	private $imageRepository;
	private $ImageView;

	public function __construct() {

		$this->ImageModel = new \model\ImageModel();
		$this->imageRepository = new \model\ImageRepository();
		$this->imageView = new \view\ImageView($this->ImageModel);
	}

	public function doImage($marker) {
 
/*		$userAction = $this->imageView->getAction();

		try {

			switch ($userAction) {

				case \view\PostView::actionUploadPage:
					return $this->imageView->uploadPageHTML();;
					break;

				default: 
					return $this->showAllImages($marker);
			}

		} catch (\Exception $e) {

			$e;
			die(); 
		} */

		return $this->showAllImages($marker);
	}

	public function showAllImages($marker) {
		
		$images = $this->imageRepository->getAllImagesFromDB($marker);

		return $this->imageView->showAllImagesHTML($images);	
	}
}