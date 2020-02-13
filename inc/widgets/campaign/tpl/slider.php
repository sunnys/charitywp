<?php
$separator = $border = '';
$number = isset( $instance['number'] ) ? $instance['number'] : 1;
$order  = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
$title  = $instance['title_group']['title'];
$sub_title  = $instance['title_group']['sub-title'];
$line = $instance['title_group']['line'];
$border = $instance['border'];
$content  = $instance['title_group']['content'];

if ( $line == true ) {
    $separator = 'has-line';
}

if ( $border == true ) {
    $border = 'has-border';
}

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

?>

<div class="thim-campaign template-default tpl-slider <?php echo esc_attr($border) ?>">
    <?php if ( is_page_template( 'page-templates/homepage2.php' )) {?>
    <div class="container">
        <?php } ?>
        <div class="title-box <?php echo esc_attr($separator);?>">
            <div class="title">
                <?php
                if (!empty($title)) {
                    echo '<p>'. esc_attr($title).'</p>';
                }
                ?>
            </div>

            <div class="content">
                <?php
                if (!empty($sub_title)) {
                    echo '<h2>'. esc_attr($sub_title).'</h2>';
                }
                ?>

                <?php
                if (!empty($content)) {
                    echo '<p>'. esc_attr($content).'</p>';
                }
                ?>
            </div>

        </div>
        <div class="campaigns archive-content">
            <?php
            if ( $campaigns->have_posts() ) {
                while ( $campaigns->have_posts() ) {
                    $campaigns->the_post();
                    ?>
                    <article <?php post_class( ) ?> >
                        <div class="content-inner">
                            <?php
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                            if ( $src ) {
                                $images_size = @getimagesize( $src['0'] );
                                $img_src     = $src['0'];
                                if ( $images_size[0] >= 434 && $images_size[1] >= 291 ) {
                                    $img_src = aq_resize( $src[0], 434, 291, true );
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
        <?php if ( is_page_template( 'page-templates/homepage2.php' )) {?>
        </div>
            <?php } ?>
</div>