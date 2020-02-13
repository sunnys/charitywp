<?php
/**
 * @Author: ducnvtt
 * @Date:   2016-02-19 09:11:33
 * @Last Modified by:   leehld
 * @Last Modified time: 2017-01-19 10:47:34
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php tp_event_print_notices(); ?>

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

        <form name="event_auth_login_form" action="" method="post" class="event-auth-form">

            <p class="form-row form-required">
                <label for="user_login"><?php _e( 'Username', 'charitywp' ) ?><span class="required">*</span></label>
                <input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr( ! empty( $_POST['user_login'] ) ? sanitize_text_field( $_POST['user_login'] ) : '' ) ?>" size="20" /></label>
            </p>

            <p class="form-row form-required">
                <label for="user_pass"><?php _e( 'Password', 'charitywp' ) ?><span class="required">*</span></label>
                <input type="password" name="user_pass" id="user_pass" class="input" value="" size="25" />
            </p>

			<?php do_action( 'event_auth_register_form' ); ?>

            <p class="form-row form-required">
                <label for="rememberme" class="inline">
                    <input class="input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'charitywp' ); ?>
                </label>
            </p>

            <p class="submit form-row">
				<?php wp_nonce_field( 'auth-login-nonce', 'auth-nonce' ); ?>
                <input type="hidden" name="action" value="event_login_action" />
                <input type="hidden" name="redirect_to" value="<?php echo esc_attr( ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ); ?>" />
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Login', 'charitywp' ); ?>" />
            </p>

        </form>

		<div class="text-center bottom-link">
			<p><a href="<?php echo esc_attr( tp_event_register_url() ); ?>"><?php esc_html_e( 'Register', 'charitywp' ) ?></a> | <a href="<?php echo esc_attr( tp_event_forgot_password_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'charitywp' ) ?></a></p>
		</div>

	</div>

</div>
