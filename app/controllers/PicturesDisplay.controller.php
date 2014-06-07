<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

abstract class PicturesDisplay extends PicturesHelper
{

	public function html() {
		$this->display();
	}

	public function display() {
		if(!Folder::isValid($this->path))
			die('WRONG DIRECTORY');

		if(!File::isValid($this->path.$this->picture))
			die('WRONG FILE') ;

		// Create the thumbnail folder if necessary
		if(!Folder::isValid($this->path_thumb))
			mkdir($this->path_thumb,0777,true);

		// Create the thumbnail if necessary
		if(!File::isValid($this->path_thumb.$this->picture))
			Picture::imagethumb(
				$this->path.'/'.$this->picture,
				$this->path_thumb.'/'.$this->picture,
				$this->size()
			);

		// Get the orientation of the orignal picture
		$img = new Jpeg($this->path.$this->picture);
		$orientation = $img->getOrientation();

		// Display the picture
		$imgm = new Jpeg($this->path_thumb.$this->picture);
		$imgm->display($orientation);
	}

	abstract public function size();
}

?>