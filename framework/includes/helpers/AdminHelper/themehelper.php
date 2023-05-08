<?php

namespace TemPlazaFramework\AdminHelper;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use Matrix\Exception;
use TemPlazaFramework\Admin\Application;
use TemPlazaFramework\Helpers\HelperLicense;

if(!class_exists('TemPlazaFramework\AdminHelper\ThemeHelper')) {
    class ThemeHelper{

        protected static $cache    = array();

        protected static $api_domain    = TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN;

        /**
         * Get themes package list from our server if current theme support
         * @param string $produce Produce code created from our server
         * @return array
         * */
        public static function getThemesPackage($produce = '', $config = array()){
            $curtheme       = wp_get_theme();
            $theme          = empty($theme)?$curtheme -> get_template():$theme;
            $produce_prefix = isset($config['produce_prefix'])?$config['produce_prefix']:'wp_';

            $produce        = !empty($produce)?$produce:$produce_prefix.$theme;

            $produce        = apply_filters('templaza-framework/theme-produce', $produce);

            $store_id   = __METHOD__;
            $store_id  .= '::'.$produce;
            $store_id  .= '::'.serialize($config);
            $store_id   = md5($store_id);

            if(isset(static::$cache[$store_id])){
                return static::$cache[$store_id];
            }

            $ignore_notice  = isset($config['ignore_notice'])?filter_var($config['ignore_notice'], FILTER_VALIDATE_BOOLEAN):false;
            $api_domain     = isset($config['api_domain'])?$config['api_domain']:static::$api_domain;
            $url        = $api_domain.'?option=com_tz_membership&view=products';
            $app        = Application::get_instance();

            $purchase_code  = HelperLicense::get_purchase_code($curtheme -> get_template()); // Testing

            if(!$purchase_code){
                return false;
            }

            $remoteData = array(
                'option'    => 'com_tz_membership',
                'view'      => 'products',
                'format'    => 'list',
                'produce'   => $produce,
                'purchase_code' => $purchase_code,
                'domain'        => get_site_url(),
            );
            // Get package file from server with post data
            try {
                $response = wp_remote_post(
                    $url,
                    array(
                        'method' => 'POST',
                        'timeout' => 45,
                        'body' => $remoteData
                    )
                );
            }catch (\Exception $exception){

            }

            if(is_wp_error($response)){
                if(!$ignore_notice) {
                    $app->enqueue_message(esc_html__($response->get_error_message(),
                        'templaza-framework'), 'error');
                }

                return false;
            }

            if(isset($response['response']['code']) && $response['response']['code'] != 200){
                if(!$ignore_notice) {
                    $app->enqueue_message(__('Could not connected to our server to get themes list',
                        'templaza-framework'), 'warning');
                }
                return false;
            }

            $body   = wp_remote_retrieve_body($response); // use the content
            $header = wp_remote_retrieve_headers($response); // array of http header lines

            if ($header['content-type'] == 'application/json') {
                $body = json_decode($body, true);
            }

            if(!isset($body['products'])){
                return false;
            }

            return static::$cache[$store_id]    = $body['products'];
        }
    }
}