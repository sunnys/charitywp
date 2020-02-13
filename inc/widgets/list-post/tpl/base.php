<?php
global $post;
$number_posts = 2;
if ( $instance['number_posts'] <> '' ) {
	$number_posts = $instance['number_posts'];
}
$query_args = array(
	'posts_per_page' => $number_posts,
	'order'          => $instance['order'] == 'asc' ? 'asc' : 'desc',
);
if ( $instance['cat_id'] != 'all' ) {
	$query_args['cat'] = $instance['cat_id'];
}
switch ( $instance['orderby'] ) {
	case 'recent' :
		$query_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$query_args['orderby'] = 'post_title';
		break;
	case 'popular' :
		$query_args['orderby'] = 'comment_count';
		break;
	default : //random
		$query_args['orderby'] = 'rand';
}

$posts_display = new WP_Query( $query_args );

if ( $posts_display->have_posts() ) { ?>
	<div class="thim-list-post-wrapper-simple list-post-<?php echo esc_attr( $instance['template'] ); ?>">
		<div class="inner-list">
			<?php
			if ( $instance['title'] ) {
				echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
			}
			echo '<div class="list-posts">';
			while ( $posts_display->have_posts() ) {
				$posts_display->the_post();
				$class = 'item-post';
				?>
				<div <?php post_class( $class ); ?>>
					<div class="article-title-wrapper">
						<div class="article-inner">

							<div class="media">
								<?php thim_thumbnail( get_the_ID(), '100x82', 'post', true ); ?>
							</div>

							<div class="content">
								<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>" class="article-title"><?php echo esc_attr( get_the_title() ) ?></a>
								<?php if ( $instance['date'] == 'show' ): ?>
									<div class="post-info">
										<?php if ( $instance['date'] == 'show' ) : ?>
											<span class="article-date"><?php echo get_the_date() ?></span>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
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