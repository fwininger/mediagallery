<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class VideosDisplay extends PicturesHelper
{

	public function html() {
		$this->display();
	}

	public function display() {
		if(!Folder::isValid($this->path))
			die('WRONG DIRECTORY');

		if(!File::isValid($this->path.$this->picture))
			die('WRONG FILE') ;

		$video = new Video($this->path.$this->picture);
		$video->display();
	}

	public function getDBThumbField() {
		return "repertoire_min";
	}

	public function getSessionThumbField() {
		return "directory_min";
	}

}

?>