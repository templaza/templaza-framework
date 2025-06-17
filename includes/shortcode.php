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
    protected $admin_template_settings;

    protected $value;
    protected $parent;
    protected $field_parent;

    public function __construct($field_parent = array(), $value = '', $parent = ''){
        $this->parent = $parent;
        $this->field_parent = $field_parent;
        $this->value = $value;


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

            add_filter('templaza-framework/field/tz_layout/element/template', array($this, '__admin_template'));
        }else{
            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/prepare',
                array($this, 'front_end_prepare_element'), 10, 2);
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

    public function get_property($name){
        if(isset($this -> {$name})){
            return $this -> {$name};
        }

        return false;
    }

    public function get_shortcode_name(){
        $store_id   = __METHOD__;
        $store_id   = md5($store_id);

        if(isset($this -> cache[$store_id])){
            return $this -> cache[$store_id];
        }

        $class_name = get_class($this);
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
                        'title'  => esc_html__('General', 'templaza-framework'),
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
                'title'    => esc_html__('Admin Label', 'templaza-framework'),
                'subtitle' => esc_html__('Define an admin label for easy identification.', 'templaza-framework'),
            ));
        }

        if($default_params) {
            $default_params = array(
                array(
                    'id'      => 'text_align',
                    'type'    => 'select',
                    'title'   => __('Text Align', 'templaza-framework'),
                    'options' => array(
                        'left'  => esc_html__('Left', 'templaza-framework'),
                        'center' => esc_html__('Center', 'templaza-framework'),
                        'right'    => esc_html__('Right', 'templaza-framework'),
                    ),
                ),
                array(
                    'id' => 'tz_customclass',
                    'type' => 'text',
                    'title' => esc_html__('Custom Class', 'templaza-framework'),
                    'subtitle' => esc_html__('Custom Class can be used for writing custom CSS or JS.', 'templaza-framework'),
                ),
                array(
                    'id' => 'tz_customid',
                    'type' => 'text',
                    'title' => esc_html__('Custom ID', 'templaza-framework'),
                    'subtitle' => esc_html__('Custom ID can be used for overriding the auto-generated id.', 'templaza-framework'),
                ),
            );

            $tab_first['fields']    = array_merge($tab_first['fields'], $default_params);

            // Default Design tab parameters
            $default_design = array(
                'id'     => 'design-settings',
                'title'  => esc_html__('Design Settings', 'templaza-framework'),
                'fields' => array(
                    array(
                        'id'    => 'background',
                        'type'  => 'background',
                        'title' => esc_html__('Background'),
                    ),
                    array(
                        'id'         => 'border',
                        'type'       => 'border',
                        'color_alpha'=> 'true',
                        'title'      => __('Border', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'border_radius',
                        'type'     => 'spacing',
                        'mode'     => 'border-radius',
                        'allow_responsive'    => true,
                        'title'    => __('Border radius', 'templaza-framework'),
                        'default'  => '',
                    ),
                    array(
                        'id'     => 'tab-spacing',
                        'type'   => 'section',
                        'indent' => true,
                        'title'  => esc_html__('Spacing', 'templaza-framework'),
                    ),

                    array(
                        'id'        => 'margin_type',
                        'type'      => 'select',
                        'title'     =>  esc_html__('Margin', 'templaza-framework'),
                        'options' => array(
                            'default'   => esc_html__('Keep existing', 'templaza-framework'),
                            'small'     => esc_html__('Small', 'templaza-framework'),
                            'medium'    => esc_html__('Medium', 'templaza-framework'),
                            'large'     => esc_html__('Large', 'templaza-framework'),
                            'xlarge'    => esc_html__('XLarge', 'templaza-framework'),
                            'remove-vertical'      => esc_html__('None', 'templaza-framework'),
                            'custom'    => esc_html__('Custom', 'templaza-framework'),
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
                        'title'  => esc_html__('Custom Margin', 'templaza-framework'),
                        'default' => array(
                            'units' => 'px'
                        ),
                        'required'  => array('margin_type', '=', 'custom'),
                    ),
                    array(
                        'id'       => 'margin_remove_top',
                        'type'     => 'switch',
                        'title'    => esc_html__('Remove top margin', 'templaza-framework'),
                        'required' => array(
                            array('margin_type', '!=', 'custom'),
                            array('margin_type', '!=', 'remove-vertical'),
                        ),
                    ),
                    array(
                        'id'       => 'margin_remove_bottom',
                        'type'     => 'switch',
                        'title'    => esc_html__('Remove bottom margin', 'templaza-framework'),
                        'required' => array(
                            array('margin_type', '!=', 'custom'),
                            array('margin_type', '!=', 'remove-vertical'),
                        ),
                    ),
                    array(
                        'id'        => 'padding_type',
                        'type'      => 'select',
                        'title'     =>  esc_html__('Padding', 'templaza-framework'),
                        'subtitle'  =>  esc_html__('Set the vertical padding.', 'templaza-framework'),
                        'options' => array(
                            'default'   => esc_html__('Default', 'templaza-framework'),
                            'small'     => esc_html__('Small', 'templaza-framework'),
                            'large'     => esc_html__('Large', 'templaza-framework'),
                            'none'      => esc_html__('None', 'templaza-framework'),
                            'custom'    => esc_html__('Custom', 'templaza-framework'),
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
                        'title'  => esc_html__('Custom Padding', 'templaza-framework'),
                        'default' => array(
                            'units' => 'px'
                        ),
                        'required'  => array('padding_type', '=', 'custom'),
                    ),
                    array(
                        'id'       => 'padding_remove_top',
                        'type'     => 'switch',
                        'title'    => esc_html__('Remove top padding', 'templaza-framework'),
                        'required' => array(
                            array('padding_type', '!=', 'none'),
                            array('padding_type', '!=', 'custom'),
                        ),
                    ),
                    array(
                        'id'       => 'padding_remove_bottom',
                        'type'     => 'switch',
                        'title'    => esc_html__('Remove bottom padding', 'templaza-framework'),
                        'required' => array(
                            array('padding_type', '!=', 'none'),
                            array('padding_type', '!=', 'custom'),
                        ),
                    ),
                    array(
                        'id'       => 'position',
                        'type'     => 'select',
                        'title'    => esc_html__('Position', 'templaza-framework'),
                        'subtitle' => esc_html__('Set position for block', 'templaza-framework'),
                        //Must provide key => value pairs for options
                        'options' => array(
                                    'inherit' => esc_html__('Inherit', 'templaza-framework'),
                                    'relative' => esc_html__('Relative', 'templaza-framework'),
                                    'absolute' => esc_html__('Absolute', 'templaza-framework'),
                                ),
                    ),
                    array(
                        'id'     => 'position_type',
                        'type'   => 'select',
                        'title'    => esc_html__('Position Type', 'templaza-framework'),
                        'options' => array(
                            'uk-position-top-left'  => esc_html__('Top Left', 'templaza-framework'),
                            'uk-position-top-center' => esc_html__('Top Center', 'templaza-framework'),
                            'uk-position-top-right'    => esc_html__('Top Right', 'templaza-framework'),
                            'uk-position-center'    => esc_html__('Center', 'templaza-framework'),
                            'uk-position-center-left'    => esc_html__('Center Left', 'templaza-framework'),
                            'uk-position-center-right'    => esc_html__('Center Right', 'templaza-framework'),
                            'uk-position-bottom-left'    => esc_html__('Bottom Left', 'templaza-framework'),
                            'uk-position-bottom-center'    => esc_html__('Bottom Center', 'templaza-framework'),
                            'uk-position-bottom-right'    => esc_html__('Bottom Right', 'templaza-framework'),
                            'custom'    => esc_html__('Custom', 'templaza-framework'),
                        ),
                        'required'  => array('position', '=', 'absolute'),
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
                        'title'  => esc_html__('Custom Colors', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Text Color', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'link_color',
                        'type'     => 'link_color',
                        'title'    => esc_html__('Link Color', 'templaza-framework'),
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
                        $defDesignIds   = array_column($default_design['fields'], 'id');

                        $n_i    = 1;
                        // Each design settings fields
                        foreach ($tab['fields'] as $tfield){

                            $def_index    = array_search($tfield['id'], $defDesignIds);
                            if($def_index !== false){
                                $default_design['fields'][$def_index]   = array_merge($default_design['fields'][$def_index],
                                    $tfield);
//                                $n_i    = 1;
                            }else{
                                if(isset($tfield['after_field']) && !empty($tfield['after_field'])){
                                    $n_index = array_search( $tfield['after_field'],$defDesignIds);
                                    if($n_index !== false){
                                        $n_field_last  = array_splice($default_design['fields'], 0,
                                            $n_index + $n_i, array($tfield));
                                        $default_design['fields']   = array_merge($n_field_last,$default_design['fields']);
                                        $n_i++;
                                    }else{
                                        array_push($default_design['fields'], $tfield);
//                                        $n_i    = 1;
                                    }
                                }else{
                                    array_push($default_design['fields'], $tfield);
//                                    $n_i    = 1;
                                }
                            }
                        }
                        $tab['fields']  = $default_design['fields'];
//                        if($element['id'] == 'section') {
//                            var_dump($default_design);
//                            die(__FILE__);
//                        }

                        $has_design_tab = $i;
//                        $field_diff = array_udiff($default_design['fields'], $tab['fields'], function($a, $b){
//                            if ($a['id']===$b['id'])
//                            {
//                                return 0;
//                            }
//
//                            return ($a['id']>$b['id'])?1:-1;
//                        });

//                        $tab['fields']  += $field_diff;
//                        ksort($tab['fields']);
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
        // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
        if($el = $this -> get_element()){
            $params = isset($el['params'])?$el['params']:null;
            if($params){
                ?>
                <script type="text/html" id="tmpl-field-tz_layout-settings-<?php echo esc_attr($el['id']); ?>">
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
            $parent = $this -> parent;
            $params = isset($el['params'])?$el['params']:null;
            if($params){
                ob_start();
                ?>
                <div class="fl_ui-panel-tab-content-container" data-fl-setting-title="<?php
                echo isset($el['param_title'])?esc_attr($el['param_title']):'';?>">
                    <table class="form-table">
                        <?php
                        if(class_exists('reduxCoreEnqueue')) {
                            $enqueue    = new Redux_Enqueue($this -> parent);
                        }
                        foreach($params as &$param){
                            $param['shortcode'] = true;
                            if($enqueue){
                                $enqueue -> enqueue_field($this -> parent, $param);
                            }

                            $this -> check_dependencies($param, $this -> field_parent, $this -> parent);
//                            if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
//                                $this->parent->field_default_values($param);
//                                $this->parent->check_dependencies($param);
//                            }else {
//                                $parent -> options_defaults_class -> field_default_values($parent->args['opt_name'], $param);
//                                $parent -> required_class -> check_dependencies($param);
//                            }
//
//                            TemPlazaFramework\Helpers\FieldHelper::check_required_dependencies($param, $this -> field_parent, $this -> parent);

                            do_action('templaza-framework/element/param/before', $param, $this);
                            $param  = apply_filters('templaza-framework/element/param/before', $param, $this);

                            $param['name']  = $param['id'];
                            $param['class'] = '';
                            $param['id']    = $this -> field_parent['id'].'-'.$param['id'];

                            ob_start();
                            if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                                $this->parent->_field_input($param);
                            }else{
                                $parent -> render_class -> field_input($param, null);
                            }
                            $param_html = ob_get_contents();
                            ob_end_clean();
                            if(preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $param_html)){
                                $param_html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $param_html);
                            }
                            ?>
                            <tr>
                                <?php
                                $title  = false;
                                if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')){
                                    $title = $this -> parent -> get_header_html($param);
                                }else{
                                    $title  = $parent -> render_class -> get_header_html($param);
                                }
                                if($title){ ?>
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

    public function check_dependencies($field, $parent_field = null, &$parent = null){
        $parent         = !empty($parent)?$parent:$this -> parent;
        $parent_field   = !empty($parent_field)?$parent_field:$this -> field_parent;

        if(version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
            $parent->field_default_values($field);
            $parent->check_dependencies($field);
        }else {
            $parent -> options_defaults_class -> field_default_values($parent->args['opt_name'], $field);
            $parent -> required_class -> check_dependencies($field);
        }

//        TemPlazaFramework\Helpers\FieldHelper::check_required_dependencies($field, $parent_field, $parent);

    }

    public function front_end_prepare_element($element, $parent_el){
        // Recreate id of element
        if(isset($element['id'])){
            $element['id']  = (int) round(microtime(true) * 1000000);
        }
        return $element;
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
        if(isset($params['position']) && $params['position']=='absolute'){
            $params['tz_class']   .= ' '.$params['position_type'];
        }
        if(isset($params['position']) && $params['position']=='relative'){
            $params['tz_class']   .= ' uk-position-relative';
        }

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
            }
        }
		if(isset($params['background_overlay_top']) && !empty($params['background_overlay_top']) || isset($params['background_overlay_bottom']) && !empty($params['background_overlay_bottom']) ){
            $overlay_color_gradient_top = CSS::make_color_rgba_redux($params['background_overlay_top']);
            $overlay_color_gradient_bottom = CSS::make_color_rgba_redux($params['background_overlay_bottom']);
            if(!empty($overlay_color_gradient_top) || !empty($overlay_color_gradient_top)){
                $params['tz_class'] .=' tz_background_overlay ';
                $css_overlay_gradient   = '';
                $css_overlay_gradient   .= '.'.$custom_css_name.'::before {background:linear-gradient(0deg, '.$overlay_color_gradient_bottom.' 30%, '.$overlay_color_gradient_top.' 100%);}';
                if(!empty($css_overlay_gradient)){
                    Templates::add_inline_style($css_overlay_gradient);
                }
            }
        }
        if(isset($params['text_color']) && !empty($params['text_color'])){
            $custom_text_name    = '.'.$custom_css_name;
            $css_text   = '';
            $css_text   .= $custom_text_name.' p, '.$custom_text_name.'{color:'.$params['text_color'].' !important;}';
            Templates::add_inline_style($css_text);
        }

        if(isset($params['link_color']) && !empty($params['link_color'])){
            $custom_link_name    = '.'.$custom_css_name;

            $css_link   = '';
            $link_color = $params['link_color'];

            if(isset($link_color['regular']) && !empty($link_color['regular'])){
                $css_link   .= $custom_link_name.' a{color:'.$link_color['regular'].' !important;}';
            }
            if(isset($link_color['hover']) && !empty($link_color['hover'])){
                $css_link   .= $custom_link_name.' a:hover{color:'.$link_color['hover'].' !important;}';
            }
            if(isset($link_color['active']) && !empty($link_color['active'])){
                $css_link   .= $custom_link_name.' a:active{color:'.$link_color['active'].' !important;}';
            }
            if(!empty($css_link)){
                Templates::add_inline_style($css_link);
            }
        }

        return $params;
    }

    public function custom_css(&$params, &$element){
        $css = array('desktop' => '', 'tablet' => '', 'mobile' => '');



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

//        if(isset($params['border_radius']) && !empty($params['border_radius'])){
//            $border_radius = $params['border_radius'];
//            var_dump($border_radius['border-radius-top-left']);
//            $css['desktop']    .= CSS::border_radius($border_radius['border-radius-top-left'],$border_radius['border-radius-top-right'],
//                $border_radius['border-radius-bottom-left'],$border_radius['border-radius-bottom-right'],true);
//
//            unset($params['border_radius']);

//        }

        $margin_type    = isset($params['margin_type'])?$params['margin_type']:'custom';
        if($margin_type == 'custom' && isset($params['margin']) && !empty($params['margin'])){

            $margin    = CSS::make_spacing_redux('margin', $params['margin'], true, 'px');

            if(!empty($margin)){
                if(is_array($margin)){
                    foreach($margin as $device => $pcss){
                        if(!isset($css[$device])){
                            $css[$device]   = '';
                        }
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
                        if(!isset($css[$device])){
                            $css[$device]   = '';
                        }
                        $css[$device] .= $pcss;
                    }
                }else{
                    $css['desktop'] .= $padding;
                }
            }

            unset($params['padding']);
        }
        if(isset($params['border_radius'])){
            $border_radius    = CSS::make_spacing_redux('border-radius', $params['border_radius'], true, 'px');
            if(!empty($border_radius)){
                if(is_array($border_radius)){
                    foreach($border_radius as $device => $bdcss){
                        if(!isset($css[$device])){
                            $css[$device]   = '';
                        }
                        $css[$device] .= $bdcss;
                    }
                }else{
                    $css['desktop'] .= $border_radius;
                }
            }
            unset($params['border_radius']);
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
        $file   = apply_filters('templaza-framework/shortcode/'.$this -> get_shortcode_name().'/tmpl', $file);
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
			'-'  => __( 'Choose an icon...', 'templaza-framework' ),
			'home' => __( 'Home', 'templaza-framework' ),
			'sign-in' => __( 'Sign-in', 'templaza-framework' ),
			'sign-out' => __( 'Sign-out', 'templaza-framework' ),
			'user' => __( 'User', 'templaza-framework' ),
			'users' => __( 'Users', 'templaza-framework' ),
			'lock' => __( 'Lock', 'templaza-framework' ),
			'unlock' => __( 'Unlock', 'templaza-framework' ),
			'settings' => __( 'Settings', 'templaza-framework' ),
			'cog' => __( 'Cog', 'templaza-framework' ),
			'nut' => __( 'Nut', 'templaza-framework' ),
			'comment' => __( 'Comment', 'templaza-framework' ),
			'commenting' => __( 'Commenting', 'templaza-framework' ),
			'comments' => __( 'Comments', 'templaza-framework' ),
			'hashtag' => __( 'Hashtag', 'templaza-framework' ),
			'tag' => __( 'Tag', 'templaza-framework' ),
			'cart' => __( 'Cart', 'templaza-framework' ),
			'credit-card' => __( 'Credit-card', 'templaza-framework' ),
			'mail' => __( 'Mail', 'templaza-framework' ),
			'receiver' => __( 'Receiver', 'templaza-framework' ),
			'search' => __( 'Search', 'templaza-framework' ),
			'location' => __( 'Location', 'templaza-framework' ),
			'bookmark' => __( 'Bookmark', 'templaza-framework' ),
			'code' => __( 'Code', 'templaza-framework' ),
			'paint-bucket' => __( 'Paint-bucket', 'templaza-framework' ),
			'camera' => __( 'Camera', 'templaza-framework' ),
			'bell' => __( 'Bell', 'templaza-framework' ),
			'bolt' => __( 'Bolt', 'templaza-framework' ),
			'star' => __( 'Star', 'templaza-framework' ),
			'heart' => __( 'Heart', 'templaza-framework' ),
			'happy' => __( 'Happy', 'templaza-framework' ),
			'lifesaver' => __( 'Lifesaver', 'templaza-framework' ),
			'rss' => __( 'Rss', 'templaza-framework' ),
			'social' => __( 'Social', 'templaza-framework' ),
			'git-branch' => __( 'Git-branch', 'templaza-framework' ),
			'git-fork' => __( 'Git-fork', 'templaza-framework' ),
			'world' => __( 'World', 'templaza-framework' ),
			'calendar' => __( 'Calendar', 'templaza-framework' ),
			'clock' => __( 'Clock', 'templaza-framework' ),
			'history' => __( 'History', 'templaza-framework' ),
			'future' => __( 'Future', 'templaza-framework' ),
			'pencil' => __( 'Pencil', 'templaza-framework' ),
			'trash' => __( 'Trash', 'templaza-framework' ),
			'move' => __( 'Move', 'templaza-framework' ),
			'link' => __( 'Link', 'templaza-framework' ),
			'question' => __( 'Question', 'templaza-framework' ),
			'info' => __( 'Info', 'templaza-framework' ),
			'warning' => __( 'Warning', 'templaza-framework' ),
			'image' => __( 'Image', 'templaza-framework' ),
			'thumbnails' => __( 'Thumbnails', 'templaza-framework' ),
			'table' => __( 'Table', 'templaza-framework' ),
			'list' => __( 'List', 'templaza-framework' ),
			'menu' => __( 'Menu', 'templaza-framework' ),
			'grid' => __( 'Grid', 'templaza-framework' ),
			'more' => __( 'More', 'templaza-framework' ),
			'more-vertical' => __( 'More-vertical', 'templaza-framework' ),
			'plus' => __( 'Plus', 'templaza-framework' ),
			'plus-circle' => __( 'Plus-circle', 'templaza-framework' ),
			'minus' => __( 'Minus', 'templaza-framework' ),
			'minus-circle' => __( 'Minus-circle', 'templaza-framework' ),
			'close' => __( 'Close', 'templaza-framework' ),
			'check' => __( 'Check', 'templaza-framework' ),
			'ban' => __( 'Ban', 'templaza-framework' ),
			'refresh' => __( 'Refresh', 'templaza-framework' ),
			'play' => __( 'Play', 'templaza-framework' ),
			'play-circle' => __( 'Play-circle', 'templaza-framework' ),
			'tv' => __( 'Tv', 'templaza-framework' ),
			'desktop' => __( 'Desktop', 'templaza-framework' ),
			'laptop' => __( 'Laptop', 'templaza-framework' ),
			'tablet' => __( 'Tablet', 'templaza-framework' ),
			'phone' => __( 'Phone', 'templaza-framework' ),
			'tablet-landscape' => __( 'Tablet-landscape', 'templaza-framework' ),
			'phone-landscape' => __( 'Phone-landscape', 'templaza-framework' ),
			'file' => __( 'File', 'templaza-framework' ),
			'copy' => __( 'Copy', 'templaza-framework' ),
			'file-edit' => __( 'File-edit', 'templaza-framework' ),
			'folder' => __( 'Folder', 'templaza-framework' ),
			'album' => __( 'Album', 'templaza-framework' ),
			'push' => __( 'Push', 'templaza-framework' ),
			'pull' => __( 'Pull', 'templaza-framework' ),
			'server' => __( 'Server', 'templaza-framework' ),
			'database' => __( 'Database', 'templaza-framework' ),
			'cloud-upload' => __( 'Cloud-upload', 'templaza-framework' ),
			'cloud-download' => __( 'Cloud-download', 'templaza-framework' ),
			'download' => __( 'Download', 'templaza-framework' ),
			'upload' => __( 'Upload', 'templaza-framework' ),
			'reply' => __( 'Reply', 'templaza-framework' ),
			'forward' => __( 'Forward', 'templaza-framework' ),
			'expand' => __( 'Expand', 'templaza-framework' ),
			'shrink' => __( 'Shrink', 'templaza-framework' ),
			'arrow-up' => __( 'Arrow-up', 'templaza-framework' ),
			'arrow-down' => __( 'Arrow-down', 'templaza-framework' ),
			'arrow-left' => __( 'Arrow-left', 'templaza-framework' ),
			'arrow-right' => __( 'Arrow-right', 'templaza-framework' ),
			'chevron-up' => __( 'Chevron-up', 'templaza-framework' ),
			'chevron-down' => __( 'Chevron-down', 'templaza-framework' ),
			'chevron-left' => __( 'Chevron-left', 'templaza-framework' ),
			'chevron-right' => __( 'Chevron-right', 'templaza-framework' ),
			'triangle-up' => __( 'Triangle-up', 'templaza-framework' ),
			'triangle-down' => __( 'Triangle-down', 'templaza-framework' ),
			'triangle-left' => __( 'Triangle-left', 'templaza-framework' ),
			'triangle-right' => __( 'Triangle-right', 'templaza-framework' ),
			'bold' => __( 'Bold', 'templaza-framework' ),
			'italic' => __( 'Italic', 'templaza-framework' ),
			'strikethrough' => __( 'Strikethrough', 'templaza-framework' ),
			'video-camera' => __( 'Video-camera', 'templaza-framework' ),
			'quote-right' => __( 'Quote-right', 'templaza-framework' ),
			'500px' => __( '500px', 'templaza-framework' ),
			'behance' => __( 'Behance', 'templaza-framework' ),
			'dribbble' => __( 'Dribbble', 'templaza-framework' ),
			'facebook' => __( 'Facebook', 'templaza-framework' ),
			'flickr' => __( 'Flickr', 'templaza-framework' ),
			'foursquare' => __( 'Foursquare', 'templaza-framework' ),
			'github' => __( 'Github', 'templaza-framework' ),
			'github-alt' => __( 'Github-alt', 'templaza-framework' ),
			'gitter' => __( 'Gitter', 'templaza-framework' ),
			'google' => __( 'Google', 'templaza-framework' ),
			'google-plus' => __( 'Google-plus', 'templaza-framework' ),
			'instagram' => __( 'Instagram', 'templaza-framework' ),
			'joomla' => __( 'Joomla', 'templaza-framework' ),
			'linkedin' => __( 'Linkedin', 'templaza-framework' ),
			'pagekit' => __( 'Pagekit', 'templaza-framework' ),
			'pinterest' => __( 'Pinterest', 'templaza-framework' ),
			'soundcloud' => __( 'Soundcloud', 'templaza-framework' ),
			'tripadvisor' => __( 'Tripadvisor', 'templaza-framework' ),
			'tumblr' => __( 'Tumblr', 'templaza-framework' ),
			'twitter' => __( 'Twitter', 'templaza-framework' ),
			'uikit' => __( 'Uikit', 'templaza-framework' ),
			'etsy' => __( 'Etsy', 'templaza-framework' ),
			'vimeo' => __( 'Vimeo', 'templaza-framework' ),
			'whatsapp' => __( 'Whatsapp', 'templaza-framework' ),
			'wordpress' => __( 'Wordpress', 'templaza-framework' ),
			'xing' => __( 'Xing', 'templaza-framework' ),
			'yelp' => __( 'Yelp', 'templaza-framework' ),
			'youtube' => __( 'Youtube', 'templaza-framework' ),
			'print' => __( 'Print', 'templaza-framework' ),
			'reddit' => __( 'Reddit', 'templaza-framework' ),
			'file-text' => __( 'File Text', 'templaza-framework' ),
			'file-pdf' => __( 'File Pdf', 'templaza-framework' ),
			'chevron-double-left' => __( 'Chevron Double Left', 'templaza-framework' ),
			'chevron-double-right' => __( 'Chevron Double Right', 'templaza-framework' ),
		];
		return apply_filters( 'templaza-framework/options-font-uikit', $font_uikit );
	}
}
