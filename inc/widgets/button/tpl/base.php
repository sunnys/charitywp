<?php 
$button_css = '';

$custom = (isset($instance['button_option']['custom']) && $instance['button_option']['custom'] === 'yes') ? true : false;
$id = 'button_'.uniqid();
?>

<div id="<?php echo esc_attr($id) ?>" class="text-<?php echo esc_attr($instance['align']); ?>">
	<a target="_blank" href="<?php echo esc_attr($instance['link']); ?>" class="thim-button <?php echo esc_attr($instance['style']); ?> inner size-<?php echo esc_attr($instance['size']); ?>"><?php echo esc_attr($instance['text']); ?></a>
</div>

<?php if ($custom) : ?>
	<style>
		#<?php echo esc_html($id) ?> .thim-button{
			background: <?php echo esc_html($instance['button_option']['button_color']) ?>;
			color: <?php echo esc_html($instance['button_option']['text_color']) ?>;
		}
		#<?php echo esc_html($id) ?> .thim-button:hover{
			background: <?php echo esc_html($instance['button_option']['button_hover_color']) ?>;
			color: <?php echo esc_html($instance['button_option']['text_hover_color']) ?>;
		}
	</style>
<?php endif; ?>