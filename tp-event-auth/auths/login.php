<?php
/**
 * @Author: ducnvtt
 * @Date:   2016-02-19 09:11:33
 * @Last Modified by:   ducnvtt
 * @Last Modified time: 2016-03-09 08:43:34
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$atts = wp_parse_args( $atts, array() );

do_action( 'event_auth_messages', $atts );

?>
<div class="row thim-loginpage" id="customer_login">

	<div class="col-xs-12 login-area" id="panel-login">


		<div class="thim-heading text-center ">
			<div class="sc-heading article_heading">
				<h3 class="heading__primary wrapper-line-heading">
					<span></span>
					<span><?php esc_html_e( 'Login', 'charitywp' ); ?></span>
					<span></span>
				</h3>
				<span class="line-heading"></span>
			</div>
		</div>

		<?php wp_login_form( $atts ); ?>

		<div class="text-center bottom-link">
			<p><a href="<?php echo esc_attr( event_auth_register_url() ); ?>"><?php esc_html_e( 'Register', 'charitywp' ) ?></a> | <a href="<?php echo esc_attr( event_auth_forgot_password_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'charitywp' ) ?></a></p>
		</div>

	</div>

</div>
