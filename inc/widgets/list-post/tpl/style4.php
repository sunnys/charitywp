<?php
global $post;
$number_posts = 2;
if ( $instance['number_posts'] <> '' ) {
	$number_posts = $instance['number_posts'];
}
$query_args = array(
	'posts_per_page' 	=> $number_posts,
	'order'          	=> $instance['order'] == 'asc' ? 'asc' : 'desc',
);
if ($instance['cat_id'] != 'all'){
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
	<div class="thim-list-post-wrapper-simple list-post-<?php echo esc_attr($instance['template']); ?>">
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
                        <div class="article-inner clearfix">
                                <?php if ($instance['date'] == 'show') : ?>
                                    <div class="time-from">
                                        <div class="date">
                                            <?php echo get_the_date('j') ?>
                                        </div>
                                        <div class="month">
                                            <?php echo get_the_date('F') ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

								<div class="content">
									<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>" class="article-title"><?php echo esc_attr( get_the_title() ) ?></a>
                                    <div class="post-meta">
                                        <span class="author"><i class="ion-ios-person-outline"></i>
                                            <?php printf( '<span class="vcard author author_name"><a href="%1$s">%2$s</a></span>',
                                                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                esc_html( get_the_author() )
                                            ); ?>
                                        </span>
                                        <span class="comment-total"><i class="ion-ios-chatbubble-outline"></i>
                                            <?php thim_comments_popup_link( '0', '1', '%', 'comments-link', 'Comments are off for this post' ); ?>
                                        </span>
                                    </div>
                                    <div class="des"><?php echo the_excerpt(); ?></div>
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