<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Functions;
use TemPlazaFramework\Helpers\FieldHelper;

if ( ! class_exists( 'ReduxFramework_TZ_Layout' ) ) {
    class ReduxFramework_TZ_Layout extends Redux_Field
    {
        protected $text_domain;
        protected $elements;
        protected $templates = array();

        public function __construct( $field = array(), $value = null, $parent = null ) {
            $this -> text_domain    = Functions::get_my_text_domain();
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
            $this -> elements  = array();
//            $this -> templates = array();

            $this -> load_element();

            $this -> field['core']  = array('section', 'row', 'column');

//            add_action('redux/page/'.$this->parent->args['opt_name'].'/enqueue', array($this, 'test'));

//            add_action('admin_footer', array($this, 'template'));

        }

        protected function load_element(){

            $folder_path    = TEMPLAZA_FRAMEWORK_SHORTCODES_PATH;
            $theme_path     = TEMPLAZA_FRAMEWORK_THEME_PATH_SHORTCODES;

            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            global $wp_filesystem;
            WP_Filesystem();
            $folders  = Functions::list_files($folder_path,'.', 1);
            $count      = count($folders);

            // Require options from theme
            if(is_dir($theme_path)){
                $theme_files    = Functions::list_files($theme_path, '.', 1);
                $folders    = array_merge($folders, $theme_files);
            }

            foreach($folders as $folder){
                $file_name  = basename($folder);

                $class      = 'TemplazaFramework_ShortCode_'.$file_name;
                if(!class_exists($class)){
                    $file_path  = $folder.'/'.$file_name.'.php';

                    if(file_exists($file_path)){
                        require_once $file_path;
                    }
                }
                if(class_exists($class)){
                    $element    = new $class($this -> field, '', $this -> parent);
                    $this -> elements[$file_name]    = $element;

                    apply_filters('templaza-framework/field/tz_layout/element', $element, $this);

                    if(method_exists($element, 'enqueue')) {

//                        add_action('redux/page/'.$this->parent->args['opt_name'].'/enqueue', array($element, 'enqueue'));
                        $element->enqueue();
                    }
                }
            }
        }







        public function render(){
            add_action('admin_footer', array($this, 'template'));

//            $fl_layout   = array(
////                'sections' => array(
//                    // Section 1
//                    array(
////                        'name' => 'Section',
//                        'type'  => 'section',
//                        'admin_label'  => 'Heading',
//                        'params' => array(
//                            'title' => 'Section Title',
//                            'tz_customclass' => '',
//                        ),
//                        // Row
//                        'elements' => array(
//                            array(
//                                'title'       => __('Row'),
//                                'type' => 'row',
//                                'params' => array(
//                                    'tz_customid' => '',
//                                    'tz_customclass' => '',
//                                ),
//                                // Columns
//                                'elements' => array(
//                                    // Column 1
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 6,
//                                        'params' => array(
//                                            'tz_customid'  => time(),
//                                            'tz_customclass' => 'test-2',
////                                            array('customid' => time()),
////                                            array(),
////                                            array(
////                                                'name' => 'customid',
////                                                'value' => '',
////                                            ),
////                                            array(
////                                                'name' => 'tz_customclass',
////                                                'value' => '',
////                                            ),
//                                        ),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'admin_label' => __('Header Element'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                )
//                                            ),
//                                        ) // End elements
//                                    ), // End Column 1
//                                    // Column 2
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 6,
//                                        'params'=> array(),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                )
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                )
//                                            ),
//                                        ) // End elements
//                                    ),// End column 2
//                                ),
//                            ), // End row 1
//                            array(
//                                'title'       => __('Row'),
//                                'type' => 'row',
//                                'params' => array(
//                                    'tz_customid' => '',
//                                    'tz_customclass' => '',
//                                ),
//                                // Columns
//                                'elements' => array(
//                                    // Column 1
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 6,
//                                        'params' => array(
//                                            'tz_customid' => '',
//                                            'tz_customclass' => '',
//                                        ),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                        ) // End elements
//                                    ), // End Column 1
//                                    // Column 2
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 6,
//                                        'params'=> array(),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                        ) // End elements
//                                    ),// End column 2
//                                ),
//                            ), // End row 1
//                            array(
//                                'title'       => __('Row 2'),
//                                'type' => 'row',
//                                'params' => array(
//                                    'tz_customid' => '',
//                                    'tz_customclass' => '',
//                                ),
//                                // Columns
//                                'elements' => array(
//                                    // Column 1
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 4,
//                                        'params' => array(
//                                            'tz_customid' => '',
//                                            'tz_customclass' => '',
//                                        ),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'copyright',
//                                                'icon'        => 'far fa-copyright',
//                                                'title'       => __('Copyright'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                        ) // End elements
//                                    ), // End Column 2.1
//                                    // Column 2.2
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 4,
//                                        'params'=> array(),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                        ) // End elements
//                                    ),// End column 2.2
//
//                                    // Column 2.3
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 4,
//                                        'params' => array(
//                                            'tz_customid' => '',
//                                            'tz_customclass' => '',
//                                        ),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'copyright',
//                                                'icon'        => 'far fa-copyright',
//                                                'title'       => __('Copyright'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                        ) // End elements
//                                    ), // End Column 2.3
//                                ),
//                            ), // End rows
//                        ),
//                    ), // End section 1
//                    // Section 2
//                    array(
////                        'name' => 'Section',
//                        'type'  => 'section',
//                        'params' => array(
//                            'title' => 'Section Title',
//                            'tz_customclass' => '',
//                        ),
//                        // Row
//                        'elements' => array(
//                            array(
//                                'title'       => __('Row'),
//                                'type' => 'row',
//                                'params' => array(
//                                    'tz_customid' => '',
//                                    'tz_customclass' => '',
//                                ),
//                                // Columns
//                                'elements' => array(
//                                    // Column 1
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 8,
//                                        'params' => array(
//                                            'tz_customid' => '',
//                                            'tz_customclass' => '',
//                                        ),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                        ) // End elements
//                                    ), // End Column 1
//                                    // Column 2
//                                    array(
//                                        'type'  => 'column',
//                                        'size'     => 4,
//                                        'params'=> array(),
//                                        // Elements
//                                        'elements' => array(
//                                            array(
//                                                'type' => 'header',
//                                                'icon'        => 'el el-tasks',
//                                                'title'       => __('Header'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                            array(
//                                                'type' => 'contact',
//                                                'icon'        => 'far fa-address-card',
//                                                'title'       => __('Contact'),
//                                                'params' => array(
//                                                    'tz_customid' => '',
//                                                    'tz_customclass' => '',
//                                                ),
//                                            ),
//                                        ) // End elements
//                                    ),// End column 2
//                                ),
//                            ), // End row 1
//                        ), // End rows
//                    ), // End section 2
//
////                )// End sections
//            );
//            $fl_layout = array();

//            $this -> value  = '[{"type":"section","elements":[{"type":"row","elements":[{"type":"column","elements":[{"type":"row_inner","elements":[{"type":"column","elements":[{"type":"social","elements":[],"params":{"tz_admin_label":"","tz_customclass":"","tz_customid":""},"id":"331597198666631","title":"Social","icon":"fas fa-share-alt"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"1031597198660148"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"311597198660144"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"1041597198655519"},{"type":"column","elements":[{"type":"social","elements":[],"params":{"tz_admin_label":"","tz_customclass":"","tz_customid":""},"id":"991597056845151","title":"Social","icon":"fas fa-share-alt","admin_label":""}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"901597198710459"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"481597198655513"}],"params":{"tz_admin_label":"","title":"","layout_type":"container","custom_container_class":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"margin":{"margin-top":"","margin-right":"","margin-bottom":"","margin-left":"","units":"px"},"padding":{"padding-top":"","padding-right":"","padding-bottom":"","padding-left":"","units":"px"},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"931597198655510"}]';
//            $this -> value  = '[{"type":"section","elements":[{"type":"row","elements":[{"type":"column","elements":[{"type":"row_inner","elements":[{"type":"column","elements":[{"type":"coypright","elements":[],"params":{"tz_admin_label":"","tz_customclass":"","tz_customid":""},"id":"331597198666631","title":"Social","icon":"fas fa-share-alt"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"1031597198660148"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"311597198660144"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"1041597198655519"},{"type":"column","elements":[{"type":"row_inner","elements":[{"type":"column","elements":[{"type":"contact","elements":[],"params":{"tz_admin_label":"","tz_customclass":"","tz_customid":""},"id":"491597115104067","title":"Contact","icon":"far fa-address-card"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"761597115097344"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"951597115097340"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"901597198710459"}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"481597198655513"}],"params":{"tz_admin_label":"","title":"","layout_type":"container","custom_container_class":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"margin":{"margin-top":"","margin-right":"","margin-bottom":"","margin-left":"","units":"px"},"padding":{"padding-top":"","padding-right":"","padding-bottom":"","padding-left":"","units":"px"},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"931597198655510"}]';
            ?>
            <textarea class="hide" name="<?php echo $this -> field['name'];?>" id="<?php echo $this -> field['id'];
            ?>"><?php echo $this -> value; ?></textarea>
            <div class="container-fluid">
                <div class="field-tz_layout-content"></div>

                <div>
                    <a href="#" class="fl_add-element-not-empty-button"><i class="far fa-plus-square"></i> <?php echo __('Add Section', $this -> text_domain); ?></a>
                </div>

            </div>
        <?php
        }

        public function template(){
            ob_start();
            ?>
        <?php
            require_once __DIR__.'/template/element.tpl.php';
            require_once __DIR__.'/template/list_items.tpl.php';
            require_once __DIR__.'/template/setting_grid.tpl.php';

            $this -> templates['element'] = ob_get_contents();
            ob_end_clean();
            $this -> templates  = apply_filters('templaza-framework/field/tz_layout/element/template', $this -> templates);

            if(isset($this -> templates) && count($this -> templates)) {
                $this -> templates  = array_unique($this -> templates);
                echo implode("\n", $this->templates);
            }
        }

        public function enqueue(){
            do_action('templaza-framework/field/tz_layout/enqueue', $this);

            if (!wp_style_is('templaza-field-tz_layout-css')) {
                wp_enqueue_style(
                    'templaza-field-tz_layout',
                    Functions::get_my_frame_url() . '/fields/tz_layout/field_tz_layout.css',
                    array(),
                    time(),
                    'all'
                );
            }

            if (!wp_script_is('templaza-field-tz_layout-js')) {
                wp_enqueue_script(
                    'templaza-field-tz_layout-js',
                    Functions::get_my_frame_url() . '/fields/tz_layout/field_tz_layout.js',
//                    array( 'jquery', 'jquery-ui-tooltip', 'jquery-ui-tabs', 'jquery-ui-sortable','jquery-ui-dialog', 'wp-util', 'redux-js'),
                    array( 'jquery', 'jquery-ui-tooltip',  'jquery-ui-sortable','jquery-ui-dialog', 'wp-util', 'redux-js'),
                    time(),
                    'all'
                );
            }
        }
    }
}