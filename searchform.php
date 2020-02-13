<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search...', 'charitywp' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
    <span class="toggle-search"><i class="fa fa-search"></i></span>
</form>