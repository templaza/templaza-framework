<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_UIImage')){
	class TemplazaFramework_ShortCode_UIImage extends TemplazaFramework_ShortCode {

		public function register(){
			return array(
				'id'          => 'uiimage',
				'icon'        => 'fas fa-image',
				'title'       => __('UI Image', $this -> text_domain),
				'param_title' => esc_html__('UI Image Settings', $this -> text_domain),
				'desc'        => __('Insert an Image or SVG', $this -> text_domain),
				'admin_label' => true,
				'params'      => array(
					array(
						'id'       => 'image',
						'type'     => 'media',
						'url'      => true,
						'title'    => __( 'Select Image', $this -> text_domain ),
						'compiler' => 'true',
						'desc'     => __( 'Basic media uploader with disabled URL input field.', $this -> text_domain ),
						'subtitle' => __( 'Select an image', $this -> text_domain )
					),
				)
			);
		}
	}

}

?>