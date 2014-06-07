<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

abstract class File
{
	// Complete path of the file.
	protected $path;

	// File name without the extension.
	protected $name;

	// File extension.
	protected $extension;

	public function __construct($path) {
		$this->path = $path;

		$file = strrchr($path, "/");
		$this->extension = substr(strrchr($file, "."), 1);
		$this->name = substr(strstr($file, ".", true), 1);
	}

	public function getName() {
		return $this->name;
	}

	public function getExt() {
		return $this->extension;
	}

	// A method must be implemented to display the file
	// in a browser with the header.
	abstract public function display();

	public static function isValid($path) {
		return is_file($path) ;
	}
}

?>