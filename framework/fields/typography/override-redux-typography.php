<?php
/**
 * Typography Field
 *
 * @package     ReduxFramework/Fields
 * @author      Kevin Provance (kprovance) & Dovy Paukstys
 * @version     4.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Functions;

if ( ! class_exists( 'Redux_Typography', false ) ) {

	/**
	 * Class Redux_Typography
	 */
	class Redux_Typography extends Redux_Field {

		/**
		 * Array of data for typography preview.
		 *
		 * @var array
		 */
		private $typography_preview = array();

		/**
		 *  Standard font array.
		 *
		 * @var array $std_fonts
		 */
		private $std_fonts = array(
			'Arial, Helvetica, sans-serif'            => 'Arial, Helvetica, sans-serif',
			'\'Arial Black\', Gadget, sans-serif'     => '\'Arial Black\', Gadget, sans-serif',
			'\'Bookman Old Style\', serif'            => '\'Bookman Old Style\', serif',
			'\'Comic Sans MS\', cursive'              => '\'Comic Sans MS\', cursive',
			'Courier, monospace'                      => 'Courier, monospace',
			'Garamond, serif'                         => 'Garamond, serif',
			'Georgia, serif'                          => 'Georgia, serif',
			'Impact, Charcoal, sans-serif'            => 'Impact, Charcoal, sans-serif',
			'\'Lucida Console\', Monaco, monospace'   => '\'Lucida Console\', Monaco, monospace',
			'\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif' => '\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif',
			'\'MS Sans Serif\', Geneva, sans-serif'   => '\'MS Sans Serif\', Geneva, sans-serif',
			'\'MS Serif\', \'New York\', sans-serif'  => '\'MS Serif\', \'New York\', sans-serif',
			'\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif' => '\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif',
			'Tahoma,Geneva, sans-serif'               => 'Tahoma, Geneva, sans-serif',
			'\'Times New Roman\', Times,serif'        => '\'Times New Roman\', Times, serif',
			'\'Trebuchet MS\', Helvetica, sans-serif' => '\'Trebuchet MS\', Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif'             => 'Verdana, Geneva, sans-serif',
		);

        /**
         * Default font weights.
         *
         * @var string[]
         */
        private $default_font_weights = array(
            '400'       => 'Normal 400',
            '700'       => 'Bold 700',
            '400italic' => 'Normal 400 Italic',
            '700italic' => 'Bold 700 Italic',
        );

		/**
		 * User font array.
		 *
		 * @var bool $user_fonts
		 */
		private $user_fonts = true;

		/**
		 * Redux_Field constructor.
		 *
		 * @param array  $field  Field array.
		 * @param string $value  Field values.
		 * @param null   $redux  ReduxFramework object pointer.
		 *
		 * @throws ReflectionException Exception.
		 */
		public function __construct( $field = array(), $value = null, $redux = null ) { // phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod
			parent::__construct( $field, $value, $redux );

			$this->parent = $redux;
			$this->field  = $field;
			$this->value  = $value;

			$this->set_defaults();

			$path_info = Redux_Helpers::path_info( __FILE__ );
			$this->dir = trailingslashit( dirname( $path_info['real_path'] ) );
			$this->url = trailingslashit( dirname( $path_info['url'] ) );

			$this->timestamp = Redux_Core::$version;
			if ( $redux->args['dev_mode'] ) {
				$this->timestamp .= '.' . time();
			}
		}

		/**
		 * Sets default values for field.
		 */
		public function set_defaults() {
			// Shim out old arg to new.
			if ( isset( $this->field['all_styles'] ) && ! empty( $this->field['all_styles'] ) ) {
				$this->field['all-styles'] = $this->field['all_styles'];
				unset( $this->field['all_styles'] );
			}

			$defaults = array(
				'font-family'             => true,
				'font-size'               => true,
				'font-weight'             => true,
				'font-style'              => true,
				'font-backup'             => false,
				'subsets'                 => true,
				'custom_fonts'            => true,
				'text-align'              => true,
				'text-transform'          => false,
				'font-variant'            => false,
				'text-decoration'         => false,
				'color'                   => true,
				'preview'                 => true,
				'line-height'             => true,
				'multi'                   => array(
					'subsets' => false,
					'weight'  => false,
				),
				'word-spacing'            => false,
				'letter-spacing'          => false,
				'google'                  => true,
				'font_family_clear'       => true,
				'font-multi-styles'       => false,
				'allow_empty_line_height' => false,
			);

			$this->field = wp_parse_args( $this->field, $defaults );

            if ( isset( $this->field['color_alpha'] ) ) {
                if ( is_array( $this->field['color_alpha'] ) ) {
                    $this->field['color_alpha']['color']        = $this->field['color_alpha']['color'] ?? false;
                    $this->field['color_alpha']['shadow-color'] = $this->field['color_alpha']['shadow-color'] ?? false;
                } else {
                    $mode                                       = $this->field['color_alpha'];
                    $this->field['color_alpha']                 = array();
                    $this->field['color_alpha']['color']        = $mode;
                    $this->field['color_alpha']['shadow-color'] = $mode;
                }
            } else {
                $this->field['color_alpha']['color']        = false;
                $this->field['color_alpha']['shadow-color'] = false;
            }

			// Set value defaults.
			$defaults = array(
				'font-family'       => '',
				'font-options'      => '',
				'font-backup'       => '',
				'text-align'        => '',
				'text-transform'    => '',
				'font-variant'      => '',
				'text-decoration'   => '',
				'line-height'       => '',
				'word-spacing'      => '',
				'letter-spacing'    => '',
				'subsets'           => '',
				'google'            => false,
				'font-script'       => '',
				'font-weight'       => '',
				'font-style'        => '',
				'color'             => '',
				'font-size'         => '',
                'margin-top'        => '',
                'margin-bottom'     => '',
                'shadow-color'      => '#000000',
                'shadow-horizontal' => '1',
                'shadow-vertical'   => '1',
                'shadow-blur'       => '4',
                'font-multi-styles' => '',
			);

			$this->value = wp_parse_args( $this->value, $defaults );

			$units = array(
				'px',
				'em',
				'rem',
				'%',
			);
//			var_dump($this->field['units']); die();
			if ( empty( $this->field['units'] ) || (!is_array($this -> field['units']) && ! in_array( $this->field['units'], Redux_Helpers::$array_units, true ) )) {
				$this->field['units'] = 'px';
			}

			// Get the google array.
			$this->get_google_array();

			if ( empty( $this->field['fonts'] ) ) {
				$this->user_fonts     = false;
				$this->field['fonts'] = $this->std_fonts;
			}

            $this->field['weights'] = $this->field['weights'] ?? $this->default_font_weights;

			// Localize std fonts.
			$this->localize_std_fonts();
		}

		/**
		 * Localize font array
		 *
		 * @param array  $field Field array.
		 * @param string $value Value.
		 *
		 * @return array
		 */
		public function localize( array $field, string $value = '' ): array {
			$params = array();

			if ( true === $this->user_fonts && ! empty( $this->field['fonts'] ) ) {
				$params['std_font'] = $this->field['fonts'];
			}

			return $params;
		}

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since ReduxFramework 1.0.0
		 */
		public function render() {
            $theme_file = TEMPLAZA_FRAMEWORK_THEME_PATH_FIELDS.'/typography/tmpl/typography.php';
            $file       = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/typography/tmpl/typography.php';
            if(file_exists($file)){
                require $file;
            }
		}

		/**
		 * Enqueue Function.
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since ReduxFramework 1.0.0
		 */
		public function enqueue() {
			$min = Redux_Functions::is_min();

			if ( ! wp_style_is( 'select2-css' ) ) {
				wp_enqueue_style( 'select2-css' );
			}

			if ( ! wp_style_is( 'wp-color-picker' ) ) {
				wp_enqueue_style( 'wp-color-picker' );
			}

			wp_enqueue_script( 'redux-webfont-js', '//' . 'ajax' . '.googleapis' . '.com/ajax/libs/webfont/1.6.26/webfont.js', array(), '1.6.26', true ); // phpcs:ignore Generic.Strings.UnnecessaryStringConcat

			$dep_array = array( 'jquery', 'wp-color-picker', 'select2-js', 'redux-js', 'redux-webfont-js' );

			wp_enqueue_script( 'redux-field-typography-js', Redux_Core::$url . "inc/fields/typography/redux-typography$min.js", $dep_array, $this->timestamp, true );

			wp_localize_script(
				'redux-field-typography-js',
				'redux_typography_ajax',
				array(
					'ajaxurl'             => esc_url( admin_url( 'admin-ajax.php' ) ),
					'update_google_fonts' => array(
						'updating' => esc_html__( 'Downloading Google Fonts...', 'redux-framework' ),
						// translators: Aria title, link title.
						'error'    => sprintf( esc_html__( 'Update Failed|msg. %1$s', 'redux-framework' ), sprintf( '<a href="#" class="update-google-fonts" data-action="manual" aria-label="%s">%s</a>', esc_html__( 'Retry?', 'redux-framework' ), esc_html__( 'Retry?', 'redux-framework' ) ) ),
						// translators: Javascript reload command, link title.
						'success'  => sprintf( esc_html__( 'Updated! %1$s to start using your updated fonts.', 'redux-framework' ), sprintf( '<a href="%s">%s</a>', 'javascript:location.reload();', esc_html__( 'Reload the page', 'redux-framework' ) ) ),
					),
				)
			);

//			if ( Redux_Core::$pro_loaded ) {
//				// phpcs:ignore WordPress.NamingConventions.ValidHookName
//				do_action( 'redux/pro/typography/enqueue' );
//			}

			if ( $this->parent->args['dev_mode'] ) {
				wp_enqueue_style( 'redux-color-picker-css' );

				wp_enqueue_style( 'redux-field-typography-css', Redux_Core::$url . 'inc/fields/typography/redux-typography.css', array(), $this->timestamp, 'all' );
			}

            if ( isset( $this->field['color_alpha'] ) && is_array( $this->field['color_alpha'] ) ) {
                if ( $this->field['color_alpha']['color'] || $this->field['color_alpha']['shadow-color'] ) {
                    wp_enqueue_script( 'redux-wp-color-picker-alpha-js' );
                }
            }

            if(isset($this -> field['allow_responsive']) && $this -> field['allow_responsive']) {
                $dep_array = array('jquery-ui-tabs', 'redux-field-typography-js');
                wp_enqueue_script('custom-redux-typography-js', Functions::get_my_frame_url()
                    . "/fields/typography/custom-redux-typography.js", $dep_array, time(), true);

                wp_enqueue_style('custom-redux-typography-css', Functions::get_my_frame_url()
                    . '/fields/typography/custom-redux-typography.css',
                    array(), time(), 'all');
            }
		}

		/**
		 * Make_google_web_font_link Function.
		 * Creates the google fonts link.
		 *
		 * @since ReduxFramework 3.0.0
		 *
		 * @param array $fonts Array of google fonts.
		 *
		 * @return string
		 */
		public function make_google_web_font_link( array $fonts ): string {
			$link    = '';
			$subsets = array();

			foreach ( $fonts as $family => $font ) {
				if ( ! empty( $link ) ) {
					$link .= '|'; // Append a new font to the string.
				}
				$link .= $family;

				if ( ! empty( $font['font-style'] ) || ! empty( $font['all-styles'] ) ) {
					$link .= ':';
					if ( ! empty( $font['all-styles'] ) ) {
						$link .= implode( ',', $font['all-styles'] );
					} elseif ( ! empty( $font['font-style'] ) ) {
						$link .= implode( ',', $font['font-style'] );
					}
				}

				if ( ! empty( $font['subset'] ) || ! empty( $font['all-subsets'] ) ) {
					if ( ! empty( $font['all-subsets'] ) ) {
						foreach ( $font['all-subsets'] as $subset ) {
							if ( ! in_array( $subset, $subsets, true ) ) {
								array_push( $subsets, $subset );
							}
						}
					} elseif ( ! empty( $font['subset'] ) ) {
						foreach ( $font['subset'] as $subset ) {
							if ( ! in_array( $subset, $subsets, true ) ) {
								array_push( $subsets, $subset );
							}
						}
					}
				}
			}

			if ( ! empty( $subsets ) ) {
				$link .= '&subset=' . implode( ',', $subsets );
			}
			$link .= '&display=' . $this->parent->args['font_display'];

			return 'https://fonts.googleapis.com/css?family=' . $link;
		}

		/**
		 * Make_google_web_font_string Function.
		 * Creates the google fonts link.
		 *
		 * @since ReduxFramework 3.1.8
		 *
		 * @param array $fonts Array of Google fonts.
		 *
		 * @return string
		 */
		public function make_google_web_font_string( array $fonts ): string {
			$link    = '';
			$subsets = array();

			foreach ( $fonts as $family => $font ) {
				if ( ! empty( $link ) ) {
					$link .= "', '"; // Append a new font to the string.
				}
				$link .= $family;

				if ( ! empty( $font['font-style'] ) || ! empty( $font['all-styles'] ) ) {
					$link .= ':';
					if ( ! empty( $font['all-styles'] ) ) {
						$link .= implode( ',', $font['all-styles'] );
					} elseif ( ! empty( $font['font-style'] ) ) {
						$link .= implode( ',', $font['font-style'] );
					}
				}

				if ( ! empty( $font['subset'] ) || ! empty( $font['all-subsets'] ) ) {
					if ( ! empty( $font['all-subsets'] ) ) {
						foreach ( $font['all-subsets'] as $subset ) {
							if ( ! in_array( $subset, $subsets, true ) && ! is_numeric( $subset ) ) {
								array_push( $subsets, $subset );
							}
						}
					} elseif ( ! empty( $font['subset'] ) ) {
						foreach ( $font['subset'] as $subset ) {
							if ( ! in_array( $subset, $subsets, true ) && ! is_numeric( $subset ) ) {
								array_push( $subsets, $subset );
							}
						}
					}
				}
			}

			if ( ! empty( $subsets ) ) {
				$link .= '&subset=' . implode( ',', $subsets );
			}

			return "'" . $link . "'";
		}

		/**
		 * Compiles field CSS for output.
		 *
		 * @param array $data Array of data to process.
		 *
		 * @return string|void
		 */
		public function css_style( $data ): string {
			$style = '';

			$font = $data;

			// Shim out old arg to new.
			if ( isset( $this->field['all_styles'] ) && ! empty( $this->field['all_styles'] ) ) {
				$this->field['all-styles'] = $this->field['all_styles'];
				unset( $this->field['all_styles'] );
			}

			// Check for font-backup.  If it's set, stick it on a variable for
			// later use.
			if ( ! empty( $font['font-family'] ) && ! empty( $font['font-backup'] ) ) {
				$font['font-family'] = str_replace( ', ' . $font['font-backup'], '', $font['font-family'] );
				$font_backup         = ',' . $font['font-backup'];
			}

			$font_value_set = false;

			if ( ! empty( $font ) ) {
				foreach ( $font as $key => $value ) {
					if ( ! empty( $value ) && in_array( $key, array( 'font-family', 'font-weight' ), true ) ) {
						$font_value_set = true;
					}
				}
			}

			if ( ! empty( $font ) ) {
				foreach ( $font as $key => $value ) {
					if ( 'font-options' === $key ) {
						continue;
					}

					// Check for font-family key.
					if ( 'font-family' === $key ) {

						// Enclose font family in quotes if spaces are in the
						// name.  This is necessary because if there are numerics
						// in the font name, they will not render properly.
						// Google should know better.
						if ( strpos( $value, ' ' ) && ! strpos( $value, ',' ) ) {
							$value = '"' . $value . '"';
						}

						// Ensure fontBackup isn't empty. We already option
						// checked this earlier.  No need to do it again.
						if ( ! empty( $font_backup ) ) {

							// Apply the backup font to the font-family element
							// via the saved variable.  We do this here, so it
							// doesn't get appended to the Google stuff below.
							$value .= $font_backup;
						}
					}

					if ( empty( $value ) && in_array(
						$key,
						array(
							'font-weight',
							'font-style',
						),
						true
					) && true === $font_value_set ) {
						$value = 'normal';
					}

					if ( 'font-weight' === $key && false === $this->field['font-weight'] ) {
						continue;
					}

					if ( 'font-style' === $key && false === $this->field['font-style'] ) {
						continue;
					}

					if ( 'google' === $key || 'subsets' === $key || 'font-backup' === $key || empty( $value ) ) {
						continue;
					}

					/* Override style of redux typography field
					*  @Original is: $style .= $key . ':' . $value . ';';
					*/
					if(!empty($value)){
					    if(is_array($value)){
                            $style .= isset($value['desktop']) && $value['desktop']?$key . ':' . $value['desktop'] . ';':'';
                        }else {
                            $style .= $key . ':' . $value . ';';
                        }
					}
				}

				if ( isset( $this->parent->args['async_typography'] ) && $this->parent->args['async_typography'] ) {
					$style .= 'opacity: 1;visibility: visible;-webkit-transition: opacity 0.24s ease-in-out;-moz-transition: opacity 0.24s ease-in-out;transition: opacity 0.24s ease-in-out;';
				} else {
					$style .= 'font-display:' . $this->parent->args['font_display'] . ';';
				}
			}

			return $style;
		}

		/**
		 * CSS Output to send to the page.
		 *
		 * @param string|null|array $style CSS styles.
		 */
		public function output( $style = '' ) {
			$font = $this->value;

			if ( '' !== $style ) {
				if ( ! empty( $this->field['output'] ) && ! is_array( $this->field['output'] ) ) {
					$this->field['output'] = array( $this->field['output'] );
				}

				if ( ! empty( $this->field['output'] ) && is_array( $this->field['output'] ) ) {
					$keys                     = implode( ',', $this->field['output'] );
					$this->parent->outputCSS .= $keys . '{' . $style . '}';

					if ( isset( $this->parent->args['async_typography'] ) && $this->parent->args['async_typography'] ) {
						$key_string    = '';
						$key_string_ie = '';

						foreach ( $this->field['output'] as $value ) {
							if ( strpos( $value, ',' ) !== false ) {
								$arr = explode( ',', $value );

								foreach ( $arr as $subvalue ) {
									$key_string    .= '.wf-loading ' . $subvalue . ',';
									$key_string_ie .= '.ie.wf-loading ' . $subvalue . ',';
								}
							} else {
								$key_string    .= '.wf-loading ' . $value . ',';
								$key_string_ie .= '.ie.wf-loading ' . $value . ',';
							}
						}

						$this->parent->outputCSS .= rtrim( $key_string, ',' ) . '{opacity: 0;}';
						$this->parent->outputCSS .= rtrim( $key_string_ie, ',' ) . '{visibility: hidden;}';
					}
				}

				if ( ! empty( $this->field['compiler'] ) && ! is_array( $this->field['compiler'] ) ) {
					$this->field['compiler'] = array( $this->field['compiler'] );
				}

				if ( ! empty( $this->field['compiler'] ) && is_array( $this->field['compiler'] ) ) {
					$keys                       = implode( ',', $this->field['compiler'] );
					$this->parent->compilerCSS .= $keys . '{' . $style . '}';

					if ( isset( $this->parent->args['async_typography'] ) && $this->parent->args['async_typography'] ) {
						$key_string    = '';
						$key_string_ie = '';

						foreach ( $this->field['compiler'] as $value ) {
							if ( strpos( $value, ',' ) !== false ) {
								$arr = explode( ',', $value );

								foreach ( $arr as $subvalue ) {
									$key_string    .= '.wf-loading ' . $subvalue . ',';
									$key_string_ie .= '.ie.wf-loading ' . $subvalue . ',';
								}
							} else {
								$key_string    .= '.wf-loading ' . $value . ',';
								$key_string_ie .= '.ie.wf-loading ' . $value . ',';
							}
						}

						$this->parent->compilerCSS .= rtrim( $key_string, ',' ) . '{opacity: 0;}';
						$this->parent->compilerCSS .= rtrim( $key_string_ie, ',' ) . '{visibility: hidden;}';
					}
				}
			}

			$this->set_google_fonts( (array) $font );
		}

		/**
		 * Set global Google font data for global pointer.
		 *
		 * @param array $font Array of font data.
		 */
		private function set_google_fonts( array $font ) {
			// Google only stuff!
			if ( ! empty( $font['font-family'] ) && ! empty( $this->field['google'] ) && filter_var( $this->field['google'], FILTER_VALIDATE_BOOLEAN ) ) {

				// Added standard font matching check to avoid output to Google fonts call - kp
				// If no custom font array was supplied, then load it with default
				// standard fonts.
				if ( empty( $this->field['fonts'] ) ) {
					$this->field['fonts'] = $this->std_fonts;
				}

				// Ensure the fonts array is NOT empty.
				if ( ! empty( $this->field['fonts'] ) ) {

					// Make the font keys in the array lowercase, for case-insensitive matching.
					$lc_fonts = array_change_key_case( $this->field['fonts'] );

					// Rebuild font array with all keys stripped of spaces.
					$arr = array();
					foreach ( $lc_fonts as $key => $value ) {
						$key         = str_replace( ', ', ',', $key );
						$arr[ $key ] = $value;
					}

					$lc_fonts = array_change_key_case( $this->field['custom_fonts'] );
					foreach ( $lc_fonts as $group => $font_arr ) {
						foreach ( $font_arr as $key => $value ) {
							$arr[ Redux_Core::strtolower( $key ) ] = $key;
						}
					}

					$lc_fonts = $arr;

					unset( $arr );

					// lowercase chosen font for matching purposes.
					$lc_font = Redux_Core::strtolower( $font['font-family'] );

					// Remove spaces after commas in chosen font for matching purposes.
					$lc_font = str_replace( ', ', ',', $lc_font );

					// If the lower cased passed font-family is NOT found in the standard font array
					// Then it's a Google font, so process it for output.
					if ( ! array_key_exists( $lc_font, $lc_fonts ) ) {
						$family = $font['font-family'];

						// TODO: This method doesn't respect spaces after commas, hence the reason
						// Strip out spaces in font names and replace with with plus signs
						// for the std_font array keys having no spaces after commas.  This could be
						// fixed with RegEx in the future.
						$font['font-family'] = str_replace( ' ', '+', $font['font-family'] );

						// Push data to parent typography variable.
						if ( empty( Redux_Core::$typography[ $font['font-family'] ] ) ) {
							Redux_Core::$typography[ $font['font-family'] ] = array();
						}

						if ( isset( $this->field['all-styles'] ) || isset( $this->field['all-subsets'] ) ) {
							if ( ! isset( $font['font-options'] ) || empty( $font['font-options'] ) ) {
								$this->get_google_array();

								if ( isset( Redux_Core::$google_array ) && ! empty( Redux_Core::$google_array ) && isset( Redux_Core::$google_array[ $family ] ) ) {
									$font['font-options'] = Redux_Core::$google_array[ $family ];
								}
							} else {
								$font['font-options'] = json_decode( $font['font-options'], true );
							}
						}

						if ( isset( $font['font-options'] ) && ! empty( $font['font-options'] ) && isset( $this->field['all-styles'] ) && filter_var( $this->field['all-styles'], FILTER_VALIDATE_BOOLEAN ) ) {
							if ( ! empty( $font['font-options']['variants'] ) ) {
								if ( ! isset( Redux_Core::$typography[ $font['font-family'] ]['all-styles'] ) || empty( Redux_Core::$typography[ $font['font-family'] ]['all-styles'] ) ) {
									Redux_Core::$typography[ $font['font-family'] ]['all-styles'] = array();
									foreach ( $font['font-options']['variants'] as $variant ) {
										Redux_Core::$typography[ $font['font-family'] ]['all-styles'][] = $variant['id'];
									}
								}
							}
						}

						if ( isset( $font['font-options'] ) && ! empty( $font['font-options'] ) && isset( $this->field['all-subsets'] ) && $this->field['all-styles'] ) {
							if ( ! empty( $font['font-options']['subsets'] ) ) {
								if ( ! isset( Redux_Core::$typography[ $font['font-family'] ]['all-subsets'] ) || empty( Redux_Core::$typography[ $font['font-family'] ]['all-subsets'] ) ) {
									Redux_Core::$typography[ $font['font-family'] ]['all-subsets'] = array();
									foreach ( $font['font-options']['subsets'] as $variant ) {
										Redux_Core::$typography[ $font['font-family'] ]['all-subsets'][] = $variant['id'];
									}
								}
							}
						}

						$style = '';

						if ( ! empty( $font['font-weight'] ) ) {
							if ( empty( Redux_Core::$typography[ $font['font-family'] ]['font-weight'] ) || ! in_array( $font['font-weight'], Redux_Core::$typography[ $font['font-family'] ]['font-weight'], true ) ) {
								$style = $font['font-weight'];
							}

							if ( ! empty( $font['font-style'] ) ) {
								$style .= $font['font-style'];
							}

							if ( empty( Redux_Core::$typography[ $font['font-family'] ]['font-style'] ) || ! in_array( $style, Redux_Core::$typography[ $font['font-family'] ]['font-style'], true ) ) {
								Redux_Core::$typography[ $font['font-family'] ]['font-style'][] = $style;
							}
						}

						if ( ! empty( $font['subsets'] ) ) {
							if ( empty( Redux_Core::$typography[ $font['font-family'] ]['subset'] ) || ! in_array( $font['subsets'], Redux_Core::$typography[ $font['font-family'] ]['subset'], true ) ) {
								Redux_Core::$typography[ $font['font-family'] ]['subset'][] = $font['subsets'];
							}
						}
					}
				}
			}
		}

		/**
		 * Localize standard, custom and typekit fonts.
		 */
		private function localize_std_fonts() {
			if ( false === $this->user_fonts ) {
				if ( isset( Redux_Core::$fonts['std'] ) && ! empty( Redux_Core::$fonts['std'] ) ) {
					return;
				}

				Redux_Core::$font_groups['std'] = array(
					'text'     => esc_html__( 'Standard Fonts', 'redux-framework' ),
					'children' => array(),
				);

				foreach ( $this->field['fonts'] as $font => $extra ) {
					Redux_Core::$font_groups['std']['children'][] = array(
						'id'          => $font,
						'text'        => $font,
						'data-google' => 'false',
					);
				}
			}

			if ( false !== $this->field['custom_fonts'] ) {
				// phpcs:ignored WordPress.NamingConventions.ValidHookName
				$this->field['custom_fonts'] = apply_filters( "redux/{$this->parent->args['opt_name']}/field/typography/custom_fonts", array() );

				if ( ! empty( $this->field['custom_fonts'] ) ) {
					foreach ( $this->field['custom_fonts'] as $group => $fonts ) {
						Redux_Core::$font_groups['customfonts'] = array(
							'text'     => $group,
							'children' => array(),
						);

						foreach ( $fonts as $family => $v ) {
							Redux_Core::$font_groups['customfonts']['children'][] = array(
								'id'          => $family,
								'text'        => $family,
								'data-google' => 'false',
							);
						}
					}
				}
			}

			// Typekit.
			// phpcs:ignored WordPress.NamingConventions.ValidHookName
			$typekit_fonts = apply_filters( "redux/{$this->parent->args['opt_name']}/field/typography/typekit_fonts", array() );

			if ( ! empty( $typekit_fonts ) ) {
				foreach ( $typekit_fonts as $group => $fonts ) {
					Redux_Core::$font_groups['typekitfonts'] = array(
						'text'     => $group,
						'children' => array(),
					);

					foreach ( $fonts as $family => $v ) {
						Redux_Core::$font_groups['typekitfonts']['children'][] = array(
							'text'        => $family,
							'id'          => $family,
							'data-google' => 'false',
						);
					}
				}
			}
		}

		/**
		 *   Construct the Google array from the stored JSON/HTML
		 */
		private function get_google_array() {
			if ( ( ( isset( Redux_Core::$fonts['google'] ) && ! empty( Redux_Core::$fonts['google'] ) ) ) || ( isset( Redux_Core::$fonts['google'] ) && false === Redux_Core::$fonts['google'] ) ) {
				return;
			}

			$fonts = Redux_Helpers::google_fonts_array( get_option( 'auto_update_redux_google_fonts', false ) );
			if ( empty( $fonts ) ) {
				$google_font = \Redux_Core::$dir. '/inc/fields/typography/googlefonts.php';
				$fonts       = include $google_font;
			}

			if ( true === $fonts ) {
				Redux_Core::$fonts['google'] = false;

				return;
			}

			if ( isset( $fonts ) && ! empty( $fonts ) && is_array( $fonts ) && false !== $fonts ) {
                Redux_Core::$fonts['google'] = $fonts;
                Redux_Core::$google_array    = $fonts;

				// optgroup.
				Redux_Core::$font_groups['google'] = array(
					'text'     => esc_html__( 'Google Webfonts', 'redux-framework' ),
					'children' => array(),
				);

				// options.
				foreach ( Redux_Core::$fonts['google'] as $font => $extra ) {
					Redux_Core::$font_groups['google']['children'][] = array(
						'id'          => $font,
						'text'        => $font,
						'data-google' => 'true',
					);
				}
			}
		}

		/**
		 * Clean up the Google Webfonts subsets to be human-readable
		 *
		 * @param array $var Font subset array.
		 *
		 * @return array
		 */
		private function get_subsets( array $var ): array {
			$result = array();

			foreach ( $var as $v ) {
				if ( strpos( $v, '-ext' ) ) {
					$name = ucfirst( str_replace( '-ext', ' Extended', $v ) );
				} else {
					$name = ucfirst( $v );
				}

				array_push(
					$result,
					array(
						'id'   => $v,
						'name' => $name,
					)
				);
			}

			return array_filter( $result );
		}

		/**
		 * Clean up the Google Webfonts variants to be human readable
		 *
		 * @since ReduxFramework 0.2.0
		 *
		 * @param array $var Font variant array.
		 *
		 * @return array
		 */
		private function get_variants( array $var ): array {
			$result = array();
			$italic = array();

			foreach ( $var as $v ) {
				$name = '';
				if ( 1 === $v[0] ) {
					$name = 'Ultra-Light 100';
				} elseif ( 2 === $v[0] ) {
					$name = 'Light 200';
				} elseif ( 3 === $v[0] ) {
					$name = 'Book 300';
				} elseif ( 4 === $v[0] || 'r' === $v[0] || 'i' === $v[0] ) {
					$name = 'Normal 400';
				} elseif ( 5 === $v[0] ) {
					$name = 'Medium 500';
				} elseif ( 6 === $v[0] ) {
					$name = 'Semi-Bold 600';
				} elseif ( 7 === $v[0] ) {
					$name = 'Bold 700';
				} elseif ( 8 === $v[0] ) {
					$name = 'Extra-Bold 800';
				} elseif ( 9 === $v[0] ) {
					$name = 'Ultra-Bold 900';
				}

				if ( 'regular' === $v ) {
					$v = '400';
				}

				if ( strpos( $v, 'italic' ) || 'italic' === $v ) {
					$name .= ' Italic';
					$name  = trim( $name );
					if ( 'italic' === $v ) {
						$v = '400italic';
					}
					$italic[] = array(
						'id'   => $v,
						'name' => $name,
					);
				} else {
					$result[] = array(
						'id'   => $v,
						'name' => $name,
					);
				}
			}

			foreach ( $italic as $item ) {
				$result[] = $item;
			}

			return array_filter( $result );
		}

		/**
		 * Update google font array via AJAX call.
		 */
		public function google_fonts_update_ajax() {
			if ( ! isset( $_POST['nonce'] ) || ( isset( $_POST['nonce'] ) && ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nonce'] ) ), 'redux_update_google_fonts' ) ) ) {
				die( 'Security check' );
			}

			if ( isset( $_POST['data'] ) && 'automatic' === $_POST['data'] ) {
				update_option( 'auto_update_redux_google_fonts', true );
			}

			if ( ! Redux_Functions_Ex::activated() ) {
				Redux_Functions_Ex::set_activated();
			}

			$fonts = Redux_Helpers::google_fonts_array( true );

			if ( ! empty( $fonts ) && ! is_wp_error( $fonts ) ) {
				echo wp_json_encode(
					array(
						'status' => 'success',
						'fonts'  => $fonts,
					)
				);
			} else {
				$err_msg = '';

				if ( is_wp_error( $fonts ) ) {
					$err_msg = $fonts->get_error_code();
				}

				echo wp_json_encode(
					array(
						'status' => 'error',
						'error'  => $err_msg,
					)
				);
			}

			die();
		}

		/**
		 * Enable output_variables to be generated.
		 *
		 * @since       4.0.3
		 * @return void
		 */
		public function output_variables() {
			// No code needed, just defining the method is enough.
		}

        protected function get_devices(){

            $devices    = array(
                'xlarge' => array(
                    'title'=> esc_html__('Large Screen', 'templaza-framework'),
//                    'icon' => 'dashicons dashicons-desktop',
                    'uk-icon' => 'tv',
                ),
                'desktop' => array(
                    'title'=> esc_html__('Desktop', 'templaza-framework'),
                    'icon' => 'dashicons dashicons-desktop',
                    'uk-icon' => 'desktop',
                ),
                'laptop' => array(
                    'title'=> esc_html__('Laptop', 'templaza-framework'),
                    'icon' => 'dashicons dashicons-laptop',
                    'uk-icon' => 'laptop',
                ),
                'tablet'  => array(
                    'title'=> esc_html__('Tablet', 'templaza-framework'),
                    'icon' => 'dashicons dashicons-tablet',
                    'uk-icon' => 'tablet',
                ),
                'mobile'  => array(
                    'title'=> esc_html__('Mobile', 'templaza-framework'),
                    'icon' => 'dashicons dashicons-smartphone',
                    'uk-icon' => 'phone',
                ),
            );
            return $devices;
        }
	}
}
if ( ! class_exists( 'ReduxFramework_Typography' ) ) {
	class_alias( 'Redux_Typography', 'ReduxFramework_Typography' );
}

