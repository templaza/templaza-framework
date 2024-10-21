<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\CSS;

if(!class_exists('TemplazaFramework_ShortCode_UIImage')){
	class TemplazaFramework_ShortCode_UIImage extends TemplazaFramework_ShortCode {

		public function register(){
			return array(
				'id'          => 'uiimage',
				'icon'        => 'fas fa-image',
				'title'       => __('UI Image', 'templaza-framework'),
				'param_title' => esc_html__('UI Image Settings', 'templaza-framework'),
				'desc'        => __('Insert an Image or SVG', 'templaza-framework'),
				'admin_label' => true,
				'params'      => array(
					array(
						'id'       => 'image',
						'type'     => 'media',
						'url'      => true,
						'title'    => __( 'Select Image', 'templaza-framework' ),
						'compiler' => 'true',
						'desc'     => __( 'Basic media uploader with disabled URL input field.', 'templaza-framework' ),
						'subtitle' => __( 'Select an image', 'templaza-framework' )
					),
                    array(
                        'id'       => 'image_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Image Url', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'image_radius',
                        'type'     => 'spacing',
                        'mode'     => 'border-radius',
                        'allow_responsive'    => true,
                        'units'  => array('px', '%' ),
                        'title'    => __('Image Border Radius', 'templaza-framework'),
                        'default'  => '',
                    ),
                    array(
                        'id'       => 'image_custom_height',
                        'type'     => 'switch',
                        'title'    => __( 'Image Custom Height', 'templaza-framework' ),
                        'default'  => true,
                    ),

                    array(
                        'id'       => 'image_height',
                        'type'     => 'spinner',
                        'title'    => __('Image Custom Height', 'templaza-framework'),
                        'default'  => '300',
                        'min'      => '0',
                        'step'     => '1',
                        'max'      => '1000',
                        'required' => array('image_custom_height', '=' , true)
                    ),
                    array(
                        'id'       => 'image_transition',
                        'type'     => 'select',
                        'title'    => esc_html__('Select Option', 'templaza-framework'),
                        'options'  => array(
                            '' => __('None', 'templaza-framework'),
                            'uk-transition-scale-up' => __('Scales Up', 'templaza-framework'),
                            'uk-transition-scale-down' => __('Scales Down', 'templaza-framework'),
                            'ripple' => __('Ripple', 'templaza-framework'),
                        ),
                        'default'  => '',
                    ),

				)
			);
		}

        public function prepare_params($params, $element, $parent_el){
            $css = Templates::$_devices;

            $params = parent::prepare_params($params, $element, $parent_el);
            $image_styles = [];
            $custom_css_name    = 'tz_custom_'.$element['id'];
            if (isset($params['image_custom_height'])) {
                if (!empty($params['image_height'])) {
                    $image_styles[] = '.'. $custom_css_name . ' .tz-image-el{ height: ' . $params['image_height'] . 'px !important;}';
                }
            }

            Templates::add_inline_style(implode('', $image_styles));


            if(isset($params['image_radius']) && !empty($params['image_radius'])){

                $radius    = CSS::make_spacing_redux('border-radius', $params['image_radius'], true, 'px');

                if(!empty($radius)){
                    if(is_array($radius)){
                        foreach($css as $device => $pcss){
                            if(!empty($radius[$device])) {
                                $style =  '.' . $custom_css_name . ' .tz-image-el{' . $radius[$device] . '}';
                                Templates::add_inline_style($style, $device);
                            }
                        }
                    }
                    else{
                        Templates::add_inline_style('.' . $custom_css_name . ' .tz-image-el{' . $radius . '}');
                    }
                }
            }

            return $params;
        }
	}

}

?>