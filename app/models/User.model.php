<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class User
{
	private $secure = false;

	private $id = null;

	private $name = null;

	private $dir = null;

	private $dir_min = null;

	private $dir_diapo = null;

	private $http;

	public function __construct($username, $password) {
		$this->http = new Http();
		$this->connexion($username, $password);
	}

	public function getName() {
		return ($this->secure) ? $this->name : null;
	}

	public function getId() {
		return ($this->secure) ? $this->id : null;
	}

	public function getDirectory() {
		return ($this->secure) ? $GLOBALS['CONFIG_photo'].$this->dir : null;
	}

	public function getDirectoryMin() {
		return ($this->secure) ? $GLOBALS['CONFIG_photo'].$this->dir_min : null;
	}

	public function getDirectoryDiapo() {
		return ($this->secure) ? $GLOBALS['CONFIG_photo'].$this->dir_diapo : null;
	}

	public function isValid() {
		return $this->secure;
	}

	public function connexion($username, $password) {
		$db = new DB();
		$response = $db->query_secure("SELECT * FROM photos_user WHERE login = ?", array($username));
		$data = $response->fetch();
		if($data == false)
			die ("<b>BAD LOGIN</b>");

		if($data['pass'] != sha1(sha1($password).$data['salt']))
			die ("<b>BAD LOGIN</b>");

		$this->secure = true;
		$this->id = $data['id'];
		$this->name = $data['description'];
		$this->dir = $data['repertoire'];
		$this->dir_min = $data['repertoire_min'];
		$this->dir_diapo = $data['repertoire_diapo'];

		return $this->secure;
	}

	public function save() {
		if(!$this->secure)
			return false;

		$this->http->sessionSet('ok', 1);
		$this->http->sessionSet('directory', $this->getDirectory());
		$this->http->sessionSet('directory_min', $this->getDirectoryMin());
		$this->http->sessionSet('directory_diapo', $this->getDirectoryDiapo());
		$this->http->sessionSet('description', $this->getName());
		$this->http->sessionSet('id_user', $this->getId());
		return true;
	}

}

?>