<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">MediaGallery</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="slider?dir=<?php echo $this->http->get('dir'); ?>">Diaporama</a></li>
				<li><a href="#">Paramètres</a></li>
				<li><a href="#">Partage</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="container-fluid">
  <div class="row">
	<?php $this->sideBar(); ?>
	<?php $this->gallery(); ?>
  </div>
</div>