<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Column')){
    class TemplazaFramework_ShortCode_Column extends TemplazaFramework_ShortCode {

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);
        }

        public function hooks(){
            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/prepare', array($this, 'prepare_options'));
        }

        public function prepare_options($item){
            $item['has_children_shortcode']    = true;
            return $item;
        }

        public function register(){
            return array(
                'id'          => 'column',
                'title'       => __('Column'),
                'param_title' => esc_html__('Column Settings'),
                'desc'        => __('Place content elements inside the row'),
                'core'        => true, // This shortcode doesn't list in element list when add new element in column
                'params'      => array(
                    array(
                        'id'    => 'tabs',
                        'type'  => 'tz_tab',
                        'tabs'  => array(
                            // General settings
                            array(
                                'id' => 'settings',
                                'title'  => esc_html__('General Settings', 'templaza-framework'),
                                'fields' => array(
                                    array(
                                        'id'       => 'use_sticky',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Use Sticky', 'templaza-framework'),
                                        'subtitle' => esc_html__('Make column remain at the top of the viewport.', 'templaza-framework'),
                                        'default'  => false,
                                    ),
                                    array(
                                        'id'     => 'tab-column__sticky_options',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Sticky Options', 'templaza-framework'),
                                        'required'  => array('use_sticky', '=', 'true'),
                                    ),
                                    array(
                                        'id'       => 'sticky_position',
                                        'type'     => 'select',
                                        'options'  => array(
                                            'top'       => 'top',
                                            'bottom'    => 'bottom'
                                        ),
                                        'title'    => esc_html__('Sticky position', 'templaza-framework'),
                                        'subtitle' => esc_html__('The position the element should be stuck to.', 'templaza-framework'),
                                        'default'  => 'top',
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_start',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Sticky start', 'templaza-framework'),
                                        'subtitle' => esc_html__('Start offset. The value can be in vh, % and px', 'templaza-framework'),
                                        'default'  => '',
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_end',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Sticky End', 'templaza-framework'),
                                        'subtitle' => esc_html__('End offset. The value can be in vh, % and px', 'templaza-framework'),
                                        'default'  => '',
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_offset',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Sticky Offset', 'templaza-framework'),
                                        'subtitle' => esc_html__('The offset the Sticky should be fixed to. The value can be in vh, % and px', 'templaza-framework'),
                                        'default'  => '',
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_overflow_flip',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Sticky Overflow Flip', 'templaza-framework'),
                                        'subtitle' => esc_html__('Flip the Sticky\'s position option if the element overflows the viewport and disable overflow scrolling', 'templaza-framework'),
                                        'default'  => false,
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_animation',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Sticky Animation', 'templaza-framework'),
                                        'subtitle' => esc_html__('The animation to use when the element becomes sticky', 'templaza-framework'),
                                        'default'  => '',
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_cls_active',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Sticky Active Class', 'templaza-framework'),
                                        'default'  => 'uk-active',
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_cls_inactive',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Sticky Active Class', 'templaza-framework'),
                                        'default'  => '',
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_show_on_up',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Only Show Sticky', 'templaza-framework'),
                                        'subtitle' => esc_html__('Only show sticky element when scrolling up', 'templaza-framework'),
                                        'default'  => false,
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_media',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Sticky Media', 'templaza-framework'),
                                        'subtitle' => esc_html__('Condition for the active status - a width as integer (e.g. 640) or a breakpoint (e.g. @s, @m, @l, @xl) or any valid media query (e.g. (min-width: 900px))', 'templaza-framework'),
                                        'default'  => false,
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'       => 'sticky_target_offset',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Sticky Target Offset', 'templaza-framework'),
                                        'subtitle' => esc_html__('Initially make sure that the Sticky element is not over a referenced element via the page\'s location hash', 'templaza-framework'),
                                        'default'  => '',
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                    array(
                                        'id'     => 'tab-column__sticky_options-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                        'required'  => array('use_sticky', '=', true),
                                    ),
                                ),
                            ), // End general settings

                            // Design settings
                            array(
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
                                        'id'     => 'tab-custom_colors',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Custom Colors', 'templaza-framework'),
                                    ),
                                    array(
                                        'id'       => 'text_color',
                                        'type'     => 'color',
                                        'title'    => esc_html__('Text Color', 'templaza-framework'),
//                                        'required' => array('custom_colors', '=', '1'),
                                    ),
                                    array(
                                        'id'       => 'link_color',
                                        'type'     => 'link_color',
                                        'title'    => esc_html__('Link Color', 'templaza-framework'),
//                                        'required' => array('custom_colors', '=', '1'),
                                    ),
                                    array(
                                        'id'     => 'tab-custom_colors-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ), // End design settings

                            // Responsive settings
                            array(
                                'id'     => 'responsive-settings',
                                'title'  => esc_html__('Responsive Settings', 'templaza-framework'),
                                'fields' => array(

                                    array(
                                        'id'      => 'xs_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Phone Portrait', 'templaza-framework'),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', 'templaza-framework'),
                                        'options' => $this -> column_width_options(),
                                        'default' => '1-1'
                                    ),
                                    array(
                                        'id'      => 'sm_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Phone Landscape', 'templaza-framework'),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', 'templaza-framework'),
                                        'options' => $this -> column_width_options()
                                    ),
                                    array(
                                        'id'      => 'md_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Tablet Landscape', 'templaza-framework'),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', 'templaza-framework'),
                                        'options' => $this -> column_width_options()
                                    ),
                                    array(
                                        'id'      => 'lg_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Desktop (Default Device)', 'templaza-framework'),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', 'templaza-framework'),
                                        'options' => $this -> column_width_options()
                                    ),
                                    array(
                                        'id'      => 'xl_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Large Screen', 'templaza-framework'),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', 'templaza-framework'),
                                        'options' => $this -> column_width_options()
                                    ),
                                    array(
                                        'id'     => 'tab-visibility-options',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Visibility Options', 'templaza-framework'),
//                                        'subtitle'   => esc_html__('<576px', 'templaza-framework'),
                                    ),
//                                    array(
//                                        'id'      => 'xs_visibility',
//                                        'type'    => 'switch',
//                                        'title'   => esc_html__('Visible On Phone Portrait'),
//                                        'subtitle'=> esc_html__('Disable to hide this section on phone portrait device'),
//                                        'default' => true,
//                                    ),
                                    array(
                                        'id'      => 'sm_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visible On Phone Landscape', 'templaza-framework'),
                                        'subtitle'=> esc_html__('Disable to hide this section on phone landscape device( max-width:639px )'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'      => 'md_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visible On Tablet Landscape'),
                                        'subtitle'=> esc_html__('Disable to hide this section on tablet landscape device(from 640px to 959px)'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'      => 'lg_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visible On Desktop'),
                                        'subtitle'=> esc_html__('Disable to hide this section on desktop device(from 960px to 1199px)'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'      => 'xl_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visible On Large Screen'),
                                        'subtitle'=> esc_html__('Disable to hide this section on large screen device(from 1200px to 1599px)'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'      => 'xxl_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visible On Extra Large Screen'),
                                        'subtitle'=> esc_html__('Disable to hide this section on large screen device(1600px and large)'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'     => 'tab-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ), // End design settings
                        ), // End tab field
                    ),
                ),
            );
        }

        protected function column_width_options(){
            return array(
                esc_html__('Fraction width', 'templaza-framework') => array(
                    '1-1'      => esc_html__('1/1', 'templaza-framework'), // 12
                    '1-2'       => esc_html__('1/2', 'templaza-framework'), // 6
                    '1-3'       => esc_html__('1/3', 'templaza-framework'),  // 4
                    '2-3'       => esc_html__('2/3', 'templaza-framework'), // 8
                    '1-4'       => esc_html__('1/4', 'templaza-framework'), // 3
                    '3-4'       => esc_html__('3/4', 'templaza-framework'), // 9
                    '1-5'      => esc_html__('1/5', 'templaza-framework'), // 2
                    '2-5'       => esc_html__('2/5', 'templaza-framework'), // 5
                    '3-5'       => esc_html__('3/5', 'templaza-framework'), // 7
                    '4-5'       => esc_html__('4/5', 'templaza-framework'), // 10
                    '1-6'      => esc_html__('1/6', 'templaza-framework'), // 1
                    '5-6'       => esc_html__('5/6', 'templaza-framework'), // 11
                ),
                                                esc_html__('Fixed width', 'templaza-framework') => array(
                    'expand'  => esc_html__('Expand', 'templaza-framework'),
                    'auto'    => esc_html__('Auto', 'templaza-framework'),
                    'small'   => esc_html__('Small', 'templaza-framework'),
                    'medium'  => esc_html__('Medium', 'templaza-framework'),
                    'large'   => esc_html__('Large', 'templaza-framework'),
                    'xlarge'  => esc_html__('XLarge', 'templaza-framework'),
                    '2xlarge' => esc_html__('2XLarge', 'templaza-framework'),
                )
            );
        }

        protected function convert_column_to_UIkit($column){
            $col_real   = $column;
            $modulo = 12 % $column;
            switch($column){
//                case 1:
//                    $col_real   = '1-12';
//                    break;
                case 2:
                case 3:
                case 4:
                case 6:
                case 8:
                case 9:
                case 10:
                    if($modulo == 0){
                        $col_real   = '1-'.(12 / $column);
                    }else{
                        $col_real   = ($column/$modulo).'-'.(12/$modulo);
                    }
                    break;
                case 5:
                    $col_real   = '1-5';
                    break;
                case 7:
                    $col_real   = '4-5';
                    break;
//                case 11:
//                    $col_real   = '11-12';
//                    break;
                case 12:
                    $col_real   = '1-1';
                    break;
            }
            return $col_real;
        }

        public function prepare_params($params, $element,$parent_el){
            $params = parent::prepare_params($params, $element,$parent_el);

            $size       = (isset($element['size']) && !empty($element['size']))?$element['size']:'';
            $xs_size    = (isset($params['xs_size']) && !empty($params['xs_size']))?$params['xs_size']:'1-1';
            $sm_size    = (isset($params['sm_size']) && !empty($params['sm_size']))?$params['sm_size']:'';
            $md_size    = (isset($params['md_size']) && !empty($params['md_size']))?$params['md_size']:'';
//            $lg_size    = (isset($params['lg_size']) && !empty($params['lg_size']))?$params['lg_size']:'';
            $xl_size    = (isset($params['xl_size']) && !empty($params['xl_size']))?$params['xl_size']:'';

            if(!empty($size)){
                if(isset($params['tz_class'])) {
                    $size    = (strpos($size, '-') === false && is_numeric($size))?$this -> convert_column_to_UIkit($size):$size;
                    $params['tz_class'] .= ' uk-width-'.$size.'@l';
                }else{
                    $params['tz_class'] = ' uk-width-'.$size.'@l';
                }
                $params['tz_class'] = trim($params['tz_class']);
            }

//            if(isset($params['xs_size']) && !empty($params['xs_colum_size'])){
//                $params['tz_class'] .= ' col-xs-'.$params['xs_colum_size'];
//            }
            if(!empty($xs_size)){
                $xs_size    = (strpos($xs_size, '-') === false && is_numeric($size))?$this -> convert_column_to_UIkit($xs_size):$xs_size;
                $params['tz_class'] .= ' uk-width-'.$xs_size;
            }
            if(!empty($sm_size)){
                $sm_size    = (strpos($sm_size, '-') === false && is_numeric($size))?$this -> convert_column_to_UIkit($sm_size):$sm_size;
                $params['tz_class'] .= ' uk-width-'.$sm_size.'@s';
            }
            if(!empty($md_size)){
                $md_size    = (strpos($md_size, '-') === false && is_numeric($size))?$this -> convert_column_to_UIkit($md_size):$md_size;
                $params['tz_class'] .= ' uk-width-'.$md_size.'@m';
            }
//            if(!empty($lg_size)){
//                $lg_size    = (strpos($lg_size, '-') === false)?$this -> convert_column_to_UIkit($lg_size):$lg_size;
//                $params['tz_class'] .= ' uk-width-'.$lg_size.'@l';
////                $params['tz_class'] .= ' col-xl-'.$params['xl_size'];
//            }
            if(!empty($xl_size)){
                $xl_size    = (strpos($xl_size, '-') === false && is_numeric($size))?$this -> convert_column_to_UIkit($xl_size):$xl_size;
                $params['tz_class'] .= ' uk-width-'.$xl_size.'@xl';
            }


//            if(isset($params['xxl_visibility']) && $params['xxl_visibility'] == ''){
//                $params['xxl_visibility']   = 1;
//            }
            if(isset($params['xl_visibility']) && $params['xl_visibility'] == ''){
                $params['xl_visibility']   = 1;
            }
            if(isset($params['lg_visibility']) && $params['lg_visibility'] == ''){
                $params['lg_visibility']   = 1;
            }
            if(isset($params['md_visibility']) && $params['md_visibility'] == ''){
                $params['md_visibility']   = 1;
            }
            if(isset($params['sm_visibility']) && $params['sm_visibility'] == ''){
                $params['sm_visibility']   = 1;
            }
            if(isset($params['xs_visibility']) && $params['xs_visibility'] == ''){
                $params['xs_visibility']   = 1;
            }

            if(isset($params['xxl_visibility']) && (!(bool) $params['xxl_visibility'])){
                $params['tz_class'] .= ' hideonxxl';
            }
            if(isset($params['xl_visibility']) && (!(bool) $params['xl_visibility'])){
//                $params['tz_class'] .= ' uk-visible@xl';
                $params['tz_class'] .= ' hideonxl';
            }
            if(isset($params['lg_visibility']) && (!(bool) $params['lg_visibility'])){
//                $params['tz_class'] .= ' uk-visible@l';
                $params['tz_class'] .= ' hideonlg';
            }
            if(isset($params['md_visibility']) && (!(bool) $params['md_visibility'])){
//                $params['tz_class'] .= ' uk-visible@m';
                $params['tz_class'] .= ' hideonmd';
            }
            if(isset($params['sm_visibility']) && (!(bool) $params['sm_visibility'])){
//                $params['tz_class'] .= ' uk-hidden@s';
                $params['tz_class'] .= ' hideonsm';
            }
//            if(isset($params['xs_visibility']) && (!(bool) $params['xs_visibility'])){
//                $params['tz_class'] .= ' hideonxs';
//            }

            return $params;
        }

        public function custom_css(&$params, &$element){
            $css    = parent::custom_css($params, $element);

            if(isset($params['text_color']) && !empty($params['text_color'])){
                $css['desktop'] .= 'color: '.$params['text_color'].';';
            }

            if(isset($params['border']) && !empty($params['border'])){
                $css['desktop'] .= CSS::border_redux($params['border']);
            }

            return $css;
        }

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-column-js')) {
                wp_enqueue_script(
                    'templaza-shortcode-column-js',
                    Functions::get_my_url() . '/shortcodes/'.$this -> get_shortcode_name()
                    .'/'.$this -> get_shortcode_name().'.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }
    }

}

?>