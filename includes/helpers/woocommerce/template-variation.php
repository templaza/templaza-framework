<?php

use TemPlazaFramework\Functions;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Templaza_Woo_Variation {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	private static $instance;

	/**
	 * Has variation images
	 *
	 * @var $has_variation_images
	 */
	protected static $has_variation_images = null;


	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
    // phpcs:disable WordPress.Security.NonceVerification.Missing, WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'post_class', array( $this, 'product_class' ), 10, 3 );

		add_filter('templaza_single_product_image_id', array( $this, 'get_variation_image' ));
		add_filter('templaza_single_product_gallery_image_ids', array( $this, 'get_variation_gallery_image_ids' ));
		add_action( 'wc_ajax_templaza_get_variation_images', array( $this, 'get_variation_images' ) );
	}

	public function has_variation_images() {
		if( isset( self::$has_variation_images ) ) {
			return self::$has_variation_images;
		}
		global $product;
		if( empty( $product ) ) {
			return self::$has_variation_images;
		}
		self::$has_variation_images = false;
		if( $product->get_type() != 'variable' ) {
			return self::$has_variation_images;
		}
		$variation_ids        = $product->get_children();
		if( empty($variation_ids) ) {
			return self::$has_variation_images;
		}
		foreach( $variation_ids as $variation_id ) {
			$variation_images = get_post_meta( $variation_id, 'templaza_variation_images', true );
			if( $variation_images ) {
				self::$has_variation_images = true;
				return self::$has_variation_images;
			}
		}

	}

	/**
	 * Adds classes to products
     *
	 * @since 1.0.0
	 *
	 * @param string $class Post class.
	 *
	 * @return array
	 */
	public function product_class( $classes ) {
		if ( is_admin() || get_post_type(get_the_ID()) != 'product') {
			return $classes;
		}
		if( $this->has_variation_images() ) {
			$classes[] = 'product-has-variation-images';
		}

		return $classes;
	}

	/**
	 * Enqueue Scripts
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'templaza_variation_images', Functions::get_my_url() . '/assets/js/woo/variation-images-frontend.js', array( 'jquery' ), '', true );
	}

	public function get_variation_images() {
		check_ajax_referer( '_templaza_nonce', 'nonce' );
		if ( isset( $_POST['product_id'] ) && ! empty( $_POST['product_id'] ) ) {
			$product_id       = absint( $_POST['product_id'] );
			$GLOBALS['post'] = get_post( $product_id  ); // WPCS: override ok.
			setup_postdata( $GLOBALS['post'] );
			ob_start();
			woocommerce_show_product_images();
			wp_reset_postdata();
			wp_send_json_success( ob_get_clean() );
			die();
		}

	}

	public function get_variation_image($image_id) {
		if ( isset( $_POST['variation_id'] ) && ! empty( $_POST['variation_id'] ) ) {
			$variation_id       = absint( $_POST['variation_id'] );
			$variation = wc_get_product( $variation_id );
			$image_id = $variation->get_image_id();
		}

		return $image_id;
	}

	public function get_variation_gallery_image_ids($image_ids) {
		if ( isset( $_POST['variation_id'] ) && ! empty( $_POST['variation_id'] ) ) {
			$variation_id       = absint( $_POST['variation_id'] );
			$variation_images = get_post_meta( $variation_id, 'templaza_variation_images', true );
			$image_ids = $variation_images ? explode(',', $variation_images) : $image_ids;
		}

		return $image_ids;
	}

}
Templaza_Woo_Variation::get_instance();