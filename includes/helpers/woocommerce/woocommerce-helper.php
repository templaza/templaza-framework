<?php
namespace TemPlaza_Woo;

use TemPlazaFramework\Functions;

/**
 * Class of Woocommerce Helper
 *
 */
class Templaza_Woo_Helper {
    /**
     * Instance
     *
     * @var $instance
     */
    protected static $instance = null;

    /**
     * Product loop
     *
     * @var $product_loop
     */
    protected static $product_loop = null;

    /**
     * Initiator
     *
     * @since 1.0.0
     * @return object
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Get shop page base URL
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return string
     */
    function templaza_get_page_base_url() {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
            $link = get_post_type_archive_link( 'product' );
        } elseif ( is_product_category() ) {
            $link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
        } elseif ( is_product_tag() ) {
            $link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
        } else {
            $queried_object = get_queried_object();
            $link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
        }

        return apply_filters( 'templaza_get_page_base_url', $link );
    }

    public static function templaza_is_catalog() {
        if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_tax( 'product_collection' ) || is_tax( 'product_condition' ) ) ) {
            return true;
        }

        return false;
    }

    /**
     * Get catalog layout
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return string
     */

    public static function templaza_get_catalog_layout() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $layout       = isset($templaza_options['templaza-shop-layout'])?$templaza_options['templaza-shop-layout']:'grid';
        return apply_filters( 'templaza_get_catalog_layout', $layout );
    }

    /**
     * Get product loop layout
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return string
     */
    public static function templaza_get_product_loop_layout() {
        if ( is_null( self::$product_loop ) ) {
            if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
                $templaza_options = array();
            }else{
                $templaza_options = Functions::get_theme_options();
            }

            if(isset($_GET['product_loop'])){
                $layout = $_GET['product_loop'];
            }else{
                $layout       = isset($templaza_options['templaza-shop-loop-layout'])?$templaza_options['templaza-shop-loop-layout']:'layout-1';
            }
            if ( self::templaza_get_catalog_layout() == 'masonry' && self::templaza_is_catalog() ) {
                $layout = 'layout-7';
            }
            $layout = apply_filters( 'templaza_get_product_loop_layout', $layout );
            self::$product_loop = $layout;
        }

        return self::$product_loop;
    }

    /**
     * Get product video
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return string
     */
    public static function templaza_get_product_video() {
        global $product;
        $video_image  = get_post_meta( $product->get_id(), 'video_thumbnail', true );
        $video_url    = get_post_meta( $product->get_id(), 'video_url', true );
        $video_width  = 1024;
        $video_height = 768;
        $video_html   = $video_class = '';

        if ( empty( $video_image ) ) {
            $video_thumb = wc_placeholder_img_src( 'shop_thumbnail' );
        } else {
            $video_thumb = wp_get_attachment_image_src( $video_image, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
            $video_thumb = $video_thumb[0];
        }

        if ( strpos( $video_url, 'youtube' ) !== false ) {
            $video_class = 'video-youtube';
        } elseif ( strpos( $video_url, 'vimeo' ) !== false ) {
            $video_class = 'video-vimeo';
        }

        // If URL: show oEmbed HTML
        if ( filter_var( $video_url, FILTER_VALIDATE_URL ) ) {

            $atts = array(
                'width'  => $video_width,
                'height' => $video_height
            );

            if ( $oembed = @wp_oembed_get( $video_url, $atts ) ) {
                $video_html = $oembed;
            } else {
                $atts = array(
                    'src'    => $video_url,
                    'width'  => $video_width,
                    'height' => $video_height
                );

                $video_html = wp_video_shortcode( $atts );

            }
        }
        if ( $video_html ) {
            $vid_html   = '<div class="templaza-video-wrapper ' . esc_attr( $video_class ) . '">' . $video_html . '</div>';
            $video_html = '<div data-thumb="' . esc_url( $video_thumb ) . '" class="woocommerce-product-gallery__image templaza-product-video">' . $vid_html . '</div>';
        }

        return $video_html;
    }

    /**
     * Get product taxonomy
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function templaza_product_taxonomy( $taxonomy = 'product_cat', $show_thumbnail = false ) {
        global $product;

        $taxonomy = empty($taxonomy) ? 'product_cat' : $taxonomy;
        $terms = get_the_terms( $product->get_id(), $taxonomy );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            if( $show_thumbnail ) {
                $thumbnail_id   = get_term_meta( $terms[0]->term_id, 'brand_thumbnail_id', true );
                $image = $thumbnail_id ? wp_get_attachment_image( $thumbnail_id, 'full' ) : '';
                echo sprintf(
                    '<a class="meta-cat" href="%s">%s</a>',
                    esc_url( get_term_link( $terms[0] ), $taxonomy ),
                    $image);
            } else {
                echo sprintf(
                    '<a class="meta-cat" href="%s">%s</a>',
                    esc_url( get_term_link( $terms[0] ), $taxonomy ),
                    esc_html( $terms[0]->name ) );
            }

        }
    }

    /**
     * Get product loop title
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function templaza_product_loop_title() {
        echo '<h2 class="woocommerce-loop-product__title">';
        woocommerce_template_loop_product_link_open();
        the_title();
        woocommerce_template_loop_product_link_close();
        echo '</h2>';
    }

    /**
     * Get wishlist button
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function templaza_wishlist_button() {
        if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
        }

    }

    /**
     * Get Quick view button
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function templaza_quick_view_button() {
        global $product;

        echo sprintf(
            '<a href="%s" class="quick-view-button tz-loop-button" data-target="quick-view-modal" data-toggle="modal" data-id="%d" data-text="%s">
				%s<span class="quick-view-text loop_button-text">%s</span>
			</a>',
            is_customize_preview() ? '#' : esc_url( get_permalink() ),
            esc_attr( $product->get_id() ),
            esc_attr__( 'Quick View', 'templaza-framework' ),
            '<i class="fas fa-eye"></i>',
            esc_html__( 'Quick View', 'templaza-framework' )
        );
    }

    /**
     * Get Product availability
     *
     * @static
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function templaza_product_availability() {
        global $product;

        $availability = $product->get_availability();

        if ( $availability['availability'] == '' ) {
            return;
        }

        echo '<div class="templaza-stock">(' . $availability['availability'] . ')</div>';
    }

    /**
     * Get IDs of the products that are set as new ones.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function templaza_get_new_product_ids() {
        // Load from cache.
        $product_ids = get_transient( 'templaza_woocommerce_products_new' );

        // Valid cache found.
        if ( false !== $product_ids && ! empty( $product_ids ) ) {
            return $product_ids;
        }

        $product_ids = array();

        // Get products which are set as new.
        $meta_query   = WC()->query->get_meta_query();
        $meta_query[] = array(
            'key'   => '_is_new',
            'value' => 'yes',
        );
        $new_products = new \WP_Query( array(
            'posts_per_page' => - 1,
            'post_type'      => 'product',
            'fields'         => 'ids',
            'meta_query'     => $meta_query,
        ) );

        if ( $new_products->have_posts() ) {
            $product_ids = array_merge( $product_ids, $new_products->posts );
        }

        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }

        $shop_badge_new   = isset($templaza_options['templaza-shop-badge-new'])?filter_var($templaza_options['templaza-shop-badge-new'], FILTER_VALIDATE_BOOLEAN):true;



        // Get products after selected days.
        if ( $shop_badge_new ) {
            $newness       = isset($templaza_options['templaza-shop-new-day'])?$templaza_options['templaza-shop-new-day']:5;

            if ( $newness > 0 ) {
                $new_products = new \WP_Query( array(
                    'posts_per_page' => - 1,
                    'post_type'      => 'product',
                    'fields'         => 'ids',
                    'date_query'     => array(
                        'after' => date( 'Y-m-d', strtotime( '-' . $newness . ' days' ) ),
                    ),
                ) );

                if ( $new_products->have_posts() ) {
                    $product_ids = array_merge( $product_ids, $new_products->posts );
                }
            }
        }

        set_transient( 'templaza_woocommerce_products_new', $product_ids, DAY_IN_SECONDS );

        return $product_ids;
    }
    /**
     * Setup the theme Woocommerce global variable.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function templaza_setup_prop( $args = array() ) {
        $default = array(
            'modals' => array(),
        );

        if ( isset( $GLOBALS['templaza_woo'] ) ) {
            $default = array_merge( $default, $GLOBALS['templaza_woo'] );
        }

        $GLOBALS['templaza_woo'] = wp_parse_args( $args, $default );
    }
    /**
     * Get a propery from the global variable.
     *
     * @param string $prop Prop to get.
     * @param string $default Default if the prop does not exist.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function templaza_get_prop( $prop, $default = '' ) {
        self::templaza_setup_prop(); // Ensure the global variable is setup.

        return isset( $GLOBALS['templaza_woo'], $GLOBALS['templaza_woo'][ $prop ] ) ? $GLOBALS['templaza_woo'][ $prop ] : $default;
    }

    public static function templaza_posts_found() {
        global $wp_query;

        if ( $wp_query && isset( $wp_query->found_posts ) ) {

            $post_text = $wp_query->found_posts > 1 ? esc_html__( 'posts', 'templaza-framework' ) : esc_html__( 'post', 'templaza-framework' );

            if ( self::templaza_is_catalog() ) {
                $post_text = $wp_query->found_posts > 1 ? esc_html__( 'products', 'templaza-framework' ) : esc_html__( 'product', 'templaza-framework' );
            }

            echo sprintf( '<div class="templaza-posts__found uk-margin-medium-top"><div class="templaza-posts__found-inner">%s<span class="current-post"> %s </span> %s <span class="found-post"> %s </span> %s <span class="count-bar"></span></div> </div>',
                esc_html__( 'Showing', 'templaza-framework' ), $wp_query->post_count, esc_html__( 'of', 'templaza-framework' ), $wp_query->found_posts, $post_text );

        }
    }
    public static function templaza_set_prop( $prop, $value = '' ) {
        if ( ! isset( $GLOBALS['templaza_woo'] ) ) {
            self::templaza_setup_prop();
        }

        if ( ! isset( $GLOBALS['templaza_woo'][ $prop ] ) ) {
            $GLOBALS['templaza_woo'][ $prop ] = $value;

            return;
        }

        if ( is_array( $GLOBALS['templaza_woo'][ $prop ] ) ) {
            if ( is_array( $value ) ) {
                $GLOBALS['templaza_woo'][ $prop ] = array_merge( $GLOBALS['templaza_woo'][ $prop ], $value );
            } else {
                $GLOBALS['templaza_woo'][ $prop ][] = $value;
                array_unique( $GLOBALS['templaza_woo'][ $prop ] );
            }
        } else {
            $GLOBALS['templaza_woo'][ $prop ] = $value;
        }
    }
    /**
     * Functions that used to get coutndown texts
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_countdown_texts() {
        return apply_filters( 'templaza_get_countdown_texts', array(
            'days'    => esc_html__( 'Days', 'templaza-framework' ),
            'hours'   => esc_html__( 'Hours', 'templaza-framework' ),
            'minutes' => esc_html__( 'Minutes', 'templaza-framework' ),
            'seconds' => esc_html__( 'Seconds', 'templaza-framework' )
        ) );
    }
    /**
     * Check is product deals
     *
     * @since 1.0.0
     *
     * @return bool
     */
    public static function is_product_deal( $product ) {
        $product = is_numeric( $product ) ? wc_get_product( $product ) : $product;

        // It must be a sale product first
        if ( ! $product->is_on_sale() ) {
            return false;
        }

        // Only support product type "simple" and "external"
        if ( ! $product->is_type( 'simple' ) && ! $product->is_type( 'external' ) ) {
            return false;
        }

        $deal_quantity = get_post_meta( $product->get_id(), '_deal_quantity', true );

        if ( $deal_quantity > 0 ) {
            return true;
        }

        return false;
    }
}