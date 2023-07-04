<?php
/**
 * WooCommerce Sticky Add To Cart template hooks.
 */
use TemPlazaFramework\Functions;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of Sticky Add To Cart
 */
class Templaza_Woo_Sticky_ATC {
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
		// Sticky add to cart
        add_action( 'wp_footer', array( $this, 'sticky_single_add_to_cart' ) );

		add_filter( 'templaza_get_back_to_top', array( $this, 'get_back_to_top' ) );
	}

	/**
	 * Check has sticky add to cart
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	public function has_sticky_atc() {
		global $product;
        if(!empty($product)){
            if ( $product->is_purchasable() && $product->is_in_stock() ) {
                return true;
            } elseif ( $product->is_type( 'external' ) || $product->is_type( 'grouped' ) ) {
                return true;
            }
        }

		return false;
	}

	/**
	 * Add sticky add to cart HTML
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function sticky_single_add_to_cart() {
		global $product;
        if( !is_404()){

		if ( ! $this->has_sticky_atc() or ! is_singular('product')) {
			return;
		}
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cart_sticky_pos        = isset($templaza_options['templaza-shop-single-cart-sticky-pos'])?$templaza_options['templaza-shop-single-cart-sticky-pos']:'top';

		$product_avaiable = $product->is_purchasable() && $product->is_in_stock();

		$add_class = [
			'templaza-sticky-add-to-cart__content-button button templaza-button',
			'product_type_' . $product->get_type(),
			$product_avaiable ? 'add_to_cart_button' : '',
			$product->supports( 'ajax_add_to_cart' ) && $product_avaiable ? 'ajax_add_to_cart' : '',
		];


		$product_type    = $product->get_type();
		$sticky_class    = 'templaza-sticky-add-to-cart product-' . $product_type;
		$sticky_class    .= ' templaza-sticky-atc_' . $cart_sticky_pos;

		$variable_style = isset($templaza_options['templaza-shop-single-cart-sticky-atc-variable'])?$templaza_options['templaza-shop-single-cart-sticky-atc-variable']:'button';
		$sticky_class    .= $product->is_type( 'variable' ) ? ' product_variable_' . $variable_style : '';

		$post_thumbnail_id =  $product->get_image_id();

		if ( $post_thumbnail_id ) {
			$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
			$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
			$thumbnail_src     = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
			$alt_text          = trim( wp_strip_all_tags( get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true ) ) );
		} else {
			$thumbnail_src = wc_placeholder_img_src( 'gallery_thumbnail' );
			$alt_text      = esc_html__( 'Awaiting product image', 'templaza-framework' );
		}
		?>
        <section id="templaza-sticky-add-to-cart" class="<?php echo esc_attr( $sticky_class ) ?>">
            <div class="uk-container uk-container-large">
                <div class="templaza-sticky-add-to-cart__content">
				<div class="templaza-sticky-atc__product-image"><img src="<?php echo esc_url( $thumbnail_src[0] ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" data-o_src="<?php echo esc_url( $thumbnail_src[0] );?>"></div>
                    <div class="templaza-sticky-add-to-cart__content-product-info">
                        <div class="templaza-sticky-add-to-cart__content-title"><?php the_title(); ?></div>
                        <span class="templaza-sticky-add-to-cart__content-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
						<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
                    </div>

					<?php
					if ( $product->is_type( 'simple' ) ) {
						woocommerce_template_single_add_to_cart();
					} else {
						if ( $product->is_type( 'variable' ) && $variable_style == 'form' ) {
							woocommerce_template_single_add_to_cart();
						}

						echo sprintf( '<a href="%s" data-quantity="1" class="%s" data-product_id = "%s" data-text="%s" data-title="%s" rel="nofollow"> %s</a>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( implode( ' ', $add_class ) ),
							esc_attr( $product->get_id() ),
							esc_attr( $product->add_to_cart_text() ),
							esc_attr( $product->get_title() ),
							esc_html__( 'Add to cart', 'templaza-framework' ) );
					}
					?>
                </div>
            </div>
        </section><!-- .templaza-sticky-add-to-cart -->
		<?php
    }
	}

	/**
	 * Get back to top
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	public function get_back_to_top( $show ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cart_sticky_pos        = isset($templaza_options['templaza-shop-single-cart-sticky-pos'])?$templaza_options['templaza-shop-single-cart-sticky-pos']:'top';

        if( $cart_sticky_pos == 'bottom' ) {
            return false;
        }

        return $show;
    }

}
Templaza_Woo_Sticky_ATC::get_instance();