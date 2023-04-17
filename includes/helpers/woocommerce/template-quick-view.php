<?php
/**
 * WooCommerce Quick View template hooks.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use TemPlaza_Woo\Templaza_Woo_Helper;
use TemPlazaFramework\Functions;
/**
 * Class of Product Quick View
 */
class Templaza_Woo_Quick_View {
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
		// Quick view modal.
		add_action( 'wc_ajax_product_quick_view', array( $this, 'templaza_quick_view' ) );

		add_action( 'templaza_woocommerce_product_quickview_thumbnail', 'woocommerce_show_product_images', 10 );
		add_action( 'templaza_woocommerce_product_quickview_thumbnail', array(
			$this,
			'templaza_product_quick_view_more_info_button'
		) );

		add_action( 'templaza_woocommerce_product_quickview_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'templaza_woocommerce_product_quickview_summary', 'woocommerce_template_single_title', 20 );
		add_action( 'templaza_woocommerce_product_quickview_summary', array(
			$this,
			'open_price_box_wrapper'
		), 30 );

		if ( apply_filters( 'templaza_product_show_price', true ) ) {
			add_action( 'templaza_woocommerce_product_quickview_summary', 'woocommerce_template_single_price', 40 );
		}

		add_action( 'templaza_woocommerce_product_quickview_summary', array(
            $this,
            'templaza_product_available'
        ), 50 );
		add_action( 'templaza_woocommerce_product_quickview_summary', array(
			$this,
			'templaza_close_price_box_wrapper'
		), 60 );
		add_action( 'templaza_woocommerce_product_quickview_summary', 'woocommerce_template_single_excerpt', 70 );
		add_action( 'templaza_woocommerce_product_quickview_summary', 'woocommerce_template_single_add_to_cart', 80 );
		add_action( 'templaza_woocommerce_product_quickview_summary', 'woocommerce_template_single_meta', 90 );

		add_action( 'wp_footer', array( $this, 'templaza_quick_view_modal' ), 40 );
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
	 * Product availability
     *
	 * @since 1.0.0
	 *
	 * @return html
	 */
	public function templaza_product_available() {
        TemPlaza_Woo\Templaza_Woo_Helper::templaza_product_availability();
	}

	/**
	 * Close button wrapper
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function templaza_close_price_box_wrapper() {
		echo '</div>';
	}

	/**
	 * Product quick view template.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function templaza_quick_view() {
		if ( empty( $_POST['product_id'] ) ) {
			wp_send_json_error( esc_html__( 'No product.', 'templaza-framework' ) );
			exit;
		}

		$post_object = get_post( $_POST['product_id'] );
		if ( ! $post_object || ! in_array( $post_object->post_type, array(
				'product',
				'product_variation',
				true
			) ) ) {
			wp_send_json_error( esc_html__( 'Invalid product.', 'templaza-framework' ) );
			exit;
		}
		$GLOBALS['post'] = $post_object;
		wc_setup_product_data( $post_object );
		ob_start();
        wc_get_template( 'content-product-quickview.php', array(
            'post_object' => $post_object,
        ) );

		wp_reset_postdata();
		wc_setup_product_data( $GLOBALS['post'] );
		$output = ob_get_clean();

		wp_send_json_success( $output );
		exit;
	}

	/**
	 * Quick view modal.
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function templaza_quick_view_modal() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $featured_icons       = isset($templaza_options['templaza-shop-loop-featured-icons'])?$templaza_options['templaza-shop-loop-featured-icons']:'1';
        if (empty($featured_icons) || (is_array($featured_icons) && $featured_icons['quickview'] != '1')) {
			return;
		}
		?>
        <div id="quick-view-modal" class="quick-view-modal templaza-modal single-product">
            <div class="off-modal-layer"></div>
            <div class="modal-content uk-container woocommerce">
                <div class="button-close active">
					<i class="fas fa-close"></i>
                </div>
                <div class="product"></div>
            </div>
            <div class="templaza-posts__loading">
                <div class="templaza-loading"></div>
            </div>
        </div>
		<?php
	}

	/**
	 * Quick view more info button
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function templaza_product_quick_view_more_info_button() {
		printf(
			'<a href="%s" class="product-more-infor">
				<span class="product-more-infor__text">%s</span>%s
			</a>',
			is_customize_preview() ? '#' : esc_url( get_permalink() ),
			apply_filters( 'product_quick_view_more_infor_text', esc_html__( 'More Product Info', 'templaza-framework' ) ),
			'<i class="fas fa-info-circle"></i>'
		);
	}
}
Templaza_Woo_Quick_View::get_instance();