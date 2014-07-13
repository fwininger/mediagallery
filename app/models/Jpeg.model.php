<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class Jpeg extends Picture
{
	public function __construct($path) {
		parent::__construct($path);
	}

	public function exif() {
		if (Jpeg::isValid($this->path))
			return exif_read_data($this->path);
		return false;
	}

	public function getOrientation() {
		$exif = $this->exif();
		if($exif == false) {
			return 0;
		}
		elseif($exif["Orientation"] == 8) {
			return 90 ;
		}
		elseif($exif["Orientation"] == 6) {
			return 270 ;
		}
		return 0;
	}

	public static function isValid($path) {
		return parent::isValid($path) && exif_imagetype($path) == IMAGETYPE_JPEG;
	}
}

?>