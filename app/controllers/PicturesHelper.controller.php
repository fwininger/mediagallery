<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

abstract class PicturesHelper extends Controllers
{
	private $localDir;

	private $sharedDir;

	protected $picture;

	protected $path;

	protected $path_thumb;

	public function __construct() {
		parent::__construct();
		$this->init();
	}

	public function init() {
		if(!$this->connexion())
			die ("BAD ACCESS");

		$this->picture = $this->http->get('image');
		$this->localDir = $this->http->get('dir');
		$this->sharedDir = $this->http->get('dirP');

		if($this->picture == null)
			die ("WRONG PARAMETERS");

		$this->addVar('picture', $this->picture);

		if($this->localDir != null) {
			$this->local();
			$this->addVar('paramDirectory', 'dir');
			$this->addVar('valueDirectory', $this->localDir);
		}
		elseif($this->sharedDir != null) {
			$this->share();
			$this->addVar('paramDirectory', 'dirP');
			$this->addVar('valueDirectory', $this->sharedDir);
		}
		else {
			die ("WRONG PARAMETERS");
		}
	}

	public function connexion() {
		if($this->http->session('ok')) {
			return true;
		}
		return false;
	}

	public function local() {
		$this->path = $this->http->session('directory').$this->localDir.'/';
		$this->path_thumb = $this->http->session($this->getSessionThumbField()).$this->localDir.'/';
	}

	public function share() {
		$db = new DB();
		$response = $db->query_secure("SELECT id_user, ressource, description, repertoire, ".$this->getDBThumbField()."
					FROM photos_partage INNER JOIN photos_user ON photos_partage.id_user_prop = photos_user.id
					WHERE id_partage = ?", array($this->sharedDir));
		$data = $response->fetch();

		if($data['id_user'] == $this->http->session('id_user')) {
			$this->path = $GLOBALS['CONFIG_photo'].$data['repertoire'].$data['ressource'];
			$this->path_thumb = $GLOBALS['CONFIG_photo'].$data[$this->getDBThumbField()].$data['ressource'];
		}
		else
			die("BAD ACCESS") ;
	}

	abstract public function getDBThumbField();

	abstract public function getSessionThumbField();
}

?>