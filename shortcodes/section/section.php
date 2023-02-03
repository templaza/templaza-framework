<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Section')){
    class TemplazaFramework_ShortCode_Section extends TemplazaFramework_ShortCode{

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);
        }

        public function hooks(){
            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/prepare',
                array($this, 'prepare_options'));
        }

        public function prepare_options($item){
            $item['has_children_shortcode']    = true;
            return $item;
        }

        public function register()
        {
            return array(
                'id'          => 'section',
                'title'       => esc_html__('Section'),
                'param_title' => esc_html__('Section Settings'),
                'desc'        => esc_html__('Place content elements inside the row', 'templaza-framework'),
                'admin_label' => true,
                'core'        => true,
                'params'      => array(
                    array(
                        'id' => 'tabs',
                        'type'  => 'tz_tab',
                        'tabs' => array(
                            // General settings
                            array(
                                'id' => 'settings',
                                'title'  => esc_html__('General', 'templaza-framework'),
                                'fields' => array(
                                    array(
                                        'id'       => 'section_type',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Section Type', 'templaza-framework'),
                                        'options'  => array(
                                            'default'         => esc_html__('Default', 'templaza-framework'),
                                            'templaza-footer' => esc_html__('Footer', 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default' => 'default'
                                    ),
									array(
                                        'id'       => 'hideon_single',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Single Post', 'templaza-framework'),
                                        'subtitle' => esc_html__('Enable to hide this section on Single Post', 'templaza-framework'),
                                        'default'  => false,
                                    ),
//                                    array(
//                                        'id'       => 'title',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Section Title', 'templaza-framework'),
//                                    ),

                                    array(
                                        'id'      => 'container_width',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Max width', 'templaza-framework'),
                                        'options' => array(
                                            'default'   => esc_html__('Default', 'templaza-framework'),
                                            'xsmall'    => esc_html__('XSmall', 'templaza-framework'),
                                            'small'     => esc_html__('Small', 'templaza-framework'),
                                            'large'     => esc_html__('Large', 'templaza-framework'),
                                            'xlarge'    => esc_html__('XLarge', 'templaza-framework'),
                                            'expand'    => esc_html__('Expand', 'templaza-framework'),
                                            'none'      => esc_html__('None', 'templaza-framework'),
                                            'custom'    => esc_html__('Custom (Add Custom class to use customized container)', 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default' => 'default',
                                    ),
                                    array(
                                        'id'       => 'padding_remove_horizontal',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Remove horizontal padding', 'templaza-framework'),
                                        'subtitle' => __('Set the maximum content width.', 'templaza-framework'),
                                        'required' => array('container_width', '=', array('default', 'xsmall', 'small', 'large', 'xlarge')),
                                    ),
                                    array(
                                        'id'    => 'custom_container_class',
                                        'type'  => 'text',
                                        'title' => esc_html__('Container Custom Class', 'templaza-framework'),
                                        'required' => array('container_width', '!=', 'none'), /* required: container_width != 'none' */
//                                        'required' => array('container_width', '=', array('default', 'xsmall', 'small',
//                                            'large', 'xlarge','expand', 'custom')), /* required: container_width != 'none' */
                                    ),
                                    array(
                                        'id'       => 'container_width_expand',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Expand One Side', 'templaza-framework'),
                                        'subtitle' => __('Expand the width of one side to the left or right while the other side keeps within the constraints of the max width.', 'templaza-framework'),
                                        'options'  => array(
                                            ''  => esc_html__("Don't expand", 'templaza-framework'),
                                            'left'  => esc_html__("To left", 'templaza-framework'),
                                            'right'  => esc_html__("To right", 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                    ),
                                    array(
                                        'id'       => 'height',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Height', 'templaza-framework'),
                                        'subtitle' => __('Expand the width of one side to the left or right while the other side keeps within the constraints of the max width.', 'templaza-framework'),
                                        'options'  => array(
                                            ''        => esc_html__("None", 'templaza-framework'),
                                            'full'    => esc_html__("Viewport", 'templaza-framework'),
                                            'percent' => esc_html__("Viewport (Minus 20%)", 'templaza-framework'),
                                            'section' => esc_html__("Viewport (Minus the following section)", 'templaza-framework'),
                                            'expand'  => esc_html__("Expand", 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                    ),
                                    array(
                                        'id'       => 'vertical_align',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Vertical Alignment', 'templaza-framework'),
                                        'subtitle' => __('Align the section content vertically, if the section height is larger than the content itself.', 'templaza-framework'),
                                        'options'  => array(
                                            ''        => esc_html__("Top", 'templaza-framework'),
                                            'middle'    => esc_html__("Middle", 'templaza-framework'),
                                            'bottom' => esc_html__("Bottom", 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
//                                        'required' => array('height', '!=', 'expand')
//                                        'required' => array(array('height', 'is_empty_or', ''), array('height', '=', 'expand'))
//                                        'required' => array(array('height', 'is_empty_or', ''), array('height', '!=', 'expand'))
                                        'required' => array('height', '=', array('full','percent','section'))
                                    ),
                                    array(
                                        'id'    => 'custom_zindex',
                                        'type'  => 'text',
                                        'title' => esc_html__('Custom Z-Index', 'templaza-framework'),
                                        'attributes'   => array(
                                            'type'  => 'number'
                                        )
                                    ),
                                ),
                            ),
                            // Design settings
                            array(
                                'id'     => 'design-settings',
                                'title'  => esc_html__('Design Settings', 'templaza-framework'),
                                'fields' => array(
                                    array(
                                        'id'         => 'background',
                                        'type'       => 'background',
                                        'title'      => esc_html__('Background', 'templaza-framework'),
                                    ),
									array(
                                        'id'       => 'background_overlay',
                                        'type'     => 'color_rgba',
                                        'title'    => esc_html__('Background Overlay', 'templaza-framework'),
                                    ),
									array(
                                        'id'       => 'background_overlay_top',
                                        'type'     => 'color_rgba',
                                        'title'    => esc_html__('Background Overlay Gradient Top', 'templaza-framework'),
                                    ),
									array(
                                        'id'       => 'background_overlay_bottom',
                                        'type'     => 'color_rgba',
                                        'title'    => esc_html__('Background Overlay Gradient Bottom', 'templaza-framework'),
                                    ),
                                    array(
                                        'id'         => 'border',
                                        'type'       => 'border',
                                        'title'      => __('Border', 'templaza-framework'),
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
                                        'id'     => 'tab-spacing',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Spacing', 'templaza-framework'),
                                    ),
                                    array(
                                        'id'     => 'margin',
                                        'type'   => 'spacing',
                                        'mode'   => 'margin',
                                        'all'    => false,
                                        'allow_responsive'  => true,
                                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                                        'title'  => esc_html__('Margin', 'templaza-framework'),
                                        'default'   => array(
                                            'units' => 'px',
                                        ),
                                    ),
                                    array(
                                        'id'        => 'padding_type',
                                        'type'      => 'select',
                                        'title'     =>  esc_html__('Padding', 'templaza-framework'),
                                        'subtitle'  =>  esc_html__('Set the vertical padding.', 'templaza-framework'),
                                        'options' => array(
                                            'default'   => esc_html__('Default', 'templaza-framework'),
                                            'xsmall'    => esc_html__('XSmall', 'templaza-framework'),
                                            'small'     => esc_html__('Small', 'templaza-framework'),
                                            'large'     => esc_html__('Large', 'templaza-framework'),
                                            'xlarge'    => esc_html__('XLarge', 'templaza-framework'),
                                            'none'      => esc_html__('None', 'templaza-framework'),
                                            'custom'    => esc_html__('Custom', 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default' => 'custom',
                                    ),
                                    array(
                                        'id'       => 'padding_remove_top',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Remove top padding', 'templaza-framework'),
                                        'required' => array('padding_type', '=', array('default','xsmall','small','large','xlarge')),
//                                        'required' => array('padding_type', '!=', array('none','custom')),
                                    ),
                                    array(
                                        'id'       => 'padding_remove_bottom',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Remove bottom padding', 'templaza-framework'),
                                        'required' => array('padding_type', '=', array('default','xsmall','small','large','xlarge')),
//                                        'required' => array('padding_type', '!=', array('none','custom')),
                                    ),
                                    array(
                                        'id'     => 'padding',
                                        'type'   => 'spacing',
                                        'mode'   => 'padding',
                                        'all'    => false,
                                        'allow_responsive'  => true,
                                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                                        'title'  => esc_html__('Custom padding', 'templaza-framework'),
                                        'default'   => array(
                                            'units' => 'px',
                                        ),
                                        'required'  => array('padding_type', '=', 'custom'),
                                    ),
                                    array(
                                        'id'     => 'tab-spacing-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ),
                            // Responsive settings
                            array(
                                'id'     => 'responsive-settings',
                                'title'  => esc_html__('Responsive Settings', 'templaza-framework'),
                                'fields' => array(
                                    array(
                                        'id'       => 'tab-device-visibility',
                                        'type'     => 'section',
                                        'indent'   => true,
                                        'title'    => esc_html__('Device Visibility', 'templaza-framework'),
                                    ),
                                    array(
                                        'id'       => 'hideonxs',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Small Devices', 'templaza-framework'),
                                        'subtitle' => esc_html__('Enable to hide this section on extra-small Devices', 'templaza-framework'),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonsm',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Small Devices', 'templaza-framework'),
                                        'subtitle' => esc_html__('Enable to hide this section on Small Devices.', 'templaza-framework'),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonmd',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Medium Devices', 'templaza-framework'),
                                        'subtitle' => esc_html__('Enable to hide this section on medium Devices.', 'templaza-framework'),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonlg',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Large Devices', 'templaza-framework'),
                                        'subtitle' => esc_html__('Enable to hide this section on Large Devices.', 'templaza-framework'),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonxl',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Large Devices', 'templaza-framework'),
                                        'subtitle' => esc_html__('Enable to hide this section on Extra-Large Devices.', 'templaza-framework'),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonxxl',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Extra-Large Devices', 'templaza-framework'),
                                        'subtitle' => esc_html__('Enable to hide this section on Extra-Extra-Large Devices.', 'templaza-framework'),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'tab-device-visibility-end',
                                        'type'     => 'section',
                                        'indent'   => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ),
                        ),
                    ),
                )
            );
        }


        public function prepare_params($params, $element,$parent_el){

            // Remove padding option if the padding_type is not custom
            if(isset($params['padding']) && isset($params['padding_type']) && $params['padding_type'] != 'custom'){
                unset($params['padding']);
            }

            $params = parent::prepare_params($params, $element,$parent_el);

            if(!isset($params['tz_class'])){
                $params['tz_class'] = '';
            }

            if(isset($params['section_type']) && $params['section_type'] !== 'default'){
                $params['tz_class']   .= ' '.$params['section_type'];
            }

            if((strpos($params['tz_class'], 'uk-section') == false) &&
                (!isset($params['padding_type']) || (isset($params['padding_type']) && $params['padding_type'] != 'custom'))){
                $params['tz_class'] .= ' uk-section';
            }
            if(isset($params['padding_type'])){
                $padding_type    = $params['padding_type'];

                switch ($padding_type){
                    case 'xsmall':
                    case 'small':
                    case 'large':
                    case 'xlarge':
                        $params['tz_class']   .= ' uk-section-'.$padding_type;
                        break;
                    case 'none':
                        $params['tz_class']   .= ' uk-padding-remove-vertical';
                        break;
                }
                if($padding_type != 'none' && $padding_type != 'custom'){
                    $padding_remove_top    = isset($params['padding_remove_top'])?filter_var($params['padding_remove_top'], FILTER_VALIDATE_BOOLEAN):false;
                    $padding_remove_bottom = isset($params['padding_remove_bottom'])?filter_var($params['padding_remove_bottom'], FILTER_VALIDATE_BOOLEAN):false;
                    if($padding_remove_top){
                        $params['tz_class'] .= ' uk-padding-remove-top';
                    }
                    if($padding_remove_bottom){
                        $params['tz_class'] .= ' uk-padding-remove-bottom';
                    }
                }
            }

            if(isset($params['height']) && isset($params['vertical_align'])){
                $height = $params['height'];
                if($height != '' && $height != 'expand' && !empty($vertical_align)){
                    $params['tz_class']   .= ' uk-flex uk-flex-'.$vertical_align;
                }
            }


            if(isset($params['hideonxxl']) && (bool) $params['hideonxxl']){
                $params['tz_class'] .= ' hideonxxl';
            }            
            if(isset($params['hideonxl']) && (bool) $params['hideonxl']){
                $params['tz_class'] .= ' hideonxl';
            }
            if(isset($params['hideonlg']) && (bool) $params['hideonlg']){
                $params['tz_class'] .= ' hideonlg';
            }
            if(isset($params['hideonmd']) && (bool) $params['hideonmd']){
                $params['tz_class'] .= ' hideonmd';
            }
            if(isset($params['hideonsm']) && (bool) $params['hideonsm']){
                $params['tz_class'] .= ' hideonsm';
            }
            if(isset($params['hideonxs']) && (bool) $params['hideonxs']){
                $params['tz_class'] .= ' hideonxs';
            }

            return $params;
        }
        public function custom_css(&$params, &$element)
        {
            $css = parent::custom_css($params, $element);

            if(isset($params['custom_zindex']) && !empty($params['custom_zindex'])){
                $css['desktop'] .= 'z-index: '.$params['custom_zindex'].';';
            }
            return $css;
        }

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-section-js')) {
                wp_enqueue_script(
                    'templaza-shortcode-section-js',
                    Functions::get_my_url() . '/shortcodes/section/section.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }
    }

}

?>