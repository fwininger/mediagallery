<?php
// Copyright (c) 2014 The MediaGallery Authors.
// All rights reserved.
//
// GNU GENERAL PUBLIC LICENSE
// See LICENSE file.

abstract class Picture extends File
{
	public function __construct($path) {
		parent::__construct($path);
	}

	public function getOrientation() {
		return 0;
	}

	// TODO : remove the orientation parameter
	public function display($orientation = 0) {
		$fileinfo = getimagesize($this->path);
		if( !$fileinfo )
			return FALSE;

		$width     = $fileinfo[0];
		$height    = $fileinfo[1];
		$type_mime = $fileinfo['mime'];
		$type      = str_replace('image/', '', $type_mime);

		$func = 'imagecreatefrom' . $type;
		if( !function_exists($func) )
			return FALSE;

		$func2 = 'image' . $type;
		if( !function_exists($func2) )
			return FALSE;

		header('Content-Type: '. $type_mime);
		$image = $func($this->path);

		// image rotation if necessery
		if($orientation != 0) {
			$image = imagerotate($image, $orientation, 0);
		}

		// TODO : remove this condition
		// for the diaporama, add black box
		if($height > 250 && $orientation != 0) {
			$height_new = $width ;
			$width_new = round($width * $width / $height, 0) ;
			$image_new = imagecreatetruecolor($width_new ,$height_new) ;
			$deplacement = round(($width_new - $height)/2,0) ;
			imagecopy($image_new, $image, $deplacement, 0, 0, 0, $height, $width) ;
			$image = $image_new ;
		}
		$func2($image) ;
	}

	// TODO : Make it unstatic
	// Source Code : http://code.seebz.net/p/imagethumb/
	// Utilisation :
	// 		imagethumb() génère une copie de l'image image_src aux dimensions maximales max_size et l'envoie vers un navigateur ou le fichier image_dest.
	//		imagethumb() utilise la bibliothèque GD et retournera FALSE si celle-ci n'est pas disponible
	//		imagethumb() fonctionne correctement avec les images de type Jpeg, Png et Gif. Dans le cas d'un Gif animé, seule la première frame sera utilisé.
	//		imagethumb() gère la transparence.
	public static function imagethumb($image_src, $image_dest = NULL, $max_size = 100, $expand = FALSE, $square = FALSE) {

		if(!file_exists($image_src))
			return FALSE;

		$fileinfo = getimagesize($image_src);
		if(!$fileinfo)
			return FALSE;

		$width     = $fileinfo[0];
		$height    = $fileinfo[1];
		$type_mime = $fileinfo['mime'];
		$type      = str_replace('image/', '', $type_mime);

		if(!$expand && max($width, $height) <= $max_size && (!$square || ($square && $width == $height))) {
			if($image_dest) {
				return copy($image_src, $image_dest);
			}
			else {
				header('Content-Type: '. $type_mime);
				return (boolean) readfile($image_src);
			}
		}

		$ratio = $width / $height;
		if($square) {
			$new_width = $new_height = $max_size;

			if( $ratio > 1 ) {
				// Landscape
				$src_y = 0;
				$src_x = round(($width - $height) / 2);
				$src_w = $src_h = $height;
			}
			else {
				// Portrait
				$src_x = 0;
				$src_y = round(($height - $width) / 2);
				$src_w = $src_h = $width;
			}
		}
		else {
			$src_x = $src_y = 0;
			$src_w = $width;
			$src_h = $height;

			if ( $ratio > 1 ) {
				// Landscape
				$new_width  = $max_size;
				$new_height = round($max_size / $ratio);
			}
			else {
				// Portrait
				$new_height = $max_size;
				$new_width  = round($max_size * $ratio);
			}
		}

		// Open the orignal picture
		$func = 'imagecreatefrom' . $type;
		if(!function_exists($func))
			return FALSE;

		$image_src = $func($image_src);
		$new_image = imagecreatetruecolor($new_width,$new_height);

		// Manage transparent of png
		if($type=='png') {
			imagealphablending($new_image,false);
			if(function_exists('imagesavealpha'))
				imagesavealpha($new_image,true);
		}

		// Manage transparent of gif
		elseif( $type=='gif' && imagecolortransparent($image_src)>=0 ) {
			$transparent_index = imagecolortransparent($image_src);
			$transparent_color = imagecolorsforindex($image_src, $transparent_index);
			$transparent_index = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
			imagefill($new_image, 0, 0, $transparent_index);
			imagecolortransparent($new_image, $transparent_index);
		}

		// Resize the picture
		imagecopyresampled(
			$new_image, $image_src,
			0, 0, $src_x, $src_y,
			$new_width, $new_height, $src_w, $src_h
		);

		// Save the picture
		$func = 'image'. $type;
		if($image_dest) {
			$func($new_image, $image_dest);
		}
		else {
			header('Content-Type: '. $type_mime);
			$func($new_image);
		}

		// Free memory
		imagedestroy($new_image);

		return TRUE;
	}
}

?>