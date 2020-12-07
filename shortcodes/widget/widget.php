<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Widget')){
    class TemplazaFramework_ShortCode_Widget extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'widget',
                'icon'        => 'el el-website',
                'title'       => __('Widget'),
                'param_title' => esc_html__('Widget Settings'),
                'desc'        => __('Load a widget.'),
                'admin_label' => true,
                'params'      => array(
//                    array(
//                        'id'       => 'sidebar',
//                        'type'     => 'select',
//                        'data'     => 'sidebars',
//                        'title'    => __( 'Sidebar', $this -> text_domain ),
//                        'subtitle' => __( 'Select Sidebar.', $this -> text_domain ),
//                    ),
                )
            );
        }

        public function admin_template_setting(){

            if($el = $this -> get_element()){

                global $wp_registered_widgets, $wp_widget_factory, $wp_registered_widget_controls;

                require_once get_home_path()."/wp-admin/includes/widgets.php";
//                var_dump($wp_registered_widgets);
//                var_dump(wp_list_widgets());
//                wp_list_widgets();
//                var_dump($wp_widget_factory->widgets);
//                $widget = 'WP_Widget_Recent_Posts';
//                var_dump(the_widget('WP_Widget_Recent_Posts'));
                $widget_id  = 'recent-posts-1';
                $widget_id  = 'text-4';
                $widget     = $wp_registered_widgets[$widget_id];
                $control    = isset( $wp_registered_widget_controls[ $widget_id ] ) ? $wp_registered_widget_controls[ $widget_id ] : array();


//                var_dump($wp_widget_factory->widgets[ $widget ]);
//                var_dump($wp_registered_widget_controls);
//                var_dump(function_exists('wp_list_widgets'));
//                var_dump(function_exists('wp_widget_control'));
        ?>
            <script type="text/html" id="tmpl-field-tz_layout-settings-<?php echo $el['id']; ?>">

                <div class="fl_ui-panel-tab-content-container" data-fl-setting-title="<?php
                echo isset($el['param_title'])?$el['param_title']:'';?>">
                <?php
                if ( isset( $control['callback'] ) ) {

                    static $i = 0;
                    $i++;
                    $args = array(
                        'widget_id'   => $widget['id'],
                        'widget_name' => $widget['name'],
//                        '_display'    => 'template',
                    );
//                    $widget['params'][0]['number']  = 1;
//                    var_dump($control['params']);
                    $control_args = array(
                        0 => $args,
                        1 => $widget['params'][0],
                    );
                    $sidebar_args   = wp_list_widget_controls_dynamic_sidebar($control_args );

                    $id        = isset( $params[0]['_temp_id'] ) ? $sidebar_args[0]['_temp_id'] : $widget_id;
//                    $control['params'][0]['number']  = 1;
//                    var_dump($control['callback']);
                    ?>
                    <div id="widget-<?php echo $i.'_'.$id; ?>">
                        <?php $has_form = call_user_func_array( $control['callback'], $control['params'] ); ?>
                    </div>
                <?php
                }
                ?>
                </div>
            </script>
        <?php }
        }
    }

}

?>