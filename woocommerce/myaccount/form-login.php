<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="row thim-login" id="customer_login">

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

		<form method="post" class="login">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="form-row form-row-wide">
				<input type="text" class="input-text" name="username" id="username" placeholder="<?php esc_html_e( 'Username or email address *', 'charitywp' ); ?>" value="<?php if ( ! empty( $_POST['username'] ) ) {
					echo esc_attr( $_POST['username'] );
				} ?>" />
			</p>
			<p class="form-row form-row-wide">
				<input class="input-text" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Password *', 'charitywp' ); ?>" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="row">
				<div class="col-xs-6 remember">
					<label for="rememberme" class="inline">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'charitywp' ); ?>
					</label>
				</div>

				<div class="col-xs-6 lost-password">
					<p class="lost_password">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'charitywp' ); ?></a>
					</p>
				</div>
			</div>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'charitywp' ); ?>" />
			</p>

			<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
				<p class="thim-link-panel">
					<?php echo esc_attr__( 'Not a member yet?', 'charitywp' ); ?>
					<a href="#" class="toggle" data-close="panel-login" data-open="panel-register"><?php echo esc_attr__( 'Register now', 'charitywp' ); ?></a>
				</p>
			<?php endif; ?>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

	</div>

	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

		<div class="col-xs-12 register-area" id="panel-register">

			<div class="thim-heading text-center ">
				<div class="sc-heading article_heading">
					<h3 class="heading__primary wrapper-line-heading">
						<span></span>
						<span><?php esc_html_e( 'Register', 'charitywp' ); ?></span>
						<span></span>
					</h3>
					<span class="line-heading"></span>
				</div>
			</div>

			<form method="post" class="register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="form-row form-row-wide">
						<input type="text" class="input-text" name="username" id="reg_username" placeholder="<?php esc_html_e( 'Username *', 'charitywp' ); ?>" value="<?php if ( ! empty( $_POST['username'] ) ) {
							echo esc_attr( $_POST['username'] );
						} ?>" />
					</p>

				<?php endif; ?>

				<p class="form-row form-row-wide">
					<input type="email" class="input-text" name="email" id="reg_email" placeholder="<?php esc_html_e( 'Email address *', 'charitywp' ); ?>" value="<?php if ( ! empty( $_POST['email'] ) ) {
						echo esc_attr( $_POST['email'] );
					} ?>" />
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="form-row form-row-wide">
						<input type="password" class="input-text" name="password" id="reg_password" placeholder="<?php esc_html_e( 'Password *', 'charitywp' ); ?>" />
					</p>

				<?php endif; ?>

				<!-- Spam Trap -->
				<div style="<?php echo( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;">
					<label for="trap"><?php esc_html_e( 'Anti-spam', 'charitywp' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" />
				</div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-register' ); ?>
					<input type="submit" class="button" name="register" value="<?php esc_attr_e( 'Register', 'charitywp' ); ?>" />
				</p>

				<p class="thim-link-panel">
					<?php echo esc_attr__( 'Are you a member?', 'charitywp' ); ?>
					<a href="#" class="toggle" data-close="panel-register" data-open="panel-login"><?php echo esc_attr__( 'Login', 'charitywp' ); ?></a>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

		</div>

	<?php endif; ?>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
