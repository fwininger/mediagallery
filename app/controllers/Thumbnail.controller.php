<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class Thumbnail extends PicturesDisplay
{
	public function size() {
		return $GLOBALS['CONFIG_miniature'];
	}

	public function getDBThumbField() {
		return "repertoire_min";
	}

	public function getSessionThumbField() {
		return "directory_min";
	}
}

?>