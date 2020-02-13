<?php
/**
 * @Author: ducnvtt
 * @Date  :   2016-03-02 14:46:31
 * @Last  Modified by:     leehld
 * @Last  Modified time:   2017-01-19 10:49:30
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php tp_event_print_notices(); ?>

?>
<div class="woocommerce">
    <div class="reset_password" id="customer_login">
        <div class="thim-heading text-center">
            <div class="sc-heading article_heading">
                <h3 class="heading__primary wrapper-line-heading">
                    <span></span>
                    <span><?php esc_html_e( 'Get Your Password', 'charitywp' ); ?></span>
                    <span></span>
                </h3>
                <span class="line-heading"></span>
            </div>
        </div>

        <form name="resetpassform" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=resetpass', 'login_post' ) ); ?>" method="POST" class="login lost_reset_password">
            <input type="hidden" name="user_login" value="<?php echo esc_attr( $atts['login'] ); ?>" />

            <p class="form-row">
                <input type="password" class="input-text" name="pass1" placeholder="<?php esc_html_e( 'New password *', 'charitywp' ); ?>" />
            </p>

            <p class="form-row">
                <input type="password" name="pass2" class="input-text" placeholder="<?php esc_html_e( 'Re-enter new password *', 'charitywp' ); ?>" />
            </p>

            <p class="pw-hint"><?php echo wp_get_password_hint(); ?></p>

            <div class="clear"></div>
			<?php
			/**
			 * Fires following the 'Strength indicator' meter in the user password reset form.
			 *
			 * @since 3.9.0
			 *
			 * @param WP_User $user User object of the user whose password is being reset.
			 */
			do_action( 'event_auth_resetpass_form', $atts['login'] );
			?>
            <input type="hidden" name="key" value="<?php echo esc_attr( $atts['key'] ); ?>" />
            <p class="submit">
                <input type="submit" name="submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Reset Password', 'charitywp' ); ?>" />
            </p>
        </form>

        <p id="nav">
            <a href="<?php echo esc_url( wp_login_url() ); ?>"><?php esc_html_e( 'Log in', 'charitywp' ); ?></a>
			<?php
			if ( get_option( 'users_can_register' ) ) :
				$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), esc_html__( 'Register', 'charitywp' ) );

				/** This filter is documented in wp-includes/general-template.php */
				echo ' | ' . $registration_url;
			endif;
			?>
        </p>

    </div>
</div>