<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

function classLoader($class)
{
	$models = 'app/models/'.str_replace('\\', '/', $class).'.model.php';
	$controllers = 'app/controllers/'.str_replace('\\', '/', $class).'.controller.php';
	$helpers = 'app/helpers/'.str_replace('\\', '/', $class).'.helper.php';
	$core = 'core/'.str_replace('\\', '/', $class).'.class.php';

	if(is_file($models)) {
		require $models;
	}
	elseif(is_file($controllers)) {
		require $controllers;
	}
	elseif(is_file($helpers)) {
		require $helpers;
	}
	elseif(is_file($core)) {
		require $core;
	}
}

spl_autoload_register('classLoader');

?>