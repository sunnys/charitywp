<?php
/* Set Default value when theme option not save at first time setup */
if ( is_page_template( 'page-templates/homepage.php' ) || is_page_template( 'page-templates/homepage2.php' ) || is_page_template( 'page-templates/comingsoon.php' ) ) {
	$file = thim_template_path();
	include $file;

	return;
} else {
	$file = thim_template_path();
	get_header();
	?>
	<section class="content-area">
		<?php
		if ( is_404() ) {
			get_template_part( 'inc/templates/404', 'top' );
		} else {
			get_template_part( 'inc/templates/heading', 'top' );
		}
		//show content
		do_action( 'thim_wrapper_loop_start' );
		include $file;
		do_action( 'thim_wrapper_loop_end' );
		?>
	</section>
	<?php
	get_footer();
}
?>