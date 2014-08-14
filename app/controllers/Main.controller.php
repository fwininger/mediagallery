<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class Main extends Controllers
{
	public function body() {
		if($this->connexion()) {
			$this->index();
		}
		else {
			$this->displayView("login");
		}
	}

	public function connexion() {
		// try to deconnect
		if($this->http->get('unsign') == 1) {
			session_unset();
			session_destroy();
		}

		if($this->http->postExists('user') && $this->http->postExists('pwd')) {
			$login    = $this->http->post('user');
			$password = $this->http->post('pwd');

			if($login == "" || $password == "")
				die ("<b>BAD LOGIN</b>");

			$user = new User($login, $password);

			if(!$user->isValid())
				die ("<b>BAD LOGIN</b>");

			return $user->save();
		}

		if($this->http->session('ok')) {
			return true;
		}

		return false;
	}

	public function sideBar() {
		if(!$this->connexion())
			return false;

		$folder = new Folder($this->http->session('directory'));
		$list = $folder->getSubFolder();

		if($list == null)
			return;

		$this->addVar("listItems", $list);

		$this->displayView("sidebar");
	}

	public function gallery() {
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

		$this->displayView("gallery");
	}

	private function index() {
		$this->displayView("index");
	}

	public function script() {
		parent::script();
		if ($this->connexion()) {
			echo "<script src=\"public/mediaelement/mediaelement-and-player.min.js\"></script>\n";
		}
	}

	public function css() {
		parent::css();
		if ($this->connexion()) {
			echo "<link href=\"public/mediaelement/mediaelementplayer.min.css\" rel=\"stylesheet\" />\n";
		}
	}
}

?>