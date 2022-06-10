<?php
namespace TemPlazaFramework\Import;

defined( 'ABSPATH' ) || exit;

class Data_Importer{
    public function __construct()
    {
        $this -> hooks();
    }

    public function hooks(){
        add_filter('wp_import_existing_post', array($this, 'pre_post_exists'), 10, 2);
    }

    /**
     * Check post type is default
     * @param int $post_exists An optional of post id
     * @param array $post An optional post info
     * */
    public function pre_post_exists($post_exists, $post){
        if(!empty($post) && isset($post['post_type'])
            && in_array($post['post_type'],array('templaza_header', 'templaza_footer'))){
            $is_home    = false;
            if ( isset( $post['postmeta'] ) ) {
                foreach( $post['postmeta'] as $meta ) {
                    if ( $meta['key'] == '__home' ) {
                        $is_home    = true;
                        break;
                    }
                }
            }

            if(!$is_home){
                return $post_exists;
            }

            $args   = array(
                'post_type'     => $post['post_type'],
                'numberposts'   => 1,
                'meta_query'    => array(
                    'key'   => '__home',
                    'value' => 1
                )
            );

            $postslist = get_posts($args);

            if(empty($postslist) || is_wp_error($postslist)){
                return $post_exists;
            }

            $post_exists    = $postslist[0] -> ID;

            // Replace default json file option in uploads folder
            $source_file    = TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION.'/'.$post['post_type'].'/'
                .$postslist[0] -> post_name.'.json';
            if(!file_exists($source_file)){
                return $post_exists;
            }

            $dest_file  = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/'.$post['post_type'].'/'
                .$postslist[0] -> post_name.'.json';

            if(file_exists($dest_file)){
                unlink($dest_file);
            }
            copy($source_file, $dest_file);

        }
        return $post_exists;
    }
}
