<?php

// Set posts_per_page for Donate archive
function thim_set_donate_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'dn_campaign' ) || is_tax( 'dn_campaign_cat' ) ) {
		$posts_per_page = get_theme_mod( 'donate_per_page' );
		$query->set( 'posts_per_page', $posts_per_page );

		return;
	}
}

add_action( 'pre_get_posts', 'thim_set_donate_per_page', 1 );


// Add filter & Search box in before loop
function thim_donate_filter_search() {
	$count  = $GLOBALS['wp_query'];
	$layout = get_theme_mod('donate_layout_filter');
	$grid   = $list = '';
	if ( $layout == 'grid' ) {
		$grid = 'active';
	} else {
		$list = 'active';
	}
	$post_from = 1;
	$post_to   = $post_from + ( $count->post_count - 1 );
	if ( $count->get( 'paged' ) > 0 ) {
		$post_from = ( $count->get( 'paged' ) - 1 ) * $count->get( 'posts_per_page' );
		$post_to   = $post_from + $count->post_count;
	}

	$post_all = $count->found_posts;
	?>
	<div class="thim-layout-search">
		<div class="row">
			<div class="col-xs-6 layout-box">
				<span class="layouts">
					<i class="fa fa-th-large <?php echo esc_attr( $grid ); ?>" data-layout="grid"></i>
					<i class="fa fa-th-list <?php echo esc_attr( $list ); ?>" data-layout="list"></i>
				</span>
				<span class="results">
					<?php
					echo esc_html__( 'Showing ', 'charitywp' ) . $post_from . ' - ' . $post_to . esc_html__( ' of ', 'charitywp' ) . $post_all . esc_html__( ' results', 'charitywp' );
					?>
				</span>
			</div>
			<div class="col-xs-6 search-box">
				<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" name="s" id="s" value="" placeHolder="<?php esc_attr_e( 'SEARCH FOCUS AREAS', 'charitywp' ) ?>" />
					<input type="hidden" name="post_type" id="post_type" value="dn_campaign" />
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
	</div>
	<?php
}

add_action( 'campaign_before_archive_loop', 'thim_donate_filter_search', 10 );


/**
 * Change layout donate
 */
add_action( 'wp_ajax_thim_session_donate_layout', 'thim_session_donate_layout' );
add_action( 'wp_ajax_nopriv_thim_session_donate_layout', 'thim_session_donate_layout' );
function thim_session_donate_layout() {
	$layout                                = $_POST['layout'];
	$_SESSION['thim_donate_layout_filter'] = $layout;
	$output['layout']                      = $_SESSION['thim_donate_layout_filter'];
	die( json_encode( $output ) );
}