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
                'desc'        => esc_html__('Place content elements inside the row', $this -> text_domain),
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
                                'title'  => esc_html__('General', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'       => 'section_type',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Section Type', $this -> text_domain),
                                        'options'  => array(
                                            'default'         => esc_html__('Default', $this -> text_domain),
                                            'templaza-footer' => esc_html__('Footer', $this -> text_domain),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default' => 'default'
                                    ),
									array(
                                        'id'       => 'hideon_single',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Single Post', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Single Post', $this -> text_domain),
                                        'default'  => false,
                                    ),
//                                    array(
//                                        'id'       => 'title',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Section Title', $this -> text_domain),
//                                    ),

                                    array(
                                        'id'      => 'container_width',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Max width', $this -> text_domain),
                                        'options' => array(
                                            'default'   => esc_html__('Default', $this -> text_domain),
                                            'xsmall'    => esc_html__('XSmall', $this -> text_domain),
                                            'small'     => esc_html__('Small', $this -> text_domain),
                                            'large'     => esc_html__('Large', $this -> text_domain),
                                            'xlarge'    => esc_html__('XLarge', $this -> text_domain),
                                            'expand'    => esc_html__('Expand', $this -> text_domain),
                                            'none'      => esc_html__('None', $this -> text_domain),
                                            'custom'    => esc_html__('Custom (Add Custom class to use customized container)', $this -> text_domain),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default' => 'default',
                                    ),
                                    array(
                                        'id'       => 'padding_remove_horizontal',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Remove horizontal padding', $this -> text_domain),
                                        'subtitle' => __('Set the maximum content width.', $this -> text_domain),
                                        'required' => array('container_width', '=', array('default', 'xsmall', 'small', 'large', 'xlarge')),
                                    ),
                                    array(
                                        'id'    => 'custom_container_class',
                                        'type'  => 'text',
                                        'title' => esc_html__('Container Custom Class', $this -> text_domain),
                                        'required' => array('container_width', '!=', 'none'), /* required: container_width != 'none' */
//                                        'required' => array('container_width', '=', array('default', 'xsmall', 'small',
//                                            'large', 'xlarge','expand', 'custom')), /* required: container_width != 'none' */
                                    ),
                                    array(
                                        'id'       => 'container_width_expand',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Expand One Side', $this -> text_domain),
                                        'subtitle' => __('Expand the width of one side to the left or right while the other side keeps within the constraints of the max width.', $this -> text_domain),
                                        'options'  => array(
                                            ''  => esc_html__("Don't expand", $this ->text_domain),
                                            'left'  => esc_html__("To left", $this ->text_domain),
                                            'right'  => esc_html__("To right", $this ->text_domain),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                    ),
                                    array(
                                        'id'       => 'height',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Height', $this -> text_domain),
                                        'subtitle' => __('Expand the width of one side to the left or right while the other side keeps within the constraints of the max width.', $this -> text_domain),
                                        'options'  => array(
                                            ''        => esc_html__("None", $this ->text_domain),
                                            'full'    => esc_html__("Viewport", $this ->text_domain),
                                            'percent' => esc_html__("Viewport (Minus 20%)", $this ->text_domain),
                                            'section' => esc_html__("Viewport (Minus the following section)", $this ->text_domain),
                                            'expand'  => esc_html__("Expand", $this ->text_domain),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                    ),
                                    array(
                                        'id'       => 'vertical_align',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Vertical Alignment', $this -> text_domain),
                                        'subtitle' => __('Align the section content vertically, if the section height is larger than the content itself.', $this -> text_domain),
                                        'options'  => array(
                                            ''        => esc_html__("Top", $this ->text_domain),
                                            'middle'    => esc_html__("Middle", $this ->text_domain),
                                            'bottom' => esc_html__("Bottom", $this ->text_domain),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
//                                        'required' => array('height', '!=', 'expand')
//                                        'required' => array(array('height', 'is_empty_or', ''), array('height', '=', 'expand'))
//                                        'required' => array(array('height', 'is_empty_or', ''), array('height', '!=', 'expand'))
                                        'required' => array('height', '=', array('full','percent','section'))
                                    ),
                                ),
                            ),
                            // Design settings
                            array(
                                'id'     => 'design-settings',
                                'title'  => esc_html__('Design Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'         => 'background',
                                        'type'       => 'background',
                                        'title'      => esc_html__('Background', $this -> text_domain),
                                    ),
									array(
                                        'id'       => 'background_overlay',
                                        'type'     => 'color_rgba',
                                        'title'    => esc_html__('Background Overlay', $this -> text_domain),
                                    ),
                                    array(
                                        'id'         => 'border',
                                        'type'       => 'border',
                                        'title'      => __('Border', $this -> text_domain),
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
                                    ),
                                    array(
                                        'id'       => 'link_color',
                                        'type'     => 'link_color',
                                        'title'    => esc_html__('Link Color', $this -> text_domain),
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
                                        'allow_responsive'  => true,
                                        'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                                        'title'  => esc_html__('Margin', $this -> text_domain),
                                        'default'   => array(
                                            'units' => 'px',
                                        ),
                                    ),
                                    array(
                                        'id'        => 'padding_type',
                                        'type'      => 'select',
                                        'title'     =>  esc_html__('Padding', $this -> text_domain),
                                        'subtitle'  =>  esc_html__('Set the vertical padding.', $this -> text_domain),
                                        'options' => array(
                                            'default'   => esc_html__('Default', $this -> text_domain),
                                            'xsmall'    => esc_html__('XSmall', $this -> text_domain),
                                            'small'     => esc_html__('Small', $this -> text_domain),
                                            'large'     => esc_html__('Large', $this -> text_domain),
                                            'xlarge'    => esc_html__('XLarge', $this -> text_domain),
                                            'none'      => esc_html__('None', $this -> text_domain),
                                            'custom'    => esc_html__('Custom', $this -> text_domain),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default' => 'custom',
                                    ),
                                    array(
                                        'id'       => 'padding_remove_top',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Remove top padding', $this -> text_domain),
                                        'required' => array('padding_type', '=', array('default','xsmall','small','large','xlarge')),
//                                        'required' => array('padding_type', '!=', array('none','custom')),
                                    ),
                                    array(
                                        'id'       => 'padding_remove_bottom',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Remove bottom padding', $this -> text_domain),
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
                                        'title'  => esc_html__('Custom padding', $this -> text_domain),
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
                                'title'  => esc_html__('Responsive Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'       => 'tab-device-visibility',
                                        'type'     => 'section',
                                        'indent'   => true,
                                        'title'    => esc_html__('Device Visibility', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'hideonxs',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Small Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on extra-small Devices', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonsm',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Small Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Small Devices.', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonmd',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Medium Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on medium Devices.', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonlg',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Large Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Large Devices.', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonxl',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Large Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Extra-Large Devices.', $this -> text_domain),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'       => 'hideonxxl',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Hide on Extra-Extra-Large Devices', $this -> text_domain),
                                        'subtitle' => esc_html__('Enable to hide this section on Extra-Extra-Large Devices.', $this -> text_domain),
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