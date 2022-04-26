<?php
/**
 * WooCommerce Notices template hooks.
 */
use TemPlazaFramework\Functions;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of WooCommerce Notices
 */

class Templaza_Woo_Notices {
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
        // Popup add to cart HTML
        add_action( 'wp_footer', array( $this, 'popup_add_to_cart' ), 50 );

        // Popup add to cart Template
        add_action( 'wc_ajax_templaza_product_popup_recommended', array( $this, 'product_template_recommended' ) );

        add_action( 'templaza_product_popup_atc_recommendation', array(
            $this,
            'products_recommendation'
        ), 5 );

        add_action( 'woocommerce_widget_shopping_cart_total', array(
			$this,
			'widget_shopping_cart_count_notice'
		), 5 );

        add_filter( 'templaza_wp_script_data', array(
            $this,
            'notices_script_data'
        ), 30 );
   }

   /**
    * Get popup add to cart
    *
    * @since 1.0.0
    *
    * @return void
    */
   public function popup_add_to_cart() {
       if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
       }else{
            $templaza_options = Functions::get_theme_options();
       }
       $cart_notify        = isset($templaza_options['templaza-shop-notify'])?$templaza_options['templaza-shop-notify']:'panel';
        if ( is_404() ) {
            return;
        }

        if ( $cart_notify != 'popup' ) {
            return;
        }
        ?>

        <div id="rz-popup-add-to-cart" class="rz-popup-add-to-cart templaza-modal woocommerce">
            <div class="off-modal-layer"></div>
            <div class="modal-content container woocommerce">
                <div class="button-close">
                    <i class="fas fa-close"></i>
                </div>
                <div class="product-modal-content">
                <div class="rz-product-popup-atc__notice">
                    <?php esc_html_e( 'Successfully added to your cart.', 'agruco' ) ?>
                </div>
               <div class="widget_shopping_cart_content"></div>
               <?php do_action( 'templaza_product_popup_atc_recommendation' ); ?>
                </div>

                <div class="templaza-posts__loading">
                    <div class="templaza-loading"></div>
                </div>
            </div>
        </div>
        <?php
    }

   /**
    * Get product recommended
    *
    * @since 1.0.0
    *
    * @return void
    */
    public function product_template_recommended() {
        ob_start();
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }

        if ( isset( $_POST['product_id'] ) && ! empty( $_POST['product_id'] )  ) {
            $product_id      = $_POST['product_id'];
            $product = wc_get_product( $product_id );

            $limit = isset($templaza_options['templaza-shop-notify-product-number'])?$templaza_options['templaza-shop-notify-product-number']:6;
            $type  = isset($templaza_options['templaza-shop-notify-popup'])?$templaza_options['templaza-shop-notify-popup']:'related_products';

             $query = new \stdClass();
            if ( 'related_products' == $type ) {
                $related_products = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product_id, $limit, $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
                $related_products = wc_products_array_orderby( $related_products, 'rand', 'desc' );

                $query->posts = $related_products;
            } elseif ( 'upsells_products' == $type ) {
                $upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), 'rand', 'desc' );

                $query->posts = $upsells;
            }

             if( count($query->posts) ) {
                 $this->products_recommended_content($query->posts);
             }

        }

        $output = ob_get_clean();
        wp_send_json_success( $output );
        die();
    }

    /**
    * Get products recommended
    *
    * @since 1.0.0
    *
    * @return void
    */
    public function products_recommendation() {
        if ( ! class_exists( 'WC_Shortcode_Products' ) ) {
            return;
        }
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $limit = isset($templaza_options['templaza-shop-notify-product-number'])?$templaza_options['templaza-shop-notify-product-number']:6;
        $type  = isset($templaza_options['templaza-shop-notify-popup'])?$templaza_options['templaza-shop-notify-popup']:'related_products';

        if('none' == $type){
            return;
        }

        if('related_products' == $type || 'upsells_products' == $type ) {
            echo '<div class="rz-product-popup-atc__recommendation"></div>';
            return;
        }

        $atts = array(
            'per_page'     => intval( $limit ),
            'category'     => '',
            'cat_operator' => 'IN',
        );

        switch ( $type ) {
            case 'sale_products':
            case 'top_rated_products':
                $atts = array_merge( array(
                    'orderby' => 'title',
                    'order'   => 'ASC',
                ), $atts );
                break;

            case 'recent_products':
                $atts = array_merge( array(
                    'orderby' => 'date',
                    'order'   => 'DESC',
                ), $atts );
                break;

            case 'featured_products':
                $atts = array_merge( array(
                    'orderby' => 'date',
                    'order'   => 'DESC',
                ), $atts );
                break;
        }

        $args  = new \WC_Shortcode_Products( $atts, $type );
        $args  = $args->get_query_args();
        $query = new \WP_Query( $args );

        if( !count($query->posts) ) {
            return;
        }

        echo '<div class="rz-product-popup-atc__recommendation loaded">';
        $this->products_recommended_content($query->posts);
        wp_reset_postdata();
        echo '</div>';

    }

    /**
    * Get products recommended content
    *
    * @since 1.0.0
    *
    * @param $query_posts
    *
    * @return void
    */
    public function products_recommended_content($query_posts) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $notify_title = isset($templaza_options['templaza-shop-notify-title'])?$templaza_options['templaza-shop-notify-title']:'You may also like';
        ?>
        <div class="recommendation-heading">
            <h2 class="product-heading"> <?php echo esc_html( $notify_title );?> </h2>
            <div class="rz-swiper-buttons">
                <span class="rz-swiper-button-prev"><i class="fas fa-chevron-left"></i></span>
                <span class="rz-swiper-button-next"><i class="fas fa-chevron-right"></i></span>
            </div>
        </div>
        <div class="swiper-container recommendation-products-carousel">
            <ul class="product-items swiper-wrapper">
            <?php
            foreach ( $query_posts as $product_id ) {
                $_product = is_numeric( $product_id ) ? wc_get_product( $product_id ) : $product_id;
                ?>
                <li class="product-item">
                    <a href="<?php echo esc_url( $_product->get_permalink() ); ?>">
                        <?php echo wp_kses_post( $_product->get_image( 'woocommerce_thumbnail' ) ); ?>
                        <span class="product-title"><?php echo wp_kses_post( $_product->get_name() ); ?></span>
                        <span class="product-price"><?php echo wp_kses_post( $_product->get_price_html() ); ?></span>
                    </a>
                </li>

                <?php
            }

            echo '	</ul>';
        echo '</div>';

    }

    /**
    * Get notices script data
    *
    * @since 1.0.0
    *
    * @param $data
    *
    * @return array
    */
    public function notices_script_data( $data ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cart_notify = isset($templaza_options['templaza-shop-notify'])?$templaza_options['templaza-shop-notify']:'panel';
        $cart_notify_autohide = isset($templaza_options['templaza-shop-notify-autohide'])?$templaza_options['templaza-shop-notify-autohide']:'3';
        if ( $cart_notify == 'simple' ) {
            $data['added_to_cart_notice'] = array(
                'added_to_cart_text'              => esc_html__( 'has been added to your cart.', 'agruco' ),
                'successfully_added_to_cart_text' => esc_html__( 'Successfully added to your cart.', 'agruco' ),
                'cart_view_text'                  => esc_html__( 'View Cart', 'agruco' ),
                'cart_view_link'                  => function_exists( 'wc_get_cart_url' ) ? esc_url( wc_get_cart_url() ) : '',
                'cart_notice_auto_hide'           => intval( $cart_notify_autohide ) > 0 ? intval( $cart_notify_autohide ) * 1000 : 0,
            );
        }

        if ( $cart_notify != 'none' ) {
            $data['added_to_cart_notice']['added_to_cart_notice_layout'] = $cart_notify;
        }
        $wishlist_notify      = isset($templaza_options['templaza-shop-notify-wishlist'])?filter_var($templaza_options['templaza-shop-notify-wishlist'], FILTER_VALIDATE_BOOLEAN):false;
        $wishlist_notify_autohide = isset($templaza_options['templaza-shop-notify-wishlist-autohide'])?$templaza_options['templaza-shop-notify-wishlist-autohide']:'3';
        if ( $wishlist_notify && defined( 'YITH_WCWL' ) ) {
            $data['added_to_wishlist_notice'] = array(
                'added_to_wishlist_text'    => esc_html__( 'has been added to your wishlist.', 'agruco' ),
                'added_to_wishlist_texts'   => esc_html__( 'have been added to your wishlist.', 'agruco' ),
                'wishlist_view_text'        => esc_html__( 'View Wishlist', 'agruco' ),
                'wishlist_view_link'        => esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ),
                'wishlist_notice_auto_hide' => intval( $wishlist_notify_autohide ) > 0 ? intval( $wishlist_notify_autohide ) * 1000 : 0,
            );
        }

        return $data;
    }

    /**
	 * Cart count notice
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function widget_shopping_cart_count_notice() {
		echo '<span class="woocommerce-mini-cart__count_notice hidden">';
		$count = WC()->cart->get_cart_contents_count();
		echo sprintf( 'There %s %s %s in your cart', _n( 'are', 'is', $count > 1, 'agruco' ), $count, _n( 'items', 'item', $count > 1, 'agruco' ) );
		echo '</span>';
	}
}
Templaza_Woo_Notices::get_instance();