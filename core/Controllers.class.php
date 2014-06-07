<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

require_once __DIR__."/../config/config.php";

abstract class Controllers
{
	protected $http;

	public function __construct() {
		$this->http = new Http();
	}

	public function html() {
		echo "<html>\n";
		echo "  <header>\n";

		$this->header();

		echo "  </header>\n";
		echo "  <body>\n";

		$this->body();

		echo "\n  </body>\n";
		echo "</html>\n";
	}

	public function header() {
		$this->title();
	}

	public function title() {
		echo "<title>Espace de Stockage de Photos</title>\n";
	}

	public function body() {
	}

	public function displayView($view) {
		include(__DIR__."/../app/views/".$view.".view.php");
	}

}

?>