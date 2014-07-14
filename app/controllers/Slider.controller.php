<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class Slider extends Controllers
{
	public function css() {
		echo "<link href=\"public/css/bootstrap.min.css\" rel=\"stylesheet\">\n";
		echo "<link href=\"public/css/jquery.carousel.fullscreen.css\" rel=\"stylesheet\"/>\n";
	}

	public function script() {
		echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>\n";
		echo "<script src=\"public/js/bootstrap.min.js\"></script>\n";
		echo "<script src=\"public/js/jquery.carousel.fullscreen.js\"></script>\n";
	}

	public function body() {
		if($this->connexion()) {
			$this->index();
		}
		else {
			die("You must be connected to access this page");
		}
	}

	public function connexion() {
		if($this->http->session('ok')) {
			return true;
		}
		return false;
	}

	private function index() {
		if(!$this->connexion())
			return false;
		$path = $this->http->session('directory');
		$path .= $this->http->get('dir');
		if(!Folder::isValid($path))
			return false;

		$folder = new Folder($path);
		$list = $folder->getFiles();

		if($list == null)
			return;

		$this->addVar("listFiles", $list);
		$this->displayView("slider");
	}
}

?>