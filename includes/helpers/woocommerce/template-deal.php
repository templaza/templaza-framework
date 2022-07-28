<?php

use TemPlaza_Woo\Templaza_Woo_Helper;
use TemPlazaFramework\Functions;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Templaza_Product_Deal_frontend {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
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
		add_filter( 'woocommerce_quantity_input_args', array( $this, 'quantity_input_args' ), 10, 2 );

		add_action( 'woocommerce_single_product_summary', array( $this, 'single_product_template' ), 25 );
		add_action( 'templaza_woocommerce_product_quickview_summary', array( $this, 'single_product_template' ), 75 );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'countdown', Functions::get_my_url() . '/assets/js/woo/jquery.countdown.js', array(), '1.0', true );
	}

	/**
	 * Change the "max" attribute of quantity input
	 *
	 * @since 1.0.0
	 *
	 * @param array $args
	 * @param object $product
	 *
	 * @return array
	 */
	public function quantity_input_args( $args, $product ) {
		if ( ! TemPlaza_Woo\Templaza_Woo_Helper::is_product_deal( $product ) ) {
			return $args;
		}

		$args['max_value'] = $this->get_max_purchase_quantity( $product );

		return $args;
	}

	/**
	 * Get max value of quantity input for a deal product
	 *
	 * @since 1.0.0
	 *
	 * @param object $product
	 *
	 * @return int
	 */
	public function get_max_purchase_quantity( $product ) {
		$limit = get_post_meta( $product->get_id(), '_deal_quantity', true );
		$sold  = intval( get_post_meta( $product->get_id(), '_deal_sales_counts', true ) );

		$max          = $limit - $sold;
		$original_max = $product->is_sold_individually() ? 1 : ( $product->backorders_allowed() || ! $product->managing_stock() ? - 1 : $product->get_stock_quantity() );

		if ( $original_max < 0 ) {
			return $max;
		}

		return min( $max, $original_max );
	}

	/**
	 * Display countdown and sold items in single product page
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function single_product_template() {
		global $product;

		if ( ! TemPlaza_Woo\Templaza_Woo_Helper::is_product_deal( $product ) ) {
			return;
		}

		$expire_date = ! empty( $product->get_date_on_sale_to() ) ? $product->get_date_on_sale_to()->getOffsetTimestamp() : '';
		$expire_date = apply_filters( 'templaza_product_deals_expire_timestamp', $expire_date, $product );

		if ( empty( $expire_date ) ) {
			return;
		}

		$now = strtotime( current_time( 'Y-m-d H:i:s' ) );

		$expire = $expire_date - $now;

		if ( $expire < 0 ) {
			return;
		}

		wc_get_template(
			'single-product/deal.php',
			array(
				'expire'          => $expire,
				'limit'           => get_post_meta( $product->get_id(), '_deal_quantity', true ),
				'sold'            => intval( get_post_meta( $product->get_id(), '_deal_sales_counts', true ) ),
				'expire_text'     => str_replace( '/', '<br>', get_option( 'templaza_product_deals_expire_text' ) ),
				'sold_items_text' => get_option( 'templaza_product_deals_sold_items_text' ),
				'sold_text'       => get_option( 'templaza_product_deals_sold_text' ),
				'countdown_texts' => TemPlaza_Woo\Templaza_Woo_Helper::get_countdown_texts()
			),
			'',
            TEMPLAZA_FRAMEWORK_INCLUDES_PATH . '/helpers/woocommerce/template-parts/'
		);
	}
}
Templaza_Product_Deal_frontend::get_instance();