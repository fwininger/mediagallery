<?
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

class Http
{
	public function cookie($key) {
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}

	public function cookieExists($key) {
		return isset($_COOKIE[$key]);
	}

	public function get($key) {
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}

	public function getExists($key) {
		return isset($_GET[$key]);
	}

	public function post($key) {
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}

	public function postExists($key) {
		return isset($_POST[$key]);
	}

	public function session($key) {
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}

	public function sessionExists($key) {
		return isset($_SESSION[$key]);
	}

	public function sessionSet($key, $value) {
		$_SESSION[$key] = $value;
	}
}

?>