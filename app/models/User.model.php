<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class User
{
	private $id;

	private $name;

	public function __construct($id, $name) {
		$this->name = $name;
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function getId() {
		return $this->id;
	}

}

?>