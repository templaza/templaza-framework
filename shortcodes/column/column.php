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
                                'title'  => esc_html__('General Settings', $this -> text_domain),
                                'fields' => array(
//                                    array(
//                                        'id'       => 'customclass',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Custom Class', $this -> text_domain),
//                                        'subtitle' => esc_html__('Custom Class can be used for writing custom CSS or JS.', $this -> text_domain),
//                                        'default'  => 'test',
//                                    ),
//                                    array(
//                                        'id'       => 'customid',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Custom ID', $this -> text_domain),
//                                        'subtitle' => esc_html__('Custom ID can be used for overriding the auto-generated id.', $this -> text_domain),
//                                        'default'  => time(),
//                                    ),
                                ),
                            ), // End general settings

                            // Design settings
                            array(
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
                            ), // End design settings

                            // Responsive settings
                            array(
                                'id'     => 'responsive-settings',
                                'title'  => esc_html__('Responsive Settings', $this -> text_domain),
                                'fields' => array(

                                    array(
                                        'id'      => 'xs_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Phone Portrait', $this -> text_domain),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', $this -> text_domain),
                                        'options' => $this -> column_width_options(),
                                        'default' => '1-1'
                                    ),
                                    array(
                                        'id'      => 'sm_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Phone Landscape', $this -> text_domain),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', $this -> text_domain),
                                        'options' => $this -> column_width_options()
                                    ),
                                    array(
                                        'id'      => 'md_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Tablet Landscape', $this -> text_domain),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', $this -> text_domain),
                                        'options' => $this -> column_width_options()
                                    ),
                                    array(
                                        'id'      => 'lg_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Desktop (Default Device)', $this -> text_domain),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', $this -> text_domain),
                                        'options' => $this -> column_width_options()
                                    ),
                                    array(
                                        'id'      => 'xl_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Large Screen', $this -> text_domain),
                                        'subtitle'   => __('Set the column width for each breakpoint. Mix fraction widths or combine fixed widths with the <i>Expand</i> value. If no value is selected, the column width of the next smaller screen size is applied. The combination of widths should always take the full width.', $this -> text_domain),
                                        'options' => $this -> column_width_options()
                                    ),
                                    array(
                                        'id'     => 'tab-visibility-options',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Visibility Options', $this -> text_domain),
//                                        'subtitle'   => esc_html__('<576px', $this -> text_domain),
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
                                        'title'   => esc_html__('Visible On Phone Landscape', $this -> text_domain),
                                        'subtitle'=> esc_html__('Disable to hide this section on phone landscape device'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'      => 'md_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visible On Tablet Landscape'),
                                        'subtitle'=> esc_html__('Disable to hide this section on tablet landscape device'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'      => 'lg_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visible On Desktop'),
                                        'subtitle'=> esc_html__('Disable to hide this section on desktop device'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'      => 'xl_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visible On Large Screen'),
                                        'subtitle'=> esc_html__('Disable to hide this section on large screen device'),
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
                esc_html__('Fraction width', $this -> text_domain) => array(
                    '1-1'      => esc_html__('1/1', $this -> text_domain), // 12
                    '1-2'       => esc_html__('1/2', $this -> text_domain), // 6
                    '1-3'       => esc_html__('1/3', $this -> text_domain),  // 4
                    '2-3'       => esc_html__('2/3', $this -> text_domain), // 8
                    '1-4'       => esc_html__('1/4', $this -> text_domain), // 3
                    '3-4'       => esc_html__('3/4', $this -> text_domain), // 9
                    '1-5'      => esc_html__('1/5', $this -> text_domain), // 2
                    '2-5'       => esc_html__('2/5', $this -> text_domain), // 5
                    '3-5'       => esc_html__('3/5', $this -> text_domain), // 7
                    '4-5'       => esc_html__('4/5', $this -> text_domain), // 10
                    '1-6'      => esc_html__('1/6', $this -> text_domain), // 1
                    '5-6'       => esc_html__('5/6', $this -> text_domain), // 11
                ),
                                                esc_html__('Fixed width', $this -> text_domain) => array(
                    'expand'  => esc_html__('Expand', $this -> text_domain),
                    'auto'    => esc_html__('Auto', $this -> text_domain),
                    'small'   => esc_html__('Small', $this -> text_domain),
                    'medium'  => esc_html__('Medium', $this -> text_domain),
                    'large'   => esc_html__('Large', $this -> text_domain),
                    'xlarge'  => esc_html__('XLarge', $this -> text_domain),
                    '2xlarge' => esc_html__('2XLarge', $this -> text_domain),
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

//            if(isset($params['xxl_visibility']) && (!(bool) $params['xxl_visibility'])){
//                $params['tz_class'] .= ' hideonxxl';
//            }
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