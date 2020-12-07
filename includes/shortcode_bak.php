<?php

//namespace TemPlazaFramework;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

class TemplazaFramework_ShortCode{
    public $cache;
    public $default_settings;

    protected $element;
    protected $text_domain;

    public function __construct($field_parent = array(), $value = '', $parent = ''){
        $this->parent = $parent;
        $this->field_parent = $field_parent;
        $this->value = $value;

        $this -> text_domain    = Functions::get_my_text_domain();

        if(is_admin()) {

            add_filter('templaza-framework/field/tz_layout/element/template', array($this, '__admin_template'));

            $this->element = $this->register();

            $this->prepare_element($this->element);

            $params = isset($this->element['params'])?$this->element['params']:null;
            if($params){
                $args   = $this -> parent -> args;
                $opt_name   = $args['opt_name'].'__params-'.$this -> get_shortcode_name();

                foreach($params as &$param) {
                    $field_class = "ReduxFramework_{$param['type']}";
                    if ( ! class_exists( $field_class ) ) {
                        $class_file = apply_filters( "redux/{$this->parent ->args['opt_name']}/field/class/{$param['type']}",
                            ReduxFramework::$_dir . "inc/fields/{$param['type']}/field_{$param['type']}.php", $param );

                        if ( $class_file ) {
                            if ( file_exists( $class_file ) ) {
                                require_once $class_file;
                            }
                        }
                    }

                    if(!isset($this -> cache['fields'][$param['type']])) {
                        $this -> cache['fields'][$param['type']] = new $field_class($param, '', $this->parent);
                    }

                }
            }
        }else{
            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/params/prepare',
                array($this, 'prepare_params'), 10, 2);

            add_shortcode('templaza_'.$this -> get_shortcode_name(), array($this, 'shortcode'));
        }
    }

    public function register(){
        return array();
    }

    public function get_element(){
        return $this -> element;
    }

//    public function set_element($element){
//        $this -> element    = $element;
//    }

    public function get_shortcode_name(){
        $store_id   = __METHOD__;
        $store_id   = md5($store_id);

        if(isset($this -> cache[$store_id])){
            return $this -> cache[$store_id];
        }

//        $class_name = __CLASS__;
        $class_name = get_class($this);
        $class_name = preg_replace('/^TemplazaFramework_ShortCode_/i', '', $class_name);
        $class_name = strtolower($class_name);

        $this -> cache[$store_id]   = $class_name;

        return $class_name;
    }

    public function __admin_template($templates){

        if(isset($templates[$this -> get_shortcode_name()])){
            return $templates;
        }

        ob_start();
        $this -> admin_template_setting();
        $this -> admin_template();
        $templates[$this -> get_shortcode_name()]   = ob_get_contents();
        ob_end_clean();

        return $templates;
    }

    public function prepare_element(&$element, $default_params = true){

        $params = isset($element['params'])?$element['params']:array();

        if($params && count($params)) {
            $param_first    = $params[0];
        }else{
            $param_first    = array();
        }

        // Add tabs field if this element don't have tabs
        if(!isset($param_first['type']) || (isset($param_first['type']) && $param_first['type'] != 'tz_tab')){
            $param_first  = array(
                'id' => 'tabs',
                'type'  => 'tz_tab',
                'tabs' => array(
                    array(
                        'id' => 'settings',
                        'title'  => esc_html__('General', $this -> text_domain),
                        'fields' => $params,
                    ),
                ),
            );
            $element['params']  = array();
            $element['params'][] = $param_first;
        }

        // Add admin label field
        if(isset($element['admin_label']) && $element['admin_label']){
            $element_first  = &$element['params'][0];
            $tabs           = &$element_first['tabs'][0];
            array_unshift($tabs['fields'], array(
                'id'       => 'tz_admin_label',
                'type'     => 'text',
                'title'    => esc_html__('Admin Label', $this -> text_domain),
                'subtitle' => esc_html__('Define an admin label for easy identification.', $this -> text_domain),
            ));
        }

        if($default_params) {
            $default_params = array(
                array(
                    'id' => 'tz_customclass',
                    'type' => 'text',
                    'title' => esc_html__('Custom Class', $this->text_domain),
                    'subtitle' => esc_html__('Custom Class can be used for writing custom CSS or JS.', $this->text_domain),
                ),
                array(
                    'id' => 'tz_customid',
                    'type' => 'text',
                    'title' => esc_html__('Custom ID', $this->text_domain),
                    'subtitle' => esc_html__('Custom ID can be used for overriding the auto-generated id.', $this->text_domain),
                ),
            );
            $element_first  = &$element['params'][0];
            $tabs           = &$element_first['tabs'][0];
            $tabs['fields'] = array_merge($tabs['fields'], $default_params);
        }
    }

    public function admin_template_setting(){
    if($el = $this -> get_element()){
        $params = isset($el['params'])?$el['params']:null;
        if($params){
        ?>
        <script type="text/html" id="tmpl-field-tz_layout-settings-<?php echo $el['id']; ?>">
                <div class="fl_ui-panel-tab-content-container" data-fl-setting-title="<?php
                echo isset($el['param_title'])?$el['param_title']:'';?>">
                    <table class="form-table">
                        <?php
                        if(class_exists('reduxCoreEnqueue')) {
//                            $enqueue = new reduxCoreEnqueue ( $this -> parent );
                            $enqueue    = new Redux_Enqueue($this -> parent);
                        }
                        foreach($params as &$param){
                            $param['shortcode'] = true;
                            if($enqueue){
                                $enqueue -> enqueue_field($this -> parent, $param);
                            }

//                            apply_filters('templaza-framework/element/param/before', $param, $this);

                            $this -> parent -> field_default_values($param);
                            $this -> parent -> check_dependencies($param);

                            TemPlazaFramework\Helpers\FieldHelper::check_required_dependencies($param, $this -> field_parent, $this -> parent);

                            do_action('templaza-framework/element/param/before', $param, $this);
                            $param  = apply_filters('templaza-framework/element/param/before', $param, $this);

                            $param['name']  = $param['id'];
                            $param['class'] = '';
                            $param['id']    = $this -> field_parent['id'].'-'.$param['id'];

                            ob_start();
                            $this -> parent -> _field_input($param);
                            $param_html = ob_get_contents();
                            ob_end_clean();
                            if(preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $param_html)){
                                $param_html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $param_html);
                            }
                            ?>
                            <tr>
                                <?php if($title = $this -> parent -> get_header_html($param)){ ?>
                                    <th><?php echo $title; ?></th>
                                <?php } ?>
                                <td><?php echo $param_html; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
        </script>
    <?php }
        }
    }

    public function prepare_params($params, $element){
        $id = '';
        if(isset($element['id'])){
            $id = $element['id'];
//            $id = $this -> generateID();
        }
        if(isset($params['tz_customid']) && !empty($params['tz_customid'])){
            $id = $params['tz_customid'];
            unset($params['tz_customid']);
        }
        $params['id']       = $id;
        $params['tz_class'] = 'templaza-'.$element['type'];
        $params['tz_id']    = 'templaza-'.$element['type'].'-'.$id;

        $css    = $this -> custom_css($params, $element);

        if(!empty($css)) {
            $custom_css_name    = 'tz_custom_'.$element['id'];
            $params['tz_css']  = '.'.$custom_css_name.'{'.$css.'}';
            $params['tz_class'] .= ' '.$custom_css_name;
        }
        if(isset($params['tz_customclass']) && !empty($params['tz_customclass'])){
            if(isset($params['tz_class'])){
                $params['tz_class'].= ' '.$params['tz_customclass'];
            }else{
                $params['tz_class'] = $params['tz_customclass'].' ';
            }
            $params['tz_class'] = trim($params['tz_class']);
            unset($params['tz_customclass']);
        }

        return $params;
    }

    public function custom_css(&$params, &$element){
        $css = '';

        if(isset($params['background'])){
            $background = $params['background'];

            if(!empty($background['background-color'])){
                $css  .= 'background-color:'.$background['background-color'].';';
            }
            if(!empty($background['background-image'])){
                $css  .= 'background-image:'.$background['background-image'].';';
                if(!empty($background['background-size'])) {
                    $css .= 'background-size:' . $background['background-size'] . ';';
                }
                if(!empty($background['background-position'])) {
                    $css .= 'background-position:' . $background['background-position'] . ';';
                }
                if(!empty($background['background-repeat'])) {
                    $css .= 'background-repeat:' . $background['background-repeat'] . ';';
                }
                if(!empty($background['background-attachment'])) {
                    $css .= 'background-attachment:' . $background['background-attachment'] . ';';
                }
            }
            unset($params['background']);
        }

        return $css;
    }

    public function shortcode($atts, $content = ''){

        if(isset($atts['tz_css'])) {
            Templates::add_inline_style( $atts['tz_css']);
        }
        ob_start();
        $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_SHORTCODES.'/'.$this -> get_shortcode_name().'/tmpl/'
            .$this -> get_shortcode_name().'.php';
        if(!file_exists($file)) {
            $file = TEMPLAZA_FRAMEWORK_SHORTCODES_PATH . '/' . $this->get_shortcode_name() . '/tmpl/'
                .$this -> get_shortcode_name().'.php';
        }

        if(file_exists($file)){
            require $file;
        }
        $html   = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    public function admin_template(){
        $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_SHORTCODES.'/'.$this -> get_shortcode_name().'/tmpl/extend.tpl.php';
        if(!file_exists($file)) {
            $file = TEMPLAZA_FRAMEWORK_SHORTCODES_PATH . '/' . $this->get_shortcode_name() . '/tmpl/extend.tpl.php';
        }

        if(file_exists($file)){
            require_once $file;
        }
    }
}
