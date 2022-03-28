<?php
/**
 * Woocommerce Setup functions and definitions.
 */
use TemPlazaFramework\Functions;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woocommerce initial
 *
 */
class Templaza_Woo_Setup {
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
		add_action( 'after_setup_theme', array( $this, 'woocommerce_setup' ) );
		add_filter( 'woocommerce_get_image_size_gallery_thumbnail', array(
			$this,
			'get_gallery_thumbnail_size'
		) );

	}

	/**
	 * WooCommerce setup function.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function woocommerce_setup() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $product_image_zoom = isset($templaza_options['templaza-shop-single-image-zoom'])?filter_var($templaza_options['templaza-shop-single-image-zoom'], FILTER_VALIDATE_BOOLEAN):true;
        $product_gallery_lightbox = isset($templaza_options['templaza-shop-single-image-lightbox'])?filter_var($templaza_options['templaza-shop-single-image-lightbox'], FILTER_VALIDATE_BOOLEAN):true;
		add_theme_support( 'woocommerce', array(
			'product_grid' => array(
				'default_rows'    => 4,
				'min_rows'        => 2,
				'max_rows'        => 20,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 7,
			),
		) );
		if ( $product_image_zoom ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
		if ( $product_gallery_lightbox ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}

		add_theme_support( 'wc-product-gallery-slider' );
	}

	/**
	 * Set the gallery thumbnail size.
	 *
	 * @since 1.0.0
	 *
	 * @param array $size Image size.
	 *
	 * @return array
	 */
	public function get_gallery_thumbnail_size( $size ) {
		$size['width']  = 150;
		$cropping      = get_option( 'woocommerce_thumbnail_cropping', '1:1' );

		if ( 'uncropped' === $cropping ) {
			$size['height'] = '';
			$size['crop']   = 0;
		} elseif ( 'custom' === $cropping ) {
			$width          = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_width', '4' ) );
			$height         = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_height', '3' ) );
			$size['height'] = absint( \Automattic\WooCommerce\Utilities\NumberUtil::round( ( $size['width'] / $width ) * $height ) );
			$size['crop']   = 1;
		} else {
			$cropping_split = explode( ':', $cropping );
			$width          = max( 1, current( $cropping_split ) );
			$height         = max( 1, end( $cropping_split ) );
			$size['height'] = absint( \Automattic\WooCommerce\Utilities\NumberUtil::round( ( $size['width'] / $width ) * $height ) );
			$size['crop']   = 1;
		}

		return $size;
	}

}
Templaza_Woo_Setup::get_instance();