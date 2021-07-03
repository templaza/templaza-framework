<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Functions;
use TemPlazaFramework\Helpers\FieldHelper;

if ( ! class_exists( 'ReduxFramework_TZ_Layout' ) ) {
    class ReduxFramework_TZ_Layout
    {
        protected $text_domain;
        protected $elements;
        protected $templates = array();

        function __construct( $field = array(), $value = '', $parent = null ) {

            $this -> text_domain    = Functions::get_my_text_domain();

            $field['title'] = isset($field['title'])?$field['title']:'';

            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
            $this -> elements  = array();
//            $this -> templates = array();


            if(is_admin()) {
                $this->load_element();
            }

//            $this -> hooks();

//            var_dump("field_tz_layout line 27");

//            $this -> field['core']  = array('section', 'row', 'column');


//            add_action('redux/page/'.$this->parent->args['opt_name'].'/enqueue', array($this, 'test'));

//            add_action('admin_footer', array($this, 'template'));

//                add_action( 'wp_ajax_mm_edit_widget', array( $this, 'ajax_show_widget_form' ) );
//                add_action( 'admin_init', array( $this, 'ajax_show_widget_form' ) );

        }

//        public function hooks(){
//            do_action('templaza-framework/fields/tz_layout/hooks');
//        }

        protected function load_element(){

            $folder_path    = TEMPLAZA_FRAMEWORK_SHORTCODES_PATH;
            $theme_path     = TEMPLAZA_FRAMEWORK_THEME_PATH_SHORTCODES;

            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            global $wp_filesystem;
            WP_Filesystem();
            $folders  = Functions::list_files($folder_path,'.', 1);
            $count      = count($folders);

            // Require shortcodes from theme
            if(is_dir($theme_path)){
                $theme_files    = Functions::list_files($theme_path, '.', 1);
                $folders    = array_merge($folders, $theme_files);
            }

//            var_dump($this -> parent -> args);
            foreach($folders as $folder){
                $file_name  = basename($folder);

                $show   = 'shortcode_'.$file_name;
//                var_dump($file_name);
//                var_dump((isset($this -> parent -> args[$show]) && !$this -> parent -> args[$show]));

                if(isset($this -> parent -> args[$show]) && !$this -> parent -> args[$show]){
                    continue;
                }

                $class      = 'TemplazaFramework_ShortCode_'.ucfirst($file_name);
                if(!class_exists($class)){
                    $file_path  = $folder.$file_name.'.php';

                    if(file_exists($file_path)){
                        require_once $file_path;
                    }
                }
                if(class_exists($class)){
//                    var_dump($theme_path.'/'.$file_name.'/config.php');
                    if(file_exists($theme_path.'/'.$file_name.'/config.php')){
                        require_once $theme_path.'/'.$file_name.'/config.php';
                    }
                    $element    = '';
                    $element    = new $class($this -> field, '', $this -> parent);
                    $this -> elements[$file_name]    = $element;

                    apply_filters('templaza-framework/field/tz_layout/element', $element, $this);

                    if(method_exists($element, 'enqueue')) {
//                        if($file_name == 'section') {
//                            var_dump($file_name);
//                            var_dump($element);
//                            var_dump(method_exists($element, 'enqueue'));
//                        }

//                        add_action('redux/options/'.$this -> parent -> args['opt_name'].'/tz_layout/register', function(){
//
//                        });

//                        add_action('redux/page/'.$this->parent->args['opt_name'].'/enqueue', array($element, 'enqueue'));
//                        $element->enqueue();
                        add_action('admin_enqueue_scripts', array($element, 'enqueue'));
//                        $element->enqueue();
                    }
                }
            }
        }

        public function render(){
            add_action('admin_footer', array($this, 'template'));

//            if(get_the_ID() == 2583) {
//                global $wp_registered_widgets, $wp_widget_factory, $wp_registered_widget_controls;
////
//////                require_once get_home_path()."/wp-admin/includes/widgets.php";
////////                var_dump($wp_registered_widgets);
////////                var_dump(wp_list_widgets());
////////                wp_list_widgets();
////////                var_dump($wp_widget_factory->widgets);
////                $widget = 'WP_Widget_Recent_Posts';
//                $widget = 'WP_Widget_Text';
////////                var_dump(the_widget('WP_Widget_Recent_Posts'));
////                $widget_id  = 'recent-posts-1';
//                $widget_id  = 'text-4';
//////                var_dump($wp_registered_widgets[$widget_id]);
//                $control    = isset( $wp_registered_widget_controls[ $widget_id ] ) ? $wp_registered_widget_controls[ $widget_id ] : array();
//
//
//
////                $control = $wp_registered_widget_controls[ $widget_id ];
//
////                $id_base = $this->get_id_base_for_widget_id( $widget_id );
//
////                $widget_number = $this->get_widget_number_for_widget_id( $widget_id );
//
//                $nonce = wp_create_nonce('megamenu_save_widget_' . $widget_id);
//
//                if ( is_callable( $control['callback'] ) ) {
//                    ?>
<!--                    --><?php //call_user_func_array( $control['callback'], $control['params'] );?>
<!--                    --><?php
//                }
////                if ( isset( $control['callback'] ) ) {
//////                    var_dump($control['callback']);
//////                    var_dump($control['params']);
////                    var_dump(user_can_richedit());
////                    $has_form = call_user_func_array( $control['callback'], $control['params'] );
////                }
////                var_dump($wp_widget_factory->widgets[ $widget ]);
////////                var_dump($wp_registered_widget_controls);
//////                $tzrecentpost = new WP_Widget_Recent_Posts();
////////                $tzrecentpost -> form();
//////                var_dump(function_exists('wp_list_widgets'));
//////                var_dump(function_exists('wp_widget_control'));
////////                var_dump(get_the_ID());
//            }
            ?>
            <textarea class="hide" name="<?php echo $this -> field['name'];?>" id="<?php echo $this -> field['id'];
            ?>"><?php echo $this -> value; ?></textarea>
<!--            <div class="container-fluid">-->
                <div class="field-tz_layout-content"></div>

                <div>
                    <?php
                    $text   = 'Add Section';
                    if(isset($this -> parent -> args['shortcode_section']) && !$this -> parent -> args['shortcode_section']){
                        $text   = 'Add Row';
                    }
                    ?>
                    <a href="#" class="fl_add-element-not-empty-button"><i class="far fa-plus-square"></i> <?php echo __($text, $this -> text_domain); ?></a>
                </div>

<!--            </div>-->
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
//                if(get_the_ID() == 2583){
//                    $widget_id  = 'text-4';
//                    $nonce = wp_create_nonce('megamenu_save_widget_' . $widget_id);
//                    wp_add_inline_script('templaza-field-tz_layout-js', '
//                (function($){
//
//                    $(document).ready(function(){
//                        var id = "text-4",
//                            action = "mm_edit_widget";
//                        $.post("'.admin_url('admin-ajax.php').'", {
//                            action: action,
//                            widget_id: id,
//                            post: 2583,
//    //                        _wpnonce: "'.$nonce.'"
//                        }, function(response) {
//                            alert("Ajax Test");
//                        });
//                    });
//                })(jQuery);
//                ');
//                }
            }

        }
    }
}