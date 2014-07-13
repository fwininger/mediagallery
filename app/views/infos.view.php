<?php
$exif = $this->vars['exif'];

if($exif != false) {
	$resolutionMP = round($exif["ExifImageWidth"] *  $exif["ExifImageLength"] / 1000000 , 1);
?>
	<b>Propriétés de l'image :</b>
	<table width="100%">
		<tr>
			<td> Nom : <?php echo  $exif["FileName"]; ?> </td>
			<td> Taille : <?php echo $exif["ExifImageWidth"]; ?> x <?php echo $exif["ExifImageLength"]; ?></td>
			<td> ISO : <?php echo $exif["ISOSpeedRatings"]; ?> </td>
		</tr>
		<tr>
			<td> Taille du fichier : <?php echo  round($exif["FileSize"] / 1048576, 2); ?> Mo </td>
			<td> Résolution : <?php echo $resolutionMP ; ?> MPixels </td>
			<td> Focale : <?php echo "F/".round(substr($exif["FNumber"],0,2) / 10,1); ?></td>
		</tr>
		<tr>
			<td> Date : <?php echo $exif["DateTimeOriginal"]; ?></td>
			<td> Appareil : <?php echo $exif["Make"]." ".$exif["Model"]; ?></td>
			<td> Temps d'exposition : <?php $temps = substr($exif["ExposureTime"],3) / 10;  echo "1/".$temps."ème"; ?> </td>
		</tr>
	</table>
<?php
}
?>
</br/>
Télécharger l'image originale : <a href=''>télécharger</a>
