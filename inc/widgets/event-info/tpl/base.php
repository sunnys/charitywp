<?php if ( is_singular( 'tp_event' ) ): ?>

	<div class="thim-event-info">
		<div class="inner-box">

			<div class="box start">
				<div class="icon"><i class="fa fa-clock-o"></i></div>
				<div class="info-detail">
					<div class="title"><strong><?php esc_html_e( 'Start Time', 'charitywp' ); ?></strong></div>
					<div class="info-content">
						<div class="time">
							<?php
							if ( class_exists( 'WPEMS' ) ) {
								echo wpems_event_start( 'h:i A' );
							} elseif ( class_exists( 'TP_Event' ) ) {
								echo tp_event_start( 'h:i A' );
							} ?>
						</div>
						<div class="date">
							<?php
							if ( class_exists( 'WPEMS' ) ) {
								echo wpems_event_start( 'l, F d, Y' );
							} elseif ( class_exists( 'TP_Event' ) ) {
								echo tp_event_start( 'l, F d, Y' );
							} ?>
						</div>
					</div>
				</div>
			</div>

			<div class="box finish">
				<div class="icon"><i class="fa fa-flag"></i></div>
				<div class="info-detail">
					<div class="title"><strong><?php esc_html_e( 'Finish Time', 'charitywp' ); ?></strong></div>
					<div class="info-content">
						<div class="time">
							<?php
							if ( class_exists( 'WPEMS' ) ) {
								echo wpems_event_end( 'h:i A' );
							} elseif ( class_exists( 'TP_Event' ) ) {
								echo tp_event_end( 'h:i A' );
							} ?>
						</div>
						<div class="date">
							<?php
							if ( class_exists( 'WPEMS' ) ) {
								echo wpems_event_end( 'l, F d, Y' );
							} elseif ( class_exists( 'TP_Event' ) ) {
								echo tp_event_end( 'l, F d, Y' );
							} ?>
						</div>
					</div>
				</div>
			</div>

			<div class="box address">
				<div class="icon"><i class="fa fa-map-marker"></i></div>
				<div class="info-detail">
					<div class="title"><strong><?php esc_html_e( 'Address', 'charitywp' ); ?></strong></div>
					<div class="info-content">
						<?php
						if ( class_exists( 'WPEMS' ) ) {
							echo wpems_event_location();
						} elseif ( class_exists( 'TP_Event' ) ) {
							echo tp_event_location();
						}
						?>
					</div>
				</div>
			</div>

		</div>
	</div>

<?php endif; ?>