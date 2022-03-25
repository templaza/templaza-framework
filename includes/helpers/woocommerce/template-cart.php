<?php
/**
 * Hooks of cart.
 */
use TemPlazaFramework\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of cart template.
 */
class Templaza_Woo_Cart {
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
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cross_sell      = isset($templaza_options['templaza-shop-cart-cross'])?filter_var($templaza_options['templaza-shop-cart-cross'], FILTER_VALIDATE_BOOLEAN):true;
		add_filter( 'templaza_wp_script_data', array(
			$this,
			'cart_script_data'
		) );

		// Add button continue shopping
		add_action( 'woocommerce_proceed_to_checkout', array( $this, 'button_continue_shop' ), 20 );

		// Change position cross-sells
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
		if ( $cross_sell ) {
			add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
		}

		// Change title cross sells
		add_filter( 'woocommerce_product_cross_sells_products_heading', array( $this, 'get_cross_sells_title' ) );
		// Change total cross sells
		add_filter( 'woocommerce_cross_sells_total', array( $this, 'get_cross_sells_total' ) );
	}

	/**
	 * Add cart script data
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function cart_script_data( $data ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cart_auto      = isset($templaza_options['templaza-shop-cart-auto'])?filter_var($templaza_options['templaza-shop-cart-auto'], FILTER_VALIDATE_BOOLEAN):true;
		if ( $cart_auto ) {
			$data['update_cart_page_auto'] = 1;
		}

		return $data;
	}

	/**
	 * Add button continue shop
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function button_continue_shop() {
		echo sprintf(
			'<a href="%s" class="templaza-button button-light continue-button">%s%s</a>',
			esc_url( get_permalink( get_option( 'woocommerce_shop_page_id' ) ) ),
			'<i class="fas fa-arrow-left"></i>',
			esc_html__( 'Continue Shopping', 'agruco' )
		);
	}

	/**
	 * Change cross sells title
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_cross_sells_title() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cross_title        = isset($templaza_options['templaza-shop-cart-cross-title'])?$templaza_options['templaza-shop-cart-cross-title']:'You may also like';
		if ( ! empty( $cross_title ) ) {
			return $cross_title;
		}
	}

	/**
	 * Change total cross sells
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_cross_sells_total() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cross_number        = isset($templaza_options['templaza-shop-cart-cross-number'])?$templaza_options['templaza-shop-cart-cross-number']:'You may also like';
		return $cross_number;
	}
}
Templaza_Woo_Cart::get_instance();