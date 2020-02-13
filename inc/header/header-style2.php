<div class="top-header">
    <div class="container">
        <div class="thim-toggle-mobile-menu">
            <span class="inner">toggle menu</span>
        </div>

        <div class="thim-logo">
			<?php do_action( 'thim_logo' ); ?>
        </div>

		<!--	 Show on Mobile and Ipad -->
	    <div class="top-sidebar show_hidden">
		    <?php
		    if ( is_active_sidebar( 'top_sidebar' ) ) {
			    dynamic_sidebar( 'top_sidebar' );
		    }
		    ?>
	    </div>

        <div class="thim-menu">
            <div class="main-menu">
                <ul class="nav navbar-nav">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container'      => false,
							'items_wrap'     => '%3$s',
							'link_before'    => '<span>',
							'link_after'     => '</span>'
						) );
					} else {
						wp_nav_menu( array(
							'theme_location' => '',
							'container'      => false,
							'items_wrap'     => '%3$s',
							'link_before'    => '<span>',
							'link_after'     => '</span>'
						) );
					}
					?>
                </ul>
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
        </div>
    </div>
</div>