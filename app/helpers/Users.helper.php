<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class Users
{

	public static function getUsers() {
		$db = new DB();
		$response =  $db->query("SELECT id, description FROM photos_user WHERE 1 ORDER BY description");

		while ($data = $response->fetch()) {
			$List[] = new User($data['id'], $data['description']);
		}
		return $List;
	}

	public static function getUserName($idUser) {
		$db = new DB();
		$response =  $db->query_secure("SELECT description FROM photos_user WHERE id=?", array($idUser));
		$data = $response->fetch();
		return $data['description'];
	}

}

?>