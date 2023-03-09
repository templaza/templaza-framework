<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use TemPlaza_Woo\Templaza_Woo_Helper;
use TemPlazaFramework\Functions;
/**
 * Class of Catalog page
 */
class Templaza_Woo_Catalog {
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
		add_filter( 'body_class', array( $this, 'body_class' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 20 );

		// Remove shop page title
		add_filter( 'woocommerce_show_page_title', '__return_false' );

		// Add div shop loop
		add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_content_open_wrapper' ), 60 );
		add_action( 'woocommerce_after_shop_loop', array( $this, 'shop_content_close_wrapper' ), 20 );

		// Add Catalog Banners Top
		add_action( 'woocommerce_before_shop_loop', array( $this, 'products_banners_top' ), 10 );
		add_action( 'woocommerce_before_shop_loop', array( $this, 'products_top_categories' ), 20 );

		// Catalog Toolbar
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

		// Catalog Products per page
        add_filter( 'loop_shop_columns', array( $this, 'templaza_products_per_row' ), 10 );
        add_filter( 'loop_shop_per_page', array( $this, 'templaza_products_per_page' ), 10 );

        // Remove Woo Breadcrumb
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

		if ( get_option( 'catalog_toolbar' ) ) {
			add_action( 'woocommerce_before_shop_loop', array( $this, 'products_toolbar' ), 40 );
		}

		if ( get_option( 'catalog_toolbar_filtered' ) ) {
			add_action( 'woocommerce_before_shop_loop', array( $this, 'products_filtered' ), 50 );
		}

		$toolbar_layout = apply_filters( 'templaza_get_catalog_toolbar_layout', get_option( 'catalog_toolbar_layout' ) );
		switch ( $toolbar_layout ) {
			case 'v1':
				switch ( get_option( 'catalog_toolbar_els' ) ) {
					case 'page_header':
						add_action( 'templaza_woocommerce_catalog_toolbar', array(
							$this,
							'product_breadcrumb_toolbar'
						), 10 );
						break;

					case 'result':
						add_action( 'templaza_woocommerce_catalog_toolbar', array(
							$this,
							'product_result_toolbar'
						), 30 );
						break;

				}

				add_action( 'templaza_woocommerce_catalog_toolbar', array( $this, 'products_ordering' ), 15 );

				add_action( 'templaza_woocommerce_catalog_toolbar', array( $this, 'products_filter_sidebar' ), 25 );

				break;

			case 'v2':
				add_action( 'templaza_woocommerce_catalog_toolbar', array( $this, 'products_filter' ), 15 );

				break;

			case 'v3':
				add_action( 'templaza_woocommerce_catalog_toolbar', array( $this, 'products_tabs' ), 15 );
				add_action( 'templaza_woocommerce_catalog_toolbar', array(
					$this,
					'toolbar_right_open_wrapper'
				), 20 );
				add_action( 'templaza_woocommerce_catalog_toolbar', array( $this, 'products_filter_button' ), 25 );
				if( intval(get_option('catalog_toolbar_products_sorting')) ) {
					add_action( 'templaza_woocommerce_catalog_toolbar', array( $this, 'products_ordering' ), 35 );
				}
				add_action( 'templaza_woocommerce_catalog_toolbar', array(
					$this,
					'toolbar_right_close_wrapper'
				), 100 );

				add_action( 'woocommerce_before_shop_loop', array( $this, 'products_filter' ), 45 );

				if ( 'modal' == get_option( 'catalog_toolbar_products_filter' ) ) {
                    TemPlaza_Woo\Templaza_Woo_Helper::templaza_set_prop( 'modals', 'filter' );
				}

				break;
		}

		add_action( 'wp_footer', array( $this, 'products_filter_modal' ) );

		// Pagination.
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );
		add_action( 'woocommerce_after_shop_loop', array( $this, 'pagination' ) );


		if ( get_option( 'taxonomy_description_position' ) == 'below' ) {
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
			add_action( 'woocommerce_after_main_content', 'woocommerce_taxonomy_archive_description', 5 );
		}

	}
    /**
     * Override theme default specification for product # per row
     */
	public function templaza_products_per_row( $cols ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cols       = isset($templaza_options['templaza-shop-column'])?$templaza_options['templaza-shop-column']:3;
        return $cols;
    }

    /**
     * Override theme default specification for product # per page
     */
	public function templaza_products_per_page( $cols ) {
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options = Functions::get_theme_options();
        }
        $cols       = isset($templaza_options['templaza-shop-products_per_page'])?$templaza_options['templaza-shop-products_per_page']:9;
        return $cols;
    }

	/**
	 * Add 'woocommerce-active' class to the body tag.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $classes CSS classes applied to the body tag.
	 *
	 * @return array $classes modified to include 'woocommerce-active' class.
	 */
	public function body_class( $classes ) {
		$classes[] = 'templaza-catalog-page';

		return $classes;
	}

	/**
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function scripts() {
		wp_register_script( 'sticky-kit', Functions::get_my_url() . '/assets/js/woo/sticky-kit.min.js', array( 'jquery' ), '1.1.3', true );

		if( get_option('catalog_sticky_sidebar') ) {
			wp_enqueue_script('sticky-kit');
		}

		wp_enqueue_script( 'templaza-product-catalog', Functions::get_my_url() . '/assets/js/woo/woo-catalog.js', array(
			'templaza-framework',
		), '20211209', true );

		$templaza_catalog_data = array(
			'filtered_price' => array(
				'min' => esc_html__( 'Min', 'templaza-framework' ),
				'max' => esc_html__( 'Max', 'templaza-framework' ),
			)
		);

		if ( intval( get_option( 'catalog_widget_collapse_content' ) ) && templaza_get_catalog_layout() == 'grid' ) {
			$templaza_catalog_data['catalog_widget_collapse_content'] = 1;
		}

		if ( intval( get_option( 'catalog_filters_sidebar_collapse_content' ) ) && get_option( 'catalog_toolbar_layout' ) == 'v3' ) {
			$templaza_catalog_data['catalog_filters_sidebar_collapse_content'] = 1;
		}

		$templaza_catalog_data = apply_filters('templaza_get_catalog_localize_data', $templaza_catalog_data);

		wp_localize_script(
			'templaza-product-catalog', 'templazaCatalogData', $templaza_catalog_data
		);

	}

	/**
	 * Open Shop Content
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function shop_content_open_wrapper() {
		echo '<div id="templaza-shop-container" class="templaza-shop-container">';
		echo '<div class="templaza-shop-filter uk-margin-bottom uk-flex uk-flex-right uk-hidden@m uk-text-right"><span class="shop-filter-btn"><i class="fas fa-sliders-h"></i> '.__('Filter','templaza-framework').'</span> </div>';
	}

	/**
	 * Close Shop Content
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function shop_content_close_wrapper() {
		echo '</div>';
	}

	/**
	 * Open toolbar right wrapper.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function toolbar_right_open_wrapper() {
		echo '<div class="catalog-toolbar-right">';
	}

	/**
	 * Close toolbar right wrapper.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function toolbar_right_close_wrapper() {
		echo '</div>';
	}

	/**
	 * Close toolbar right wrapper.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_banners_top() {
		if ( wc_get_loop_prop( 'is_shortcode' ) ) {
			return;
		}
		if ( ! TemPlaza_Woo\Templaza_Woo_Helper::templaza_is_catalog() ) {
			return;
		}

		if ( is_shop() && ! intval( get_option( 'shop_page_banners' ) ) ) {
			return;
		} elseif ( is_product_category() && ! intval( get_option( 'category_page_banners' ) ) ) {
			return;

		}

		$output = '';

		if ( function_exists( 'is_product_category' ) && is_product_category() ) {
			$queried_object = get_queried_object();
			$term_id        = $queried_object->term_id;
			$banners_ids    = get_term_meta( $term_id, 'templaza_cat_banners_id', true );
			$banners_links  = get_term_meta( $term_id, 'templaza_cat_banners_link', true );

			if ( $banners_ids ) {
				$thumbnail_ids = explode( ',', $banners_ids );
				$banners_links = explode( "\n", $banners_links );
				$i             = 0;
				foreach ( $thumbnail_ids as $thumbnail_id ) {
					if ( empty( $thumbnail_id ) ) {
						continue;
					}

					$image = wp_get_attachment_image( $thumbnail_id, 'full' );

					if ( empty( $image ) ) {
						continue;
					}
					if ( $image ) {
						$link = $link_html = '';

						if ( $banners_links && isset( $banners_links[ $i ] ) ) {
							$link = preg_replace( '/<br \/>/iU', '', $banners_links[ $i ] );
						}

						$output .= sprintf(
							'<li class="swiper-slide"><a href="%s">%s</a></li>',
							esc_url( $link ),
							$image
						);
					}

					$i ++;
				}
			}
		}

		if ( empty( $output ) ) {
			$banners = (array) get_option( 'shop_banners_images' );

			if ( $banners ) {
				foreach ( $banners as $banner ) {
					$image = isset( $banner['image'] ) && $banner['image'] ? wp_get_attachment_image( $banner['image'], 'full' ) : '';
					if ( ! $image ) {
						continue;
					}
					$output .= sprintf(
						'<li class="swiper-slide"><a href="%s">%s</a></li>',
						esc_url( isset( $banner['link_url'] ) && $banner['link_url'] ? $banner['link_url'] : '#' ),
						$image
					);
				}
			}
		}


		if ( ! empty( $output ) ) {
			echo sprintf( '<div id="catalog-header-banners" class="templaza-hide_on__mobile catalog-header-banners swiper-container"><ul class="list-images swiper-wrapper">%s</ul></div>', $output );
		}

	}

	/**
	 * Catalog products toolbar.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_toolbar() {
		if ( wc_get_loop_prop( 'is_shortcode' ) ) {
			return;
		}

		$classes = 'layout-' . get_option( 'catalog_toolbar_layout' );
		?>

        <div class="catalog-toolbar <?php echo esc_attr( $classes ); ?>">
			<?php do_action( 'templaza_woocommerce_catalog_toolbar' ); ?>
        </div>

		<?php
	}

	/**
	 * Displays product breadcrumb in toolbar
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_breadcrumb_toolbar() {
		$tag = get_option( 'catalog_page_header' ) != '' && in_array( 'title', get_option( 'catalog_page_header_els' ) ) ? 'h3' : 'h1';
		?>
        <div class="product-toolbar-breadcrumb clearfix">
			<?php
			the_archive_title( '<' . $tag . ' class="page-header__title">', '</' . $tag . '>' );
			?>
        </div>

		<?php
	}

	/**
	 * Displays products result in toolbar
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_result_toolbar() {
        TemPlaza_Woo\Templaza_Woo_Helper::templaza_posts_found();
	}

	/**
	 * Displays products filtered
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_filtered() {
		?>
        <div id="templaza-products-filter__activated" class="products-filter__activated"></div>
		<?php
	}


	/**
	 * Products pagination.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function pagination() {
		if ( wc_get_loop_prop( 'is_shortcode' ) ) {
			woocommerce_pagination();

			return;
		}
        if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
            $templaza_options = array();
        }else{
            $templaza_options            = Functions::get_theme_options();
        }
        $pagination_type        = isset($templaza_options['templaza-shop-pagination'])?$templaza_options['templaza-shop-pagination']:'number';

		if ( 'number' == $pagination_type ) {
			woocommerce_pagination();

		} else {

            TemPlaza_Woo\Templaza_Woo_Helper::templaza_posts_found();

			if ( get_next_posts_link() ) {

				$classes = array(
					'woocommerce-navigation',
					'next-posts-navigation',
					'ajax-navigation',
					'ajax-' . $pagination_type,
				);

				$classes[] = $pagination_type == 'scroll' ? 'loading' : '';

				$nav_html = sprintf( '<span class="button-text">%s</span>', esc_html__( 'Load More', 'templaza-framework' ) );

				echo '<nav class="' . esc_attr( implode( ' ', $classes ) ) . '">';
				echo '<div id="templaza-catalog-previous-ajax" class="nav-previous-ajax">';
				next_posts_link( $nav_html );
				echo '<div class="templaza-gooey-loading">
						<div class="templaza-gooey">
							<div class="dots">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</div>
					</div>';
				echo '</div>';
				echo '</nav>';
			}

		}
	}

	/**
	 * Catalog Top Categories
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_top_categories() {
		if ( ! is_shop() && ! is_product_category () ) {
			return;
		}

		if ( is_shop() && ! intval( get_option( 'top_categories_shop_page' ) ) ) {
			return;
		} elseif ( is_product_category() && ! intval( get_option( 'top_categories_category_page' ) ) ) {
			return;
		}

		$cats_number = get_option( 'catalog_top_categories_limit' );
		$cats_order  = get_option( 'catalog_top_categories_orderby' );
		$sub_cat     = get_option( 'catalog_top_categories_subcategories' );
		$count       = intval( get_option( 'catalog_top_categories_count' ) );

		if ( intval( $cats_number ) < 1 ) {
			return;
		}

		$terms = $this->get_terms_product_cat( $cats_number, $sub_cat, $cats_order );

		if ( is_wp_error( $terms ) || ! $terms ) {
			return;
		}

		$thumbnail_size_cropped = apply_filters( 'templaza_top_categories_thumbnail_size', array(
			'width'  => '250',
			'height' => '250'
		) );
		$thumbnail_size         = apply_filters( 'templaza_top_categories_thumbnail_size', 'full' );

		$output = array();
		foreach ( $terms as $term ) {

			$item_css     = '';
			$count_html   = $count ? sprintf( '<span class="count-category">(%s)</span>', $term->count ) : '';
			$thumbnail_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );

			$cat_content = '';
			if ( $thumbnail_id ) {
				$cat_content = $this->get_attachment_image_html( $thumbnail_id, $thumbnail_size_cropped, $thumbnail_size );

			} else {
				$item_css .= ' no-thumb';
			}

			$cat_content .= $term->name;
			$cat_content .= $count_html;

			$output[] = sprintf(
				'<li class="templaza-catalog-categories__item swiper-slide %s">' .
				'<a href="%s" class="templaza-catalog-categories__title">' .
				'%s' .
				'</a>' .
				'</li>',
				esc_attr( $item_css ),
				esc_url( get_term_link( $term->term_id, 'product_cat' ) ),
				$cat_content
			);
		}

		if ( $output ) {
			$columns = 5;
			if ( get_option( 'catalog_sidebar' ) != 'full-content' && templaza_get_catalog_layout() == 'grid' ) {
				$columns = 4;
			}
			$columns = apply_filters( 'templaza_top_categories_columns', $columns );

			$class = intval( get_option( 'top_categories_ajax_filter' ) ) ? 'ajax-filter' : '';
			printf(
				'<div id="templaza-catalog-top-categories" class="templaza-catalog-categories templaza-swiper-carousel-elementor navigation-arrows navigation-tablet-dots navigation-mobile-dots %s" data-columns="%s"><div class="swiper-container"><ul class="catalog-categories__wrapper swiper-wrapper">%s</ul></div></div>',
				esc_attr( $class ),
				esc_attr( $columns ),
				implode( ' ', $output )
			);
		}
	}

	/**
	 * Products filter
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_filter() {
		if ( ! is_active_sidebar( 'catalog-filters-sidebar' ) ) {
			return;
		}

		$layout = get_option( 'catalog_toolbar_layout' );
		$open   = get_option( 'catalog_toolbar_products_filter' );

		if ( 'modal' == $open && 'v3' == $layout ) {
			return;
		}

		?>
        <div id="catalog-filters"
             class="catalog-toolbar-filters products-filter-dropdown catalog-toolbar-filters__<?php echo esc_attr( $layout ) ?>">
            <div class="catalog-filters-content">
				<?php dynamic_sidebar( 'catalog-filters-sidebar' ); ?>
            </div>
        </div>
		<?php
	}

	/**
	 * Products filter modal
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_filter_modal() {
		if ( ! in_array( 'filter', TemPlaza_Woo\Templaza_Woo_Helper::templaza_get_prop( 'modals' ) ) ) {
			return;
		}

		$classes = '';
		if ( intval( get_option( 'catalog_filters_sidebar_collapse_content' ) ) ) {
			$classes = 'has-collapse-' . get_option( 'catalog_filters_sidebar_collapse_status' );
		} else {
			$classes = 'no-collapse';
		}

		$classes = apply_filters( 'templaza_get_product_filters_modal_classes', $classes );
		$sidebar = apply_filters( 'templaza_get_product_filters_modal_sidebar', 'catalog-filters-sidebar' );

		?>
        <div id="catalog-filters-modal" class="catalog-filters-modal templaza-modal" tabindex="-1" role="dialog">
            <div class="off-modal-layer"></div>
            <div class="filters-panel-content panel-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php esc_html_e( 'Filter By', 'templaza-framework' ) ?></h3>
                    <a href="#"
                           class="close-account-panel button-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="modal-content templaza-scrollbar catalog-sidebar <?php echo esc_attr( $classes ); ?>">
					<?php if ( is_active_sidebar( $sidebar ) ) {
						dynamic_sidebar( $sidebar );
					}; ?>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Get product category
	 *
	 * @since 1.0.0
	 *
	 * @return object
	 */
	public function get_terms_product_cat( $limit, $check_sub, $orderby = '' ) {
		$terms    = array();
		$taxonomy = 'product_cat';
		$orderby  = $orderby ? $orderby : 'count';
		$limit    = trim( $limit );
		$args     = array(
			'taxonomy' => $taxonomy,
			'orderby'  => $orderby,
		);

		$args['menu_order'] = false;
		if ( $orderby == 'order' ) {
			$args['menu_order'] = 'asc';
		} else {
			if ( $orderby == 'count' ) {
				$args['order'] = 'desc';
			}
		}

		// Get terms.
		if ( is_tax( $taxonomy ) && $check_sub ) {
			$queried = get_queried_object();

			$args['parent'] = $queried->term_id;

			if ( is_numeric( $limit ) ) {
				$args['number'] = intval( $limit );
			}

			$terms = get_terms( $args );

			if ( empty( $terms ) ) {
				$args['parent'] = $queried->parent;
				$terms          = get_terms( $args );
			}
		}

		// Keep get default tabs if there is no sub-categorys.
		if ( empty( $terms ) ) {
			if ( is_numeric( $limit ) ) {
				$args['number'] = intval( $limit );
			}

			$terms = get_terms( $args );
		}

		return $terms;
	}

	/**
	 * Display products tabs.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_tabs() {
		if ( ! woocommerce_products_will_display() ) {
			return;
		}

		$type   = get_option( 'catalog_toolbar_tabs' );
		$tabs   = array();
		$active = false;

		$base_url = templaza_get_page_base_url();

		if ( 'category' == $type ) {
			$taxonomy = 'product_cat';

			$terms = $this->get_terms_product_cat( get_option( 'catalog_toolbar_tabs_categories' ), get_option( 'catalog_toolbar_tabs_subcategories' ) );

			if ( empty( $terms ) || is_wp_error( $terms ) ) {
				return;
			}

			foreach ( $terms as $term ) {
				if ( is_tax( $taxonomy, $term->slug ) ) {
					$active = true;
				}

				$tabs[] = sprintf(
					'<a href="%s" class="tab-%s %s">%s</a>',
					esc_url( get_term_link( $term ) ),
					esc_attr( $term->slug ),
					is_tax( $taxonomy, $term->slug ) ? 'active' : '',
					esc_html( $term->name )
				);
			}
		} else {
			$groups = (array) get_option( 'catalog_toolbar_tabs_groups' );

			if ( empty( $groups ) ) {
				return;
			}

			$labels = array(
				'best_sellers' => esc_html__( 'Best Sellers', 'templaza-framework' ),
				'featured'     => esc_html__( 'Hot Products', 'templaza-framework' ),
				'new'          => esc_html__( 'New Products', 'templaza-framework' ),
				'sale'         => esc_html__( 'Sale Products', 'templaza-framework' ),
			);

			foreach ( $groups as $group ) {
				if ( isset( $_GET['products_group'] ) && $group == $_GET['products_group'] ) {
					$active = true;
				}

				$tabs[] = sprintf(
					'<a href="%s" class="tab-%s %s">%s</a>',
					esc_url( add_query_arg( array( 'products_group' => $group ), $base_url ) ),
					esc_attr( $group ),
					isset( $_GET['products_group'] ) && $group == $_GET['products_group'] ? 'active' : '',
					$labels[ $group ]
				);
			}
		}

		if ( empty( $tabs ) ) {
			return;
		}


		if ( 'group' == $type ) {
			$btn_url = $base_url;
		} else {
			if ( ! is_wp_error( $terms ) && ! empty( $terms ) && $terms['0']->parent ) {
				$btn_url = get_category_link( $terms['0']->parent );
			}

			$btn_url = empty( $btn_url ) ? wc_get_page_permalink( 'shop' ) : $btn_url;
		}

		array_unshift( $tabs, sprintf(
			'<a href="%s" class="tab-all %s">%s</a>',
			esc_url( $btn_url ),
			$active ? '' : 'active',
			esc_html__( 'All', 'templaza-framework' )
		) );

		$text_toggle = $type == 'group' ? esc_html__( 'Products', 'templaza-framework' ) : esc_html__( 'Categories', 'templaza-framework' );

		echo '<div class="catalog-toolbar-tabs__title">' . $text_toggle . '<i class="far fa-chevron-down"></i></div>';
		echo '<div class="catalog-toolbar-tabs__content">';

		foreach ( $tabs as $tab ) {
			echo trim( $tab );
		}

		echo '</div>';
	}

	/**
	 * Products filter toggle.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_filter_button() {
		if ( ! woocommerce_products_will_display() ) {
			return;
		}

		$open = get_option( 'catalog_toolbar_products_filter' );

		?>
        <a href="#catalog-filters" class="toggle-filters catalog-toolbar-item__control"
           data-toggle="<?php echo esc_attr( $open ) ?>"
           data-target="catalog-filters-<?php echo esc_attr( $open ) ?>">
            <span class="text-filter"><?php esc_html_e( 'Filter', 'templaza-framework' ) ?></span>
        </a>
		<?php
	}

	/**
	 * Products filter sidebar.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_filter_sidebar() {
		$has_sidebar = apply_filters( 'templaza_get_sidebar', false );
		if ( ! $has_sidebar ) {
			return;
		}

		?>
        <a href="#primary-sidebar" class="toggle-filters"
           data-toggle="modal" data-target="primary-sidebar">
            <span class="text-filter"><?php esc_html_e( 'Filter', 'templaza-framework' ) ?></span>
        </a>
		<?php
	}

	/**
	 * Products sorting
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function products_ordering() {
		$catalog_orderby_options = apply_filters( 'templaza_products_filter_order_by', array(
			'menu_order' => esc_html__( 'Default sorting', 'templaza-framework' ),
			'popularity' => esc_html__( 'Sort by popularity', 'templaza-framework' ),
			'rating'     => esc_html__( 'Sort by average rating', 'templaza-framework' ),
			'date'       => esc_html__( 'Sort by latest', 'templaza-framework' ),
			'price'      => esc_html__( 'Sort by price: low to high', 'templaza-framework' ),
			'price-desc' => esc_html__( 'Sort by price: high to low', 'templaza-framework' ),
		) );

		// get form action url
		$form_action = templaza_get_page_base_url();

		$orderby    = ! empty( $_GET['orderby'] ) ? $_GET['orderby'] : '';
		$order_html = $order_current = '';
		foreach ( $catalog_orderby_options as $id => $name ) {
			$url       = $form_action . '?orderby=' . esc_attr( $id );
			$css_class = '';
			if ( $orderby == $id ) {
				$css_class     = 'active';
				$order_current = $name;
			}

			$order_html .= sprintf(
				'<li><a href="%s" class="woocommerce-ordering__link %s">%s</a></li>',
				esc_url( $url ),
				esc_attr( $css_class ),
				esc_html( $name )
			);
		}

		?>
        <div class="woocommerce-ordering">
            <span class="woocommerce-ordering__button"><span
                        class="woocommerce-ordering__button-label"><?php echo ! empty( $orderby ) ? $order_current : esc_html__( 'Default', 'templaza-framework' ) ?> </span> <i class="far fa-chevron-down"></i></span>

            <ul class="woocommerce-ordering__submenu">
				<?php echo wp_kses_post( $order_html ); ?>
            </ul>

        </div>
		<?php
	}

	/**
	 * Get attachment image html
	 *
	 * @since 1.0.0
	 *
	 * @param $thumbnail_id
	 * @param $thumbnail_size_cropped
	 * @param $thumbnail_size
	 *
	 * @return string
	 */
	public function get_attachment_image_html( $thumbnail_id, $thumbnail_size_cropped, $thumbnail_size ) {
		if ( class_exists( '\Elementor\Group_Control_Image_Size' ) ) {
			$settings['image_size'] = 'custom';

			$settings['image_custom_dimension'] = $thumbnail_size_cropped;

			$settings['image'] = array(
				'url' => wp_get_attachment_image_src( $thumbnail_id )[0],
				'id'  => $thumbnail_id
			);
			$el_elementor      = new \Elementor\Group_Control_Image_Size;

			$image = $el_elementor->get_attachment_image_html( $settings );

		} else {
			$image = wp_get_attachment_image( $thumbnail_id, $thumbnail_size );
		}

		return $image;
	}

	/**
	 * Change catalog sidebar after content
	 *
	 * @since 1.0.0
	 *
	 * @param $index
	 *
	 * @return void
	 */
	public function catalog_sidebar_after_content( $index ) {
		if ( is_admin() ) {
			return;
		}

		if ( $index != 'catalog-sidebar' ) {
			return;
		}
		?>
        </div>
        </div>
		<?php

	}
}
Templaza_Woo_Catalog::get_instance();