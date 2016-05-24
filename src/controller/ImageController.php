<?php

namespace controller;

require_once("./src/model/ImageModel.php");
require_once("./src/model/ImageRepository.php");
require_once("./src/view/ImageView.php");
require_once("./src/view/MapView.php");

class ImageController {

	private $ImageModel;
	private $imageRepository;
	private $ImageView;
	private $mapView;

	public function __construct() {

		$this->ImageModel = new \model\ImageModel();
		$this->imageRepository = new \model\ImageRepository();
		$this->imageView = new \view\ImageView($this->ImageModel);
		$this->mapView = new \view\MapView();

	}

	public function doImage($marker) {
 
		$userAction = $this->imageView->getUserAction();

		try {

			switch ($userAction) {

				case \view\ImageView::$actionReturn:
					return $this->mapView->showMapView();
					break;

				case \view\ImageView::$actionUploadPage:
					return $this->imageView->uploadImagePageHTML();
					break;

				default: 
					return $this->showAllImages($marker);
			}

		} catch (\Exception $e) {

			$e;
			die(); 
		} 

//		return $this->showAllImages($marker);
	}

	public function showAllImages($marker) {
		
		$images = $this->imageRepository->getAllImagesFromDB($marker);

		return $this->imageView->showAllImagesHTML($images);	
	}
}