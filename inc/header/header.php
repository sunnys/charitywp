<div class="top-header">
    <div class="container">

        <div class="thim-toggle-mobile-menu">
            <span class="inner">toggle menu</span>
        </div>

        <div class="thim-logo">
			<?php do_action( 'thim_logo' ); ?>
        </div>
        <!-- top-sidebar/start -->
        <div class="top-sidebar">
			<?php
			if ( is_active_sidebar( 'top_sidebar' ) ) {
				dynamic_sidebar( 'top_sidebar' );
			}
			?>
        </div>
        <!-- top-sidebar/end -->
        <div class="menu-toggle">
            <div class="inner">
                <span><?php esc_html_e( 'Menu', 'charitywp' ); ?></span>
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </div>
</div>
