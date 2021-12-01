<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Latest_Posts')){
	class TemplazaFramework_ShortCode_Latest_Posts extends TemplazaFramework_ShortCode {

		public function register(){
			return array(
				'id'          => 'latest_posts',
				'icon'        => 'fas fa-image',
				'title'       => esc_html__('Latest Post', $this -> text_domain),
				'param_title' => esc_html__('Latest Post Settings', $this -> text_domain),
				'desc'        => esc_html__('Get Post or Custom Post Type', $this -> text_domain),
				'admin_label' => true,
				'params'      => array(
                    array(
                        'id'    => 'latest_post_type',
                        'type'  => 'select',
                        'title' => esc_html__( 'Select Post Type', $this -> text_domain ),
                        'data'  => 'post_types',
                        'args'  => array(
                            'public'      => true,
                        )
                    ),
                    array(
                        'id'       => 'latest_post_order_by',
                        'type'     => 'select',
                        'title'    => esc_html__('Order By', $this -> text_domain),
                        'options'  => array(
                            'date' => esc_html__('Date', $this -> text_domain),
                            'ID' => esc_html__('ID', $this -> text_domain),
                            'title' => esc_html__('Title', $this -> text_domain),
                            'author' => esc_html__('Author', $this -> text_domain),
                            'rand' => esc_html__('Random', $this -> text_domain),
                        ),
                        'default'  => 'date',
                    ),
                    array(
                        'id'       => 'latest_post_order',
                        'type'     => 'select',
                        'title'    => esc_html__('Order', $this -> text_domain),
                        'options'  => array(
                            'ASC' => esc_html__('Ascending(ASC)', $this -> text_domain),
                            'DESC' => esc_html__('Descending(DESC)', $this -> text_domain),
                        ),
                        'default'  => 'DESC',
                    ),
                    array(
                        'id'       => 'latest_post_number',
                        'type'     => 'text',
                        'title'    => esc_html__('Number Posts', $this -> text_domain),
                        'default'  => '6',
                    ),
                    array(
                        'id'       => 'latest_post_image_cover',
                        'type'     => 'switch',
                        'title'    => esc_html__('Thumbnail Cover)', $this -> text_domain),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'latest_post_image_cover_height',
                        'type'     => 'text',
                        'title'    => esc_html__('Thumbnail Cover height)', $this -> text_domain),
                        'default'  => '300',
                        'required' => array('latest_post_image_cover', '=' , true)
                    ),

                    array(
                        'id'       => 'latest_post_show_date',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show created date)', $this -> text_domain),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'latest_post_show_author',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show author)', $this -> text_domain),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'latest_post_show_nav',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show nav (next, preview button)', $this -> text_domain),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'latest_post_show_dot',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show dots', $this -> text_domain),
                        'default'  => false,
                    )
				)
			);
		}
	}

}

?>