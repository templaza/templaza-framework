<?php
/**
 * Product Loop template hooks.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use TemPlaza_Woo\Templaza_Woo_Helper;
use TemPlazaFramework\Functions;
/**
 * Class of Product Loop
 */
class Templaza_Product_Loop {
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
		if(is_admin()) {
			add_action( 'init', array( $this, 'product_loop_content_hooks' ));
		} else {
			add_action( 'wp', array( $this, 'product_loop_content_hooks' ), 10 );
		}
	}

	/**
	 * Loop hook.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_content_hooks() {
		// variables
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $attributes       = isset($templaza_options['templaza-shop-loop-attributes'])?$templaza_options['templaza-shop-loop-attributes']:'';
		// Remove wrapper link
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

		// Product inner wrapper
		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'product_wrapper_open' ), 10 );
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'product_wrapper_close' ), 1000 );


		// Change product thumbnail.
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'product_loop_thumbnail' ), 1 );

		// Group elements bellow product thumbnail.
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'summary_wrapper_open' ), 1 );
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'summary_wrapper_close' ), 1000 );

		// Change the product title.
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
		add_action( 'woocommerce_shop_loop_item_title', array(
            TemPlaza_Woo\Templaza_Woo_Helper::instance(),
			'templaza_product_loop_title'
		) );

		// Remove add to cart
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

		// Remove rating
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		if ( is_array($attributes) && $attributes['rating']=='1' ) {
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 20 );
		}

		if ( is_array($attributes) && $attributes['taxonomy']=='1' ) {
			add_action( 'woocommerce_shop_loop_item_title', array(
				$this,
				'product_loop_category'
			), 5 );
		}

		// Change add to cart link
		add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'add_to_cart_link' ), 20, 3 );

		// Add more class to loop start.
		add_filter( 'woocommerce_product_loop_start', array( $this, 'loop_start' ), 5 );

		// Product Loop Layout
		$this->product_loop_layout();

		add_action( 'wc_ajax_templaza_product_loop_form', array( $this, 'product_loop_form_ajax' ) );

		add_filter( 'templaza_wp_script_data', array( $this, 'loop_script_data' ) );

	}

	/**
	 * Loop start.
	 *
	 * @since 1.0.0
	 *
	 * @param string $html Open loop wrapper with the <ul class="products"> tag.
	 *
	 * @return string
	 */
	public function loop_start( $html ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $shop_layout    = isset($templaza_options['templaza-shop-layout'])?$templaza_options['templaza-shop-layout']:'grid';
        $shop_col       = isset($templaza_options['templaza-shop-column'])?$templaza_options['templaza-shop-column']:3;
        $shop_col_gap   = isset($templaza_options['templaza-shop-column-gap'])?$templaza_options['templaza-shop-column-gap']:'';
		$html            = '';
		$products_layout = TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_catalog_layout();
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
		$classes = array(
			'products'
		);

		$loop_layout = TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_product_loop_layout();

		$class_layout = $loop_layout == 'layout-3' ? 'layout-2' : $loop_layout;

		$classes[] = 'product-loop-' . $class_layout;

		if ( $loop_layout == 'layout-3' ) {
			$classes[] = 'product-loop-layout-3';
		}

		$classes[] = $loop_layout == 'layout-3' ? 'has-quick-view' : '';

		$classes[] = in_array( $loop_layout, array( 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7' ) ) ? 'product-loop-center' : '';

		if ( in_array( $loop_layout, array( 'layout-2', 'layout-3', 'layout-9' ) ) ) {
            $loop_wishlist           = isset($templaza_options['templaza-shop-loop-wishlist'])?filter_var($templaza_options['templaza-shop-loop-wishlist'], FILTER_VALIDATE_BOOLEAN):true;
            if($loop_wishlist){
                $classes[] = 'show-wishlist';
            }else{
                $classes[] = ' ';
            }
		}

		if ( in_array( $loop_layout, array( 'layout-8', 'layout-9' ) ) ) {
            $loop_variation           = isset($templaza_options['templaza-shop-loop-variation'])?filter_var($templaza_options['templaza-shop-loop-variation'], FILTER_VALIDATE_BOOLEAN):true;
            if($loop_variation){
                $classes[] = 'has-variations-form';
            }else{
                $classes[] = ' ';
            }
		}

		$classes[] = TemPlaza_Woo\Templaza_Woo_Helper::templaza_is_catalog() ? '' . $products_layout : '';
		$classes[] = 'columns-' . wc_get_loop_prop( 'columns' );
		$classes[] = 'uk-child-width-1-' . wc_get_loop_prop( 'columns' ).'@l';
		$classes[] = 'uk-child-width-1-' . wc_get_loop_prop( 'large_columns' ).'@xl';
		$classes[] = 'uk-child-width-1-' . wc_get_loop_prop( 'laptop_columns' ).'@m';
		$classes[] = 'uk-child-width-1-' . wc_get_loop_prop( 'tablet_columns' ).'@s';
		$classes[] = 'uk-child-width-1-' . wc_get_loop_prop( 'mobile_columns' ).'';
		$classes[] = 'uk-grid-' . wc_get_loop_prop( 'column_gap' ).'';

		if ( $mobile_pl_col = intval( get_option( 'mobile_landscape_product_columns' ) ) ) {
			$classes[] = 'mobile-pl-col-' . $mobile_pl_col;
		}

		if ( $mobile_pp_col = intval( get_option( 'mobile_portrait_product_columns' ) ) ) {
			$classes[] = 'mobile-pp-col-' . $mobile_pp_col;
		}

		if ( intval( get_option( 'mobile_product_loop_atc' ) )
		     || in_array( $loop_layout, array(
				'layout-3',
				'layout-6',
				'layout-8',
			) ) ) {
			$classes[] = 'mobile-show-atc';
		}

		if ( intval( get_option( 'mobile_product_featured_icons' ) ) ) {
			$classes[] = 'mobile-show-featured-icons';
		}

		$html .= '<ul  class=" uk-grid-'.esc_attr($shop_col_gap).' ' . esc_attr( implode( ' ', $classes ) ) . '" data-uk-grid> ';

		return $html;
	}

	/**
	 * Product loop layout
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_layout() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $featured_icons       = isset($templaza_options['templaza-shop-loop-featured-icons'])?$templaza_options['templaza-shop-loop-featured-icons']:'';

		$featured_icons = apply_filters( 'templaza_get_product_loop_featured_icons', $featured_icons );

		$loop_layout    = TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_product_loop_layout();
		$attributes = isset($templaza_options['templaza-shop-loop-attributes'])?$templaza_options['templaza-shop-loop-attributes']:'';
        $loop_desc     = isset($templaza_options['templaza-shop-loop-description'])?filter_var($templaza_options['templaza-shop-loop-description'], FILTER_VALIDATE_BOOLEAN):true;
        $loop_variation     = isset($templaza_options['templaza-shop-loop-variation'])?filter_var($templaza_options['templaza-shop-loop-variation'], FILTER_VALIDATE_BOOLEAN):true;
        $loop_variation_ajax     = isset($templaza_options['templaza-shop-loop-variation-ajax'])?filter_var($templaza_options['templaza-shop-loop-variation-ajax'], FILTER_VALIDATE_BOOLEAN):true;
		switch ( $loop_layout ) {

			// Icons & Quick view button
			case 'layout-2':
				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_open'
				), 5 );

				if (!empty($featured_icons) && $featured_icons['wishlist']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_wishlist_button'
					), 10 );
				}

				if (!empty($featured_icons) && $featured_icons['cart']=='1'  ) {
				    if(function_exists('woocommerce_template_loop_add_to_cart')) {
                        add_action('templaza_product_loop_thumbnail', 'woocommerce_template_loop_add_to_cart', 20);
                    }
				}

				if (!empty($featured_icons) && $featured_icons['quickview']=='1'  ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 30 );
				}

				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_close'
				), 100 );

				if (!empty($featured_icons) && $featured_icons['quickview']=='1'  ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 115 );
				}

				if ( intval( get_option( 'mobile_product_loop_atc' ) ) && function_exists('woocommerce_template_loop_add_to_cart') ) {
					add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 50 );
				}

				break;
			// Icons over thumbnail on hover
			case 'layout-3':
				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_open'
				), 5 );

				if (!empty($featured_icons) && $featured_icons['wishlist']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_wishlist_button'
					), 10 );
				}

				if (!empty($featured_icons) && $featured_icons['quickview']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 20 );
				}

				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_close'
				), 100 );

				if (!empty($attributes) && $attributes['rating']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
					remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 20 );
				}

				if (!empty($featured_icons) && $featured_icons['cart']=='1' && function_exists('woocommerce_template_loop_add_to_cart') ) {
					add_action( 'templaza_product_loop_thumbnail', 'woocommerce_template_loop_add_to_cart', 110 );
					add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 50 );
				}

				break;
			// Icons on the bottom
			case 'layout-4':
				add_action( 'woocommerce_after_shop_loop_item', array(
					$this,
					'product_loop_buttons_open'
				), 5 );

				if (!empty($featured_icons) && $featured_icons['cart']=='1' && function_exists('woocommerce_template_loop_add_to_cart') ) {
					add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
					add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 50 );
				}

				if (!empty($featured_icons) && $featured_icons['quickview']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 15 );
				}
				if (!empty($featured_icons) && $featured_icons['wishlist']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_wishlist_button'
					), 20 );
				}

				add_action( 'woocommerce_after_shop_loop_item', array(
					$this,
					'product_loop_buttons_close'
				), 30 );

				break;
			// Simple
			case 'layout-5':
				break;
			// Standard button
			case 'layout-6':
				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_open'
				), 5 );

				if (!empty($featured_icons) && $featured_icons['quickview']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 15 );
				}
				if (!empty($featured_icons) && $featured_icons['wishlist']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_wishlist_button'
					), 20 );
				}

				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_close'
				), 100 );

				if (!empty($featured_icons) && $featured_icons['cart']=='1' ) {
				    if(function_exists('woocommerce_template_loop_add_to_cart')) {
                        add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 20);
                    }
				}

				add_action( 'woocommerce_after_shop_loop_item_title', array(
					$this,
					'product_loop_space'
				), 30 );

				if ( $loop_desc ) {
					add_action( 'woocommerce_after_shop_loop_item_title', array(
						$this,
						'product_loop_desc'
					), 30 );
				}
				break;

			// Info on hover
			case 'layout-7':
				add_action( 'woocommerce_after_shop_loop_item', array(
					$this,
					'product_loop_buttons_open'
				), 5 );

				if ( $featured_icons['cart']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
				}

				if (!empty($featured_icons) && $featured_icons['quickview']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 15 );
				}
				if (!empty($featured_icons) && $featured_icons['wishlist']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_wishlist_button'
					), 20 );
				}

				add_action( 'woocommerce_after_shop_loop_item', array(
					$this,
					'product_loop_buttons_close'
				), 30 );

				if ( intval( get_option( 'mobile_product_loop_atc' ) ) ) {
					add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 50 );
				}
				break;

			// Icons & Add to cart text
			case 'layout-8':
				// add loop top
				add_action( 'woocommerce_shop_loop_item_title', array(
					$this,
					'template_loop_top_open'
				), 1 );
				add_action( 'woocommerce_shop_loop_item_title', array(
					$this,
					'template_loop_cat_title_close'
				), 25 );
				add_action( 'woocommerce_after_shop_loop_item_title', array(
					$this,
					'template_loop_top_close'
				), 15 );

				// Add loop buttons
				add_action( 'woocommerce_after_shop_loop_item', array(
					$this,
					'product_loop_buttons_open'
				), 5 );

				// Add variation
				if ( $loop_variation ) {
					add_action( 'woocommerce_after_shop_loop_item', array(
						$this,
						'display_variation_dropdown'
					), 5 );

					add_filter( 'woocommerce_product_add_to_cart_text', array(
						$this,
						'product_variable_add_to_cart_text'
					), 5 );

					add_action( 'woocommerce_after_shop_loop_item', array(
						$this,
						'product_loop_quick_shop'
					), 40 );

					add_action( 'woocommerce_after_shop_loop_item', array(
						$this,
						'close_variation_form'
					), 15 );
				}

				if (!empty($featured_icons) && $featured_icons['cart']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
				}

				// Variation buttons on mobile
				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_inner_buttons_open'
				), 5 );

				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_inner_buttons_close'
				), 100 );

                if (!empty($featured_icons) && $featured_icons['wishlist']=='1' ) {
                    add_action( 'woocommerce_after_shop_loop_item', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
                        'templaza_wishlist_button'
                    ), 20 );

                    add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
                        'templaza_wishlist_button'
                    ), 20 );
                }

				if (!empty($featured_icons) && $featured_icons['quickview']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 25 );

					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 25 );
				}


				add_action( 'woocommerce_after_shop_loop_item', array(
					$this,
					'product_loop_buttons_close'
				), 30 );

				break;
			// Quick Shop
			case 'layout-9':
				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_open'
				), 5 );

				if (!empty($featured_icons) && $featured_icons['wishlist']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_wishlist_button'
					), 10 );
				}

				if (!empty($featured_icons) && $featured_icons['quickview']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 20 );
				}

				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_close'
				), 100 );

				// Add variation
				if ( $loop_variation ) {
					// Add loop buttons
					add_action( 'woocommerce_after_shop_loop_item', array(
						$this,
						'product_loop_form_open'
					), 5 );

					if ( $loop_variation_ajax==false ) {
						add_action( 'woocommerce_after_shop_loop_item', array(
							$this,
							'display_variation_dropdown'
						), 10 );
					}

					add_filter( 'woocommerce_product_add_to_cart_text', array(
						$this,
						'product_variable_add_to_cart_text'
					), 5 );

					add_action( 'woocommerce_after_shop_loop_item', array(
						$this,
						'close_variation_form'
					), 15 );


					add_action( 'woocommerce_after_shop_loop_item', array(
						$this,
						'product_loop_form_close'
					), 30 );
				}

				if (!empty($featured_icons) && $featured_icons['cart']=='1' ) {
					add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 40 );

					if ( $loop_variation ) {
						add_action( 'woocommerce_after_shop_loop_item', array(
							$this,
							'product_loop_quick_shop'
						), 40 );
					}
				}

				break;

			// Icons over thumbnail on hover
			default:
				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_open'
				), 5 );

				if (!empty($featured_icons) && $featured_icons['cart']=='1' ) {
				    if(function_exists('woocommerce_template_loop_add_to_cart')) {
                        add_action('templaza_product_loop_thumbnail', 'woocommerce_template_loop_add_to_cart', 10);
                    }
				}

				if (!empty($featured_icons) &&  $featured_icons['quickview']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_quick_view_button'
					), 15 );
				}
				if ( !empty($featured_icons) && $featured_icons['wishlist']=='1' ) {
					add_action( 'templaza_product_loop_thumbnail', array(
                        TemPlaza_Woo\Templaza_Woo_Helper::instance(),
						'templaza_wishlist_button'
					), 20 );
				}

				add_action( 'templaza_product_loop_thumbnail', array(
					$this,
					'product_loop_buttons_close'
				), 100 );

				if (!empty($attributes) && $attributes['rating']=='1' ) {
					add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
					remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 20 );
				}

				if (!empty($attributes) &&  $attributes['taxonomy']=='1' ) {
					remove_action( 'woocommerce_shop_loop_item_title', array( $this, 'product_loop_category' ), 5 );
					add_action( 'woocommerce_shop_loop_item_title', array( $this, 'product_loop_category' ), 5 );
				}

				if ( intval( get_option( 'mobile_product_loop_atc' ) ) ) {
				    if(function_exists('woocommerce_template_loop_add_to_cart')) {
                        add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 50);
                    }
				}

				break;
		}
	}

	/**
	 * Product loop form AJAX
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_form_ajax() {
		if ( empty( $_POST['product_id'] ) ) {
			exit;
		}
		$original_post   = $GLOBALS['post'];
		$product         = wc_get_product( $_POST['product_id'] );
		$GLOBALS['post'] = get_post( $_POST['product_id'] );
		setup_postdata( $GLOBALS['post'] );
		ob_start();

		// Get Available variations?
		$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

		// Load the template.
        get_template_part( 'helpers/woocommerce/template-parts/add-to-cart-variable',
			array(
				'available_variations' => $get_variations ? $product->get_available_variations() : false,
				'attributes'           => $product->get_variation_attributes(),
				'selected_attributes'  => $product->get_default_attributes(),
			)
		);
		$output = ob_get_clean();

		$GLOBALS['post'] = $original_post; // WPCS: override ok.
		wp_reset_postdata();

		wp_send_json_success( $output );
		exit;
	}

	/**
	 * Open product wrapper.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_wrapper_open() {
		echo '<div class="product-inner">';
	}

	/**
	 * Close product wrapper.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_wrapper_close() {
		echo '</div>';
	}

	/**
	 * Open product summary wrapper.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function summary_wrapper_open() {
		echo '<div class="product-summary">';
	}

	/**
	 * Close product summary wrapper.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function summary_wrapper_close() {
		echo '</div>';
	}

	/**
	 * Open product Loop buttons.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_buttons_open() {
		echo '<div class="product-loop__buttons">';
	}

	/**
	 * Close product Loop buttons.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_buttons_close() {
		echo '</div>';
	}

	/**
	 * Product thumbnail wrapper.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_thumbnail() {
		global $product;
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $loop_hover = isset($templaza_options['templaza-shop-loop-hover'])?$templaza_options['templaza-shop-loop-hover']:'';

		$loop_layout = TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_product_loop_layout();

		$product_hover = $loop_layout == 'layout-7' ? 'classic' : $loop_hover;
		$product_hover = apply_filters( 'templaza_get_product_loop_hover', $product_hover );

		switch ( $product_hover ) {
			case 'slider':
				$image_ids  = $product->get_gallery_image_ids();
				$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );

				if ( $image_ids ) {
					echo '<div class="product-thumbnail product-thumbnails--slider swiper-container">';
					echo '<div class="swiper-wrapper">';
				} else {
					echo '<div class="product-thumbnail">';
				}

				woocommerce_template_loop_product_link_open();
				woocommerce_template_loop_product_thumbnail();
				woocommerce_template_loop_product_link_close();

				foreach ( $image_ids as $image_id ) {
					$src = wp_get_attachment_image_src( $image_id, $image_size );

					if ( ! $src ) {
						continue;
					}

					woocommerce_template_loop_product_link_open();

					printf(
						'<img data-src="%s" width="%s" height="%s" alt="%s" class="swiper-lazy">',
						esc_url( $src[0] ),
						esc_attr( $src[1] ),
						esc_attr( $src[2] ),
						esc_attr( $product->get_title() )
					);

					woocommerce_template_loop_product_link_close();
				}
				if ( $image_ids ) {
					echo '</div>';
					echo '<span class="rz-product-loop-swiper-prev rz-swiper-button"><i class="fas fa-chevron-left"></i></span>';
					echo '<span class="rz-product-loop-swiper-next rz-swiper-button"><i class="fas fa-chevron-right"></i></span>';
				}
				do_action( 'templaza_product_loop_thumbnail' );
				echo '</div>';
				break;
			case 'fadein':
				$image_ids = $product->get_gallery_image_ids();

				if ( ! empty( $image_ids ) ) {
					echo '<div class="product-thumbnail">';
					echo '<div class="product-thumbnails--hover">';
				} else {
					echo '<div class="product-thumbnail">';
				}

				woocommerce_template_loop_product_link_open();
				woocommerce_template_loop_product_thumbnail();

				if ( ! empty( $image_ids ) ) {
					$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );
					echo wp_get_attachment_image( $image_ids[0], $image_size, false, array( 'class' => 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail hover-image' ) );
				}

				woocommerce_template_loop_product_link_close();
				if ( ! empty( $image_ids ) ) {
					echo '</div>';
				}
				do_action( 'templaza_product_loop_thumbnail' );
				echo '</div>';
				break;
			case 'zoom';
				echo '<div class="product-thumbnail">';
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

				if ( $image ) {
					$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
					echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link product-thumbnail-zoom" data-zoom_image="' . esc_attr( $image[0] ) . '">';
				} else {
					woocommerce_template_loop_product_link_open();
				}
				woocommerce_template_loop_product_thumbnail();
				woocommerce_template_loop_product_link_close();
				do_action( 'templaza_product_loop_thumbnail' );
				echo '</div>';
				break;
			default:
				echo '<div class="product-thumbnail">';
				woocommerce_template_loop_product_link_open();
				woocommerce_template_loop_product_thumbnail();
				woocommerce_template_loop_product_link_close();
				do_action( 'templaza_product_loop_thumbnail' );
				echo '</div>';
				break;
		}
	}

	/**
	 * Category name
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_category() {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }

		$taxonomy = isset($templaza_options['templaza-shop-loop-taxonomy'])?$templaza_options['templaza-shop-loop-taxonomy']:'';
        TemPlaza_Woo\Templaza_Woo_Helper::templaza_product_taxonomy( $taxonomy );
	}

	/**
	 * Product loop Description
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_space() {
		echo sprintf( '<div class="woocommerce-product-loop_space"></div>' );
	}


	/**
	 * Product loop Description
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_desc() {
		global $post;

		$short_description = $post ? $post->post_excerpt : '';

		if ( ! $short_description ) {
			return;
		}
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $loop_desc_length       = isset($templaza_options['templaza-shop-loop-description-length'])?$templaza_options['templaza-shop-loop-description-length']:'10';

		$length = intval( $loop_desc_length );
		if ( $length ) {
			$short_description = wp_trim_words( $short_description, $length, '...');
		}

		echo sprintf( '<div class="woocommerce-product-details__short-description"> %s</div>', $short_description );
	}

	/**
	 * Open product Loop form.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_form_open() {
		global $product;

		if ( ! $product->is_type( 'variable' ) ) {
			return;
		}

		echo '<div class="product-loop__form">';
	}

	/**
	 * Close product Loop form.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_form_close() {
		global $product;

		if ( ! $product->is_type( 'variable' ) ) {
			return;
		}
		echo '</div>';
	}

	/**
	 * Open product Loop buttons.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_inner_buttons_open() {
		echo '<div class="product-loop-inner__buttons">';
	}

	/**
	 * Close product Loop buttons.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_inner_buttons_close() {
		echo '</div>';
	}

	/**
	 * Quick shop button.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_loop_quick_shop() {
		global $product;

		if ( ! $product->is_type( 'variable' ) ) {
			return;
		}

		echo sprintf(
			'<a href="#" class="product-quick-shop-button templaza-button" data-product_id="%s" >%s%s</a>',
			esc_attr( $product->get_id() ),
			'<i class="fas fa-cart"></i>',
			esc_html__( 'Quick Shop', 'agruco' )
		);
	}

	/**
	 * Close variation form
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function close_variation_form() {
		global $product;

		if ( ! $product->is_type( 'variable' ) ) {
			return;
		}

		echo sprintf(
			'<a href="#" class="product-close-variations-form ">%s</a>',
			'<i class="fas fa-close"></i>'
		);
	}

	/**
	 * Open product loop top.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function template_loop_top_open() {
		echo '<div class="product-loop__top"><div class="product-loop__cat-title">';
	}

	/**
	 * Close product Loop  cat & title.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function template_loop_cat_title_close() {
		echo '</div>';
	}

	/**
	 * Close product Loop buttons.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function template_loop_top_close() {
		echo '</div>';
	}

	/**
	 * Product add to cart
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function add_to_cart_link( $html, $product, $args ) {
		return sprintf(
			'<a href="%s" data-quantity="%s" class="%s tz-loop-button tz-loop_atc_button" %s data-text="%s" data-title="%s" >%s<span class="add-to-cart-text loop_button-text">%s</span></a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() ),
			esc_html( $product->get_title() ),
			'<i class="fas fa-shopping-cart"></i>',
			esc_html( $product->add_to_cart_text() )
		);
	}

	/**
	 * Variation loop
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function display_variation_dropdown() {
		global $product;

		if ( ! $product->is_type( 'variable' ) ) {
			return;
		}

		// Get Available variations?
		$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

		// Load the template.
		wc_get_template(
			'loop/add-to-cart-variable.php',
			array(
				'available_variations' => $get_variations ? $product->get_available_variations() : false,
				'attributes'           => $product->get_variation_attributes(),
				'selected_attributes'  => $product->get_default_attributes(),
			)
		);
	}

	/**
	 * Variable add to cart loop
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function product_variable_add_to_cart_text( $text ) {
		global $product;

		if ( ! $product->is_type( 'variable' ) ) {
			return $text;
		}

		if ( $product->is_purchasable() ) {
			$text = esc_html__( 'Add to cart', 'agruco' );

		}

		return $text;
	}

	/**
	 * Catalog script data.
	 *
	 * @since 1.0.0
	 *
	 * @param $data
	 *
	 * @return array
	 */
	public function loop_script_data( $data ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $loop_variation     = isset($templaza_options['templaza-shop-loop-variation'])?filter_var($templaza_options['templaza-shop-loop-variation'], FILTER_VALIDATE_BOOLEAN):true;
        $loop_variation_ajax     = isset($templaza_options['templaza-shop-loop-variation-ajax'])?filter_var($templaza_options['templaza-shop-loop-variation-ajax'], FILTER_VALIDATE_BOOLEAN):true;
        $loop_hover       = isset($templaza_options['templaza-shop-loop-hover'])?$templaza_options['templaza-shop-loop-hover']:'classic';
        if ( in_array( TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_product_loop_layout(), array( 'layout-8', 'layout-9' ) ) ) {
			$data['product_loop_layout'] = TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_product_loop_layout();
			if ( $loop_variation ) {
				$data['product_loop_variation'] = 1;
			}

			if (  TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_product_loop_layout() == 'layout-9' && $loop_variation_ajax ) {
				$data['product_loop_variation_ajax'] = 1;
			}
		}

		if ( 'zoom' == $loop_hover && wp_script_is( 'zoom', 'registered' ) ) {
			$data['product_loop_hover'] = 'zoom';
		}

		return $data;
	}
}
Templaza_Product_Loop::get_instance();