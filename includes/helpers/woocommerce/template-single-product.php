<?php
/**
 * Hooks of single product.
 */

use TemPlaza_Woo\Templaza_Woo_Helper;
use WeDevs\WeMail\Rest\Help\Help;
use TemPlazaFramework\Functions;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of single product template.
 */
class Templaza_Single_Product {
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

		// Adds a class of product layout to product page.
		add_filter( 'post_class', array( $this, 'product_class' ), 10, 3 );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 20 );

		add_filter( 'templaza_wp_script_data', array(
			$this,
			'product_script_data'
		) );

		// Replace the default sale flash.
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );

		// Change the product thumbnails columns
		add_filter( 'woocommerce_product_thumbnails_columns', array( $this, 'product_thumbnails_columns' ) );

		// Remove breadcrumb
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

		// Replace Woocommerce notices
		remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
		add_action( 'woocommerce_before_single_product_summary', 'woocommerce_output_all_notices', 10 );

		// Gallery summary wrapper
		add_action( 'woocommerce_before_single_product_summary', array(
			$this,
			'open_gallery_summary_wrapper'
		), 19 );
		add_action( 'woocommerce_after_single_product_summary', array(
			$this,
			'close_gallery_summary_wrapper'
		), 1 );

		// Change wishlist button
		add_filter( 'yith_wcwl_show_add_to_wishlist', '__return_empty_string' );

		// Summary order els
		add_action( 'woocommerce_single_product_summary', array( $this, 'open_summary_top_wrapper' ), 2 );
		add_action( 'woocommerce_single_product_summary', array( $this, 'single_product_taxonomy' ), 2 );

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

		// Re-order the stars rating.
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 3 );
		add_action( 'woocommerce_single_product_summary', array( $this, 'close_summary_top_wrapper' ), 4 );

		add_action( 'woocommerce_single_product_summary', array( $this, 'open_price_box_wrapper' ), 9 );
		add_action( 'woocommerce_single_product_summary', array(
            TemPlaza_Woo\Templaza_Woo_Helper::instance(),
			'templaza_product_availability'
		), 11 );
		add_action( 'woocommerce_single_product_summary', array( $this, 'close_price_box_wrapper' ), 15 );
//		add_action( 'woocommerce_single_product_summary', array( $this, 'product_share' ), 50 );

		// Remove product tab heading.
		add_filter( 'woocommerce_product_description_heading', '__return_null' );
		add_filter( 'woocommerce_product_reviews_heading', '__return_null' );
		add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );

		// Change Review Avatar Size
		add_filter( 'woocommerce_review_gravatar_size', array( $this, 'review_gravatar_size' ) );

		// Upsells Products
        $product_upsells           = isset($templaza_options['templaza-shop-upsells'])?filter_var($templaza_options['templaza-shop-upsells'], FILTER_VALIDATE_BOOLEAN):true;
		if ( $product_upsells == false ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		}

		add_filter( 'woocommerce_get_upsell_display_args', array(
			$this,
			'get_upsell_display_args'
		) );

		add_filter( 'woocommerce_product_upsells_heading', array(
			$this,
			'product_upsells_heading'
		) );

		// Related options
        $product_related           = isset($templaza_options['templaza-shop-related'])?filter_var($templaza_options['templaza-shop-related'], FILTER_VALIDATE_BOOLEAN):true;

		if ( $product_related == false ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}

		add_filter( 'woocommerce_product_related_products_by_category', array(
			$this,
			'related_products_by_category'
		) );

		add_filter( 'woocommerce_get_related_product_cat_terms', array(
			$this,
			'related_products_by_parent_category'
		), 20, 2 );

		add_filter( 'woocommerce_product_related_products_by_tag', array(
			$this,
			'related_products_by_tag'
		) );
		add_filter( 'woocommerce_related_products_heading', array(
			$this,
			'related_products_heading'
		) );

		add_filter( 'woocommerce_get_related_products_args', array(
			$this,
			'get_related_products_args'
		) );

		// change product gallery classes
		add_filter( 'woocommerce_single_product_image_gallery_classes', array(
			$this,
			'product_image_gallery_classes'
		) );

        $tabs_position        = isset($templaza_options['templaza-shop-single-content-tabs'])?$templaza_options['templaza-shop-single-content-tabs']:'default';
        // Product Layout
		switch ( $this->single_get_product_layout() ) {
			case 'layout-3':
				// Change Gallery
				add_filter( 'woocommerce_single_product_flexslider_enabled', '__return_false' );
				add_filter( 'woocommerce_gallery_image_size', array( $this, 'gallery_image_size_large' ) );

				break;

			case 'layout-4':
				// Change Gallery
				add_filter( 'woocommerce_single_product_flexslider_enabled', '__return_false' );
				add_filter( 'woocommerce_gallery_image_size', array( $this, 'gallery_image_size_large' ) );

				break;

			case 'layout-5':
				// Change Gallery
				add_filter( 'woocommerce_single_product_flexslider_enabled', '__return_false' );
				add_filter( 'woocommerce_gallery_image_size', array( $this, 'gallery_image_size_large' ) );

				$tabs_position = 'under_summary';

				break;
		}

		if( $tabs_position == 'under_summary' ) {
			// Move product tabs into the summary.
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			add_action( 'woocommerce_single_product_summary', array( $this, 'product_data_tabs' ), 100 );
		}

        add_action( 'woocommerce_single_product_summary', array( $this, 'product_extra_content' ), 200 );
	}

	/**
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function scripts() {
		wp_enqueue_script( 'templaza-single-product', Functions::get_my_url() . '/assets/js/woo/single-product.js', array(
			'templaza-woo-scripts',
		), false, true );
	}

	/**
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @since 1.0.0
     *
     * @param $data
	 *
	 * @return array
	 */
	public function product_script_data( $data ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $image_zoom      = isset($templaza_options['templaza-shop-single-image-zoom'])?filter_var($templaza_options['templaza-shop-single-image-zoom'], FILTER_VALIDATE_BOOLEAN):true;
		$data['product_gallery_slider'] = self::product_gallery_is_slider();
		$data['product_image_zoom']     = intval( $image_zoom );

		return $data;
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
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return $classes;
		}
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $tab_position        = isset($templaza_options['templaza-shop-single-content-tabs'])?$templaza_options['templaza-shop-single-content-tabs']:'default';
        $cart_ajax      = isset($templaza_options['templaza-shop-single-cart-ajax'])?filter_var($templaza_options['templaza-shop-single-cart-ajax'], FILTER_VALIDATE_BOOLEAN):true;
		$classes[] = '' . $this->single_get_product_layout();

		if ( in_array( $this->single_get_product_layout(), array( 'layout-2', 'layout-3' ) ) ) {
			$classes[] = 'product-thumbnails-vertical';
		}

		if ( $cart_ajax ) {
			$classes[] = 'product-add-to-cart-ajax';
		}

		if ( in_array( $this->single_get_product_layout(), array( 'layout-5' ) ) || $tab_position == 'under_summary' ) {
			$classes[] = 'product-tabs-under-summary';
		}

		global $product;
        if(!empty($product)){
            $video_image = get_post_meta( $product->get_id(), 'video_thumbnail', true );
            if ( $product->get_gallery_image_ids() || $video_image ) {
                $classes[] = 'has-gallery-image';
            }
        }

		return $classes;
	}

	/**
	 * Open gallery summary wrapper
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function open_gallery_summary_wrapper() {
		$container = apply_filters( 'templaza_single_product_container_class', '' );
		echo '<div class="product-gallery-summary templaza-shop-box clearfix ' . esc_attr( $container ) . '">';
	}

	/**
	 * Close gallery summary wrapper
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function close_gallery_summary_wrapper() {
		echo '</div>';
	}

	/**
	 * Open button wrapper
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function open_summary_top_wrapper() {
		echo '<div class="summary-top-box">';
	}

	/**
	 * Close button wrapper
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function close_summary_top_wrapper() {
		echo '</div>';
	}

	/**
	 * Open button wrapper
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function open_price_box_wrapper() {
		echo '<div class="summary-price-box">';
	}

	/**
	 * Close button wrapper
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function close_price_box_wrapper() {
		echo '</div>';
	}

	/**
	 * Product thumbnails columns
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function product_thumbnails_columns() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $thumb_number        = isset($templaza_options['templaza-shop-single-thumb-number'])?$templaza_options['templaza-shop-single-thumb-number']:4;
		return intval($thumb_number);
	}


	/**
	 * Change review gravatar size
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function review_gravatar_size() {
		return '100';
	}

	/**
	 * Change Upsell products args
	 *
	 * @since 1.0.0
     *
     * @param array $args
	 *
	 * @return array
	 */
	public function get_upsell_display_args( $args ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $upsells_number        = isset($templaza_options['templaza-shop-upsells-number'])?$templaza_options['templaza-shop-upsells-number']:'6';
		$args = array(
			'posts_per_page' => intval( $upsells_number ),
			'columns'        => 4,
		);

		return $args;
	}

	/**
	 * Product Upsells heading
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function product_upsells_heading() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $upsells_title        = isset($templaza_options['templaza-shop-upsells-title'])?$templaza_options['templaza-shop-upsells-title']:'You may also like';
		return $upsells_title;
	}

	/**
	 * Related products by category
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function related_products_by_category() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $related_category      = isset($templaza_options['templaza-shop-related-category'])?filter_var($templaza_options['templaza-shop-related-category'], FILTER_VALIDATE_BOOLEAN):true;
		return $related_category;
	}

	/**
	 * Related products by parent category
	 *
	 * @since 1.0.0
	 *
     * @param array $term_ids
     * @param int $product_id
     *
	 * @return array
	 */
	public function related_products_by_parent_category( $term_ids, $product_id ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $related_category      = isset($templaza_options['templaza-shop-related-category'])?filter_var($templaza_options['templaza-shop-related-category'], FILTER_VALIDATE_BOOLEAN):true;
        $related_category_parent      = isset($templaza_options['templaza-shop-related-parent-category'])?filter_var($templaza_options['templaza-shop-related-parent-category'], FILTER_VALIDATE_BOOLEAN):false;
		if ( $related_category == false ) {
			return $term_ids;
		}

		if ( $related_category_parent == false ) {
			return $term_ids;
		}

		$terms = wc_get_product_terms(
			$product_id, 'product_cat', array(
				'orderby' => 'parent',
			)
		);

		$term_ids = array();

		if ( ! is_wp_error( $terms ) && $terms ) {
			$current_term = end( $terms );
			$term_ids[]   = $current_term->term_id;
		}

		return $term_ids;

	}

	/**
	 * Related products by tag
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function related_products_by_tag() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $related_tag      = isset($templaza_options['templaza-shop-related-tag'])?filter_var($templaza_options['templaza-shop-related-tag'], FILTER_VALIDATE_BOOLEAN):true;
		return $related_tag;
	}

	/**
	 * Related products heading
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function related_products_heading() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $related_title        = isset($templaza_options['templaza-shop-related-title'])?$templaza_options['templaza-shop-related-title']:'Related Products';
		return $related_title;
	}

	/**
	 * Change Related products args
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_related_products_args( $args ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $related_number        = isset($templaza_options['templaza-shop-related-number'])?$templaza_options['templaza-shop-related-number']:4;

		$args = array(
			'posts_per_page' => intval( $related_number ),
			'columns'        => 4,
			'orderby'        => 'rand',
		);

		return $args;
	}

	/**
	 * Add class to product gallery
	 *
	 * @since 1.0.0
     *
     * @param array $classes
	 *
	 * @return array
	 */
	public function product_image_gallery_classes( $classes ) {
		global $product;
		$attachment_ids = $product->get_gallery_image_ids();

		if ( ! $attachment_ids ) {
			$classes[] = 'without-thumbnails';

		}

		return $classes;
	}

	/**
	 * Change product gallery image size
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function gallery_image_size_large( $size ) {
		return 'woocommerce_single';
	}

	/**
	 * Product data tabs.
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_data_tabs() {
		$tabs = apply_filters( 'woocommerce_product_tabs', array() );

		if ( ! empty( $tabs ) ) :
			?>

            <div class="woocommerce-tabs templaza-shop-tabs-meta wc-tabs-wrapper">
				<?php foreach ( $tabs as $key => $tab ) : ?>
                    <div class="templaza-tab-wrapper">
                        <a href="#tab-<?php echo esc_attr( $key ); ?>"
                           class="templaza-accordion-title tab-title-<?php echo esc_attr( $key ); ?>">
							<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> entry-content wc-tab panel-content"
                             id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel">
							<?php
							if ( isset( $tab['callback'] ) ) {
								call_user_func( $tab['callback'], $key, $tab );
							}
							?>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>

		<?php
		endif;
	}


	/**
	 * Category name
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function single_product_taxonomy() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $product_taxonomy      = isset($templaza_options['templaza-shop-single-taxonomy'])?$templaza_options['templaza-shop-single-taxonomy']:'';
        $product_brand      = isset($templaza_options['templaza-shop-single-brand-type'])?$templaza_options['templaza-shop-single-brand-type']:'title';

        if ( $product_taxonomy !='' ) {
            $taxonomy = $product_taxonomy;
			$show_thumbnail = $taxonomy == 'product_brand' && $product_brand == 'logo' ? true : false;
            TemPlaza_Woo\Templaza_Woo_Helper::templaza_product_taxonomy( $taxonomy, $show_thumbnail );
		}
	}

	/**
	 * Check if product gallery is slider.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function product_gallery_is_slider() {
		$support = ! in_array( $this->single_get_product_layout(), array( 'layout-3', 'layout-5' ) );

		return apply_filters( 'templaza_product_gallery_is_slider', $support );
	}

	/**
	 * Get product layout
     *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function single_get_product_layout() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $product_layout        = isset($templaza_options['templaza-shop-single-layout'])?$templaza_options['templaza-shop-single-layout']:'layout-1';

		return apply_filters( 'templaza_single_get_product_layout', $product_layout );
	}
    /**
     * Add product extra content
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function product_extra_content() {
        $extra = get_post_meta(get_the_ID(),'product-single-extra-content',true);
        if (  $extra ) {
            echo '<div class="single-product-extra-content">';
            echo $extra;
            echo '</div>';
        }
    }

}
Templaza_Single_Product::get_instance();