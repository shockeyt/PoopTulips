<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php esc_html_e( 'Billing &amp; Shipping', 'gecko' ); ?></h3>

	<?php else : ?>

		<h3><?php esc_html_e( 'Billing Details', 'gecko' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
	
	<div class="woocommerce-billing-fields__field-wrapper">
		<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>
			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
		<?php endforeach; ?>
	</div>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) { ?>
	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>
		<div class="woocommerce-account-fields">
			<?php if ( $checkout->enable_guest_checkout ) : ?>

				<p class="form-row form-row-wide create-account pr style-checkbox">
					<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"></label><span><?php esc_html_e( 'Create an account?', 'gecko' ); ?></span>
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

			<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

				<div class="create-account">
					<p><?php esc_html_e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'gecko' ); ?></p>

					<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

						<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

					<?php endforeach; ?>

					<div class="clear"></div>

				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
		</div>
	<?php endif; ?>
<?php } else { ?>
	<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
		<div class="woocommerce-account-fields">
			<?php if ( ! $checkout->is_registration_required() ) : ?>

				<p class="form-row form-row-wide create-account pr style-checkbox">
					
						<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> 
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox" for="createaccount"></label><span><?php esc_html_e( 'Create an account?', 'gecko' ); ?></span>
					
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

			<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

				<div class="create-account">
					<?php foreach ( $checkout->get_checkout_fields( 'account' )  as $key => $field ) : ?>
						<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
					<?php endforeach; ?>
					<div class="clear"></div>
				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
		</div>
	<?php endif; ?>
<?php } ?>