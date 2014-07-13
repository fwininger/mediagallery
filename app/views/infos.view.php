<?php
$exif = $this->vars['exif'];

if($exif != false) {
	$resolutionMP = round($exif["ExifImageWidth"] *  $exif["ExifImageLength"] / 1000000 , 1);
?>
<br/>
<div class="panel panel-default">
  <div class="panel-heading">Propriétés de l'image</div>
  <div class="panel-body">
	<div class="col-xs-6 col-sm-4">
		Nom : <?php echo  $exif["FileName"]; ?>
	</div>
	<div class="col-xs-6 col-sm-4">
		Date : <?php echo $exif["DateTimeOriginal"]; ?>
	</div>
	<div class="col-xs-6 col-sm-4">
		ISO : <?php echo $exif["ISOSpeedRatings"]; ?>
	</div>
	<div class="col-xs-6 col-sm-4">
		Taille du fichier : <?php echo  round($exif["FileSize"] / 1048576, 2); ?> Mo
	</div>
	<div class="col-xs-6 col-sm-4">
		Résolution : <?php echo $resolutionMP ; ?> MPixels
	</div>
	<div class="col-xs-6 col-sm-4">
		Focale : <?php echo "F/".round(substr($exif["FNumber"],0,2) / 10,1); ?>
	</div>
	<div class="col-xs-6 col-sm-4">
		Taille : <?php echo $exif["ExifImageWidth"]; ?> x <?php echo $exif["ExifImageLength"]; ?>
	</div>
	<div class="col-xs-6 col-sm-4">
		Appareil : <?php echo $exif["Make"]." ".$exif["Model"]; ?>
	</div>
	<div class="col-xs-6 col-sm-4">
		Temps d'exposition : <?php $temps = substr($exif["ExposureTime"],3) / 10;  echo "1/".$temps."ème"; ?>
	</div>
  </div>
</div>
<?php
}
?>
