<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;

?>

<?php if ( has_post_thumbnail() ): ?>
	<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
    <a href="#" class="donate_load_form thim-button style3"
       data-campaign-id="<?php echo esc_attr( get_the_ID() ) ?>"><?php esc_html_e( 'DONATE NOW', 'charitywp' ); ?></a>

<?php endif; ?>