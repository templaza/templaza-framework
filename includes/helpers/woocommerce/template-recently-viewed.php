<?php
/**
 * Recently viewed template hooks.
 */
use TemPlazaFramework\Functions;
use TemPlaza_Woo\Templaza_Woo_Helper;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of general Recently viewed .
 */
class Templaza_Woo_Recently_Viewed {
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
	 * Instance
	 *
	 * @var $instance
	 */
	private $product_ids;

	/**
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		$viewed_products   = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
		$this->product_ids = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $recent_viewed_ajax      = isset($templaza_options['templaza-shop-recent-viewed-ajax'])?filter_var($templaza_options['templaza-shop-recent-viewed-ajax'], FILTER_VALIDATE_BOOLEAN):true;
		// Track Product View
		add_action( 'template_redirect', array( $this, 'track_product_view' ) );
		if ( $recent_viewed_ajax ) {
			add_action( 'wc_ajax_templaza_get_recently_viewed', array( $this, 'do_ajax_products_content' ) );
		}

		add_action( 'templaza_recently_viewed', array( $this, 'products_recently_viewed_section' ) );
	}

	/**
	 * Track product views
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function track_product_view() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}

		global $post;

		if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) {
			$viewed_products = array();
		} else {
			$viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );
		}

		if ( ! in_array( $post->ID, $viewed_products ) ) {
			$viewed_products[] = $post->ID;
		}

		if ( sizeof( $viewed_products ) > 15 ) {
			array_shift( $viewed_products );
		}

		// Store for session only
		wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ), time() + 60 * 60 * 24 * 30 );
	}

	/**
	 * Get product recently viewed
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_content() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }

		$limit = isset($templaza_options['templaza-shop-recent-viewed-number'])?$templaza_options['templaza-shop-recent-viewed-number']:'6';

		if ( empty( $this->product_ids ) ) {
			printf(
				'<ul class="product-list no-products">' .
				'<li class="text-center">%s <br><a href="%s" class="templaza-button">%s</a></li>' .
				'</ul>',
				esc_html__( 'Recently Viewed Products is a function which helps you keep track of your recent viewing history.', 'templaza-framework' ),
				esc_url( get_permalink( get_option( 'woocommerce_shop_page_id' ) ) ),
				esc_html__( 'Shop Now', 'templaza-framework' )
			);
		} else {

            woocommerce_product_loop_start();
            $original_post = $GLOBALS['post'];

            $index = 1;
            foreach ( $this->product_ids as $post_id ) {
                if ( $index > $limit ) {
                    break;
                }

                $index ++;

                $GLOBALS['post'] = get_post( $post_id );
                setup_postdata( $GLOBALS['post'] );
                wc_get_template_part( 'content', 'product' );
            }
            $GLOBALS['post'] = $original_post;
            woocommerce_product_loop_end();
            wc_reset_loop();

			wp_reset_postdata();

		}
	}

	/**
	 * Get product content AJAX
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function do_ajax_products_content() {
		ob_start();

		$this->products_content();

		$output [] = ob_get_clean();

		wp_send_json_success( $output );
		die();
	}

	/**
	 * Get product recently viewed
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_recently_viewed_section() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $recent_viewed      = isset($templaza_options['templaza-shop-recent-viewed'])?filter_var($templaza_options['templaza-shop-recent-viewed'], FILTER_VALIDATE_BOOLEAN):true;
        $display_page       = isset($templaza_options['templaza-shop-recent-viewed-page'])?$templaza_options['templaza-shop-recent-viewed-page']:'';
        $recent_viewed_ajax      = isset($templaza_options['templaza-shop-recent-viewed-ajax'])?filter_var($templaza_options['templaza-shop-recent-viewed-ajax'], FILTER_VALIDATE_BOOLEAN):true;
        if ( $recent_viewed == false ) {
			return;
		}

		if ( ! is_singular( 'product' ) && ! TemPlaza_Woo\Templaza_Woo_Helper::templaza_is_catalog() && ! is_cart() && ! is_checkout() ) {
			return;
		}

		if ( is_singular( 'product' ) && $display_page['single'] !=1 ) {
			return;
		} elseif ( TemPlaza_Woo\Templaza_Woo_Helper::templaza_is_catalog() && $display_page['catalog'] !=1 ) {
			return;
		} elseif ( function_exists( 'is_cart' ) && is_cart() && $display_page['cart'] !=1 ) {
			return;
		} elseif ( function_exists( 'is_checkout' ) && is_checkout() && $display_page['checkout'] !=1 ) {
			return;
		}
        $button_text = isset($templaza_options['templaza-shop-recent-viewed-readmore-text'])?$templaza_options['templaza-shop-recent-viewed-readmore-text']:'';
        $button_link = isset($templaza_options['templaza-shop-recent-viewed-readmore-url'])?$templaza_options['templaza-shop-recent-viewed-readmore-url']:'#';
        $recent_viewed_title = isset($templaza_options['templaza-shop-recent-viewed-title'])?$templaza_options['templaza-shop-recent-viewed-title']:'Recently Viewed';
        $recent_viewed_column = isset($templaza_options['templaza-shop-recent-viewed-columns'])?$templaza_options['templaza-shop-recent-viewed-columns']:4;
        $recent_viewed_empty      = isset($templaza_options['templaza-shop-recent-viewed-empty'])?filter_var($templaza_options['templaza-shop-recent-viewed-empty'], FILTER_VALIDATE_BOOLEAN):true;
		$button_html = '';
		if ( $button_text ) {
			$button_html = sprintf( '<a href="%s" class="recently-button">%s</a>', esc_url( $button_link ), esc_html( $button_text ) );
		}
		if($recent_viewed_title){
            $title_html = sprintf( '<h2 class="recently-title">%s</h2>', esc_html( $recent_viewed_title ));
        }else{
            $title_html = '';
        }

		$addClass = $recent_viewed_ajax ? '' : 'no-ajax';

		if ( empty( $this->product_ids ) ) {
			$addClass .= intval($recent_viewed_empty) ? ' hide-empty' : '';
		}

		$header_class =  $button_html ? '' : 'no-button';

		?>
        <section class="templaza-history-products <?php echo esc_attr( $addClass ) ?>" id="templaza-history-products"
                 data-col=<?php echo esc_attr( $recent_viewed_column ) ?>>

            <?php if ( $title_html || $button_html ) :
                printf( '<h2 class="recently-header %s">%s %s</h2>', esc_html($header_class), $recent_viewed_title, $button_html );
            endif; ?>
            <div class="recently-products ">

                <?php if ( ! $recent_viewed_ajax ) :
                    $this->products_content();
                else: ?>
                    <div class="templaza-posts__loading">
                        <div class="templaza-loading"></div>
                    </div>
                <?php endif; ?>
            </div>

        </section>
		<?php
	}

}
Templaza_Woo_Recently_Viewed::get_instance();