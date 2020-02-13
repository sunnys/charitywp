<?php 
if ( have_posts() ) :?>
	<div class="archive-content">
		<div class="row">
		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();
			get_template_part( 'content' );
		endwhile;
		?>
		</div>
	</div>
	<?php
	thim_paging_nav();
else :
	get_template_part( 'content', 'none' );
endif;