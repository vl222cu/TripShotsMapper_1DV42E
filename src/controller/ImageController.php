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

	public function showAllImages($markerId) {
		
		$images = $this->imageRepository->getAllImagesFromDB($markerId);
		
		return $this->imageView->showAllImagesHTML($images, $markerId);	
	}

	public function showAddImagePage($markerId) {
		var_dump($markerId);
		return $this->imageView->addImagePageHTML($markerId);	
	}
}