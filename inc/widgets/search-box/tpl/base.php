<div class="thim-search-box">
	<div class="toggle-form"><i class="ion ion-ios-search"></i></div>
	<div class="form-search-wrapper">
		<div class="background-toggle"></div>
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		    <input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search...', 'charitywp' ) ?>" value="<?php echo get_search_query() ?>" name="s" autofocus />
		    <button type="submit"><i class="ion ion-ios-search"></i></button>
		</form>
	</div>
</div>