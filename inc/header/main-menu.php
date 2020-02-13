<?php
$menu_line   = get_theme_mod( 'header_menu_line' );
$mobile_line = get_theme_mod( 'header_mobile_menu_line' );
?>
<div class="thim-menu <?php echo esc_attr( $menu_line ) ?> <?php echo esc_attr( $mobile_line ) ?>">
	<span class="close-menu"><i class="fa fa-times"></i></span>
	<div class="main-menu">
		<ul class="nav navbar-nav">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '%3$s'
				) );
			} else {
				wp_nav_menu( array(
					'theme_location' => '',
					'container'      => false,
					'items_wrap'     => '%3$s'
				) );
			}
			?>
		</ul>
	</div>
	<div class="menu-sidebar thim-hidden-768px">
		<?php
		if ( is_active_sidebar( 'menu_sidebar' ) ) {
			dynamic_sidebar( 'menu_sidebar' );
		}
		?>
	</div>
</div>