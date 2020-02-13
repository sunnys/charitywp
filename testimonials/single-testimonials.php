<?php
/**
 * The Template for displaying all single posts.
 *
 * @package    thimpress
 */

get_header();
?>
    <div class="page-content page_testimonial_single">
		<?php
		while ( have_posts() ) :
			the_post(); ?>
			<?php $testimonial_id = get_the_ID(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="image">
					<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                </div>
                <div class="content">
                    <h3 class="title"><?php echo get_the_title(); ?></h3>
					<?php
					$regency = get_post_meta( $testimonial_id, 'regency', true );
					echo '<div class="regency">' . esc_attr( $regency ) . '</div>';
					?>
                    <div class="entry-content">
						<?php the_content(); ?>
                    </div>
                </div>
            </article>

            <div class="clear"></div>
			<?php
		endwhile; // end of the loop.
		?>
    </div>
<?php
do_action( 'thim_wrapper_loop_end' );
get_footer();