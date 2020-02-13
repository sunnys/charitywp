<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' ); ?>

<div class="reset_password">
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
	<form method="post" class="lost_reset_password">

		<?php if ( 'lost_password' == $args['form'] ) : ?>

			<p class="description"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'charitywp' ) ); ?></p>

			<p class="form-row">
				<input class="input-text" type="text" name="user_login" id="user_login" placeholder="<?php esc_html_e( 'Username or email', 'charitywp' ); ?>" />
				<input type="hidden" name="wc_reset_password" value="true" />
				<input type="submit" class="button" value="<?php echo 'lost_password' == $args['form'] ? esc_html__( 'Reset Password', 'charitywp' ) : esc_html__( 'Save', 'charitywp' ); ?>" />
			</p>

		<?php else : ?>

			<p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'charitywp' ) ); ?></p>

			<p class="form-row">
				<input type="password" class="input-text" name="password_1" id="password_1" placeholder="<?php esc_html_e( 'New password', 'charitywp' ); ?>" />
				<input type="password" class="input-text" name="password_2" id="password_2" placeholder="<?php esc_html_e( 'Re-enter new password', 'charitywp' ); ?>" />
				<input type="hidden" name="wc_reset_password" value="true" />
				<input type="submit" class="button" value="<?php echo 'lost_password' == $args['form'] ? esc_html__( 'Reset Password', 'charitywp' ) : esc_html__( 'Save', 'charitywp' ); ?>" />
			</p>

			<input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
			<input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />

		<?php endif; ?>


		<div class="clear"></div>

		<?php do_action( 'woocommerce_lostpassword_form' ); ?>

		<?php wp_nonce_field( $args['form'] ); ?>

	</form>
</div>