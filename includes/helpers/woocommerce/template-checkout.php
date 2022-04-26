<?php
/**
 * Hooks of checkout.
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of checkout template.
 */
class Templaza_Woo_Checkout {
	/**
	 * Instance
	 *
	 * @var $instance
	 */
	protected static $instance = null;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		// Wrap checkout login and coupon notices.
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
		add_action( 'woocommerce_before_checkout_form', array( __CLASS__, 'before_login_form' ), 10 );
		add_action( 'woocommerce_before_checkout_form', array( __CLASS__, 'checkout_login_form' ), 10 );
		add_action( 'woocommerce_before_checkout_form', array( __CLASS__, 'checkout_coupon_form' ), 10 );
		add_action( 'woocommerce_before_checkout_form', array( __CLASS__, 'after_login_form' ), 10 );

	}

	/**
	 * Checkout Before login form.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function before_login_form() {
		echo '<div class="row-flex checkout-form-cols">';
	}

	/**
	 * Checkout After login form.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function after_login_form() {
		echo '</div>';
	}

	/**
	 * Checkout login form.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function checkout_login_form() {
		if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
			return;
		}

		echo '<div class="checkout-login checkout-form-col col-flex col-flex-md-6 col-flex-xs-12">';
		woocommerce_checkout_login_form();
		echo '</div>';
	}

	/**
	 * Checkout coupon form.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function checkout_coupon_form() {
		if ( ! wc_coupons_enabled() ) {
			return;
		}

		echo '<div class="checkout-coupon checkout-form-col col-flex col-flex-md-6 col-flex-xs-12">';
		woocommerce_checkout_coupon_form();
		echo '</div>';
	}
}
Templaza_Woo_Checkout::get_instance();