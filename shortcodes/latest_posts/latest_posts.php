<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Shortcode\Helper\Latest_PostsHelper;

require_once __DIR__.'/helper.php';

if(!class_exists('TemplazaFramework_ShortCode_Latest_Posts')){
	class TemplazaFramework_ShortCode_Latest_Posts extends TemplazaFramework_ShortCode {

//	    public function __construct($field_parent = array(), $value = '', $parent = '')
//        {
////            $this -> hooks();
//            parent::__construct($field_parent, $value, $parent);
//        }
//
//        public function hooks(){
//	        var_dump(__METHOD__);
//	        add_action('templaza-framework/shortcode/'.$this -> get_shortcode_name().'/ajax/get_categories', array($this, 'ajax_get_categories'));
//        }
//
//        public function ajax_get_categories(){
//	        $post_type  = isset($_REQUEST['post_type'])?$_REQUEST['post_type']:'';
//
//	        var_dump($post_type); die(__METHOD__);
//        }

        public function register(){

            $fields     = array(
                array(
                    'id'    => 'latest_post_type',
                    'type'  => 'select',
                    'title' => esc_html__( 'Select Post Type', 'templaza-framework' ),
                    'data'  => 'post_types',
                    'args'  => array(
                        'public'      => true,
                    )
                ),
            );

            $cats_sync  = Latest_PostsHelper::get_categories();

            if(!empty($cats_sync)){
                foreach ($cats_sync as $post_type => $cat_option){
                    $fields[]   = array(
                        'id'            => $post_type.'_category',
                        'type'          => 'select',
                        'title'         => esc_html__('Select Category', 'templaza-framework'),
                        'multi'         => true,
                        'name_bracket'  => false,
                        'options'       => $cat_option,
                        'required'      => array('latest_post_type', '=' , $post_type),
                    );
                }
            }

            $fields     = array_merge($fields, array(
                array(
                    'id'       => 'show_featured',
                    'type'     => 'select',
                    'title'    => esc_html__('Show Featured', 'templaza-framework'),
                    'options'  => array(
                        ''     => esc_html__('Show', 'templaza-framework'),
                        0      => esc_html__('Hide', 'templaza-framework'),
                        1      => esc_html__('Featured Only', 'templaza-framework'),
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
                    'title'    => esc_html__('Thumbnail Cover', 'templaza-framework'),
                    'default'  => false,
                ),
                array(
                    'id'       => 'latest_post_image_cover_height',
                    'type'     => 'text',
                    'title'    => esc_html__('Thumbnail Cover height', 'templaza-framework'),
                    'default'  => '300',
                    'required' => array('latest_post_image_cover', '=' , true)
                ),
                array(
                    'id'       => 'latest_post_image_transition',
                    'type'     => 'select',
                    'title'    => esc_html__('Thumb Transition', 'templaza-framework'),
                    'options'  => array(
                        '' => esc_html__('None', 'templaza-framework'),
                        'uk-transition-scale-up' => esc_html__('Scale Up', 'templaza-framework'),
                        'uk-transition-scale-down' => esc_html__('Scale Down', 'templaza-framework'),
                        'ripple' => esc_html__('Ripple', 'templaza-framework'),
                    ),
                    'default'  => '3',
                ),

                array(
                    'id'       => 'latest_post_show_date',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show created date', 'templaza-framework'),
                    'default'  => true,
                ),
                array(
                    'id'       => 'latest_post_show_author',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show author', 'templaza-framework'),
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
            ));

			return array(
				'id'          => 'latest_posts',
				'icon'        => 'fas fa-image',
				'title'       => esc_html__('Latest Post', 'templaza-framework'),
				'param_title' => esc_html__('Latest Post Settings', 'templaza-framework'),
				'desc'        => esc_html__('Get Post or Custom Post Type', 'templaza-framework'),
				'admin_label' => true,
				'params'      => $fields
			);
		}

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-'.$this -> get_shortcode_name())) {
                wp_enqueue_script(
                    'templaza-shortcode-'.$this -> get_shortcode_name(),
                    Functions::get_my_url() . '/shortcodes/'.$this -> get_shortcode_name()
                    .'/'.$this -> get_shortcode_name().'.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );

                $latest_posts  = array();
                if (class_exists('TemPlazaFramework\Functions')) {
                    $options = Functions::get_global_settings();

                    if (isset($options['enable-featured-for-posttypes']) && !empty($options['enable-featured-for-posttypes'])) {
                        $latest_posts['enable_featured_for_posttypes'] = $options['enable-featured-for-posttypes'];
                    }
                }
                wp_localize_script('templaza-shortcode-'.$this -> get_shortcode_name(),
                    'templaza_shortcode__latest_posts', $latest_posts);
            }
        }
	}

}

?>