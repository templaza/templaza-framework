<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use ScssPhp\ScssPhp\Compiler;

if(!class_exists('TemPlazaFramework\Media')){

    class Media{
        protected static $cache         = array();
        protected static $shortcode = '';

        /**
         * Get image formats by mime type.
         * Accepts an array of strings which correspond to the second part of a mime type  (i.e. image/jpeg would be “jpeg”).
         * Only files that match one of the items in the array will appear in the media library.
         * @return array
         * */
        public static function get_image_formats_by_mime_type(){
            return self::get_file_formats_by_mime_type('image');
        }

        /**
         * Get video formats by mime type.
         * Accepts an array of strings which correspond to the second part of a mime type  (i.e. video/mp4 would be “mp4”).
         * Only files that match one of the items in the array will appear in the media library.
         * @return array
         * */
        public static function get_video_formats_by_mime_type(){
            $mimes  = self::get_file_formats_by_mime_type('video');


            return $mimes;
        }

        /**
         * Get file formats by mime type.
         * Only files that match one of the items in the array will appear in the media library.
         * @param string|string[] $file_type Accepts an array of strings which correspond to the second part of a mime type  (i.e. video/mp4 would be “video”).
         * @return array
         * */
        public static function get_file_formats_by_mime_type($file_type = ''){
            $store_id   = __METHOD__;

            $mime_types = get_allowed_mime_types();

            $store_id  .= ':'.serialize($file_type);
            $store_id  .= ':'.serialize($mime_types);
            $store_id   = md5($store_id);

            if(empty($file_type)){
                return $mime_types;
            }

            if(isset(self::$cache[$store_id])){
                return self::$cache[$store_id];
            }

            if(!empty($mime_types) && count($mime_types)){
                $data   = array();
                foreach($mime_types as $ext => $mime_type){
                    if(is_array($file_type)){
                        if(count($file_type)){
                            foreach($file_type as $ftype){
                                if(strpos($mime_type, $ftype) !== false){
                                    $data[] = preg_replace('/^'.$ftype.'\//', '', $mime_type);
                                }
                            }
                        }
                    }elseif(strpos($mime_type, $file_type) !== false){
                        $data[] = preg_replace('/^'.$file_type.'\//', '', $mime_type);
                    }
                }
                if(count($data)){
                    self::$cache[$store_id] = $data;
                    return $data;
                }
            }

            return array();
        }
    }
}