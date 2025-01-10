<?php

namespace TemPlazaFramework;

defined('TEMPLAZA_FRAMEWORK') or exit();

//require_once \ReduxFramework::. '/inc/classes/class-redux-functions-ex.php';
//var_dump(class_exists('Redux_Core'));

class Enqueue extends \Redux_Enqueue{

    private $min = '';
    private $timestamp = '';
    private $repeater_data = array();

    public function init() {
        $core = $this->core();

        \Redux_Functions::$parent = $core;

        $this->min = \Redux_Functions::is_min();

        $this->timestamp = \Redux_Core::$version;
        if ( $core->args['dev_mode'] ) {
            $this->timestamp .= '.' . time();
        }

        $this->register_styles( $core );
        $this->register_scripts( $core );

        add_thickbox();

        $this->enqueue_fields( $core );

        add_filter( "redux/{$core->args['opt_name']}/localize", array( 'Redux_Helpers', 'localize' ) );

        $this->set_localized_data( $core );

        /**
         * Action 'redux/page/{opt_name}/enqueue'
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        do_action( "redux/page/{$core->args['opt_name']}/enqueue" );
    }

    public function set_localized_data( $core ) {
        if ( ! empty( $core->args['last_tab'] ) ) {
            $this->localize_data['last_tab'] = $core->args['last_tab'];
        }

        if(isset($core->core_instance)) {
            $this->localize_data['core_instance'] = $core->core_instance;
        }
        if(isset($core -> core_thread)) {
            $this->localize_data['core_thread'] = $core->core_thread;
        }

        $this->localize_data['font_weights'] = $this->args['font_weights'];

        $this->localize_data['required'] = \Redux_Core::$required;
        $this->repeater_data['fonts']    = \Redux_Core::$fonts;
        if ( ! isset( $this->repeater_data['opt_names'] ) ) {
            $this->repeater_data['opt_names'] = array();
        }
        $this->repeater_data['opt_names'][]    = $core->args['opt_name'];
        $this->repeater_data['folds']          = array();
        $this->localize_data['required_child'] = \Redux_Core::$required_child;
        $this->localize_data['fields']         = $core->fields;

        if ( isset( $core->font_groups['google'] ) ) {
            $this->repeater_data['googlefonts'] = $core->font_groups['google'];
        }

        if ( isset( $core->font_groups['std'] ) ) {
            $this->repeater_data['stdfonts'] = $core->font_groups['std'];
        }

        if ( isset( $core->font_groups['customfonts'] ) ) {
            $this->repeater_data['customfonts'] = $core->font_groups['customfonts'];
        }

        if ( isset( $core->font_groups['typekitfonts'] ) ) {
            $this->repeater_data['typekitfonts'] = $core->font_groups['typekitfonts'];
        }

        $this->localize_data['folds'] = \Redux_Core::$folds;

        // Make sure the children are all hidden properly.
        foreach ( $core->fields as $key => $value ) {
            if ( in_array( $key, $core->fields_hidden, true ) ) {
                foreach ( $value as $k => $v ) {
                    if ( ! in_array( $k, $core->fields_hidden, true ) ) {
                        $core->fields_hidden[] = $k;
                        $core->folds[ $k ]     = 'hide';
                    }
                }
            }
        }

        $this->localize_data['fields_hidden'] = \Redux_Core::$fields_hidden;
        $this->localize_data['options']       = $core->options;
        $this->localize_data['defaults']      = $core->options_defaults;

        /**
         * Save pending string
         * filter 'redux/{opt_name}/localize/save_pending
         *
         * @param     string        save_pending string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $save_pending = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/save_pending",
            esc_html__(
                'You have changes that are not saved. Would you like to save them now?',
                'redux-framework'
            )
        );

        /**
         * Reset all string
         * filter 'redux/{opt_name}/localize/reset
         *
         * @param     string        reset all string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $reset_all = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/reset",
            esc_html__(
                'Are you sure? Resetting will lose all custom values.',
                'redux-framework'
            )
        );

        /**
         * Reset section string
         * filter 'redux/{opt_name}/localize/reset_section
         *
         * @param     string        reset section string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $reset_section = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/reset_section",
            esc_html__(
                'Are you sure? Resetting will lose all custom values in this section.',
                'redux-framework'
            )
        );

        /**
         * Preset confirm string
         * filter 'redux/{opt_name}/localize/preset
         *
         * @param     string        preset confirm string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $preset_confirm = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/preset",
            esc_html__(
                'Your current options will be replaced with the values of this preset. Would you like to proceed?',
                'redux-framework'
            )
        );

        /**
         * Import confirm string
         * filter 'redux/{opt_name}/localize/import
         *
         * @param     string        import confirm string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $import_confirm = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/import",
            esc_html__(
                'Your current options will be replaced with the values of this import. Would you like to proceed?',
                'redux-framework'
            )
        );

        global $pagenow;

        $this->localize_data['args'] = array(
            'dev_mode'               => $core->args['dev_mode'],
            'save_pending'           => $save_pending,
            'reset_confirm'          => $reset_all,
            'reset_section_confirm'  => $reset_section,
            'preset_confirm'         => $preset_confirm,
            'import_section_confirm' => $import_confirm,
            'please_wait'            => esc_html__( 'Please Wait', 'redux-framework' ),
            'opt_name'               => $core->args['opt_name'],
            'flyout_submenus'        => isset( $core->args['pro']['flyout_submenus'] ) ? $core->args['pro']['flyout_submenus'] : false,
            'slug'                   => $core->args['page_slug'],
            'hints'                  => $core->args['hints'],
            'disable_save_warn'      => $core->args['disable_save_warn'],
            'class'                  => $core->args['class'],
            'ajax_save'              => $core->args['ajax_save'],
            'menu_search'            => $pagenow . '?page=' . $core->args['page_slug'] . '&tab=',
        );

        $this->localize_data['ajax'] = array(
            'console' => esc_html__(
                'There was an error saving. Here is the result of your action:',
                'redux-framework'
            ),
            'alert'   => esc_html__(
                'There was a problem with your action. Please try again or reload the page.',
                'redux-framework'
            ),
        );

//            // phpcs:ignore WordPress.NamingConventions.ValidHookName
//            $this->localize_data = apply_filters( "redux/{$core->args['opt_name']}/localize", $this->localize_data );
//
//            // phpcs:ignore WordPress.NamingConventions.ValidHookName
//            $this->repeater_data = apply_filters( "redux/{$core->args['opt_name']}/repeater", $this->repeater_data );

        $this->get_warnings_and_errors_array();

        if ( ! isset( $core->repeater_data ) ) {
            $core->repeater_data = array();
        }
        $core->repeater_data = \Redux_Functions_Ex::nested_wp_parse_args(
            $this->repeater_data,
            $core->repeater_data
        );

        if ( ! isset( $core->localize_data ) ) {
            $core->localize_data = array();
        }
        $core->localize_data = \Redux_Functions_Ex::nested_wp_parse_args(
            $this->localize_data,
            $core->localize_data
        );

        // Shim for extension compatibility.
        if ( \Redux::$extension_compatibility ) {
            $this->repeater_data = \Redux_Functions_Ex::nested_wp_parse_args(
                $this->localize_data,
                $core->repeater_data
            );
        }

        if(!Admin_Functions::is_localize_script('redux-js',
            'redux_' . str_replace( '-', '_', $core->args['opt_name'] ))) {
            wp_localize_script(
                'redux-js',
                'redux_' . str_replace('-', '_', $core->args['opt_name']),
                $this->localize_data
            );
        }
    }


    private function enqueue_fields( $core ) {
        $data = array();

        foreach ( $core->sections as $section ) {
            if ( isset( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    $this->enqueue_field( $core, $field );
                }
            }
        }
    }
    /**
     * Register all core framework styles.
     *
     * @param     object $core ReduxFramework object.
     */
    private function register_styles( $core ) {

        // *****************************************************************
        // Redux Admin CSS
        // *****************************************************************
        if ( 'wordpress' === $core->args['admin_theme'] || 'wp' === $core->args['admin_theme'] ) { // phpcs:ignore WordPress.WP.CapitalPDangit
            $color_scheme = get_user_option( 'admin_color' );
        } elseif ( 'classic' === $core->args['admin_theme'] || '' === $core->args['admin_theme'] ) {
            $color_scheme = 'classic';
        } else {
            $color_scheme = $core->args['admin_theme'];
        }

        if ( ! file_exists( \Redux_Core::$dir . "assets/css/colors/$color_scheme/colors{$this->min}.css" ) ) {
            $color_scheme = 'fresh';
        }

        $css = \Redux_Core::$url . "assets/css/colors/$color_scheme/colors{$this->min}.css";

        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $css = apply_filters( 'redux/enqueue/' . $core->args['opt_name'] . '/args/admin_theme/css_url', $css );

        wp_register_style(
            'redux-admin-theme-css',
            $css,
            array(),
            $this->timestamp,
            'all'
        );

        wp_enqueue_style(
            'redux-admin-css',
            \Redux_Core::$url . "assets/css/redux-admin{$this->min}.css",
            array( 'redux-admin-theme-css' ),
            $this->timestamp,
            'all'
        );

        // *****************************************************************
        // Redux Fields CSS
        // *****************************************************************
        if ( ! $core->args['dev_mode'] ) {
            wp_enqueue_style(
                'redux-fields-css',
                \Redux_Core::$url . 'assets/css/redux-fields.min.css',
                array(),
                $this->timestamp,
                'all'
            );
        }

        // *****************************************************************
        // Select2 CSS
        // *****************************************************************
        wp_enqueue_style(
            'select2-css',
            \Redux_Core::$url . 'assets/css/vendor/select2.min.css',
            array(),
            '4.0.5',
            'all'
        );

        // *****************************************************************
        // Spectrum CSS
        // *****************************************************************
        $css_file = 'redux-spectrum.css';

        wp_register_style(
            'redux-spectrum-css',
            \Redux_Core::$url . "assets/css/vendor/spectrum{$this->min}.css",
            array(),
            '1.3.3',
            'all'
        );

        // *****************************************************************
        // Elusive Icon CSS
        // *****************************************************************
        wp_enqueue_style(
            'redux-elusive-icon',
            \Redux_Core::$url . "assets/css/vendor/elusive-icons{$this->min}.css",
            array(),
            $this->timestamp,
            'all'
        );

        // *****************************************************************
        // QTip CSS
        // *****************************************************************
        wp_enqueue_style(
            'qtip-css',
            \Redux_Core::$url . "assets/css/vendor/qtip{$this->min}.css",
            array(),
            '2.2.0',
            'all'
        );

        // *****************************************************************
        // JQuery UI CSS
        // *****************************************************************

        wp_enqueue_style(
            'jquery-ui-css',
            // phpcs:ignore WordPress.NamingConventions.ValidHookName
            apply_filters(
            // phpcs:ignore WordPress.NamingConventions.ValidHookName
                "redux/page/{$core->args['opt_name']}/enqueue/jquery-ui-css",
                \Redux_Core::$url . 'assets/css/vendor/jquery-ui-1.10.0.custom.css'
            ),
            array(),
            $this->timestamp,
            'all'
        );

        // *****************************************************************
        // Iris CSS
        // *****************************************************************
        wp_enqueue_style( 'wp-color-picker' );

        if ( $core->args['dev_mode'] ) {
            // *****************************************************************
            // Media CSS
            // *****************************************************************
            wp_enqueue_style(
                'redux-field-media-css',
                \Redux_Core::$url . 'assets/css/media.css',
                array(),
                $this->timestamp,
                'all'
            );
        }

        // *****************************************************************
        // RTL CSS
        // *****************************************************************
        if ( is_rtl() ) {
            wp_enqueue_style(
                'redux-rtl-css',
                \Redux_Core::$url . 'assets/css/rtl.css',
                array( 'redux-admin-css' ),
                $this->timestamp,
                'all'
            );
        }
    }

    /**
     * Register all core framework scripts.
     *
     * @param     object $core ReduxFramework object.
     */
    private function register_scripts( $core ) {
        // *****************************************************************
        // JQuery / JQuery UI JS
        // *****************************************************************
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-dialog' );

        // *****************************************************************
        // Select2 Sortable JS
        // *****************************************************************
        wp_register_script(
            'redux-select2-sortable-js',
            \Redux_Core::$url . 'assets/js/vendor/select2-sortable/redux.select2.sortable' . $this->min . '.js',
            array( 'jquery', 'jquery-ui-sortable' ),
            $this->timestamp,
            true
        );

        wp_enqueue_script(
            'select2-js',
            \Redux_Core::$url . 'assets/js/vendor/select2/select2' . $this->min . '.js`',
            array( 'jquery', 'redux-select2-sortable-js' ),
            '4.0.5',
            true
        );

        // *****************************************************************
        // QTip JS
        // *****************************************************************
        wp_enqueue_script(
            'qtip-js',
            \Redux_Core::$url . 'assets/js/vendor/qtip/qtip' . $this->min . '.js',
            array( 'jquery' ),
            '2.2.0',
            true
        );

        // *****************************************************************
        // Spectrum JS
        // *****************************************************************
        $js_file = 'redux-spectrum.min.js';

        if ( $core->args['dev_mode'] ) {
            $js_file = 'redux-spectrum.js';
        }

        wp_register_script(
            'redux-spectrum-js',
            \Redux_Core::$url . 'assets/js/vendor/spectrum/' . $js_file,
            array( 'jquery' ),
            '1.3.3',
            true
        );

        $dep_array = array( 'jquery' );

        // *****************************************************************
        // Vendor JS
        // *****************************************************************
        wp_register_script(
            'redux-vendor',
            \Redux_Core::$url . 'assets/js/redux-vendors' . $this->min . '.js',
            array( 'jquery' ),
            $this->timestamp,
            true
        );

        array_push( $dep_array, 'redux-vendor' );

        // *****************************************************************
        // Redux JS
        // *****************************************************************
        wp_register_script(
            'redux-js',
            \Redux_Core::$url . 'assets/js/redux' . $this->min . '.js',
            $dep_array,
            $this->timestamp,
            true
        );

        if ( $core->args['async_typography'] ) {
            wp_enqueue_script(
                'webfontloader',
                // phpcs:ignore Generic.Strings.UnnecessaryStringConcat
                '//' . 'ajax' . '.googleapis' . '.com/ajax/libs/webfont/1.6.26/webfont.js',
                array( 'jquery' ),
                '1.6.26',
                true
            );
        }
    }

    /**
     *
     * */
    public function framework_init() {
        $core = $this->core();

        \Redux_Functions::$parent = $core;

        $this->min = \Redux_Functions::is_min();

        $this->timestamp = \Redux_Core::$version;
        if ( $core->args['dev_mode'] ) {
            $this->timestamp .= '.' . time();
        }

        $this->framework_register_styles( $core );
        $this->framework_register_scripts( $core );

        add_thickbox();

        $this->framework_enqueue_fields( $core );

        add_filter( "redux/{$core->args['opt_name']}/localize", array( 'Redux_Helpers', 'localize' ) );

        $this->framework_set_localized_data( $core );

        /**
         * Action 'redux/page/{opt_name}/enqueue'
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        do_action( "redux/page/{$core->args['opt_name']}/enqueue" );
    }

    public function framework_set_localized_data( $core ) {
        if ( ! empty( $core->args['last_tab'] ) ) {
            $this->localize_data['last_tab'] = $core->args['last_tab'];
        }

        if(isset($core -> core_instance)) {
            $this->localize_data['core_instance'] = $core->core_instance;
        }
        if(isset($core -> core_thread)) {
            $this->localize_data['core_thread'] = $core->core_thread;
        }

        $this->localize_data['font_weights'] = $this->args['font_weights'];

        $this->localize_data['required'] = \Redux_Core::$required;
        $this->repeater_data['fonts']    = \Redux_Core::$fonts;
        if ( ! isset( $this->repeater_data['opt_names'] ) ) {
            $this->repeater_data['opt_names'] = array();
        }
        $this->repeater_data['opt_names'][]    = $core->args['opt_name'];
        $this->repeater_data['folds']          = array();
        $this->localize_data['required_child'] = \Redux_Core::$required_child;
        $this->localize_data['fields']         = $core->fields;

        if ( isset( $core->font_groups['google'] ) ) {
            $this->repeater_data['googlefonts'] = \Redux_Core::$font_groups['google'];
        }

        if ( isset( $core->font_groups['std'] ) ) {
            $this->repeater_data['stdfonts'] = \Redux_Core::$font_groups['std'];
        }

        if ( isset( $core->font_groups['customfonts'] ) ) {
            $this->repeater_data['customfonts'] = \Redux_Core::$font_groups['customfonts'];
        }

        if ( isset( $core->font_groups['typekitfonts'] ) ) {
            $this->repeater_data['typekitfonts'] = \Redux_Core::$font_groups['typekitfonts'];
        }

        $this->localize_data['folds'] = \Redux_Core::$folds;

        // Make sure the children are all hidden properly.
        foreach ( $core->fields as $key => $value ) {
            if ( in_array( $key, \Redux_Core::$fields_hidden, true ) ) {
                foreach ( $value as $k => $v ) {
                    if ( ! in_array( $k, \Redux_Core::$fields_hidden, true ) ) {
                        \Redux_Core::$fields_hidden[] = $k;
                        \Redux_Core::$folds[ $k ]     = 'hide';
                    }
                }
            }
        }

        $this->localize_data['fields_hidden'] = \Redux_Core::$fields_hidden;
        $this->localize_data['options']       = $core->options;
        $this->localize_data['defaults']      = $core->options_defaults;

        /**
         * Save pending string
         * filter 'redux/{opt_name}/localize/save_pending
         *
         * @param     string        save_pending string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $save_pending = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/save_pending",
            esc_html__(
                'You have changes that are not saved. Would you like to save them now?',
                'redux-framework'
            )
        );

        /**
         * Reset all string
         * filter 'redux/{opt_name}/localize/reset
         *
         * @param     string        reset all string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $reset_all = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/reset",
            esc_html__(
                'Are you sure? Resetting will lose all custom values.',
                'redux-framework'
            )
        );

        /**
         * Reset section string
         * filter 'redux/{opt_name}/localize/reset_section
         *
         * @param     string        reset section string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $reset_section = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/reset_section",
            esc_html__(
                'Are you sure? Resetting will lose all custom values in this section.',
                'redux-framework'
            )
        );

        /**
         * Preset confirm string
         * filter 'redux/{opt_name}/localize/preset
         *
         * @param     string        preset confirm string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $preset_confirm = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/preset",
            esc_html__(
                'Your current options will be replaced with the values of this preset. Would you like to proceed?',
                'redux-framework'
            )
        );

        /**
         * Import confirm string
         * filter 'redux/{opt_name}/localize/import
         *
         * @param     string        import confirm string
         */
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $import_confirm = apply_filters(
        // phpcs:ignore WordPress.NamingConventions.ValidHookName
            "redux/{$core->args['opt_name']}/localize/import",
            esc_html__(
                'Your current options will be replaced with the values of this import. Would you like to proceed?',
                'redux-framework'
            )
        );

        global $pagenow;

        $this->localize_data['args'] = array(
            'dev_mode'               => $core->args['dev_mode'],
            'save_pending'           => $save_pending,
            'reset_confirm'          => $reset_all,
            'reset_section_confirm'  => $reset_section,
            'preset_confirm'         => $preset_confirm,
            'import_section_confirm' => $import_confirm,
            'please_wait'            => esc_html__( 'Please Wait', 'redux-framework' ),
            'opt_name'               => $core->args['opt_name'],
            'flyout_submenus'        => isset( $core->args['pro']['flyout_submenus'] ) ? $core->args['pro']['flyout_submenus'] : false,
            'slug'                   => $core->args['page_slug'],
            'hints'                  => $core->args['hints'],
            'disable_save_warn'      => $core->args['disable_save_warn'],
            'class'                  => $core->args['class'],
            'ajax_save'              => $core->args['ajax_save'],
            'menu_search'            => $pagenow . '?page=' . $core->args['page_slug'] . '&tab=',
        );

        $this->localize_data['ajax'] = array(
            'console' => esc_html__(
                'There was an error saving. Here is the result of your action:',
                'redux-framework'
            ),
            'alert'   => esc_html__(
                'There was a problem with your action. Please try again or reload the page.',
                'redux-framework'
            ),
        );

        $this->get_warnings_and_errors_array();

        if ( ! isset( $core->repeater_data ) ) {
            $core->repeater_data = array();
        }
        $core->repeater_data = \Redux_Functions_Ex::nested_wp_parse_args(
            $this->repeater_data,
            $core->repeater_data
        );

        if ( ! isset( $core->localize_data ) ) {
            $core->localize_data = array();
        }
        $core->localize_data = \Redux_Functions_Ex::nested_wp_parse_args(
            $this->localize_data,
            $core->localize_data
        );

        // Shim for extension compatibility.
        if ( \Redux::$extension_compatibility ) {
            $this->repeater_data = \Redux_Functions_Ex::nested_wp_parse_args(
                $this->localize_data,
                $core->repeater_data
            );
        }

        if(!Admin_Functions::is_localize_script('redux-js',
            'redux_' . str_replace( '-', '_', $core->args['opt_name'] ))) {
            wp_localize_script(
                'redux-js',
                'redux_' . str_replace('-', '_', $core->args['opt_name']),
                $this->localize_data
            );
        }
    }


    private function framework_enqueue_fields( $core ) {
        $data = array();

        foreach ( $core->sections as $section ) {
            if ( isset( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    $this->enqueue_field( $core, $field );
                }
            }
        }
    }
    /**
     * Register all core framework styles.
     *
     * @param     object $core ReduxFramework object.
     */
    private function framework_register_styles( $core ) {

        // *****************************************************************
        // Redux Admin CSS
        // *****************************************************************
        if ( 'wordpress' === $core->args['admin_theme'] || 'wp' === $core->args['admin_theme'] ) { // phpcs:ignore WordPress.WP.CapitalPDangit
            $color_scheme = get_user_option( 'admin_color' );
        } elseif ( 'classic' === $core->args['admin_theme'] || '' === $core->args['admin_theme'] ) {
            $color_scheme = 'classic';
        } else {
            $color_scheme = $core->args['admin_theme'];
        }

        if ( ! file_exists( \Redux_Core::$dir . "assets/css/colors/$color_scheme/colors{$this->min}.css" ) ) {
            $color_scheme = 'fresh';
        }

        $css = \Redux_Core::$url . "assets/css/colors/$color_scheme/colors{$this->min}.css";

        // phpcs:ignore WordPress.NamingConventions.ValidHookName
        $css = apply_filters( 'redux/enqueue/' . $core->args['opt_name'] . '/args/admin_theme/css_url', $css );

        wp_register_style(
            'redux-admin-theme-css',
            $css,
            array(),
            $this->timestamp,
            'all'
        );

        wp_enqueue_style(
            'redux-admin-css',
            \Redux_Core::$url . "assets/css/redux-admin{$this->min}.css",
            array( 'redux-admin-theme-css' ),
            $this->timestamp,
            'all'
        );

        // *****************************************************************
        // Redux Fields CSS
        // *****************************************************************
        if ( ! $core->args['dev_mode'] ) {
            wp_enqueue_style(
                'redux-fields-css',
                \Redux_Core::$url . 'assets/css/redux-fields.min.css',
                array(),
                $this->timestamp,
                'all'
            );
        }

        // *****************************************************************
        // Select2 CSS
        // *****************************************************************
        wp_enqueue_style(
            'select2-css',
            \Redux_Core::$url . 'assets/css/vendor/select2.min.css',
            array(),
            '4.0.5',
            'all'
        );

        // *****************************************************************
        // Spectrum CSS
        // *****************************************************************
        $css_file = 'redux-spectrum.css';

        wp_register_style(
            'redux-spectrum-css',
            \Redux_Core::$url . "assets/css/vendor/spectrum{$this->min}.css",
            array(),
            '1.3.3',
            'all'
        );

        // *****************************************************************
        // Elusive Icon CSS
        // *****************************************************************
        wp_enqueue_style(
            'redux-elusive-icon',
            \Redux_Core::$url . "assets/css/vendor/elusive-icons{$this->min}.css",
            array(),
            $this->timestamp,
            'all'
        );

        // *****************************************************************
        // QTip CSS
        // *****************************************************************
        wp_enqueue_style(
            'qtip-css',
            \Redux_Core::$url . "assets/css/vendor/qtip{$this->min}.css",
            array(),
            '2.2.0',
            'all'
        );

        // *****************************************************************
        // JQuery UI CSS
        // *****************************************************************

        wp_enqueue_style(
            'jquery-ui-css',
            // phpcs:ignore WordPress.NamingConventions.ValidHookName
            apply_filters(
            // phpcs:ignore WordPress.NamingConventions.ValidHookName
                "redux/page/{$core->args['opt_name']}/enqueue/jquery-ui-css",
                \Redux_Core::$url . 'assets/css/vendor/jquery-ui-1.10.0.custom.css'
            ),
            array(),
            $this->timestamp,
            'all'
        );

        // *****************************************************************
        // Iris CSS
        // *****************************************************************
        wp_enqueue_style( 'wp-color-picker' );

        if ( $core->args['dev_mode'] ) {
            // *****************************************************************
            // Media CSS
            // *****************************************************************
            wp_enqueue_style(
                'redux-field-media-css',
                \Redux_Core::$url . 'assets/css/media.css',
                array(),
                $this->timestamp,
                'all'
            );
        }

        // *****************************************************************
        // RTL CSS
        // *****************************************************************
        if ( is_rtl() ) {
            wp_enqueue_style(
                'redux-rtl-css',
                \Redux_Core::$url . 'assets/css/rtl.css',
                array( 'redux-admin-css' ),
                $this->timestamp,
                'all'
            );
        }
    }

    /**
     * Register all core framework scripts.
     *
     * @param     object $core ReduxFramework object.
     */
    private function framework_register_scripts( $core ) {
        // *****************************************************************
        // JQuery / JQuery UI JS
        // *****************************************************************
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-dialog' );

        // *****************************************************************
        // Select2 Sortable JS
        // *****************************************************************
        wp_register_script(
            'redux-select2-sortable-js',
            \Redux_Core::$url . 'assets/js/vendor/select2-sortable/redux.select2.sortable' . $this->min . '.js',
            array( 'jquery', 'jquery-ui-sortable' ),
            $this->timestamp,
            true
        );

        wp_enqueue_script(
            'select2-js',
            \Redux_Core::$url . 'assets/js/vendor/select2/select2' . $this->min . '.js`',
            array( 'jquery', 'redux-select2-sortable-js' ),
            '4.0.5',
            true
        );

        // *****************************************************************
        // QTip JS
        // *****************************************************************
        wp_enqueue_script(
            'qtip-js',
            \Redux_Core::$url . 'assets/js/vendor/qtip/qtip' . $this->min . '.js',
            array( 'jquery' ),
            '2.2.0',
            true
        );

        // *****************************************************************
        // Spectrum JS
        // *****************************************************************
        $js_file = 'redux-spectrum.min.js';

        if ( $core->args['dev_mode'] ) {
            $js_file = 'redux-spectrum.js';
        }

        wp_register_script(
            'redux-spectrum-js',
            \Redux_Core::$url . 'assets/js/vendor/spectrum/' . $js_file,
            array( 'jquery' ),
            '1.3.3',
            true
        );

        $dep_array = array( 'jquery' );

        // *****************************************************************
        // Vendor JS
        // *****************************************************************
        wp_register_script(
            'redux-vendor',
            \Redux_Core::$url . 'assets/js/redux-vendors' . $this->min . '.js',
            array( 'jquery' ),
            $this->timestamp,
            true
        );

        array_push( $dep_array, 'redux-vendor' );

        // *****************************************************************
        // Redux JS
        // *****************************************************************
        wp_register_script(
            'redux-js',
            \Redux_Core::$url . 'assets/js/redux' . $this->min . '.js',
            $dep_array,
            $this->timestamp,
            true
        );

        if ( $core->args['async_typography'] ) {
            wp_enqueue_script(
                'webfontloader',
                // phpcs:ignore Generic.Strings.UnnecessaryStringConcat
                '//' . 'ajax' . '.googleapis' . '.com/ajax/libs/webfont/1.6.26/webfont.js',
                array( 'jquery' ),
                '1.6.26',
                true
            );
        }
    }
}