<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="campaign_countdown">
	
	<div class="inner-wrapper">
		<div class="donate_counter">
			<div class="donate_counter_percent" data-percent="<?php echo esc_attr( donate_get_campaign_percent() ) ?>" data-tootip="<?php echo esc_attr( donate_get_campaign_percent() . '%' ) ?>">
				<span class="donate_percent_tooltip"><?php printf( '%s%s', donate_get_campaign_percent(), '%' ) ?></span>
			</div>
		</div>
	</div>

</div>