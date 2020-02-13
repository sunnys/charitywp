<?php

$column = 2;
$column = (int) ( get_theme_mod( 'archive_column' ) );
$col    = 'col-xs-6 col-md-' . ( 12 / $column );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $col ); ?>>
	<div class="content-inner">

		<?php thim_feature_image( 420, 300, 'thumbnail' ); ?>

		<header class="entry-header">
			<?php thim_entry_meta(); ?>
			<?php the_title( sprintf( '<h2 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header>


		<div class="entry-content">
			<?php
			if ( has_post_format( 'link' ) && thim_meta( 'thim_url' ) && thim_meta( 'thim_text' ) ) {
				$url  = thim_meta( 'thim_url' );
				$text = thim_meta( 'thim_text' );
				if ( $url && $text ) { ?>
					<header class="entry-header">
						<h3 class="blog_title">
							<a class="link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>

							<h3>
					</header>

					<?php
				}
				?>
				<div class="entry-summary">
					<?php the_content( 'Read More' ); ?>
				</div><!-- .entry-summary -->
			<?php } elseif ( has_post_format( 'quote' ) && thim_meta( 'thim_quote' ) && thim_meta( 'thim_author_url' ) ) {
				$quote      = thim_meta( 'thim_quote' );
				$author     = thim_meta( 'thim_author' );
				$author_url = thim_meta( 'thim_author_url' );
				if ( $author_url ) {
					$author = ' <a href=' . esc_url( $author_url ) . '>' . $author . '</a>';
				}
				if ( $quote && $author ) {
					?>
					<header class="entry-header">
						<div class="box-header box-quote">
							<blockquote><?php echo esc_html( $quote ); ?><cite><?php echo esc_html( $author ); ?></cite>
							</blockquote>
						</div>
					</header>
					<?php
				}
			} elseif ( has_post_format( 'audio' ) ) {
				?>

				<?php the_title( sprintf( '<header class="entry-header"><h2 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2></header>' ); ?>
				<div class="entry-summary">
					<?php the_content( 'Read More' ); ?>
				</div><!-- .entry-summary -->
				<?php
			} else {
				?>
				<!-- .entry-header -->
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				<a class="readmore" href="<?php echo esc_url( get_permalink() ) ?>" target="_self"><?php esc_html_e( 'Read More', 'charitywp' ); ?></a>
			<?php }; ?>
		</div>
	</div>
</article><!-- #post-## -->