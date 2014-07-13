<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
	<?php
	for($i = 0; $i < count($this->vars['listItems']) ; $i++) {
		$folder = $this->vars['listItems'][$i];
		$subfolder = $folder->getSubFolder();

		if($subfolder == null) {
			echo ($folder->getName() == $this->http->get('dir')) ? "<li class=\"active\">" : "<li>";
			echo "<a href=\"index?dir=".$folder->getName()."\" >".$folder->getName();
			if($folder->isSharedBy($this->http->session('id_user')))
				echo " <span class=\"glyphicon glyphicon-share-alt\"></span>";
			echo "</a></li>\n";
		}
		else {
			$root = explode("/", $this->http->get('dir'));
			echo ($folder->getName() == $root[0]) ? "<li class=\"dropdown active open\">" : "<li class=\"dropdown\">";
			echo "<a href=\"index?dir=".$folder->getName()."\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$folder->getName()."<span class=\"caret\"></span></a>";
			echo "<ul class=\"dropdown-menu dropdown-custom\" role=\"menu\">\n";
			for($k = 0; $k < count($subfolder); $k++) {
				echo ($subfolder[$k]->getCName() == $this->http->get('dir')) ? "<li class=\"active\">":"<li>";
				echo "<a href=\"index?dir=".$subfolder[$k]->getCName()."\" >".$subfolder[$k]->getName()."</a></li>\n";
			}
			echo "</ul>\n</li>\n";
		}
	}
	?>
  </ul>
</div>