<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="campaign_countdown">

	<div class="donate_counter">
		<div class="donate_counter_percent" data-percent="<?php echo esc_attr( donate_get_campaign_percent() ) ?>" data-tootip="<?php echo esc_attr( donate_get_campaign_percent() . '%' ) ?>">
			<span class="donate_percent_tooltip"><?php printf( '%s%s', donate_get_campaign_percent(), '%' ) ?></span>
		</div>
	</div>
	<?php if ( donate_get_campaign_days_to_go() == 0 ) { ?>
		<span class="donate_days_to_go no_date"><?php printf( __( '%s days to go', 'charitywp' ), donate_get_campaign_days_to_go() ) ?></span>
	<?php } else { ?>
		<span class="donate_days_to_go"><?php printf( __( '%s days to go', 'charitywp' ), donate_get_campaign_days_to_go() ) ?></span>
	<?php } ?>
</div>