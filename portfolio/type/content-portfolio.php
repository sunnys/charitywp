<?php
/**
 * @package thimpress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-format-standard' ); ?>>
	<div class="row entry-content-portfolio">
		<div class="content-inner col-sm-12">
			<header class="entry-header">
				<?php
				thim_post_meta(
					array(
						'date'     => true,
						'author'   => false,
						'category' => false,
						'comment'  => false
					)
				);
				?>
				<?php the_title( sprintf( '<h1 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
				<?php
				thim_post_meta(
					array(
						'date'     => false,
						'author'   => true,
						'category' => true,
						'comment'  => true
					)
				);
				?>
			</header>
		</div>
		<div class="entry-content-left col-sm-12">
			<?php
			if ( get_post_meta( get_the_ID(), 'selectPortfolio', true ) == 'portfolio_type_slider' ) {
				echo '<div class="portfolio_carousel">';
				$atts = get_post_meta( get_the_ID(), 'portfolio_image_sliders' );
				foreach ( $atts as $att ) {
					$src = wp_get_attachment_image_src( $att, 'full' );
					$src = $src[0];
					// Show image
					echo "<div class='single-img'><img src='{$src}' /></div>";
				}
				echo '</div>';
			} else if ( get_post_meta( get_the_ID(), 'selectPortfolio', true ) == 'portfolio_type_video' ) {
				$video_type = get_post_meta( get_the_ID(), 'project_video_type', true );
				if ( $video_type == 'vimeo' ) {
					$atts = get_post_meta( get_the_ID(), 'project_video_embed' );
					$att  = trim( $atts[0], ' ' );
					$id   = substr( $att, 18 );
					echo '<iframe src="//player.vimeo.com/video/' . $id . '" width="100%" allowfullscreen></iframe>';
				} else {
					$atts = get_post_meta( get_the_ID(), 'project_video_embed' );
					$att  = $atts[0];
					$att  = trim( $atts[0], ' ' );
					$att  = preg_replace( "([?,=])", "/", $att );
					$att  = preg_replace( "[watch]", '', $att );
					echo '<iframe src="' . $att . '" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				}
			} else {
				$atts = get_post_meta( get_the_ID(), 'project_item_slides' );
				foreach ( $atts as $att ) {
					$src = wp_get_attachment_image_src( $att, 'full' );
					$src = $src[0];
					// Show image
					echo "<div class='single-img'><img src='{$src}' /></div>";
				}
			}
			?>
			<div class="bd-content-portfolio">
				<?php the_content(); ?>

				<?php if ( get_post_meta( get_the_ID(), 'project_link', true ) ) { ?>
					<div class="link-project">
						<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'project_link', true ) ); ?>"
						   target="_blank" class="sc-btn">Link project</a>
					</div>
				<?php } ?>
			</div>

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tp-portfolio' ),
				'after'  => '</div>',
			) );
			?>

		</div>
		<?php thim_portfolio_related(); ?>
	</div>
</article><!-- #post-## -->
