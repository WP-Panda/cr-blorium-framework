<style>
<?php global $smof_data; ?>
<?php 
$width = $smof_data['content_width'] ? $smof_data['content_width'] .'px' : '100%'; ?>
	#content{ 
		width: <?php echo $width; ?>;
	}
<?php
$width = $smof_data['top_widgets_panel_content_width'] ? $smof_data['top_widgets_panel_content_width'] .'px' : '100%'; ?>
	.widget-area-top-panel { 
		width: <?php echo $width; ?>;
	}
<?php
$width = $smof_data['footer_widgets_panel_content_width'] ? $smof_data['footer_widgets_panel_content_width'] .'px' : '100%'; ?>
	.widget-area-footer,.widget-area-footer-panel{
		width: <?php echo $width; ?>;
	}
<?php
$width = $smof_data['footer_copyright_panel_content_width'] ? $smof_data['footer_copyright_panel_content_width'] .'px' : '100%'; ?>
	.site-info {
		width: <?php echo $width; ?>;
	}
</style>