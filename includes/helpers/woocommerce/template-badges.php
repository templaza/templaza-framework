<?php
/**
 * Badges template hooks.
 */
use TemPlaza_Woo\Templaza_Woo_Helper;
use TemPlazaFramework\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of Badges template.
 */
class Templaza_Woo_Badges {
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
		// Change the markup of sale flash.
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $loop_badges     = isset($templaza_options['templaza-shop-catalog-badges'])?filter_var($templaza_options['templaza-shop-catalog-badges'], FILTER_VALIDATE_BOOLEAN):true;
        $single_badges     = isset($templaza_options['templaza-shop-single-badges'])?filter_var($templaza_options['templaza-shop-single-badges'], FILTER_VALIDATE_BOOLEAN):true;
		add_filter( 'woocommerce_sale_flash', array( $this, 'get_sale_flash' ), 10, 3 );

		// Remove the default sale flash.
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
		if ($loop_badges ) {
			add_action( 'templaza_product_loop_thumbnail', array( $this, 'product_badges' ), 0 );

		}
		add_action( 'templaza_product_loop_masonry_thumbnail', array( $this, 'product_badges' ), 5 );
		add_action( 'templaza_product_loop_showcase_thumbnail', array( $this, 'product_badges' ), 5 );
		add_action( 'templaza_woocommerce_product_quickview_thumbnail', array(
			$this,
			'product_badges'
		), 5 );

		// Badges
		if ( $single_badges ) {
			add_action( 'templaza_before_product_gallery', array( $this, 'product_badges' ) );
		}
	}

	/**
	 * Product badges.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_badges() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $layout = isset($templaza_options['templaza-shop-catalog-badges-layout'])?$templaza_options['templaza-shop-catalog-badges-layout']:'layout-1';
		global $product;
		$badges = array();
		$custom_badges       = maybe_unserialize( get_post_meta( $product->get_id(), 'custom_badges_text', true ) );
		$custom_badges_bg    = get_post_meta( $product->get_id(), 'custom_badges_bg', true );
		$custom_badges_color = get_post_meta( $product->get_id(), 'custom_badges_color', true );

		if ( $custom_badges ) {
			$style    = '';
			$bg_color = ! empty( $custom_badges_bg ) ? 'background-color:' . $custom_badges_bg . ';' : '';
			$color    = ! empty( $custom_badges_color ) ? 'color:' . $custom_badges_color . ';' : '';

			if ( $bg_color || $color ) {
				$style = 'style="' . $color . $bg_color . '"';
			}

			$badges[] = '<span class="custom ribbon"' . $style . '>' . esc_html( $custom_badges ) . '</span>';

		} else {
			$badges = self::get_badges();
		}

		if ( $badges != '' ) {
			if ( $custom_badges ) {
				$badges = implode( '', $badges );

			} else {
				$badges = $layout == 'layout-2' ? $badges[1] : implode( '', $badges[0] );
			}

			if ( ! empty( $badges ) ) {
				printf( '<span class="woocommerce-badges woocommerce-badges--%s">%s</span>', esc_attr( $layout ), $badges );
			}
		}
	}

	/**
	 * Get product badges.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_badges() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $badge_soldout     = isset($templaza_options['templaza-shop-badge-soldout'])?filter_var($templaza_options['templaza-shop-badge-soldout'], FILTER_VALIDATE_BOOLEAN):true;
        $badge_new     = isset($templaza_options['templaza-shop-badge-new'])?filter_var($templaza_options['templaza-shop-badge-new'], FILTER_VALIDATE_BOOLEAN):true;
        $badge_featured     = isset($templaza_options['templaza-shop-badge-featured'])?filter_var($templaza_options['templaza-shop-badge-featured'], FILTER_VALIDATE_BOOLEAN):true;
        $badge_sale     = isset($templaza_options['templaza-shop-badge-sale'])?filter_var($templaza_options['templaza-shop-badge-sale'], FILTER_VALIDATE_BOOLEAN):true;
		global $product;
		$badge  = '';
		$badges = array();

		if ( $badge_soldout && ! $product->is_in_stock() ) {
			$in_stock = false;

			// Double check if this is a variable product.
			if ( $product->is_type( 'variable' ) ) {
				$variations = $product->get_available_variations();

				foreach ( $variations as $variation ) {
					if ( $variation['is_in_stock'] ) {
						$in_stock = true;
						break;
					}
				}
			}

			if ( ! $in_stock ) {
				$text               = isset($templaza_options['templaza-shop-badge-soldout-text'])?$templaza_options['templaza-shop-badge-soldout-text']:'Sold Out';
				$badges['sold-out'] = $badge = '<span class="sold-out woocommerce-badge"><span>' . esc_html( $text ) . '</span></span>';
			}
		} else {
			if ( $badge_new && in_array( $product->get_id(), TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_new_product_ids() ) ) {
				$text          = isset($templaza_options['templaza-shop-badge-new-text'])?$templaza_options['templaza-shop-badge-new-text']:'New';
				$badges['new'] = $badge = '<span class="new woocommerce-badge"><span>' . esc_html( $text ) . '</span></span>';
			}

			if ( $product->is_featured() && $badge_featured ) {
				$text               = isset($templaza_options['templaza-shop-badge-featured-text'])?$templaza_options['templaza-shop-badge-featured-text']:'Hot';
				$badges['featured'] = $badge = '<span class="featured woocommerce-badge"><span>' . esc_html( $text ) . '</span></span>';
			}

			if ( $product->is_on_sale() && $badge_sale ) {
				ob_start();
				woocommerce_show_product_sale_flash();
				$badges['sale'] = $badge = ob_get_clean();
			}
		}


		$badges = apply_filters( 'templaza_product_badges', $badges, $product );
		ksort( $badges );

		return array( $badges, $badge );
	}

	/**
	 * Sale badge.
	 *
	 * @since 1.0.0
	 *
	 * @param string $output The sale flash HTML.
	 * @param object $post The post object.
	 * @param object $product The product object.
	 *
	 * @return string
	 */
	public function get_sale_flash( $output, $post, $product ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $single_badges     = isset($templaza_options['templaza-shop-single-badges'])?filter_var($templaza_options['templaza-shop-single-badges'], FILTER_VALIDATE_BOOLEAN):true;
		if ( $single_badges == false ) {
			return '';
		}

		$type       = isset($templaza_options['templaza-shop-badge-sale-type'])?$templaza_options['templaza-shop-badge-sale-type']:'text';
		$text       = isset($templaza_options['templaza-shop-badge-sale-text'])?$templaza_options['templaza-shop-badge-sale-text']:'Sale';
		$percentage = 0;

		if ( 'percent' == $type || 'both' == $type || false !== strpos( $text, '{%}' ) || false !== strpos( $text, '{$}' ) ) {

			if ( $product->get_type() == 'variable' ) {
				$available_variations = $product->get_available_variations();
				$max_percentage       = 0;
				$max_saved            = 0;
				$total_variations     = count( $available_variations );

				for ( $i = 0; $i < $total_variations; $i ++ ) {
					$variation_id        = $available_variations[ $i ]['variation_id'];
					$variable_product    = new \WC_Product_Variation( $variation_id );
					$regular_price       = $variable_product->get_regular_price();
					$sales_price         = $variable_product->get_sale_price();
					$variable_saved      = $regular_price && $sales_price ? ( $regular_price - $sales_price ) : 0;
					$variable_percentage = $regular_price && $sales_price ? round( ( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 ) ) : 0;

					if ( $variable_saved > $max_saved ) {
						$max_saved = $variable_saved;
					}

					if ( $variable_percentage > $max_percentage ) {
						$max_percentage = $variable_percentage;
					}
				}

				$percentage = $max_percentage ? $max_percentage : $percentage;
			} elseif ( (float) $product->get_regular_price() != 0 ) {
				$saved      = (float) $product->get_regular_price() - (float) $product->get_sale_price();
				$percentage = round( ( $saved / (float) $product->get_regular_price() ) * 100 );
			}
		}

		if ( 'percent' == $type ) {
			$output = $percentage ? '<span class="onsale woocommerce-badge"><span> - ' . $percentage . '%</span></span>' : '';
		} elseif ( 'both' == $type ) {
			$output = '<span class="onsale woocommerce-badge"><span class="text">' . wp_kses_post( $text ) . '</span><span class="percent"> ' . $percentage . '%</span></span>';
		} else {
			$output = '<span class="onsale woocommerce-badge"><span>' . wp_kses_post( $text ) . '</span></span>';
		}

		return $output;
	}

}
Templaza_Woo_Badges::get_instance();