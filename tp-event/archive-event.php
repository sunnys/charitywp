<?php
/**
 * The Template for displaying all archive products.
 *
 * Override this template by copying it to yourtheme/tp-event/templates/archive-event.php
 *
 * @author        ThimPress
 * @package       tp-event/template
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $query_string;
$tab_active = get_theme_mod( 'event_tab_active' );
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
$per_page = get_theme_mod( 'event_per_page' );
?>

<?php
/**
 * tp_event_before_main_content hook
 *
 * @hooked tp_event_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked tp_event_breadcrumb - 20
 */
do_action( 'tp_event_before_main_content' );
?>

<?php
/**
 * tp_event_archive_description hook
 *
 * @hooked tp_event_taxonomy_archive_description - 10
 * @hooked tp_event_room_archive_description - 10
 */
do_action( 'tp_event_archive_description' );
?>

<?php
/**
 * tp_event_before_event_loop hook
 *
 * @hooked tp_event_result_count - 20
 * @hooked tp_event_catalog_ordering - 30
 */
do_action( 'tp_event_before_event_loop' );
?>

<div class="archive-content tab-content" data-tab="<?php echo esc_attr( $tab_active ); ?>">

	<div class="tab-pane row <?php echo esc_attr( $happening_active ); ?>" id="happening">
		<?php
		$paged          = ( get_query_var( 'paged' ) && $happening_active === 'active' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$offset         = ( $paged == 1 && $happening_active != 'active' ) ? 0 : ( ( $paged - 1 ) * $per_page );
		$happening_args = array(
			'post_type'      => array( 'tp_event' ),
			'post_status'    => 'tp-event-happenning',
			'posts_per_page' => $per_page,
			'page'           => $paged,
			'offset'         => $offset,
			'orderby'        => 'tp_event_date_start',
			'order'          => 'ASC',
			'meta_key'       => 'tp_event_date_start'
		);

		$events_happening = new WP_Query( $happening_args );

		if ( $events_happening->have_posts() ) {
			while ( $events_happening->have_posts() ) {
				$events_happening->the_post();
				tp_event_get_template_part( 'content', 'event' );
			}
		}

		thim_event_paging_nav( $events_happening, 'happening' );

		wp_reset_postdata();
		?>
	</div>
	<div class="tab-pane row <?php echo esc_attr( $upcoming_active ); ?>" id="upcoming">
		<?php
		$paged         = ( get_query_var( 'paged' ) && $upcoming_active === 'active' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$offset        = ( $paged == 1 && $upcoming_active != 'active' ) ? 0 : ( ( $paged - 1 ) * $per_page );
		$upcoming_args = array(
			'post_type'      => array( 'tp_event' ),
			'post_status'    => 'tp-event-upcoming',
			'posts_per_page' => $per_page,
			'page'           => $paged,
			'offset'         => $offset,
			'orderby'        => 'tp_event_date_start',
			'order'          => 'ASC',
			'meta_key'       => 'tp_event_date_start'
		);

		$events_upcoming = new WP_Query( $upcoming_args );

		if ( $events_upcoming->have_posts() ) {
			while ( $events_upcoming->have_posts() ) {
				$events_upcoming->the_post();
				tp_event_get_template_part( 'content', 'event' );
			}
		}

		thim_event_paging_nav( $events_upcoming, 'upcoming' );

		wp_reset_postdata();
		?>
	</div>
	<div class="tab-pane row <?php echo esc_attr( $expired_active ); ?>" id="expired">
		<?php
		$paged        = ( get_query_var( 'paged' ) && $expired_active === 'active' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$offset       = ( $paged == 1 && $expired_active != 'active' ) ? 0 : ( ( $paged - 1 ) * $per_page );
		$expired_args = array(
			'post_type'      => array( 'tp_event' ),
			'post_status'    => 'tp-event-expired',
			'posts_per_page' => $per_page,
			'page'           => $paged,
			'offset'         => $offset,
			'orderby'        => 'tp_event_date_start',
			'order'          => 'ASC',
			'meta_key'       => 'tp_event_date_start'
		);

		$events_expired = new WP_Query( $expired_args );

		if ( $events_expired->have_posts() ) {
			while ( $events_expired->have_posts() ) {
				$events_expired->the_post();
				tp_event_get_template_part( 'content', 'event' );
			}
		}

		thim_event_paging_nav( $events_expired, 'expired' );

		wp_reset_postdata();
		?>
	</div>

</div>

<?php
/**
 * tp_event_after_event_loop hook
 *
 * @hooked tp_event_pagination - 10
 */
do_action( 'tp_event_after_event_loop' );
?>

<?php
/**
 * tp_event_after_main_content hook
 *
 * @hooked tp_event_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'tp_event_after_main_content' );
?>

<?php
/**
 * tp_event_sidebar hook
 *
 * @hooked tp_event_get_sidebar - 10
 */
do_action( 'tp_event_sidebar' );
?>

