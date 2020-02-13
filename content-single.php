<?php
/**
 * @package thim
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-inner">
		<?php do_action( 'thim_entry_top', 'full' ); ?>

		<header class="entry-header">
			<?php 
				thim_post_meta(
					array(
						'date' 		=> true,
						'author'	=> false,
						'category'	=> false,
						'comment'	=> false
					)
				); 
			?>
			<?php the_title( sprintf( '<h1 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			<?php 
				thim_post_meta(
					array(
						'date' 		=> false,
						'author'	=> true,
						'category'	=> true,
						'comment'	=> true
					)
				); 
			?>
		</header>

		<div class="entry-content">
			<div class="entry-summary">
				<?php the_content(); ?>
				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'charitywp' ),
					'after'  => '</div>',
				) );
				?>
			</div>
		</div>

		<div class="post-bottom row">
			<div class="col-md-6 col-sm-12">
				<?php thim_tags() ?>
			</div>
			<div class="col-md-6 col-sm-12">
				<?php do_action('thim_social_share'); ?>
			</div>
		</div>
	</div>
</article><!-- #post-## -->
<?php do_action('thim_about_author'); ?>
<?php thim_related_post() ?>