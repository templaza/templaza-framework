<?php // phpcs:disable WordPress.WhiteSpace.PrecisionAlignment.Found
/**
 * Import & Export for Option Panel
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys
 * @version     4.0.0
 */

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Functions;

// Don't duplicate me!
if ( ! class_exists( 'Redux_Import_Export', false ) ) {

	/**
	 * Main Redux_import_export class
	 *
	 * @since       1.0.0
	 */
	class Redux_Import_Export extends Redux_Field {

	    protected $is_field;

		/**
		 * Redux_Import_Export constructor.
		 *
		 * @param array  $field  Field array.
		 * @param string $value  Value array.
		 * @param object $parent ReduxFramework object.
		 *
		 * @throws ReflectionException .
		 */
        // phpcs:disable WordPress.Security.NonceVerification.Recommended
		public function __construct( $field, $value, $parent ) {
			parent::__construct( $field, $value, $parent );

			$this->is_field = $this->parent->extensions['import_export']->is_field;

		}

		/**
		 * Set field defaults.
		 */
		public function set_defaults() {
			// Set default args for this field to avoid bad indexes. Change this to anything you use.
			$defaults = array(
				'options'          => array(),
				'stylesheet'       => '',
				'output'           => true,
				'enqueue'          => true,
				'enqueue_frontend' => true,
			);

			$this->field = wp_parse_args( $this->field, $defaults );
		}

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		public function render() {
			$secret = md5( md5( Redux_Functions_Ex::hash_key() ) . '-' . $this->parent->args['opt_name'] );

			// No errors please.
			$defaults = array(
				'full_width' => true,
				'overflow'   => 'inherit',
			);

			$this->field = wp_parse_args( $this->field, $defaults );

			$do_close = false;

			$id = $this->parent->args['opt_name'] . '-' . $this->field['id'];

            $cpost_type = isset($_GET['post_type'])?$_GET['post_type']:'';
            $cpost      = (isset($_GET['post']) && !empty($_GET['post']))?get_post($_GET['post']):'';
            $post_name  = (!empty($cpost) && isset($cpost -> post_name) && !empty($cpost -> post_name))? $cpost -> post_name:'';

            if(!isset($_GET['post']) || ((isset($_GET['post']) && !empty($_GET['post']) || $cpost_type) && empty($post_name))){
                ?>
                <p class="uk-text-danger">
                    <span>
                        <?php // phpcs:ignore WordPress.NamingConventions.ValidHookName ?>
                        <?php
                        echo esc_html( apply_filters( 'redux-import-warning', esc_html__( 'WARNING! Please save add title and publish first!', 'redux-framework' ) ) ); ?>
                    </span>
                </p>
                <?php
                return;
            }
			?>
			<h4><?php esc_html_e( 'Import Options', 'redux-framework' ); ?></h4>
			<p>
				<a
					href="javascript:void(0);"
					id="redux-import-code-button"
					class="button-secondary">
					<?php esc_html_e( 'Import from Clipboard', 'redux-framework' ); ?>
				</a>

				<a
					href="javascript:void(0);"
					id="redux-import-link-button"
					class="button-secondary">
					<?php esc_html_e( 'Import from URL', 'redux-framework' ); ?>
				</a>

				<a
					href="#"
					id="redux-import-upload"
					class="button-secondary">
					<?php esc_html_e( 'Upload file', 'redux-framework' ); ?><span></span>
				</a>
				<input type="file" id="redux-import-upload-file" size="50">
			</p>
			<div id="redux-import-code-wrapper">
				<p class="description" id="import-code-description">
					<?php // phpcs:ignore WordPress.NamingConventions.ValidHookName ?>
					<?php echo esc_html( apply_filters( 'redux-import-file-description', esc_html__( 'Paste your clipboard data here.', 'redux-framework' ) ) ); ?>
				</p>
				<textarea
					id="import-code-value"
					name="<?php echo esc_attr( $this->parent->args['opt_name'] ); ?>[import_code]"
					class="large-text no-update" rows="3"></textarea>
			</div>
			<div id="redux-import-link-wrapper">
				<p class="description" id="import-link-description">
					<?php // phpcs:ignore WordPress.NamingConventions.ValidHookName ?>
					<?php echo esc_html( apply_filters( 'redux-import-link-description', esc_html__( 'Input the URL to another sites options set and hit Import to load the options from that site.', 'redux-framework' ) ) ); ?>
				</p>
				<input
					class="large-text no-update"
					id="import-link-value"
					name="<?php echo esc_attr( $this->parent->args['opt_name'] ); ?>[import_link]"
					rows="2"/>
			</div>
			<p id="redux-import-action">
				<input
					type="submit"
					id="redux-import"
					name="import"
					class="button-primary"
                    data-secret="<?php echo esc_attr( $secret ); ?>"
                    <?php
                    echo (isset($_GET['post']) && !empty($_GET['post']))?' data-post-id="'.esc_attr($_GET['post']).'"':''?>
					value="<?php esc_html_e( 'Import', 'redux-framework' ); ?>">
				<span>
					<?php // phpcs:ignore WordPress.NamingConventions.ValidHookName ?>
					<?php
                    echo esc_html( apply_filters( 'redux-import-warning', esc_html__( 'WARNING! This will overwrite all existing option values, please proceed with caution!', 'redux-framework' ) ) ); ?>
				</span>
			</p>
			<div class="hr">
				<div class="inner">
					<span>&nbsp;</span>
				</div>
			</div>
			<h4><?php esc_html_e( 'Export Options', 'redux-framework' ); ?></h4>
			<div class="redux-section-desc">
				<p class="description">
					<?php // phpcs:ignore WordPress.NamingConventions.ValidHookName ?>
					<?php echo esc_html( apply_filters( 'redux-backup-description', esc_html__( 'Here you can copy/download your current option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).', 'redux-framework' ) ) ); ?>
				</p>
			</div>
			<?php $link = admin_url( 'admin-ajax.php?action=redux_download_options-' . $this->parent->args['opt_name'] . '&secret=' . $secret );
            if(isset($_GET['post']) && !empty($_GET['post'])){
                $link   .= '&post_id='.$_GET['post'];
            }
			?>
			<p>
				<button id="redux-export-code-copy" class="button-secondary"
						data-secret="<?php echo esc_attr( $secret ); ?>"
						data-copy="<?php esc_attr_e( 'Copy to Clipboard', 'redux-framework' ); ?>"
						data-copied="<?php esc_attr_e( 'Copied!', 'redux-framework' ); ?>"<?php
                echo (isset($_GET['post']) && !empty($_GET['post']))?' data-post-id="'.esc_attr($_GET['post']).'"':''?>>
					<?php esc_html_e( 'Copy to Clipboard', 'redux-framework' ); ?>
				</button>
				<a href="<?php echo esc_url( $link ); ?>" id="redux-export-code-dl" class="button-primary">
					<?php esc_html_e( 'Export File', 'redux-framework' ); ?>
				</a>
				<a href="javascript:void(0);" id="redux-export-link" class="button-secondary"
				   data-copy="<?php esc_attr_e( 'Copy Export URL', 'redux-framework' ); ?>"
				   data-copied="<?php esc_attr_e( 'Copied!', 'redux-framework' ); ?>"
				   data-url="<?php echo esc_url( $link ); ?>">
					<?php esc_html_e( 'Copy Export URL', 'redux-framework' ); ?>
				</a>
			</p>
			<p></p>
			<textarea class="large-text no-update" id="redux-export-code" rows="1"></textarea>
			<?php
		}

		/**
		 * Enqueue Function.
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		public function enqueue() {
			wp_enqueue_script(
				'redux-extension-import-export-js',
                Redux_Core::$url . 'inc/extensions/import_export/import_export/redux-import-export' . Redux_Functions::is_min() . '.js',
				array(
					'jquery',
					'redux-js',
				),
				Redux_Extension_Import_Export::$version,
				true
			);

			wp_enqueue_style( 'redux-import-export', Redux_Core::$url . 'inc/extensions/import_export/import_export/redux-import-export.css', array(), Redux_Extension_Import_Export::$version, 'all' );

            $dep_array = array('redux-extension-import-export-js');
            wp_enqueue_script('custom-redux-import_export-js', Functions::get_my_frame_url()
                . "/fields/import_export/custom-redux-import_export.js", $dep_array, time(), true);
		}
	}
}
