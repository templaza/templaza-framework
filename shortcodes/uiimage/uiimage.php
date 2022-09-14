<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

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
				)
			);
		}
	}

}

?>