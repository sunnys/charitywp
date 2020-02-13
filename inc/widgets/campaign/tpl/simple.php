<?php

$number = isset( $instance['number'] ) ? $instance['number'] : 1;
$order  = isset( $instance['order'] ) ? $instance['order'] : 'DESC';

$campaign_args = array(
	'post_type'      => array( 'dn_campaign' ),
	'posts_per_page' => $number,
	'order'          => $order,
);

switch ( $instance['orderby'] ) {
	case 'recent' :
		$campaign_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$campaign_args['orderby'] = 'post_title';
		break;
	case 'popular' :
		$campaign_args['orderby'] = 'comment_count';
		break;
	default :
		$campaign_args['orderby'] = 'rand';
}

$campaigns = new WP_Query( $campaign_args );

if ( $campaigns->have_posts() ) { ?>
    <div class="thim-list-post-wrapper-simple list-post-base">
        <div class="inner-list">
			<?php
			if ( $instance['title'] ) {
				echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
			}
			echo '<div class="list-posts">';
			while ( $campaigns->have_posts() ) {
				$campaigns->the_post();
				$class = 'item-post post';
				?>
                <div <?php post_class( $class ); ?>>
                    <div class="article-title-wrapper">
                        <div class="article-inner">

                            <div class="media">
								<?php
								$src     = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
								$img_src = aq_resize( $src[0], 100, 82, true );
								?>
                                <a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">
                                    <img src="<?php echo esc_attr( $img_src ); ?>" alt="<?php echo get_the_title() ?>"
                                         title="<?php echo get_the_title() ?>"/>
                                </a>
                            </div>

                            <div class="content">
                                <a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>"
                                   class="article-title"><?php echo esc_attr( get_the_title() ) ?></a>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
			}
			wp_reset_postdata();
			echo '</div>';
			?>
        </div>
    </div>
	<?php
}
?>