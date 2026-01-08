<?php

namespace TemPlazaFramework\Helpers;

defined( 'ABSPATH' ) || exit;

if(!class_exists('TemPlazaFramework\Helpers\Http')){

    class Http{
        public function post($url, $post_data,  ?array $headers = null){
            $post_data  = http_build_query($post_data);

            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $post_data
                )
            );

            $context  = stream_context_create($opts);
        }
        public function get_header(){

        }
    }
}