<?php

$number = isset( $instance['number_posts'] ) ? $instance['number_posts'] : 3;

$post_args = array(
	'posts_per_page' => $number,
	'order'          => $instance['order']
);

if ( $instance['cat_id'] != 'all' ) {
	$post_args['cat'] = $instance['cat_id'];
}

switch ( $instance['orderby'] ) {
	case 'recent' :
		$post_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$post_args['orderby'] = 'post_title';
		break;
	case 'popular' :
		$post_args['orderby'] = 'comment_count';
		break;
	default :
		$post_args['orderby'] = 'rand';
}

$posts_display = new WP_Query( $post_args );
$show_date     = isset( $instance['date'] ) ? $instance['date'] : 'show';


$columns = isset( $instance['columns'] ) ? $instance['columns'] : 3;
$col     = 12 / $columns;

if ( $posts_display->have_posts() ) { ?>
	<div class="thim-list-post-wrapper-simple list-post-<?php echo esc_attr( $instance['template'] ); ?>">
		<div class="inner-list">
			<?php
			if ( $instance['title'] ) {
				echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
			}
			echo '<div class="list-posts row">';
			while ( $posts_display->have_posts() ) {
				$posts_display->the_post();
				$class = 'item-post col-xs-6 col-md-' . $col;
				?>
				<div <?php post_class( $class ); ?>>
					<div class="article-title-wrapper">
						<div class="article-inner">

							<div class="media">
								<?php thim_thumbnail( get_the_ID(), '370x270', 'post', true ); ?>
							</div>

							<div class="post-content">
								<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>"
								   class="article-title">
									<h3 class="title"><?php echo esc_attr( get_the_title() ) ?></h3></a>
								<?php if ( $instance['date'] == 'show' ): ?>
									<div class="post-info">
										<?php if ( $instance['date'] == 'show' ) : ?>
											<span class="article-date"><?php echo get_the_date() ?></span>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<div class="thim-post-content">
									<?php the_excerpt(); ?>
								</div>
							</div>
							<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>" class="thim-button readmore style7"><?php echo esc_html( $instance['button_text'] ); ?></a>
						</div>
					</div>
				</div>
				<?php
			}
			echo '</div>';
			?>
		</div>
	</div>
	<?php
	wp_reset_postdata();
}
?>
