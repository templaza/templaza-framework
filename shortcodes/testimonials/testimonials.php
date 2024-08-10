<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Testimonials')){
    class TemplazaFramework_ShortCode_Testimonials extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'testimonials',
                'icon'        => 'fas fa-bars',
                'title'       => esc_html__('Testimonials', 'templaza-framework'),
                'param_title' => esc_html__('Testimonials Settings', 'templaza-framework'),
                'desc'        => esc_html__('Insert an Testimonials', 'templaza-framework'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'        => 'testimonials_wrap_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Testimonials Style', 'templaza-framework'),
                        'options'   => array(
                            'default'       => esc_html__('Default', 'templaza-framework'),
                            'inline'        => esc_html__('Inline', 'templaza-framework'),
                        )
                    ),

                    array(
                        'id'       => 'testimonials_items',
                        'type'     => 'tz_repeater',
                        'title' => esc_html__('Items', 'templaza-framework'),
                        'fields' => array(
                            array(
                                'id'       => 'item_title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Item Title', 'templaza-framework' ),
                                'subtitle' => esc_html__( 'What text use as a nav title.', 'templaza-framework' ),
                            ),
                            array(
                                'id'        => 'item_icon',
                                'type'      => 'select',
                                'title'     => esc_html__('Icon', 'templaza-framework'),
                                'subtitle'  => esc_html__('Place scalable vector icons anywhere in your content. See live preview here https://getuikit.com/docs/icon', 'templaza-framework'),
                                'options'   => $this->get_font_uikit()
                            ),
                            array(
                                'id'        => 'item_target',
                                'type'      => 'select',
                                'title'     => esc_html__('Link Open', 'templaza-framework'),
                                'options'   => array(
                                    ''              => esc_html__('Self', 'templaza-framework'),
                                    '_blank'        => esc_html__('New Window', 'templaza-framework'),
                                )
                            ),
                        ),
                    ),
                )
            );
        }
    }

}

?>