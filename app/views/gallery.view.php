<script>
$(document).ready(function() {
	$(".myDiv").click(function() {
		if (!$(this).hasClass("info") ) {
			$(this).addClass("info");
			$(this).animate({
				width: '100%',
			}, 500);
			var url = $(this).children('.myImg').attr("src").replace("thumbnail", "exif");
			$(this).children('.myExif').load(encodeURI(url));
			$(this).children('.myExif').show();

			var src = $(this).children('.myImg').attr("src").replace("thumbnail", "thumbbig");
			$(this).children('.myImg').attr("src", src);
		} else {
			$(this).removeClass("info");
			$(this).animate({
				width: '25%',
			}, 500);
			$(this).children('.myExif').hide();

			var src = $(this).children('.myImg').attr("src").replace("thumbbig", "thumbnail");
			$(this).children('.myImg').attr("src", src);
		}
	});
	$(".videotitle").click(function() {
		if (!$(this).parent().hasClass("info") ) {
			$(this).parent().addClass("info");
			$(this).parent().animate({
				width: '80%',
			}, 500);
		} else {
			$(this).parent().removeClass("info");
			$(this).parent().animate({
				width: '25%',
			}, 500);
		}
	});
});

</script>
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
			$p = $this->http->session('directory');
			$p .= $this->http->get('dir').'/';
			$p .= $files[$i];

			if(Jpeg::isValid($p)) {
			?>
			<div class="col-xs-6 col-sm-3 placeholder myDiv">
				<img src="thumbnail?dir=<?php echo $this->http->get('dir'); ?>&image=<?php echo $files[$i]; ?>" class="img-responsive myImg" alt="<?php echo $files[$i] ?>">
				<h4><?php echo $files[$i] ?></h4>
				<div class="myExif"></div>
			</div>
			<?php } else { ?>
			<div class="col-xs-6 col-sm-3 placeholder myDivVideo">
				<video src="video?dir=<?php echo $this->http->get('dir'); ?>&image=<?php echo $files[$i]; ?>"
					style="width:100%;height:100%;" width="100%" height="100%" controls="controls" preload="none" type="video/mp4"></video>
				<h4 class='videotitle'><?php echo $files[$i] ?></h4>
			</div>
			<?php
			}
		}
		?>
	</div>
</div>
<script>
	$('audio,video').mediaelementplayer({ /* options */ });
</script>