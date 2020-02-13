<?php
/**
 * @Author: ducnvtt
 * @Date:   2016-02-22 17:03:48
 * @Last Modified by:     ducnvtt
 * @Last Modified time: 2 2016-03-02 14:10:16
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'event_auth_messages', $atts );

?>

<?php if( ! $atts['checkemail'] ) : ?>

<div class="thim-loginpage" id="customer_login">

		<div class="thim-heading text-center ">
			<div class="sc-heading article_heading">
				<h3 class="heading__primary wrapper-line-heading">
					<span></span>
					<span><?php esc_html_e( 'FORGOT PASSWORD', 'charitywp' ); ?></span>
					<span></span>
				</h3>
				<span class="line-heading"></span>
			</div>
		</div>

		<form name="lostpasswordform" class="lostpasswordform" action="<?php echo esc_url( wp_lostpassword_url() ); ?>" method="post">


				<p class="description"><?php echo esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'charitywp' ); ?></p>
	
				<p class="form-row">
					<input class="input-text" type="text" name="user_login" id="user_login" placeholder="<?php esc_html_e( 'Username or email', 'charitywp' ); ?>"/>
					<input name="wp-submit" id="wp-submit" type="submit" class="button" value="<?php esc_attr_e( 'Get New Password', 'charitywp' ) ?>" />
				</p>

				<?php
				/**
				 * Fires inside the lostpassword form tags, before the hidden fields.
				 *
				 * @since 2.1.0
				 */
				do_action( 'event_auth_lostpassword_form', $atts ); ?>
				<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $atts['redirect_to'] ); ?>" />

			</form>

			<div class="text-center bottom-link">
				<p>
					<a href="<?php echo esc_attr( event_auth_login_url() ) ?>"><?php esc_html_e( 'Login', 'charitywp' ); ?></a>
				</p>
			</div>

			<?php do_action( 'event_auth_lostpassword_form_footer', $atts ); ?>
</div>

<?php endif; ?>