<?php

//namespace TemPlazaFramework;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
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

            $this->element  = apply_filters('templaza-framework/field/tz_layout/element/'.$this -> get_shortcode_name().'/registered', $this->element);

            $this->prepare_element($this->element);

            $params = isset($this->element['params'])?$this->element['params']:null;
            if($params){

                $params = apply_filters('templaza-framework/field/tz_layout/element/'.$this -> get_shortcode_name().'/params/prepare', $params);
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
                array($this, 'prepare_params'), 10, 3);

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
//        $class_name = preg_replace('/^TemplazaFramework_ShortCode_/i', '', $class_name);
        $class_name = preg_replace('/^'.__CLASS__.'_/i', '', $class_name);
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
        $element_first  = &$element['params'][0];
        $tabs           = &$element_first['tabs'];
        $tab_first      = &$element_first['tabs'][0];
        if(isset($element['admin_label']) && $element['admin_label']){
            array_unshift($tab_first['fields'], array(
                'id'       => 'tz_admin_label',
                'type'     => 'text',
                'title'    => esc_html__('Admin Label', $this -> text_domain),
                'subtitle' => esc_html__('Define an admin label for easy identification.', $this -> text_domain),
            ));
        }

        if($default_params) {
            $default_params = array(
                array(
                    'id'      => 'text_align',
                    'type'    => 'select',
                    'title'   => __('Text Align', $this -> text_domain),
                    'options' => array(
                        'text-start'  => esc_html__('Left', $this -> text_domain),
                        'text-center' => esc_html__('Center', $this -> text_domain),
                        'text-end'    => esc_html__('Right', $this -> text_domain),
                    ),
                ),
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
//            $element_first          = &$element['params'][0];
//            $tab_first              = &$element_first['tabs'][0];
            $tab_first['fields']    = array_merge($tab_first['fields'], $default_params);

            // Default Design tab parameters
            $default_design = array(
                'id'     => 'design-settings',
                'title'  => esc_html__('Design Settings', $this -> text_domain),
                'fields' => array(
                    array(
                        'id'    => 'background',
                        'type'  => 'background',
                        'title' => esc_html__('Background'),
                    ),
                    array(
                        'id'         => 'border',
                        'type'       => 'border',
                        'title'      => __('Border', $this -> text_domain),
                    ),
                    array(
                        'id'     => 'tab-spacing',
                        'type'   => 'section',
                        'indent' => true,
                        'title'  => esc_html__('Spacing', $this -> text_domain),
                    ),
                    array(
                        'id'     => 'margin',
                        'type'   => 'spacing',
                        'mode'   => 'margin',
                        'all'    => false,
                        'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Margin', $this -> text_domain),
                        'default' => array(
                            'units' => 'px'
                        ),
                    ),
                    array(
                        'id'     => 'padding',
                        'type'   => 'spacing',
                        'mode'   => 'padding',
                        'all'    => false,
                        'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Padding', $this -> text_domain),
                        'default' => array(
                            'units' => 'px'
                        ),
                    ),
                    array(
                        'id'     => 'tab-spacing-end',
                        'type'   => 'section',
                        'indent' => false, // Indent all options below until the next 'section' option is set.
                    ),
                    array(
                        'id'     => 'tab-custom_colors',
                        'type'   => 'section',
                        'indent' => true,
                        'title'  => esc_html__('Custom Colors', $this -> text_domain),
                    ),
                    array(
                        'id'       => 'text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Text Color', $this -> text_domain),
//                                        'required' => array('custom_colors', '=', '1'),
                    ),
                    array(
                        'id'       => 'link_color',
                        'type'     => 'link_color',
                        'title'    => esc_html__('Link Color', $this -> text_domain),
//                                        'required' => array('custom_colors', '=', '1'),
                    ),
                    array(
                        'id'     => 'tab-custom_colors-end',
                        'type'   => 'section',
                        'indent' => false, // Indent all options below until the next 'section' option is set.
                    ),
                )
            );

            if($tabs && count($tabs)){
                $has_design_tab = false;
                foreach($tabs as $i => &$tab){
                    if(isset($tab['id']) && $tab['id'] == 'design-settings'){
                        $has_design_tab = $i;
                        $field_diff = array_udiff($default_design['fields'], $tab['fields'], function($a, $b){
                            if ($a['id']===$b['id'])
                            {
                                return 0;
                            }

                            return ($a['id']>$b['id'])?1:-1;
                        });
                        $tab['fields']  += $field_diff;
                        ksort($tab['fields']);
                        break;
                    }
                }

                if($has_design_tab === false) {
                    if(count($element_first['tabs']) < 2){
                        array_push($tabs, $default_design);
                    }
                    else{
                        $first_tab  = $element_first['tabs'][0];
                        $tabs[0]    = $default_design;
                        array_unshift($tabs, $first_tab);
                    }
                }
            }
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

    public function prepare_params($params, $element, $parent_el){
        $id = '';
        if(isset($element['id'])){
            $id = $element['id'];
        }
        if(isset($params['tz_customid']) && !empty($params['tz_customid'])){
            $id = $params['tz_customid'];
            unset($params['tz_customid']);
        }
        $params['id']       = $id;
        $params['tz_class'] = isset($params['tz_class'])?$params['tz_class']:'templaza-'.$element['type'];
        $params['tz_id']    = 'templaza-'.$element['type'].'-'.$id;

        $css    = $this -> custom_css($params, $element);

        $custom_css_name    = 'tz_custom_'.$element['id'];
        $params['tz_class'].= ' '.$custom_css_name;
        if(!empty($css)) {
//            $custom_css_name    = 'tz_custom_'.$element['id'];
            $params['tz_css']   = '.'.$custom_css_name.'{'.$css.'}';
//            $params['tz_class'].= ' '.$custom_css_name;
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

        if(isset($params['text_align']) && !empty($params['text_align'])){
            $params['tz_class'] .= ' '.$params['text_align'];
        }
		if(isset($params['background_overlay']) && !empty($params['background_overlay'])){
            $overlay_color = CSS::make_color_rgba_redux($params['background_overlay']);
            $params['tz_class'] .=' tz_background_overlay ';
            $css_overlay   = '';
            $css_overlay   .= '.'.$custom_css_name.'::before {background-color:'.$overlay_color.' ;}';            
			if(isset($params['tz_css'])){
                $params['tz_css']   .= $css_overlay;
            }else{
                $params['tz_css']   = $css_overlay;
            }
        }

        if(isset($params['link_color']) && !empty($params['link_color'])){
//            $custom_css_name    = '.tz_custom_'.$element['id'];
            $custom_css_name    = '.'.$custom_css_name;


            $css_link   = '';
            $link_color = $params['link_color'];

            if(isset($link_color['regular']) && !empty($link_color['regular'])){
                $css_link   .= $custom_css_name.' a{color:'.$link_color['regular'].' !important;}';
            }
            if(isset($link_color['hover']) && !empty($link_color['hover'])){
                $css_link   .= $custom_css_name.' a:hover{color:'.$link_color['hover'].' !important;}';
            }
            if(isset($link_color['active']) && !empty($link_color['active'])){
                $css_link   .= $custom_css_name.' a:active{color:'.$link_color['active'].' !important;}';
            }
            if(!empty($css_link)){
                if(isset($params['tz_css'])){
                    $params['tz_css']   .= $css_link;
                }else{
                    $params['tz_css']   = $css_link;
                }

            }
        }

        return $params;
    }

    public function custom_css(&$params, &$element){
        $css = '';

        if(isset($params['text_color']) && !empty($params['text_color'])){
            $css    .= 'color: '.$params['text_color'].' !important;';
            unset($params['text_color']);
        }

        if(isset($params['background'])){
            $background = $params['background'];
            $css    .= CSS::background($background['background-color'], $background['background-image'],
                $background['background-repeat'], $background['background-attachment'],
                $background['background-position'], $background['background-size'], '', '', true);

            unset($params['background']);
        }

        if(isset($params['border']) && !empty($params['border'])){
            $border = $params['border'];
            $css    .= CSS::border($border['border-top'],$border['border-right'],
                $border['border-bottom'],$border['border-left'], $border['border-style'],
                $border['border-color'], true);

            unset($params['border']);

        }

        if(isset($params['margin']) && !empty($params['margin'])){
            $margin = $params['margin'];
            $css    .= CSS::margin($margin['margin-top'],$margin['margin-right'],
                $margin['margin-bottom'],$margin['margin-left'], true);

            unset($params['margin']);
        }

        if(isset($params['padding']) && !empty($params['padding'])){
            $padding = $params['padding'];
            $css    .= CSS::padding($padding['padding-top'],$padding['padding-right'],
                $padding['padding-bottom'],$padding['padding-left'], true);

            unset($params['padding']);
        }

        return $css;
    }

    public function shortcode($atts, $content = ''){

        if(isset($atts['tz_css'])) {
            Templates::add_inline_style( $atts['tz_css']);
        }
        $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_SHORTCODES.'/'.$this -> get_shortcode_name().'/tmpl/'
            .$this -> get_shortcode_name().'.php';
        if(!file_exists($file)) {
            $file = TEMPLAZA_FRAMEWORK_SHORTCODES_PATH . '/' . $this->get_shortcode_name() . '/tmpl/'
                .$this -> get_shortcode_name().'.php';
        }
        ob_start();

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
