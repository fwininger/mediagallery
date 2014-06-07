<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class Folder
{
	protected $path;

	protected $name;

	public function __construct($path) {
		$this->path = $path;
		$this->name = strrchr($path, "/");
	}

	public function getName() {
		return $this->name;
	}

	public function getFiles() {
		if(!Folder::isValid($this->path))
			die("<br/><b>Le répertoire n'existe pas!</b>");

		$dir = opendir($this->path);
		while($file = readdir($dir)) {
			if($file != '.' && $file != '..' && !is_dir($this->path.$file)) {
				$ListFiles[] = $file;
			}
		}
		closedir($dir);

		if($ListFiles == null)
			return null;

		sort($ListFiles);
		return $ListFiles;
	}

	// TODO : this method must return a list of Folder.
	public function getSubFolder() {
		if(!Folder::isValid($this->path))
			die("<br/><b>Le répertoire n'existe pas!</b>");

		$dir = opendir($this->path);
		while($folder = readdir($dir)) {
			if($folder != '.' && $folder != '..') {
				if(is_dir($this->path.$folder)) {
					$ListFolder[]=$folder;
				}
			}
		}
		closedir($dir) ;

		if($ListFolder == null)
			return null;

		sort($ListFolder);
		return $ListFolder;
	}

	public static function isValid($path) {
		return is_dir($path) ;
	}
}

?>