<?php

namespace model;
/**
* Inspired by source: http://codular.com/php-file-uploads
*/
class ImageModel {

	public static $imgInfo;

	public function validImage($imgType) {

		if ((($imgType == "image/gif")
		|| ($imgType == "image/jpeg")
		|| ($imgType == "image/jpg")
		|| ($imgType == "image/png"))) {

			return true;
		}

		return false;
	}

	public function checkImageSize($imgSize) {

		self::$imgInfo = $imgSize;
		$imageInformation = getimagesize(self::$imgInfo);
		$imageWidth = $imageInformation[0]; 
		$imageHeight = $imageInformation[1]; 

		if($imageWidth > 800 || $imageHeight > 800 || $imgSize > 2000000) {
		 
		 	return false;
		}

		return true;
	}
}
