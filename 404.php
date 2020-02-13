<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package thim
 */

$image = '';
if ( get_theme_mod( '404_image', true ) ) {
	if ( is_numeric( get_theme_mod( '404_image' ) ) ) {
		$cate_top_attachment = wp_get_attachment_image_src( get_theme_mod( '404_image' ), 'full' );
		$image               .= '<img src="' . $cate_top_attachment[0] . '">';
	} else {
		$image .= '<img src="' . get_theme_mod( '404_image' ) . '">';
	}
}

?>

<div class="row">
    <div class="col-xs-5 media">
		<?php echo ent2ncr( $image ); ?>
    </div>
    <div class="col-xs-7 content">
		<?php
		echo ent2ncr( get_theme_mod( '404_content' ) );
		?>
    </div>
</div>