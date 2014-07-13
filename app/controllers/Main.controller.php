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
			// TODO : add a SHA/MD5 support of the password in the DB
			$password = $this->http->post('pwd');

			if($login == "" || $password == "")
				die ("<b>BAD LOGIN</b");

			$db = new DB();
			$response = $db->query_secure("SELECT * FROM photos_user WHERE login = ? AND pass = ?", array($login,$password));
			$data = $response->fetch();

			if($data == false)
				die ("<b>BAD LOGIN</b");

			$this->http->sessionSet('ok', 1);
			$this->http->sessionSet('directory', $GLOBALS['CONFIG_photo'].$data['repertoire']);
			$this->http->sessionSet('directory_min', $GLOBALS['CONFIG_photo'].$data['repertoire_min']);
			$this->http->sessionSet('directory_diapo', $GLOBALS['CONFIG_photo'].$data['repertoire_diapo']);
			$this->http->sessionSet('description', $data['description']);
			$this->http->sessionSet('id_user', $data['id']);

			return true;
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
}

?>