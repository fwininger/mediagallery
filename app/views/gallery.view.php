<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<?php
		$root = explode("/", $this->http->get('dir'));
		if($root[1] != "")
		{
	?>
	<ol class="breadcrumb">
		<li><a href="index">Home</a></li>
		<li><a href="index?dir=<? echo $root[0] ?>"><? echo $root[0] ?></a></li>
		<li class="active"><? echo $root[1] ?></li>
	</ol>
	<?php } else { ?>
	<ol class="breadcrumb">
		<li><a href="index">Home</a></li>
		<li class="active"><? echo $root[0] ?></li>
	</ol>
	<?php } ?>

	<div class="row placeholders">
		<?php
		$files = $this->vars['listFiles'];

		for($i = 0; $i < count($files); $i++) {
			?>
			<div class="col-xs-6 col-sm-3 placeholder">
				<img src="thumbnail?dir=<?php echo $this->http->get('dir'); ?>&image=<?php echo $files[$i]; ?>" class="img-responsive" alt="<?php echo $files[$i] ?>">
				<h4><?php echo $files[$i] ?></h4>
			</div>
			<?php
		}
		?>
	</div>
</div>