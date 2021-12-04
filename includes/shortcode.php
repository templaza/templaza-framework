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
    protected $admin_template_settings;

    public function __construct($field_parent = array(), $value = '', $parent = ''){
        $this->parent = $parent;
        $this->field_parent = $field_parent;
        $this->value = $value;

        $this -> text_domain    = Functions::get_my_text_domain();

        if(is_admin()) {

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

//            $this -> _init_admin_template_settings();

            add_filter('templaza-framework/field/tz_layout/element/template', array($this, '__admin_template'));
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
                        'left'  => esc_html__('Left', $this -> text_domain),
                        'center' => esc_html__('Center', $this -> text_domain),
                        'right'    => esc_html__('Right', $this -> text_domain),
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
                        'id'        => 'margin_type',
                        'type'      => 'select',
                        'title'     =>  esc_html__('Margin', $this -> text_domain),
                        'options' => array(
                            'default'   => esc_html__('Keep existing', $this -> text_domain),
                            'small'     => esc_html__('Small', $this -> text_domain),
                            'medium'    => esc_html__('Medium', $this -> text_domain),
                            'large'     => esc_html__('Large', $this -> text_domain),
                            'xlarge'    => esc_html__('XLarge', $this -> text_domain),
                            'remove-vertical'      => esc_html__('None', $this -> text_domain),
                            'custom'    => esc_html__('Custom', $this -> text_domain),
                        ),
                        'select2'       => array( 'allowClear' => false ),
                        'default' => 'custom',
                    ),
                    array(
                        'id'     => 'margin',
                        'type'   => 'spacing',
                        'mode'   => 'margin',
                        'all'    => false,
                        'allow_responsive'    => true,
                        'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Custom Margin', $this -> text_domain),
                        'default' => array(
                            'units' => 'px'
                        ),
                        'required'  => array('margin_type', '=', 'custom'),
                    ),
                    array(
                        'id'       => 'margin_remove_top',
                        'type'     => 'switch',
                        'title'    => esc_html__('Remove top margin', $this -> text_domain),
                        'required' => array(
                            array('margin_type', '!=', 'custom'),
                            array('margin_type', '!=', 'remove-vertical'),
                        ),
//                        'required' => array('margin_type', '=', array('default','small','medium','large','xlarge')),
                    ),
                    array(
                        'id'       => 'margin_remove_bottom',
                        'type'     => 'switch',
                        'title'    => esc_html__('Remove bottom margin', $this -> text_domain),
                        'required' => array(
                            array('margin_type', '!=', 'custom'),
                            array('margin_type', '!=', 'remove-vertical'),
                        ),
//                        'required' => array('margin_type', '=', array('default','small','medium','large','xlarge')),
                    ),
                    array(
                        'id'        => 'padding_type',
                        'type'      => 'select',
                        'title'     =>  esc_html__('Padding', $this -> text_domain),
                        'subtitle'  =>  esc_html__('Set the vertical padding.', $this -> text_domain),
                        'options' => array(
                            'default'   => esc_html__('Default', $this -> text_domain),
                            'small'     => esc_html__('Small', $this -> text_domain),
                            'large'     => esc_html__('Large', $this -> text_domain),
                            'none'      => esc_html__('None', $this -> text_domain),
                            'custom'    => esc_html__('Custom', $this -> text_domain),
                        ),
                        'select2'       => array( 'allowClear' => false ),
                        'default' => 'custom',
                    ),
                    array(
                        'id'     => 'padding',
                        'type'   => 'spacing',
                        'mode'   => 'padding',
                        'all'    => false,
                        'allow_responsive'    => true,
                        'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Custom Padding', $this -> text_domain),
                        'default' => array(
                            'units' => 'px'
                        ),
                        'required'  => array('padding_type', '=', 'custom'),
                    ),
                    array(
                        'id'       => 'padding_remove_top',
                        'type'     => 'switch',
                        'title'    => esc_html__('Remove top padding', $this -> text_domain),
                        'required' => array(
                            array('padding_type', '!=', 'none'),
                            array('padding_type', '!=', 'custom'),
                        ),
//                        'required' => array('padding_type', '=', array('default','xsmall','small','large','xlarge')),
                    ),
                    array(
                        'id'       => 'padding_remove_bottom',
                        'type'     => 'switch',
                        'title'    => esc_html__('Remove bottom padding', $this -> text_domain),
                        'required' => array(
                            array('padding_type', '!=', 'none'),
                            array('padding_type', '!=', 'custom'),
                        ),
//                        'required' => array('padding_type', '=', array('default','xsmall','small','large','xlarge')),
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
                    <?php if(!isset($this -> admin_template_settings[$this -> get_shortcode_name()])
                        || empty($this -> admin_template_settings[$this -> get_shortcode_name()])){
                        $this ->_init_admin_template_settings();
                    }
                    if(isset($this -> admin_template_settings[$this -> get_shortcode_name()])
                        && !empty($this -> admin_template_settings[$this -> get_shortcode_name()])){
                        echo $this -> admin_template_settings[$this -> get_shortcode_name()];
                    } ?>
                </script>
            <?php }
        }
    }

    protected function _init_admin_template_settings(){
        if($el = $this -> get_element()){
            $params = isset($el['params'])?$el['params']:null;
            if($params){
                ob_start();
                ?>
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
                <?php
                $this -> admin_template_settings[$this -> get_shortcode_name()] = ob_get_contents();
                ob_end_clean();
            }
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

        $custom_css_name    = 'tz_custom_'.$element['id'];
        $params['tz_class'].= ' '.$custom_css_name;

        $margin_type   = isset($params['margin_type'])?$params['margin_type']:'custom';

        switch ($margin_type){
            case 'xsmall':
            case 'small':
            case 'large':
            case 'xlarge':
                $params['tz_class']   .= ' uk-margin-'.$margin_type;
                break;
            case 'none':
            case 'remove-vertical':
                $params['tz_class']   .= ' uk-margin-remove-vertical';
                break;
        }
        if($margin_type != 'none' && $margin_type != 'remove-vertical' && $margin_type != 'custom'){
            $margin_remove_top    = isset($params['margin_remove_top'])?filter_var($params['margin_remove_top'], FILTER_VALIDATE_BOOLEAN):false;
            $margin_remove_bottom = isset($params['margin_remove_bottom'])?filter_var($params['margin_remove_bottom'], FILTER_VALIDATE_BOOLEAN):false;
            if($margin_remove_top){
                $params['tz_class'] .= ' uk-margin-remove-top';
            }
            if($margin_remove_bottom){
                $params['tz_class'] .= ' uk-margin-remove-bottom';
            }
        }

        $padding_type   = isset($params['padding_type'])?$params['padding_type']:'custom';
//        if(isset($params['padding_type'])){
//            $padding_type    = $params['padding_type'];

        switch ($padding_type){
            case 'xsmall':
            case 'small':
            case 'large':
            case 'xlarge':
                $params['tz_class']   .= ' uk-section-'.$padding_type;
                break;
            case 'none':
            case 'remove-vertical':
                $params['tz_class']   .= ' uk-padding-remove';
                break;
        }
        if($padding_type != 'none' && $padding_type != 'remove-vertical' && $padding_type != 'custom'){
            $padding_remove_top    = isset($params['padding_remove_top'])?filter_var($params['padding_remove_top'], FILTER_VALIDATE_BOOLEAN):false;
            $padding_remove_bottom = isset($params['padding_remove_bottom'])?filter_var($params['padding_remove_bottom'], FILTER_VALIDATE_BOOLEAN):false;
            if($padding_remove_top){
                $params['tz_class'] .= ' uk-padding-remove-top';
            }
            if($padding_remove_bottom){
                $params['tz_class'] .= ' uk-padding-remove-bottom';
            }
        }
//        }

        $css    = $this -> custom_css($params, $element);

        if(!empty($css)){
            if(is_array($css)){
                if(count($css)){
                    foreach ($css as $device => $style){
                        if(!empty($style)) {
                            $style  = '.'.$custom_css_name.'{'.$style.'}';
                            Templates::add_inline_style($style, $device);
                        }
                    }
                }
            }else{
                Templates::add_inline_style($css);
            }
        }

//        if(!empty($css)) {
//            $params['tz_css']   = '.'.$custom_css_name.'{'.$css.'}';
//        }

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
            $params['tz_class'] .= ' uk-text-'.$params['text_align'];
        }
		if(isset($params['background_overlay']) && !empty($params['background_overlay'])){
            $overlay_color = CSS::make_color_rgba_redux($params['background_overlay']);
            if(!empty($overlay_color)){
                $params['tz_class'] .=' tz_background_overlay ';
                $css_overlay   = '';
                $css_overlay   .= '.'.$custom_css_name.'::before {background-color:'.$overlay_color.' ;}';
                if(!empty($css_overlay)){
                    Templates::add_inline_style($css_overlay);
                }
//                if(isset($params['tz_css'])){
//                    $params['tz_css']   .= $css_overlay;
//                }else{
//                    $params['tz_css']   = $css_overlay;
//                }
            }
        }

        if(isset($params['link_color']) && !empty($params['link_color'])){
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
                Templates::add_inline_style($css_link);
            }
//            if(!empty($css_link)){
//                if(isset($params['tz_css'])){
//                    $params['tz_css']   .= $css_link;
//                }else{
//                    $params['tz_css']   = $css_link;
//                }
//
//            }
        }

        return $params;
    }

    public function custom_css(&$params, &$element){
        $css = array('desktop' => '', 'tablet' => '', 'mobile' => '');

        if(isset($params['text_color']) && !empty($params['text_color'])){
            $css['desktop'] .= 'color: '.$params['text_color'].' !important;';
            unset($params['text_color']);
        }

        if(isset($params['background'])){
            $background = $params['background'];
            $css['desktop']    .= CSS::background($background['background-color'], $background['background-image'],
                $background['background-repeat'], $background['background-attachment'],
                $background['background-position'], $background['background-size'], '', '', true);

            unset($params['background']);
        }

        if(isset($params['border']) && !empty($params['border'])){
            $border = $params['border'];
            $css['desktop']    .= CSS::border($border['border-top'],$border['border-right'],
                $border['border-bottom'],$border['border-left'], $border['border-style'],
                $border['border-color'], true);

            unset($params['border']);

        }

        $margin_type    = isset($params['margin_type'])?$params['margin_type']:'custom';
        if($margin_type == 'custom' && isset($params['margin']) && !empty($params['margin'])){

            $margin    = CSS::make_spacing_redux('margin', $params['margin'], true, 'px');

            if(!empty($margin)){
                if(is_array($margin)){
                    foreach($margin as $device => $pcss){
                        $css[$device] .= $pcss;
                    }
                }else{
                    $css['desktop'] .= $margin;
                }
            }

            unset($params['margin']);
        }

        $padding_type    = isset($params['padding_type'])?$params['padding_type']:'custom';
        if($padding_type == 'custom' && isset($params['padding']) && !empty($params['padding'])){
            $padding    = CSS::make_spacing_redux('padding', $params['padding'], true, 'px');

            if(!empty($padding)){
                if(is_array($padding)){
                    foreach($padding as $device => $pcss){
                        $css[$device] .= $pcss;
                    }
                }else{
                    $css['desktop'] .= $padding;
                }
            }

            unset($params['padding']);
        }

        return $css;
    }

    public function shortcode($atts, $content = ''){
        do_action('templaza-framework/shortcode/before_do_shortcode', $atts,  $content);
        do_action('templaza-framework/shortcode/'.$this -> get_shortcode_name().'/before_do_shortcode', $atts, $content);

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

        do_action('templaza-framework/shortcode/after_do_shortcode', $atts, $content, $html);
        do_action('templaza-framework/shortcode/'.$this -> get_shortcode_name().'/after_do_shortcode', $atts, $content, $html);

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
    
	public function get_font_uikit() {
		$font_uikit = [
			'-'  => __( 'Choose an icon...', $this -> text_domain ),
			'home' => __( 'Home', $this -> text_domain ),
			'sign-in' => __( 'Sign-in', $this -> text_domain ),
			'sign-out' => __( 'Sign-out', $this -> text_domain ),
			'user' => __( 'User', $this -> text_domain ),
			'users' => __( 'Users', $this -> text_domain ),
			'lock' => __( 'Lock', $this -> text_domain ),
			'unlock' => __( 'Unlock', $this -> text_domain ),
			'settings' => __( 'Settings', $this -> text_domain ),
			'cog' => __( 'Cog', $this -> text_domain ),
			'nut' => __( 'Nut', $this -> text_domain ),
			'comment' => __( 'Comment', $this -> text_domain ),
			'commenting' => __( 'Commenting', $this -> text_domain ),
			'comments' => __( 'Comments', $this -> text_domain ),
			'hashtag' => __( 'Hashtag', $this -> text_domain ),
			'tag' => __( 'Tag', $this -> text_domain ),
			'cart' => __( 'Cart', $this -> text_domain ),
			'credit-card' => __( 'Credit-card', $this -> text_domain ),
			'mail' => __( 'Mail', $this -> text_domain ),
			'receiver' => __( 'Receiver', $this -> text_domain ),
			'search' => __( 'Search', $this -> text_domain ),
			'location' => __( 'Location', $this -> text_domain ),
			'bookmark' => __( 'Bookmark', $this -> text_domain ),
			'code' => __( 'Code', $this -> text_domain ),
			'paint-bucket' => __( 'Paint-bucket', $this -> text_domain ),
			'camera' => __( 'Camera', $this -> text_domain ),
			'bell' => __( 'Bell', $this -> text_domain ),
			'bolt' => __( 'Bolt', $this -> text_domain ),
			'star' => __( 'Star', $this -> text_domain ),
			'heart' => __( 'Heart', $this -> text_domain ),
			'happy' => __( 'Happy', $this -> text_domain ),
			'lifesaver' => __( 'Lifesaver', $this -> text_domain ),
			'rss' => __( 'Rss', $this -> text_domain ),
			'social' => __( 'Social', $this -> text_domain ),
			'git-branch' => __( 'Git-branch', $this -> text_domain ),
			'git-fork' => __( 'Git-fork', $this -> text_domain ),
			'world' => __( 'World', $this -> text_domain ),
			'calendar' => __( 'Calendar', $this -> text_domain ),
			'clock' => __( 'Clock', $this -> text_domain ),
			'history' => __( 'History', $this -> text_domain ),
			'future' => __( 'Future', $this -> text_domain ),
			'pencil' => __( 'Pencil', $this -> text_domain ),
			'trash' => __( 'Trash', $this -> text_domain ),
			'move' => __( 'Move', $this -> text_domain ),
			'link' => __( 'Link', $this -> text_domain ),
			'question' => __( 'Question', $this -> text_domain ),
			'info' => __( 'Info', $this -> text_domain ),
			'warning' => __( 'Warning', $this -> text_domain ),
			'image' => __( 'Image', $this -> text_domain ),
			'thumbnails' => __( 'Thumbnails', $this -> text_domain ),
			'table' => __( 'Table', $this -> text_domain ),
			'list' => __( 'List', $this -> text_domain ),
			'menu' => __( 'Menu', $this -> text_domain ),
			'grid' => __( 'Grid', $this -> text_domain ),
			'more' => __( 'More', $this -> text_domain ),
			'more-vertical' => __( 'More-vertical', $this -> text_domain ),
			'plus' => __( 'Plus', $this -> text_domain ),
			'plus-circle' => __( 'Plus-circle', $this -> text_domain ),
			'minus' => __( 'Minus', $this -> text_domain ),
			'minus-circle' => __( 'Minus-circle', $this -> text_domain ),
			'close' => __( 'Close', $this -> text_domain ),
			'check' => __( 'Check', $this -> text_domain ),
			'ban' => __( 'Ban', $this -> text_domain ),
			'refresh' => __( 'Refresh', $this -> text_domain ),
			'play' => __( 'Play', $this -> text_domain ),
			'play-circle' => __( 'Play-circle', $this -> text_domain ),
			'tv' => __( 'Tv', $this -> text_domain ),
			'desktop' => __( 'Desktop', $this -> text_domain ),
			'laptop' => __( 'Laptop', $this -> text_domain ),
			'tablet' => __( 'Tablet', $this -> text_domain ),
			'phone' => __( 'Phone', $this -> text_domain ),
			'tablet-landscape' => __( 'Tablet-landscape', $this -> text_domain ),
			'phone-landscape' => __( 'Phone-landscape', $this -> text_domain ),
			'file' => __( 'File', $this -> text_domain ),
			'copy' => __( 'Copy', $this -> text_domain ),
			'file-edit' => __( 'File-edit', $this -> text_domain ),
			'folder' => __( 'Folder', $this -> text_domain ),
			'album' => __( 'Album', $this -> text_domain ),
			'push' => __( 'Push', $this -> text_domain ),
			'pull' => __( 'Pull', $this -> text_domain ),
			'server' => __( 'Server', $this -> text_domain ),
			'database' => __( 'Database', $this -> text_domain ),
			'cloud-upload' => __( 'Cloud-upload', $this -> text_domain ),
			'cloud-download' => __( 'Cloud-download', $this -> text_domain ),
			'download' => __( 'Download', $this -> text_domain ),
			'upload' => __( 'Upload', $this -> text_domain ),
			'reply' => __( 'Reply', $this -> text_domain ),
			'forward' => __( 'Forward', $this -> text_domain ),
			'expand' => __( 'Expand', $this -> text_domain ),
			'shrink' => __( 'Shrink', $this -> text_domain ),
			'arrow-up' => __( 'Arrow-up', $this -> text_domain ),
			'arrow-down' => __( 'Arrow-down', $this -> text_domain ),
			'arrow-left' => __( 'Arrow-left', $this -> text_domain ),
			'arrow-right' => __( 'Arrow-right', $this -> text_domain ),
			'chevron-up' => __( 'Chevron-up', $this -> text_domain ),
			'chevron-down' => __( 'Chevron-down', $this -> text_domain ),
			'chevron-left' => __( 'Chevron-left', $this -> text_domain ),
			'chevron-right' => __( 'Chevron-right', $this -> text_domain ),
			'triangle-up' => __( 'Triangle-up', $this -> text_domain ),
			'triangle-down' => __( 'Triangle-down', $this -> text_domain ),
			'triangle-left' => __( 'Triangle-left', $this -> text_domain ),
			'triangle-right' => __( 'Triangle-right', $this -> text_domain ),
			'bold' => __( 'Bold', $this -> text_domain ),
			'italic' => __( 'Italic', $this -> text_domain ),
			'strikethrough' => __( 'Strikethrough', $this -> text_domain ),
			'video-camera' => __( 'Video-camera', $this -> text_domain ),
			'quote-right' => __( 'Quote-right', $this -> text_domain ),
			'500px' => __( '500px', $this -> text_domain ),
			'behance' => __( 'Behance', $this -> text_domain ),
			'dribbble' => __( 'Dribbble', $this -> text_domain ),
			'facebook' => __( 'Facebook', $this -> text_domain ),
			'flickr' => __( 'Flickr', $this -> text_domain ),
			'foursquare' => __( 'Foursquare', $this -> text_domain ),
			'github' => __( 'Github', $this -> text_domain ),
			'github-alt' => __( 'Github-alt', $this -> text_domain ),
			'gitter' => __( 'Gitter', $this -> text_domain ),
			'google' => __( 'Google', $this -> text_domain ),
			'google-plus' => __( 'Google-plus', $this -> text_domain ),
			'instagram' => __( 'Instagram', $this -> text_domain ),
			'joomla' => __( 'Joomla', $this -> text_domain ),
			'linkedin' => __( 'Linkedin', $this -> text_domain ),
			'pagekit' => __( 'Pagekit', $this -> text_domain ),
			'pinterest' => __( 'Pinterest', $this -> text_domain ),
			'soundcloud' => __( 'Soundcloud', $this -> text_domain ),
			'tripadvisor' => __( 'Tripadvisor', $this -> text_domain ),
			'tumblr' => __( 'Tumblr', $this -> text_domain ),
			'twitter' => __( 'Twitter', $this -> text_domain ),
			'uikit' => __( 'Uikit', $this -> text_domain ),
			'etsy' => __( 'Etsy', $this -> text_domain ),
			'vimeo' => __( 'Vimeo', $this -> text_domain ),
			'whatsapp' => __( 'Whatsapp', $this -> text_domain ),
			'wordpress' => __( 'Wordpress', $this -> text_domain ),
			'xing' => __( 'Xing', $this -> text_domain ),
			'yelp' => __( 'Yelp', $this -> text_domain ),
			'youtube' => __( 'Youtube', $this -> text_domain ),
			'print' => __( 'Print', $this -> text_domain ),
			'reddit' => __( 'Reddit', $this -> text_domain ),
			'file-text' => __( 'File Text', $this -> text_domain ),
			'file-pdf' => __( 'File Pdf', $this -> text_domain ),
			'chevron-double-left' => __( 'Chevron Double Left', $this -> text_domain ),
			'chevron-double-right' => __( 'Chevron Double Right', $this -> text_domain ),
		];
		return apply_filters( 'templaza-framework/options-font-uikit', $font_uikit );
	}
}
