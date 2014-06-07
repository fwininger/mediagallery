<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class ThumbnailBig extends PicturesDisplay
{
	public function size() {
		return $GLOBALS['CONFIG_diaporama'];
	}

	public function getDBThumbField() {
		return "repertoire_diapo";
	}

	public function getSessionThumbField() {
		return "directory_diapo";
	}
}

?>