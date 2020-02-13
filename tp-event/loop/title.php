<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="entry-header">
	<?php if( ! is_singular( 'tp_event' ) || ! in_the_loop() ): ?>
		<h2 class="blog_title"><a href="<?php the_permalink() ?>">
	<?php else: ?>
		<h1 class="blog_title">
	<?php endif; ?>
			<?php the_title(); ?>
	<?php if( ! is_singular( 'tp_event' ) || ! in_the_loop() ): ?>
		</a></h2>
	<?php else: ?>
		</h1>
	<?php endif; ?>
</div>