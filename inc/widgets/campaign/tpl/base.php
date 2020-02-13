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

$column = 12 / $instance['default_option']['columns'];

if ( $column === 2.4 ) {
	$column = 15;
}

$col = 'col-xs-6 col-md-' . $column;

?>

<div class="thim-campaign template-default">
    <div class="campaigns archive-content row">
		<?php
		if ( $campaigns->have_posts() ) {
			while ( $campaigns->have_posts() ) {
				$campaigns->the_post();
				?>
                <article <?php post_class( $col ) ?> >
                    <div class="content-inner">
						<?php
						$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						if ( $src ) {
							$images_size = @getimagesize( $src['0'] );
							$img_src     = $src['0'];
							if ( $images_size[0] >= 373 && $images_size[1] >= 250 ) {
								$img_src = aq_resize( $src[0], 373, 250, true );
							}
							?>
                            <div class="entry-thumbnail">
                                <div class="thumbnail">
                                    <a href="<?php echo esc_url( get_permalink() ) ?>">
                                        <img src="<?php echo esc_attr( $img_src ); ?>"
                                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                                             title="<?php echo esc_attr( get_the_title() ); ?>">
                                    </a>
                                </div>
                                <a href="#" class="donate_load_form thim-button style3"
                                   data-campaign-id="<?php echo esc_attr( get_the_ID() ) ?>"><?php esc_html_e( 'DONATE NOW', 'charitywp' ); ?></a>
                            </div>
						<?php } ?>
                        <div class="event-content">
                            <div class="entry-header">
								<?php the_title( sprintf( '<h2 class="blog_title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                            </div>
                            <div class="entry-content">
								<?php the_excerpt() ?>
                            </div>
							<?php
							do_action( 'donate_loop_campaign_countdown' );
							do_action( 'donate_loop_campaign_goal_raised' );
							?>
                        </div>
                    </div>
                </article>
				<?php
			}
			wp_reset_postdata();
		}
		?>
    </div>
</div>