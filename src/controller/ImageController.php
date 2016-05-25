<?php

namespace controller;

require_once("./src/model/ImageModel.php");
require_once("./src/model/ImageRepository.php");
require_once("./src/view/ImageView.php");
require_once("./src/view/MapView.php");

class ImageController {

	private $imageModel;
	private $imageRepository;
	private $ImageView;
	private $mapView;

	public function __construct() {

		$this->imageModel = new \model\ImageModel();
		$this->imageRepository = new \model\ImageRepository();
		$this->imageView = new \view\ImageView($this->imageModel);
		$this->mapView = new \view\MapView();

	}

	public function showAllImages($markerId) {
		
		$images = $this->imageRepository->getAllImagesFromDB($markerId);
		
		return $this->imageView->showAllImagesHTML($images, $markerId);	
	}

	public function showAddImagePage($markerId) {

		return $this->imageView->uploadImagePageHTML($markerId);	
	}

	public function uploadImage($markerId) {

		if ($this->imageModel->validImage($this->imageView->getImageType()) && $this->imageModel->checkImageSize($this->imageView->getTempImage())) {

			if ($this->imageRepository->saveImage($markerId, $this->imageView->getImage())) {

				$this->imageView->setImgMessage(\view\ImageView::MESSAGE_UPLOAD_SUCCESSED);

				return $this->imageView->uploadImagePageHTML($markerId);

			} else {

				$this->imageView->setImgMessage(\view\ImageView::MESSAGE_ERROR_UPLOAD_TO_SERVER);

				return $this->imageView->uploadImagePageHTML($markerId);
			}

		} else {

			$this->imageView->setImgMessage(\view\ImageView::MESSAGE_ERROR_UPLOAD_FAILED);

			return $this->imageView->uploadImagePageHTML($markerId);
		}
	}
}