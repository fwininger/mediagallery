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

	protected $cname;

	protected $level;

	public function __construct($path, $level = 0) {
		$this->level = $level;
		$this->path = $path;

		$name = substr($path, 0, -1);
		$name = strrchr($name, "/");
		$name = substr($name, 1);
		$this->name = $name;
		$this->cname = $name;

		// TODO : make it general
		if($level == 2) {
			$name = substr($path, 0, -1);
			$p = strrpos($name, "/");
			$name = substr($name, 0, $p);
			$name = strrchr($name, "/");
			$name = substr($name, 1);
			$this->cname = $name.'/'.$this->name;
		}
	}

	public function getName() {
		return $this->name;
	}

	public function getCName() {
		return $this->cname;
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

		for($i = 0; $i < count($ListFolder); $i++) {
			$List[$i] = new Folder($this->path.$ListFolder[$i]."/", $this->level + 1);
		}
		return $List;
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