<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Post_TypeFunctions;
use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_MetaBox_Post_Format')){
    class TemplazaFramework_MetaBox_Post_Format extends TemplazaFramework_MetaBox{
        // phpcs:disable WordPress.WP.AlternativeFunctions.strip_tags_strip_tags, WordPress.WP.AlternativeFunctions.json_encode_json_encode,  WordPress.Security.NonceVerification.Missing
        public function register(){
            // Get all post types without templaza_style
            $metaboxes[] = array(
                'id'            => 'templaza-post-format',
                'title'         => __( 'Post Format Data', 'templaza-framework' ),
                'post_types'    => array('post'),
                'position'      => 'side', // normal, advanced, side
                'priority'      => 'default', // high, core, default, low - Priorities of placement
                'store_each'    => true, // Store value of each fields to each post meta
//                'sections'      => array(
//                    array(
//                        'fields' => array(
//                            array(
//                                'id'        => 'gallery',
//                                'type'      => 'gallery',
//                                'title'     => esc_html__('Gallery', 'templaza-framework'),
//                            ),
//                            array(
//                                'id'        => 'oembed',
//                                'type'      => 'text',
//                                'title'     => esc_html__( 'Embed Code', 'templaza-framework' ),
//                                'validate'  => 'url',
//                            ),
//                        ),
//                    ),
//                ),
            );

            return $metaboxes;
        }

        public function add_meta_boxes($post_type)
        {
            parent::add_meta_boxes($post_type); // TODO: Change the autogenerated stub

            if (post_type_supports($post_type, 'post-formats') && current_theme_supports('post-formats')) {
                // assets
                wp_enqueue_script('templaza-post-formats-ui', Functions::get_my_url()
                    .'/metaboxes/post-format/assets/js/post-formats.js', array('jquery'), Functions::get_my_version(), false);
                wp_enqueue_style('templaza-post-formats-ui', Functions::get_my_url()
                    .'/metaboxes/post-format/assets/css/post-formats.css', array(), Functions::get_my_version(), 'screen');
                wp_localize_script(
                    'templaza-post-formats-ui',
                    'vp_pfui_post_format',
                    array(
                        'loading'      => __('Loading...', 'templaza-framework'),
                        'wpspin_light' => admin_url('images/wpspin_light.gif'),
                        'media_title'  => __('Pick Gallery Images', 'templaza-framework'),
                        'media_button' => __('Add Image(s)', 'templaza-framework')
                    )
                );

                global $wp_version;
                if( 5 > $wp_version ){
                    add_action('edit_form_after_title', array($this, 'vp_pfui_post_admin_setup'));
                } else {
                    add_action('block_editor_meta_box_hidden_fields', array($this, 'vp_pfui_post_admin_setup'));
                }
            }

            if ( post_type_supports( $post_type, 'post-formats' ) && current_theme_supports( 'post-formats' ) ) {
                wp_enqueue_script( 'templaza-post-formats-ui-admin',
                    Functions::get_my_url() . '/metaboxes/post-format/assets/js/admin.js',
                    array( 'templaza-post-formats-ui' ), Functions::get_my_version(), false );
            }
        }

        public function hooks()
        {
            parent::hooks(); // TODO: Change the autogenerated stub

//            add_filter("redux/options/{$this->prefix}templaza-options/wordpress_data/translate/post_type_value",
//                array($this, 'meta_box_basic_post_type_value'), 10, 2);


            add_action('admin_init', array($this, 'admin_init'));

            add_filter( 'admin_body_class', array( $this,'custom_admin_body_class' ) );
//            add_action('add_meta_boxes', array($this, 'vp_pfui_add_meta_boxes'));
            add_action('wp_ajax_vp_pfui_gallery_preview', array($this, 'vp_pfui_gallery_preview'));

            add_filter('pre_ping', array($this, 'vp_pfui_pre_ping_post_links'), 10, 3);

            add_filter('social_broadcast_format', array($this, 'vp_pfui_social_broadcast_format'), 10, 2);

            $post_type  = $this -> post_type -> get_post_type();

            if(post_type_exists($post_type) && $this -> post_type ->  get_current_screen_post_type() == $post_type){
//                // Add header column to post type list
//                if(method_exists($this,'post_type_table_head')) {
//                    add_filter('manage_'.$post_type.'_posts_columns', array($this, 'post_type_table_head'));
//                }
//                // Duplicate post action
//                add_action("templaza-framework/post-type/{$post_type}/duplicate", array($this, 'post_duplicate'), 11, 2);
////                // Set home for post type
////                add_action( 'admin_action_'.$post_type.'_set_default', array($this, 'post_type_set_default') );
            }

        }

        public function custom_admin_body_class( $classes ) {
			$classes .= ' templaza-gutenberg-vp-pfui';

			return $classes;
		}

        public function render($post, $metabox){
            $this -> vp_pfui_post_admin_setup();
        }

        public function vp_pfui_base_url() {
            return trailingslashit(apply_filters('vp_pfui_base_url', plugins_url('', __FILE__)));
        }

        public function admin_init(){
            $post_formats = get_theme_support('post-formats');
            if (!empty($post_formats[0]) && is_array($post_formats[0])) {
                if (in_array('link', $post_formats[0])) {
                    add_action('save_post', array($this, 'vp_pfui_format_link_save_post'));
                }
                if (in_array('status', $post_formats[0])) {
                    add_action('save_post', array($this, 'vp_pfui_format_status_save_post'), 10, 2);
                }
                if (in_array('quote', $post_formats[0])) {
                    add_action('save_post',  array($this,'vp_pfui_format_quote_save_post'), 10, 2);
                }
                if (in_array('video', $post_formats[0])) {
                    add_action('save_post',  array($this,'vp_pfui_format_video_save_post'));
                }
                if (in_array('audio', $post_formats[0])) {
                    add_action('save_post',  array($this,'vp_pfui_format_audio_save_post'));
                }
                if (in_array('video', $post_formats[0])) {
                    add_action('save_post',  array($this,'vp_pfui_format_gallery_save_post'));
                }
            }
        }

        public function vp_pfui_format_link_save_post($post_id) {
            if (!defined('XMLRPC_REQUEST') && isset($_POST['_format_link_url'])) {
                update_post_meta($post_id, '_format_link_url', $_POST['_format_link_url']);
            }
            if (!defined('XMLRPC_REQUEST') && isset($_POST['_format_link_title'])) {
                update_post_meta($post_id, '_format_link_title', $_POST['_format_link_title']);
            }
        }
        public function vp_pfui_format_status_save_post($post_id, $post) {
            if (has_post_format('status', $post)) {
                $this -> vp_pfui_format_auto_title_post($post_id, $post);
            }
        }

        public function vp_pfui_format_quote_save_post($post_id, $post) {
            if (!defined('XMLRPC_REQUEST')) {
                $keys = array(
                    '_format_quote_source_content',
                    '_format_quote_source_author',
                    '_format_quote_source_url',
                );
                foreach ($keys as $key) {
                    if (isset($_POST[$key])) {
                        update_post_meta($post_id, $key, $_POST[$key]);
                    }
                }
            }
            if (has_post_format('quote', $post)) {
                $this -> vp_pfui_format_auto_title_post($post_id, $post);
            }
        }

        public function vp_pfui_format_video_save_post($post_id) {
            if (!defined('XMLRPC_REQUEST') && isset($_POST['_format_video_embed'])) {
                update_post_meta($post_id, '_format_video_embed', $_POST['_format_video_embed']);
                update_post_meta($post_id, '_format_video_autoplay', $_POST['_format_video_autoplay']);
                update_post_meta($post_id, '_format_video_loop', $_POST['_format_video_loop']);
                update_post_meta($post_id, '_format_video_muted', $_POST['_format_video_muted']);
                update_post_meta($post_id, '_format_video_autopause', $_POST['_format_video_autopause']);
                update_post_meta($post_id, '_format_video_byline', $_POST['_format_video_byline']);
                update_post_meta($post_id, '_format_video_title', $_POST['_format_video_title']);
                update_post_meta($post_id, '_format_video_portrait', $_POST['_format_video_portrait']);
                update_post_meta($post_id, '_format_video_controls', $_POST['_format_video_controls']);
                update_post_meta($post_id, '_format_video_related', $_POST['_format_video_related']);
                update_post_meta($post_id, '_format_video_cookie', $_POST['_format_video_cookie']);
            }
        }

        public function vp_pfui_format_audio_save_post($post_id) {
            if (!defined('XMLRPC_REQUEST') && isset($_POST['_format_audio_embed'])) {
                update_post_meta($post_id, '_format_audio_embed', $_POST['_format_audio_embed']);
            }
        }

        public function vp_pfui_format_gallery_save_post($post_id) {
            if (!defined('XMLRPC_REQUEST') && isset($_POST['_format_gallery_images'])) {
                global $post;
                if( $_POST['_format_gallery_images'] !== '' ) {
                    $images = explode(',', $_POST['_format_gallery_images']);
                } else {
                    $images = array();
                }
                update_post_meta($post_id, '_format_gallery_images', $images);
            }
        }

//        // we aren't really adding meta boxes here,
//        // but this gives us the info we need to get our stuff in.
//        public function vp_pfui_add_meta_boxes($post_type) {
//            if (post_type_supports($post_type, 'post-formats') && current_theme_supports('post-formats')) {
//                // assets
//                wp_enqueue_script('vp-post-formats-ui', Functions::get_my_frame_url().'/assets/js/post-formats.js', array('jquery'), VP_PFUI_VERSION);
//                wp_enqueue_style('vp-post-formats-ui', Functions::get_my_frame_url().'/assets/css/post-formats.css', array(), VP_PFUI_VERSION, 'screen');
//                wp_localize_script(
//                    'vp-post-formats-ui',
//                    'vp_pfui_post_format',
//                    array(
//                        'loading'      => __('Loading...', 'vp-post-formats-ui'),
//                        'wpspin_light' => admin_url('images/wpspin_light.gif'),
//                        'media_title'  => __('Pick Gallery Images', 'vp-post-formats-ui'),
//                        'media_button' => __('Add Image(s)', 'vp-post-formats-ui')
//                    )
//                );
//
//                global $wp_version;
//                if( 5 > $wp_version ){
//                    add_action('edit_form_after_title', array($this, 'vp_pfui_post_admin_setup'));
//                } else {
//                    add_action('block_editor_meta_box_hidden_fields', array($this, 'vp_pfui_post_admin_setup'));
//                }
//            }
//        }

        /**
         * Show the post format navigation tabs
         * A lot of cues are taken from the `post_format_meta_box`
         *
         * @return void
         */
        public function vp_pfui_post_admin_setup() {
            $post_formats = get_theme_support('post-formats');
            if (!empty($post_formats[0]) && is_array($post_formats[0])) {
                global $post;
                $current_post_format = get_post_format($post->ID);
                $hacked_format       = null;

                // support the possibility of people having hacked in custom
                // post-formats or that this theme doesn't natively support
                // the post-format in the current post - a tab will be added
                // for this format but the default WP post UI will be shown ~sp
                if (!empty($current_post_format) && !in_array($current_post_format, $post_formats[0])) {
                    $hacked_format = $current_post_format;
                    array_push($post_formats[0], $current_post_format);
                }
                array_unshift($post_formats[0], 'standard');
                $post_formats = $post_formats[0];


                include(TEMPLAZA_FRAMEWORK_CORE_TEMPLATE.'/post-formats/tabs.php');

                // prevent added un-supported custom post format from view output
                if(!is_null($hacked_format) and ($key = array_search($current_post_format, $post_formats)) !== false) {
                    unset($post_formats[$key]);
                }

                $format_views = array(
                    'link',
                    'quote',
                    'video',
                    'gallery',
                    'audio',
                );
                foreach ($format_views as $format) {
                    if (in_array($format, $post_formats)) {
                        include(TEMPLAZA_FRAMEWORK_CORE_TEMPLATE.'/post-formats/format-'.$format.'.php');
                    }
                }
            }
        }

        public function vp_pfui_format_auto_title_post($post_id, $post) {
            // get out early if a title is already set
            if (!empty($post->post_title)) {
                return;
            }

            remove_action('save_post',  array($this,'vp_pfui_format_status_save_post'), 10, 2);
            remove_action('save_post',  array($this,'vp_pfui_format_quote_save_post'), 10, 2);

            $content = trim(strip_tags($post->post_content));
            $title = substr($content, 0, 50);
            if (strlen($content) > 50) {
                $title .= '...';
            }
            $title = apply_filters('vp_pfui_format_auto_title', $title, $post);
            wp_update_post(array(
                'ID' => $post_id,
                'post_title' => $title
            ));

            add_action('save_post',  array($this,'vp_pfui_format_status_save_post'), 10, 2);
            add_action('save_post',  array($this,'vp_pfui_format_quote_save_post'), 10, 2);
        }

        public function vp_pfui_gallery_preview() {
            if (empty($_POST['id']) || !($post_id = intval($_POST['id']))) {
                exit;
            }
            global $post;
            $post->ID = $post_id;
            ob_start();
            include(TEMPLAZA_FRAMEWORK_CORE_TEMPLATE.'/post-formats/format-gallery.php');
            $html = ob_get_clean();
            header('Content-type: text/javascript');
            echo json_encode(compact('html'));
            exit;
        }
        public function vp_pfui_pre_ping_post_links($post_links, $pung, $post_id = null) {
            // return if we don't get a post ID (pre WP 3.4)
            if (empty($post_id)) {
                return;
            }
            $url = get_post_meta($post_id, '_format_link_url', true);
            if (!empty($url) && !in_array($url, $pung) && !in_array($url, $post_links)) {
                $post_links[] = $url;
            }
        }

        // For integration with Social plugin (strips {title} from broadcast format on status posts)
        public function vp_pfui_social_broadcast_format($format, $post) {
            if (get_post_format($post) == 'status') {
                $format = trim(str_replace(
                    array(
                        '{title}:',
                        '{title} -',
                        '{title}',
                    ),
                    '',
                    $format
                ));
            }
            return $format;
        }

        public function vp_pfui_post_has_gallery($post_id = null) {
            if (empty($post_id)) {
                $post_id = get_the_ID();
            }
            $images = new WP_Query(array(
                'post_parent' => $post_id,
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'posts_per_page' => 1, // -1 to show all
                'post_mime_type' => 'image%',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            return (bool) $images->post_count;
        }

    }
}