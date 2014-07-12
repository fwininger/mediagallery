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

	protected $level;

	public function __construct($path, $level = 0) {
		$this->path = $path;
		$this->name = strrchr($path, "/");
		$this->level = 0;
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

	public function isSharedBy($id_user) {
		$db = new DB();
		$response =  $db->query_secure("SELECT ressource FROM photos_partage INNER JOIN photos_user ON photos_partage.id_user_prop = photos_user.id WHERE id_user_prop = ?", array($id_user));

		while ($data = $response->fetch()) {
			if($this->path == $data['ressource']) {
				return true;
			}
		}
		return false;
	}
}

?>