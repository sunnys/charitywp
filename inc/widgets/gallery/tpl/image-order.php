<?php

global $post;

$img_id     = explode( ",", $instance['image'] );
$gallery_id = 'gallery_' . uniqid();

$crop_sizes = array();

$crop_sizes[] = '331x221';
$crop_sizes[] = '491x350';
$crop_sizes[] = '238x158';
$crop_sizes[] = '280x157';
$crop_sizes[] = '338x204';
$crop_sizes[] = '243x162';

if ( $img_id ):
	?>
	<div class="thim-gallery-box" id="<?php echo esc_attr( $gallery_id ); ?>">
		<?php if ( is_page_template( 'page-templates/homepage2.php' ) ) { ?>
		<div class="container">
			<?php } ?>
			<h2 class="widget-title">
				<?php
				if ( $instance['title'] ) {
					echo ent2ncr( $instance['title'] );
				}
				?>
			</h2>
			<div class="gallery-wrapper">
				<ul class="grid clearfix" id="<?php echo esc_attr( $gallery_id ); ?>_items">
					<?php
					foreach ( $img_id as $key => $image ) {
						$thumbnail_size = 'full';
						if ( isset( $crop_sizes[$key] ) ) {
							$thumbnail_size = $crop_sizes[$key];
						}
						$attachment_id = get_post_thumbnail_id( $img_id[0] );
						$src           = wp_get_attachment_image_src( $image, 'full' );
						?>
						<li class="grid-item">
							<a class="grid-image" href="<?php echo esc_url( $src[0] ); ?>">
								<?php
								thim_thumbnail( $image, $thumbnail_size, 'attachment', false, 'no-lazy' );
								?>
							</a>
						</li>
					<?php }
					?>
				</ul>
			</div>
			<div class="info-list clearfix">
				<?php
				$panel_list = $instance['info_group'] ? $instance['info_group'] : '';
				$columns    = 12 / count( $instance['info_group'] );
				foreach ( $panel_list as $key => $panel ) :
					?>

					<div class="info col-sm-<?php echo $columns; ?>">
						<h3 class="title"><?php echo $panel["title"]; ?></h3>
						<div class="sub-title"><?php echo $panel["content"]; ?></div>
					</div>

				<?php endforeach; ?>
			</div>
			<?php
			$readmore_link         = $instance['readmore_group']['link'];
			$readmore_text         = $instance['readmore_group']['button_readmore_group']['read_text'];
			$readmore_button_style = $instance['readmore_group']['button_readmore_group']['button_style'];

			?>
			<div class="read-more">
				<a class="thim-button readmore <?php echo $readmore_button_style; ?>" href="<?php echo $readmore_link; ?>"><?php echo $readmore_text; ?></a>
			</div>
			<?php if ( is_page_template( 'page-templates/homepage2.php' ) ) { ?>
		</div>
	<?php } ?>
	</div>
<?php endif; ?>
