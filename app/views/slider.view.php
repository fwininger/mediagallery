<?php
	$files = $this->vars['listFiles'];
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	<?php
	for($i = 1; $i < count($files); $i++) {
	?>
		<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>"></li>
	<?php
	}
	?>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
	<?php
	for($i = 0; $i < count($files); $i++) {
		$p = $this->http->session('directory');
		$p .= $this->http->get('dir').'/';
		$p .= $files[$i];

		if(Jpeg::isValid($p)) {
		?>
		<div class="item<? if($i == 0) echo " active"; ?>">
			<img src="./thumbbig?dir=<?php echo $this->http->get('dir'); ?>&image=<?php echo $files[$i]; ?>" alt=""/>
			<div class="container">
				<div class="carousel-caption">
					<h1><?php echo $files[$i] ?></h1>
					<p class="lead"></p>
				</div>
			</div>
		</div>
		<?php
		}
	}
	?>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</div>
