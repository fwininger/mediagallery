<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

require_once("autoload.php");

session_start();

$page = new Slider();
$page->html();

?>