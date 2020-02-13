<?php
/**
 * The Template for displaying all single posts.
 *
 * @package    thimpress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'THIM_Portfolio' ) ) {
	exit;
}

$portfolio_data = get_theme_mods();

$portfolio_archive_layout  = get_theme_mod( 'portfolio_layout' );
$portfolio_archive_filter  = get_theme_mod( 'portfolio_filter' );
$portfolio_archive_style   = get_theme_mod( 'portfolio_style' );
$portfolio_archive_columns = get_theme_mod( 'portfolio_columns' );
$posts_per_page            = get_theme_mod( 'portfolio_paging' );
$paged                     = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
$gutter                    = get_theme_mod( 'portfolio_gutter' );

$filter = '';
if ( $portfolio_archive_filter ) {
	$filter = 'portfolio_filter';
}

$class_column = "";
if ( $portfolio_archive_columns == 2 ) {
	$class_column = "two-col";
} elseif ( $portfolio_archive_columns == 3 ) {
	$class_column = "three-col";
} elseif ( $portfolio_archive_columns == 4 ) {
	$class_column = "four-col";
} elseif ( $portfolio_archive_columns == 5 ) {
	$class_column = "five-col";
} else {
	$class_column = "one-col";
}

$class_gutter = "";
if ( $gutter > 0 ) {
	$class_gutter = "has_gutter";
}

$args = array(
	'post_type'      => 'portfolio',
	'posts_per_page' => $posts_per_page,
	'paged'          => $paged
);

if ( isset( get_queried_object()->term_id ) ) {
	$category = get_queried_object()->term_id;
} else {
	$category = "";
}

if ( ( is_array( $category ) && ! empty( $category ) ) || ( ! is_array( $category ) && $category ) ) {
	$args['tax_query'][] = array(
		'taxonomy' => 'portfolio_category',
		'field'    => 'ID',
		'terms'    => $category
	);
}
$gallery = new WP_Query( $args );

$number_total = max( $gallery->post_count, $posts_per_page );

$post_taxs      = '';
$portfolio_taxs = [];
if ( is_array( $gallery->posts ) && ! empty( $gallery->posts ) && $gallery->post_count ) {
	foreach ( $gallery->posts as $gallery_post ) {
		$post_taxs = wp_get_post_terms( $gallery_post->ID, 'portfolio_category', array( "fields" => "all" ) );
		if ( is_array( $post_taxs ) && ! empty( $post_taxs ) ) {
			foreach ( $post_taxs as $post_tax ) {
				if ( is_array( $category ) && ! empty( $category ) && ( in_array( $post_tax->term_id, $category ) || in_array( $post_tax->parent, $category ) ) ) {
					$portfolio_taxs[ urldecode( $post_tax->slug ) ] = $post_tax->name;
				}
				if ( empty( $category ) || ! isset( $category ) ) {
					$portfolio_taxs[ urldecode( $post_tax->slug ) ] = $post_tax->name;
				}
			}
		}
	}
} else {
	exit;
}
?>
<section class="content-area">
	<div class="portfolio_container">

		<div class="wrapper_portfolio <?php echo esc_attr( $filter ); ?> <?php echo esc_attr( $posts_per_page ); ?> <?php echo $portfolio_archive_style; ?> <?php echo $class_gutter; ?>">
			<?php if ( $portfolio_archive_filter ) { ?>
				<div class="portfolio-tabs-wrapper filters">
					<div class="portfolio-tabs">
						<button class="filter active"
						        data-filter="*"><?php echo esc_html__( 'All', 'charitywp' ); ?></button>
						<?php foreach ( $portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name ): ?>
							<button class="filter"
							        data-filter=".<?php echo esc_attr( $portfolio_tax_slug ); ?>"><?php echo ent2ncr( $portfolio_tax_name ); ?></button>
						<?php endforeach; ?>
					</div>
				</div>
			<?php } ?>

			<div class="portfolio_column">
				<div class="content_portfolio" data-style="<?php echo $portfolio_archive_style; ?>"
				     data-columns="<?php echo $portfolio_archive_columns; ?>"
				     data-gutter="<?php echo $gutter; ?>">
					<?php
					while ( $gallery->have_posts() ): $gallery->the_post();
						$feature_images = get_post_meta( get_the_ID(), 'feature_images', true );
						$images_size    = 'portfolio_size11';
						$style_layout   = '';
						$imgurl         = '';
						$image_url      = '';

						$class_size = "";
						if ( $portfolio_archive_style == "multi_grid" ) {
							if ( $feature_images == 'size11' ) {
								$images_size = 'portfolio_size11';
								$class_size  = "";
							} elseif ( $feature_images == 'size12' ) {
								$images_size = 'portfolio_size12';
								$class_size  = " height_large";
							} elseif ( $feature_images == 'size21' ) {
								$images_size = 'portfolio_size21';
								$class_size  = " item_large";
							} elseif ( $feature_images == 'size22' ) {
								$images_size = 'portfolio_size22';
								$class_size  = " height_large item_large";
							} else {
								$array       = array(
									'portfolio_size11' => 'size11',
									'portfolio_size12' => 'size12',
									'portfolio_size21' => 'size21',
									'portfolio_size22' => 'size22'
								);
								$images_size = array_rand( $array, 1 );
								if ( $images_size == 'portfolio_size11' ) {
									$class_size = "";
								} else if ( $images_size == 'portfolio_size12' ) {
									$class_size = " height_large";
								} else if ( $images_size == 'portfolio_size21' ) {
									$class_size = " item_large";
								} else {
									$class_size = " height_large item_large";
								}
							}
						} else if ( $portfolio_archive_style == "masonry" ) {
							if ( $feature_images == 'size11' ) {
								$images_size = 'portfolio_size11';
								$class_size  = "";
							} else {
								$images_size = 'portfolio_size_special';
								$class_size  = "";
							}
						} else {
							//$images_size = 'portfolio_same_size';
							$images_size = 'portfolio_size11';
						}

						$item_classes = '';
						$terms_id     = array();
						$item_cats    = get_the_terms( get_the_ID(), 'portfolio_category' );
						if ( $item_cats ):
							foreach ( $item_cats as $item_cat ) {
								$item_classes .= $item_cat->slug . ' ';
								$terms_id[]   = $item_cat->term_id;
							}
						endif;

						$image_id = get_post_thumbnail_id( get_the_ID() );

						$w = $h = '';
						if ( $portfolio_archive_style == "masonry" ) {
							$crop       = true;
							$dimensions = isset( $portfolio_data['thim_portfolio_option_dimensions'] ) ? $portfolio_data['thim_portfolio_option_dimensions'] : array();
							if ( $images_size == 'portfolio_size11' ) {
								$w = isset( $dimensions['width'] ) ? $dimensions['width'] : '480';
								$h = isset( $dimensions['height'] ) ? $dimensions['height'] : '320';
							} else {
								$w = isset( $dimensions['width'] ) ? $dimensions['width'] : '600';
								$h = isset( $dimensions['height'] ) ? $dimensions['height'] : '600';
							}
							$imgurl     = wp_get_attachment_image_src( $image_id, 'full' );
							$image_crop = $imgurl[0];
							if ( $imgurl[1] >= $w && $imgurl[2] >= $h ) {
								$image_crop = aq_resize( $imgurl[0], $w, $h, $crop );
							}
							$image_url = '<img src="' . $image_crop . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';
						} else {
							$crop       = true;
							$dimensions = isset( $portfolio_data['thim_portfolio_option_dimensions'] ) ? $portfolio_data['thim_portfolio_option_dimensions'] : array();
							if ( $images_size == 'portfolio_size11' ) {
								$w = isset( $dimensions['width'] ) ? $dimensions['width'] : '480';
								$h = isset( $dimensions['height'] ) ? $dimensions['height'] : '320';
							} else if ( $images_size == 'portfolio_size12' ) {
								$w = isset( $dimensions['width'] ) ? $dimensions['width'] : '480';
								$h = isset( $dimensions['height'] ) ? ( intval( $dimensions['height'] ) * 2 ) : '640';
							} else if ( $images_size == 'portfolio_size21' ) {
								$w = isset( $dimensions['width'] ) ? ( intval( $dimensions['width'] ) * 2 ) : '960';
								$h = isset( $dimensions['height'] ) ? $dimensions['height'] : '320';
							} else {
								$w = isset( $dimensions['width'] ) ? ( intval( $dimensions['width'] ) * 2 ) : '960';
								$h = isset( $dimensions['height'] ) ? ( intval( $dimensions['height'] ) * 2 ) : '640';
							}

							$imgurl     = wp_get_attachment_image_src( $image_id, 'full' );
							$image_crop = $imgurl[0];
							if ( $imgurl[1] >= $w && $imgurl[2] >= $h ) {
								$image_crop = aq_resize( $imgurl[0], $w, $h, $crop );
							}

							if ( $portfolio_archive_style == "multi_grid" ) {
								$image_url = '<div class="thumb-img" style="background: url(' . $image_crop . ');background-size: cover;background-repeat: no-repeat;background-position: center center;height: inherit;"><img style="visibility: hidden;" src="' . $image_crop . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" /></div>';
							} else {
								$image_url = '<img src="' . $image_crop . '" alt="' . get_the_title() . '" title="' . get_the_title() . '"/>';
							}
						}

						// check postfolio type
						$data_href   = "";
						$imclass     = "";
						$title_image = "";

						if ( get_post_meta( get_the_ID(), 'selectPortfolio', true ) == "portfolio_type_video" ) {
							$imclass = "video-popup";
							if ( get_post_meta( get_the_ID(), 'project_video_embed', true ) != "" ) {
								$imImage = get_post_meta( get_the_ID(), 'project_video_embed', true );
							} else if ( has_post_thumbnail( get_the_ID() ) ) {
								$image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
								$title_image = get_the_title( get_post_thumbnail_id( get_the_ID() ) );
								$imImage     = $image[0];
							} else {
								$imclass  = "";
								$imImage  = get_permalink( get_the_ID() );
								$btn_text = "View More";
							}
						} else {
							$imclass = "image-popup-01";
							if ( has_post_thumbnail( get_the_ID() ) ) {// using thumb
								$image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
								$imImage     = $image[0];
								$title_image = get_the_title( get_post_thumbnail_id( get_the_ID() ) );
							} else {// no thumb and no overide image
								$imclass  = "";
								$imImage  = get_permalink( get_the_ID() );
								$btn_text = "View More";
							}
						}
						/* end check portfolio type */

						echo '<div class="element-item ' . $item_classes . $class_size . ' ' . $class_column . ' item_portfolio">';

						// Display portfolio
						echo '<div class="portfolio-image">' . $image_url . '
							<div class="portfolio-hover"><div class="thumb-bg"><div class="mask-content">';
						echo '<span class="p_line"></span>';
						echo '<div class="portfolio_zoom"><a href="' . esc_url( $imImage ) . '" title="' . $title_image . '" class="btn_zoom ' . $imclass . '" ' . $data_href . '><i class="fa fa-search"></i></a></div>';
						echo '<div class="portfolio_title"><h3><a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" title="' . esc_attr( get_the_title( get_the_ID() ) ) . '" >' . get_the_title( get_the_ID() ) . '</a></h3></div>';
						echo '</div></div></div></div>';

						echo '</div>';
						?>

					<?php endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
				echo paginate_links( array(
					'base'      => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
					'format'    => '',
					'add_args'  => '',
					'current'   => max( 1, get_query_var( 'paged' ) ),
					'total'     => $gallery->max_num_pages,
					'prev_text' => __( 'Previous', 'charitywp' ),
					'next_text' => __( 'Next', 'charitywp' ),
					'type'      => 'list',
					'end_size'  => 3,
					'mid_size'  => 3
				) ); ?>
			</div>
		</div>
		<!-- .wapper portfolio -->
	</div>
</section>