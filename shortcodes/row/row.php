<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Row')){
    class TemplazaFramework_ShortCode_Row extends TemplazaFramework_ShortCode {
        protected $element;

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
                'id'          => 'row',
                'title'       => __('Row'),
                'icon'        => 'el el-align-left',
                'param_title' => esc_html__('Row Settings'),
                'desc'        => __('Load a row'),
                'core'        => true,
                'params'      => array(
                    array(
                        'id' => 'tabs',
                        'type'  => 'tz_tab',
                        'title' => '',
                        'tabs' => array(
                            // General settings
                            array(
                                'id' => 'settings',
                                'title'  => esc_html__('General Settings', 'templaza-framework'),
                                'fields' => array(
                                    array(
                                        'id'        => 'column_gap',
                                        'type'      => 'select',
                                        'title'     =>  esc_html__('Column Gap', 'templaza-framework'),
                                        'subtitle'  => esc_html__('Set the size of the gap between the grid columns.', 'templaza-framework'),
                                        'options'   => array(
                                            'default'   => esc_html__('Default', 'templaza-framework'),
                                            'small'     => esc_html__('Small', 'templaza-framework'),
                                            'medium'    => esc_html__('Medium', 'templaza-framework'),
                                            'large'     => esc_html__('Large', 'templaza-framework'),
                                            'collapse'  => esc_html__('None', 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default'       => 'default',
                                    ),
                                    array(
                                        'id'        => 'row_gap',
                                        'type'      => 'select',
                                        'title'     =>  esc_html__('Row Gap', 'templaza-framework'),
                                        'subtitle'  => esc_html__('Set the size of the gap between the grid rows.', 'templaza-framework'),
                                        'options'   => array(
                                            'default'   => esc_html__('Default', 'templaza-framework'),
                                            'small'     => esc_html__('Small', 'templaza-framework'),
                                            'medium'    => esc_html__('Medium', 'templaza-framework'),
                                            'large'     => esc_html__('Large', 'templaza-framework'),
                                            'collapse'  => esc_html__('None', 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default'       => 'default',
                                    ),
                                    array(
                                        'id'        => 'divider',
                                        'type'      => 'switch',
                                        'title'     =>  esc_html__('Divider', 'templaza-framework'),
                                        'subtitle'  => esc_html__('Show a divider between grid columns.', 'templaza-framework'),
                                        'required'  => array(
                                            array('column_gap', '=', array('default','small','medium','large')), /* column_gap is not equal 'collapse' */
                                            array('row_gap', '=', array('default','small','medium','large')), /* row_gap is not equal 'collapse' */
                                        ),
                                    ),
                                    array(
                                        'id'        => 'width',
                                        'type'      => 'select',
                                        'title'     =>  esc_html__('Max Width', 'templaza-framework'),
                                        'options' => array(
                                            'default'   => esc_html__('Default', 'templaza-framework'),
                                            'xsmall'    => esc_html__('XSmall', 'templaza-framework'),
                                            'small'     => esc_html__('Small', 'templaza-framework'),
                                            'large'     => esc_html__('Large', 'templaza-framework'),
                                            'xlarge'    => esc_html__('XLarge', 'templaza-framework'),
                                            'expand'    => esc_html__('Expand', 'templaza-framework'),
                                            'none'      => esc_html__('None', 'templaza-framework'),
                                        ),
                                        'select2'       => array( 'allowClear' => false ),
                                        'default'       => 'none',
                                    ),
                                    array(
                                        'id'       => 'padding_remove_horizontal',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Remove horizontal padding', 'templaza-framework'),
                                        'subtitle' => __('Set the maximum content width. Note: The section may already have a maximum width, which you cannot exceed.', 'templaza-framework'),
                                        'required' => array('width', '=', array('default', 'xsmall', 'small', 'large', 'xlarge')),
                                    ),
                                    array(
                                        'id'       => 'width_expand',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Expand One Side', 'templaza-framework'),
                                        'subtitle' => __('Expand the width of one side to the left or right while the other side keeps within the constraints of the max width.', 'templaza-framework'),
                                        'options'  => array(
                                            'no_expand' => esc_html__("Don't expand", 'templaza-framework'),
                                            'left'      => esc_html__("To left", 'templaza-framework'),
                                            'right'     => esc_html__("To right", 'templaza-framework'),
                                        ),
                                        'default'       => 'no_expand',
                                        'select2'       => array( 'allowClear' => false ),
                                        'required' => array('width', '=', array('default', 'xsmall', 'small', 'large', 'xlarge')),
                                    ),
                                    array(
                                        'id'       => 'height',
                                        'type'     => 'select',
                                        'title'    => esc_html__('Height', 'templaza-framework'),
                                        'subtitle' => __('Enabling viewport height on a row that directly follows the header will subtract the header height from it.', 'templaza-framework'),
                                        'options'  => array(
                                            'none'    => esc_html__("None", 'templaza-framework'),
                                            'full'    => esc_html__("Viewport", 'templaza-framework'),
                                            'percent' => esc_html__("Viewport (Minus 20%)", 'templaza-framework'),
                                        ),
                                        'default'       => 'none',
                                        'select2'       => array( 'allowClear' => false ),
                                    ),
                                    array(
                                        'id'       => 'match_height',
                                        'type'     => 'switch',
                                        'title'    => esc_html__('Match Height', 'templaza-framework'),
                                        'subtitle' => __('Match the height of all panel elements which are styled as a card.', 'templaza-framework'),
                                    ),
                                    array(
                                        'id'       => 'match_height_selector',
                                        'type'     => 'text',
                                        'title'    => esc_html__('Match Height Selector', 'templaza-framework'),
                                        'default'  => '>.templaza-column>*',
                                        'required' => array('match_height', '=', '1'),
                                    ),
                                ),
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
            $params = parent::prepare_params($params, $element,$parent_el);

            if(!isset($params['tz_class'])){
                $params['tz_class'] = '';
            }

            $width          = (isset($params['width']) && !empty($params['width']))?$params['width']:'none';
            $row_gap        = (isset($params['row_gap']) && !empty($params['row_gap']))?$params['row_gap']:'default';
            $column_gap     = (isset($params['column_gap']) && !empty($params['column_gap']))?$params['column_gap']:'default';
            $width_expand   = (isset($params['width_expand']) && !empty($params['width_expand']))?$params['width_expand']:'no_expand';

            $pad_rm_h   = isset($params['padding_remove_horizontal'])?filter_var($params['padding_remove_horizontal'], FILTER_VALIDATE_BOOLEAN):false;
            $grid_gap   = '';

//            if($column_gap == $row_gap && $column_gap != 'default'){
//                $grid_gap .= ' uk-grid-'.$column_gap;
//            }else{
//                if($column_gap != 'default'){
//                    $grid_gap .= ' uk-grid-column-'.$params['column_gap'];
//                }
//                if($row_gap != 'default'){
//                    $grid_gap .= ' uk-grid-row-'.$params['row_gap'];
//                }
//            }

            $_tz_outer_class    = '';

            if(!empty($width) && $width != 'none'){
                $_tz_outer_class       = $params['tz_class'];
                $_tz_outer_class       .= ' uk-container';
                $_tz_outer_class       .= ($width != 'default')?' uk-container-'.$width:'';
                $params['tz_class']     = '';

                if(in_array($row_gap, array('small','medium','large'))){
                    $_tz_outer_class .= ' uk-grid-margin-' . $params['row_gap'];
                }elseif($row_gap == 'default'){
                    $_tz_outer_class .= ' uk-grid-margin';
                }

                $_tz_outer_class    .= (!empty($width_expand) && $width_expand != 'no_expand')?' uk-container-expand-'.$width_expand:'';

            }

            if($width != 'expand' && $width != 'none' && $pad_rm_h){
                $_tz_outer_class    .= ' uk-padding-remove-horizontal';
            }


            $params['_tz_outer_class']  = $_tz_outer_class;

            if($column_gap == $row_gap && $column_gap != 'default'){
                $params['tz_class'] .= ' uk-grid-'.$column_gap;
            }else{
                if($column_gap != 'default'){
                    $params['tz_class'] .= ' uk-grid-column-'.$params['column_gap'];
                }
                if($row_gap != 'default'){
                    $params['tz_class'] .= ' uk-grid-row-'.$params['row_gap'];
                }
            }

            if(isset($params['divider']) &&
                (isset($params['column_gap']) && !empty($params['column_gap']) && $params['column_gap'] != 'collapse') &&
                (isset($params['row_gap']) && !empty($params['row_gap']) && $params['row_gap'] != 'collapse')){
                $divider    = isset($params['divider'])?filter_var($params['divider'], FILTER_VALIDATE_BOOLEAN):false;
                if($divider) {
                    $params['tz_class'] .= ' uk-grid-divider';
                }
            }

            if($parent_el && isset($parent_el['params'])){
                $_parent_params = $parent_el['params'];
                if(isset($_parent_params['layout_type']) && in_array($_parent_params['layout_type'],
                        array( 'no-container', 'container-with-no-gutters', 'container-fluid-with-no-gutters'))) {
                    $params['tz_class'] .= ' uk-grid-collapse';
//                    $params['tz_class'] .= ' gx-0';
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

    }

}

?>