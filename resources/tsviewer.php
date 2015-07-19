<div id="viewercontainer">
	<?php
		if($online == TRUE){
			echo '<h3>Hivecom Teamspeak Viewer</h3>';
		} else{
			echo '<h3>Hivecom is currently offline</h3>';
		}
	?>
	<div id="viewercontent">
		<div id="ts3viewer_1028008"> </div>
		<script type="text/javascript" src="http://static.tsviewer.com/short_expire/js/ts3viewer_loader.js"></script>
		<script type="text/javascript">
			var tsviewer = "http://www.tsviewer.com/ts3viewer.php?ID=1028008&text=eeeeee&text_size=12&text_family=1&js=1&text_s_weight=normal&text_s_style=normal&text_s_variant=normal&text_s_decoration=none&text_s_color_h=92e12b&text_s_weight_h=normal&text_s_style_h=normal&text_s_variant_h=normal&text_s_decoration_h=none&text_i_weight=normal&text_i_style=normal&text_i_variant=normal&text_i_decoration=none&text_i_color_h=92e12b&text_i_weight_h=normal&text_i_style_h=normal&text_i_variant_h=normal&text_i_decoration_h=none&text_c_weight=normal&text_c_style=normal&text_c_variant=normal&text_c_decoration=none&text_c_color_h=92e12b&text_c_weight_h=normal&text_c_style_h=normal&text_c_variant_h=normal&text_c_decoration_h=none&text_u_weight=normal&text_u_style=normal&text_u_variant=normal&text_u_decoration=none&text_u_color_h=92e12b&text_u_weight_h=normal&text_u_style_h=normal&text_u_variant_h=normal&text_u_decoration_h=none";
			ts3v_display.init(tsviewer, 1028008, 100);
		</script>
	</div>
</div>
