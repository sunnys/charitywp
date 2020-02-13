<?php

$category     = $instance['category'];
$filter       = $instance['filter'];
$style        = $instance['portfolio_style'];
$gutter       = $instance['gutter'];
$columns      = $instance['columns'];
$number_posts = $instance['number_posts'];

$portfolio_args = array();
if ( $category == 'all' ) {
	$portfolio_args = array(
		'post_type'      => 'portfolio',
		'posts_per_page' => $number_posts
	);
} else {
	$portfolio_args = array(
		'post_type'      => 'portfolio',
		'posts_per_page' => $number_posts,
		'tax_query'      => array(
			array(
				'taxonomy' => 'portfolio_category',
				'field'    => 'slug',
				'terms'    => $category,
			),
		),
	);
}


$posts         = get_posts( $portfolio_args );
$category_args = array(
	'taxonomy' => 'portfolio_category',
);
$categories    = get_categories( $category_args );

$filter_class = '';
if ( $filter ) {
	$filter_class = 'portfolio_filter';
}

$class_column = "";
if ( $columns == 2 ) {
	$class_column = "two-col";
} elseif ( $columns == 3 ) {
	$class_column = "three-col";
} elseif ( $columns == 4 ) {
	$class_column = "four-col";
} elseif ( $columns == 5 ) {
	$class_column = "five-col";
} else {
	$class_column = "one-col";
}

$class_gutter = "";
if ( $gutter > 0 ) {
	$class_gutter = "has_gutter";
}

?>
<div class="thim_portfolio_wrapper">
	<div class="wrapper_portfolio <?php echo $filter_class; ?> <?php echo $style; ?> <?php echo $class_gutter; ?>">
		<?php if ( $filter ) { ?>
			<div class="portfolio-tabs-wrapper filters">
				<div class="portfolio-tabs">
					<button class="filter active"
							data-filter="*"><?php echo esc_html__( 'All', 'charitywp' ); ?></button>
					<?php foreach ( $categories as $category ): ?>
						<button class="filter"
								data-filter=".<?php echo preg_replace( '/[^a-z A-Z0-9]/', '', esc_attr( $category->slug ) ); ?>"><?php echo ent2ncr( $category->name ); ?></button>
					<?php endforeach; ?>
				</div>
			</div>
		<?php } ?>
		<div class="portfolio_column">
			<div class="content_portfolio" data-style="<?php echo $style; ?>"
				 data-columns="<?php echo $columns; ?>"
				 data-gutter="<?php echo $gutter; ?>">
				<?php
				foreach ( $posts as $post ) :
					$feature_images = get_post_meta( $post->ID, 'feature_images', true );
					$images_size    = 'portfolio_size11';
					$style_layout   = '';
					$imgurl         = '';
					$image_url      = '';

					$class_size = "";
					if ( $style == "multi_grid" ) {
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
							} else {
								if ( $images_size == 'portfolio_size12' ) {
									$class_size = " height_large";
								} else {
									if ( $images_size == 'portfolio_size21' ) {
										$class_size = " item_large";
									} else {
										$class_size = " height_large item_large";
									}
								}
							}
						}
					} else {
						if ( $style == "masonry" ) {
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
					}

					$item_classes = '';
					$terms_id     = array();
					$item_cats    = get_the_terms( $post->ID, 'portfolio_category' );
					if ( $item_cats ):
						foreach ( $item_cats as $item_cat ) {
							$item_classes  .= $item_cat->slug . ' ';
							$terms_id[]    = $item_cat->term_id;
							$item_classess = preg_replace( '/[^a-z A-Z0-9]/', '', $item_classes );
						}
					endif;

					$image_id = get_post_thumbnail_id( $post->ID );

					$w = $h = '';
					if ( $style == "masonry" ) {
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
						} else {
							if ( $images_size == 'portfolio_size12' ) {
								$w = isset( $dimensions['width'] ) ? $dimensions['width'] : '480';
								$h = isset( $dimensions['height'] ) ? ( intval( $dimensions['height'] ) * 2 ) : '640';
							} else {
								if ( $images_size == 'portfolio_size21' ) {
									$w = isset( $dimensions['width'] ) ? ( intval( $dimensions['width'] ) * 2 ) : '960';
									$h = isset( $dimensions['height'] ) ? $dimensions['height'] : '320';
								} else {
									$w = isset( $dimensions['width'] ) ? ( intval( $dimensions['width'] ) * 2 ) : '960';
									$h = isset( $dimensions['height'] ) ? ( intval( $dimensions['height'] ) * 2 ) : '640';
								}
							}
						}

						$imgurl     = wp_get_attachment_image_src( $image_id, 'full' );
						$image_crop = $imgurl[0];
						if ( $imgurl[1] >= $w && $imgurl[2] >= $h ) {
							$image_crop = aq_resize( $imgurl[0], $w, $h, $crop );
						}

						if ( $style == "multi_grid" ) {
							$image_url = '<div class="thumb-img" style="background: url(' . $image_crop . ');background-size: cover;background-repeat: no-repeat;background-position: center center;height: inherit;"><img style="visibility: hidden;" src="' . $image_crop . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" /></div>';
						} else {
							$image_url = '<img src="' . $image_crop . '" alt="' . get_the_title() . '" title="' . get_the_title() . '"/>';
						}
					}

					// check postfolio type
					$data_href   = "";
					$imclass     = "";
					$title_image = "";

					if ( get_post_meta( $post->ID, 'selectPortfolio', true ) == "portfolio_type_video" ) {
						$imclass = "video-popup";
						if ( get_post_meta( $post->ID, 'project_video_embed', true ) != "" ) {
							$imImage = get_post_meta( $post->ID, 'project_video_embed', true );
						} else {
							if ( has_post_thumbnail( $post->ID ) ) {
								$image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
								$imImage     = $image[0];
								$title_image = get_the_title( get_post_thumbnail_id( get_the_ID() ) );
							} else {
								$imclass  = "";
								$imImage  = get_permalink( $post->ID );
								$btn_text = "View More";
							}
						}
					} else {
						$imclass = "image-popup-01";
						if ( has_post_thumbnail( $post->ID ) ) {// using thumb
							$image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							$imImage     = $image[0];
							$title_image = get_the_title( get_post_thumbnail_id( $post->ID ) );
						} else {// no thumb and no overide image
							$imclass  = "";
							$imImage  = get_permalink( $post->ID );
							$btn_text = "View More";
						}
					}
					/* end check portfolio type */

					echo '<div class="element-item ' . $item_classess . $class_size . ' ' . $class_column . ' item_portfolio">';

					// Display portfolio
					echo '<div class="portfolio-image">' . $image_url . '
							<div class="portfolio-hover"><div class="thumb-bg"><div class="mask-content">';
					echo '<span class="p_line"></span>';
					echo '<div class="portfolio_zoom"><a href="' . esc_url( $imImage ) . '" title="' . $title_image . '" class="btn_zoom ' . $imclass . '" ' . $data_href . '><i class="fa fa-search"></i></a></div>';
					echo '<div class="portfolio_title"><h3><a href="' . esc_url( get_permalink( $post->ID ) ) . '" title="' . esc_attr( get_the_title( $post->ID ) ) . '" >' . get_the_title( $post->ID ) . '</a></h3></div>';
					echo '</div></div></div></div>';

					echo '</div>';
					?>

				<?php endforeach;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
	<!-- .wapper portfolio -->
</div>