<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class Infos extends PicturesHelper
{
	public function body() {
		$img = new Jpeg($this->path.$this->picture);
		$this->addVar('exif',$img->exif());
		$this->displayView('infos');
	}

	public function title() {
		echo "<title>".$this->picture."</title>\n";
	}

	public function getDBThumbField() {
		return "repertoire_diapo";
	}

	public function getSessionThumbField() {
		return "directory_diapo";
	}
}

?>