<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package thim
 */
if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>
<div id="sidebar" class="widget-area col-sm-3" role="complementary">
	<div class="sidebar theiaStickySidebar">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</div>
</div>

<div class="clear"></div>
<!-- #secondary -->

