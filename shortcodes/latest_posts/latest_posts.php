<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Latest_Posts')){
	class TemplazaFramework_ShortCode_Latest_Posts extends TemplazaFramework_ShortCode {

		public function register(){
			return array(
				'id'          => 'latest_posts',
				'icon'        => 'fas fa-image',
				'title'       => esc_html__('Latest Post', 'templaza-framework'),
				'param_title' => esc_html__('Latest Post Settings', 'templaza-framework'),
				'desc'        => esc_html__('Get Post or Custom Post Type', 'templaza-framework'),
				'admin_label' => true,
				'params'      => array(
                    array(
                        'id'    => 'latest_post_type',
                        'type'  => 'select',
                        'title' => esc_html__( 'Select Post Type', 'templaza-framework' ),
                        'data'  => 'post_types',
                        'args'  => array(
                            'public'      => true,
                        )
                    ),
                    array(
                        'id'       => 'latest_post_order_by',
                        'type'     => 'select',
                        'title'    => esc_html__('Order By', 'templaza-framework'),
                        'options'  => array(
                            'date' => esc_html__('Date', 'templaza-framework'),
                            'ID' => esc_html__('ID', 'templaza-framework'),
                            'title' => esc_html__('Title', 'templaza-framework'),
                            'author' => esc_html__('Author', 'templaza-framework'),
                            'rand' => esc_html__('Random', 'templaza-framework'),
                        ),
                        'default'  => 'date',
                    ),
                    array(
                        'id'       => 'latest_post_order',
                        'type'     => 'select',
                        'title'    => esc_html__('Order', 'templaza-framework'),
                        'options'  => array(
                            'ASC' => esc_html__('Ascending(ASC)', 'templaza-framework'),
                            'DESC' => esc_html__('Descending(DESC)', 'templaza-framework'),
                        ),
                        'default'  => 'DESC',
                    ),
                    array(
                        'id'       => 'latest_post_number',
                        'type'     => 'text',
                        'title'    => esc_html__('Number Posts', 'templaza-framework'),
                        'default'  => '6',
                    ),
                    array(
                        'id'       => 'latest_post_image_cover',
                        'type'     => 'switch',
                        'title'    => esc_html__('Thumbnail Cover)', 'templaza-framework'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'latest_post_image_cover_height',
                        'type'     => 'text',
                        'title'    => esc_html__('Thumbnail Cover height)', 'templaza-framework'),
                        'default'  => '300',
                        'required' => array('latest_post_image_cover', '=' , true)
                    ),

                    array(
                        'id'       => 'latest_post_show_date',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show created date)', 'templaza-framework'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'latest_post_show_author',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show author)', 'templaza-framework'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'latest_post_slider_item',
                        'type'     => 'number',
                        'title'    => esc_html__('Slider number', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'latest_post_slider_item',
                        'type'     => 'select',
                        'title'    => esc_html__('Slider item', 'templaza-framework'),
                        'options'  => array(
                            '1' => esc_html__('1', 'templaza-framework'),
                            '2' => esc_html__('2', 'templaza-framework'),
                            '3' => esc_html__('3', 'templaza-framework'),
                            '4' => esc_html__('4', 'templaza-framework'),
                            '5' => esc_html__('5', 'templaza-framework'),
                            '6' => esc_html__('6', 'templaza-framework'),
                        ),
                        'default'  => '3',
                    ),
                    array(
                        'id'       => 'latest_post_show_nav',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show nav (next, preview button)', 'templaza-framework'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'latest_post_show_dot',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show dots', 'templaza-framework'),
                        'default'  => false,
                    )
				)
			);
		}
	}

}

?>