<?php
/**
 * Created by: Khoapq
 * Date: 15/10/2015
 */
$html = '';
$group_id = 'accordion_'.uniqid();
$title = $instance['title'] ? $instance['title'] : '';
$panel_list = $instance['panel'] ? $instance['panel'] : '';
$expand_first = $instance['expand_first'] ? $instance['expand_first'] : 'true';
?>

<div class="thim-accordion">
	<?php 
	if ($title != '') {
		echo '<h3 class="widget-title">'.$title.'</h3>';
	}
	?>
	<div id="<?php echo esc_attr($group_id); ?>" class="panel-group" role="tablist" aria-multiselectable="true">
	<!-- List Panel -->
	<?php foreach ($panel_list as $key => $panel) : ?>

		<?php 
		$accordion_class	= (($key == 0) && $expand_first === 'true') ? '' : 'collapsed';
		$panel_class 		= (($key == 0) && $expand_first === 'true') ? 'in' : '';
		$expanded 			= (($key == 0) && $expand_first === 'true') ? 'true' : 'false';
		?>

		<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="heading_<?php echo esc_attr($group_id.'_'.$key); ?>">
		      <h4 class="panel-title">
		        <a role="button" class="<?php echo esc_attr($accordion_class); ?>" data-toggle="collapse" data-parent="#<?php echo esc_attr($group_id); ?>" href="#collapse_<?php echo esc_attr($group_id.'_'.$key); ?>" aria-expanded="<?php echo esc_attr($expanded); ?>" aria-controls="collapse_<?php echo esc_attr($group_id.'_'.$key); ?>">
		          <?php echo esc_attr($panel['panel_title']); ?>
		        </a>
		      </h4>
		    </div>
		    <div id="collapse_<?php echo esc_attr($group_id.'_'.$key); ?>" class="panel-collapse collapse <?php echo esc_attr($panel_class); ?>" role="tabpanel" aria-labelledby="heading_<?php echo esc_attr($group_id.'_'.$key); ?>">
		      <div class="panel-body">
		         <?php echo $panel['panel_body']; ?>
		      </div>
		    </div>
		  </div>

	<?php endforeach; ?>
	<!-- End: List Panel -->
	</div>

</div>