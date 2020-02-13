<?php

$number = 1;
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
$campaign_box = 'thim_' . uniqid();

$campaigns = new WP_Query( $campaign_args );

if ( $campaigns->have_posts() ) { ?>
    <div class="thim-campaign tpl-campaign-list-1" id="<?php echo esc_attr( $campaign_box ); ?>">
        <?php
        if ( $campaigns->have_posts() ) {
            while ( $campaigns->have_posts() ) {
                $campaigns->the_post();
                ?>
                <div <?php post_class( 'campaign' ) ?> >
                    <div class="inner">
                        <div class="content">
                            <?php the_title( sprintf( '<a href="%s" rel="bookmark" class="title">', esc_url( get_permalink() ) ), '</a>' ); ?>
                            <div class="excerpt"><?php the_excerpt() ?></div>
                            <?php
                            do_action( 'donate_single_campaign_countdown' );
                            do_action( 'donate_loop_campaign_goal_raised' );
                            do_action( 'donate_single_campaign_donate' );
                            ?>
                        </div>

                        <?php
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                        if ( $src ) {
                            $images_size = @getimagesize( $src['0'] );
                            $img_src     = $src['0'];
                            $imgH        = $images_size[1];
                            if ( $images_size[0] >= 581 && $images_size[1] >= 355 ) {
                                $img_src = aq_resize( $src[0], 581, 355, true );
                                $imgH    = 355;
                            }
                            ?>
                            <div class="media">
                                <a href="<?php echo esc_url( get_permalink() ) ?>">
                                    <div class="inner-media"
                                         style="height: 355px; background-position: center; background-size: cover; background-image: url(<?php echo esc_attr( $img_src ); ?>)"></div>
                                </a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
        }
        ?>
    </div>
	<?php
}
?>