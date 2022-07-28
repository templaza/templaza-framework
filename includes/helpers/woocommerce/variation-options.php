<?php
use TemPlazaFramework\Functions;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Templaza_Product_Variation_Option  {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	private static $instance;


	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
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
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 50 );

		// Linked Products tab
		add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'variation_images_html' ), 10, 3 );
		// Save product meta
		add_action( 'woocommerce_save_product_variation', array( $this, 'save_product_variation_images' ) );
	}

	/**
	 * Enqueue Scripts
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_scripts( $hook ) {
		$screen = get_current_screen();
		if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) && $screen->post_type == 'product' ) {
			wp_enqueue_script( 'templaza_variation_images', Functions::get_my_url() . '/assets/js/woo/variation-images-admin.js', array( 'jquery' ), '', true );
			wp_enqueue_style( 'templaza_variation_images', Functions::get_my_url() . '/assets/css/woo/variation-images-admin.css', array(), '');
		}
	}

	/**
	 * Add more options to advanced tab.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function variation_images_html($loop, $variation_data, $variation) {
		$variation_id   = absint( $variation->ID );
		$gallery_images = get_post_meta( $variation_id, 'templaza_variation_images', true );
		$attachments = $gallery_images ? explode(',', $gallery_images) : '';
		?>
		<div class="form-row form-row-full templaza-variation-images-container">
			<h4><?php esc_html_e( 'Variation Images', 'templaza-framework' ); ?></h4>
			<ul class="variation-images-list">
				<?php
				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment_id ) {
						$attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );
						if ( empty( $attachment ) ) {
							continue;
						}
						?>
						<li class="image" data-attachment_id="<?php echo esc_attr( $attachment_id ); ?>">
							<?php echo $attachment; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<a href="#" class="delete tips" data-tip="<?php esc_attr_e( 'Delete image', 'templaza-framework' ); ?>"></a>
						</li>
						<?php
					}

				}
				?>
			</ul>
			<p class="hide-if-no-js">
				<a href="#" class="templaza-variation-images-upload" data-choose="<?php esc_attr_e( 'Add images to variation gallery', 'templaza-framework' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'templaza-framework' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'templaza-framework' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'templaza-framework' ); ?>"><?php esc_html_e( 'Add variation images gallery', 'templaza-framework' ); ?></a>
			</p>
			<input type="hidden" class="templaza_variation_images" name="templaza_variation_images[<?php echo esc_attr( $variation->ID ); ?>]" value="<?php echo esc_attr($gallery_images ); ?>" />
		</div>
	<?php
	}

	/**
	 * product_meta_fields_save function.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $post_id
	 *
	 * @return void
	 */
	public function save_product_variation_images( $variation_id ) {
		if ( isset( $_POST['templaza_variation_images'][$variation_id ] ) ) {
			$woo_data = $_POST['templaza_variation_images'][$variation_id ];
			update_post_meta( $variation_id, 'templaza_variation_images', $woo_data );
		} else {
			delete_post_meta( $variation_id, 'templaza_variation_images' );
		}

	}

}
Templaza_Product_Variation_Option::get_instance();