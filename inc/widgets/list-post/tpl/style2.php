<?php

$number = isset( $instance['number_posts'] ) ? $instance['number_posts'] : 3;

$portfolio_args = array(
	'posts_per_page' => $number,
	'order'          => $instance['order']
);


if ( $instance['cat_id'] != 'all' ) {
	$portfolio_args['cat'] = $instance['cat_id'];
}

switch ( $instance['orderby'] ) {
	case 'recent' :
		$portfolio_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$portfolio_args['orderby'] = 'post_title';
		break;
	case 'popular' :
		$portfolio_args['orderby'] = 'comment_count';
		break;
	default :
		$portfolio_args['orderby'] = 'rand';
}

$portfolios = new WP_Query( $portfolio_args );
$show_date  = isset( $instance['date'] ) ? $instance['date'] : 'show';


$columns = isset( $instance['columns'] ) ? $instance['columns'] : 3;
$col     = 12 / $columns;


?>

	<div class="thim-portfolio">
		<div class="row portfolios">
			<?php
			$html = '';
			if ( $portfolios->have_posts() ) {
				while ( $portfolios->have_posts() ) {
					$portfolios->the_post();

					$html .= '<div class="portfolio col-xs-6 col-md-' . $col . '">';
					$html .= '<div class="inner">';

					$html .= '<div class="media">';
					$html .= thim_thumbnail( get_the_ID(), '385x480', 'post', true );
					$html .= '</div>';

					$html .= '<div class="content">';
					$html .= '<div class="content-inner">';
					$html .= '<a href="' . ( get_permalink( get_the_ID() ) ) . '" class="title">' . get_the_title() . '</a>';
					if ( $show_date === 'show' ) {
						$html .= '<div class="date">' . get_the_date() . '</div>';
					}
					$html .= '<a href="' . ( get_permalink( get_the_ID() ) ) . '" class="readmore">' . esc_html( $instance['button_text'] ) . '</a>';
					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';

					$html .= '</div>';

				}
			}
			echo ent2ncr( $html );
			?>
		</div>
	</div>

<?php wp_reset_postdata(); ?>