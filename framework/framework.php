<?php

namespace TemPlazaFramework\Core;

use Cassandra\Value;
use TemPlazaFramework\Functions;

defined( 'ABSPATH' ) || exit;

class Framework{
    public function init(){

        $plgPath    = TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH;
        if ( !class_exists( 'ReduxFramework' ) && file_exists( $plgPath . '/redux-framework/ReduxCore/framework.php' ) ) {
            require_once( $plgPath . '/redux-framework/ReduxCore/framework.php' );
        }
        if ( !isset( $redux_demo ) && file_exists( TEMPLAZA_FRAMEWORK_CORE_PATH. '/options/basic-config.php' ) ) {
            require_once( TEMPLAZA_FRAMEWORK_CORE_PATH. '/options/basic-config.php' );
        }

        $this -> enqueue_script();
        $this -> enqueue_style();

//        add_filter( 'redux/redux_demo/panel/templates_path', array($this, 'redux_panel_path') );
    }

    public function redux_panel_path($tmpPath){
        return TEMPLAZA_FRAMEWORK_CORE_PATH.'/templates/redux-panel/';
    }

    public function enqueue_script(){
        wp_enqueue_script(TEMPLAZA_FRAMEWORK_NAME.'__js', Functions::get_my_frame_url().'/assets/vendors/core/core.js');
    }

    public function enqueue_style(){
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__css', Functions::get_my_frame_url().'/assets/vendors/core/core.css');
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__style', Functions::get_my_frame_url().'/assets/css/framework.min.css');
    }

}

//$framePrefix    = 'templaza-framework';
//$tplPath        = get_template_directory_uri();
//wp_enqueue_script($framePrefix.'__js', $tplPath.'/'.$framePrefix.'/assets/vendors/core/core.js');
//wp_enqueue_style($framePrefix.'__css', $tplPath.'/'.$framePrefix.'/assets/vendors/core/core.css');
//wp_enqueue_style($framePrefix.'__style', $tplPath.'/'.$framePrefix.'/assets/css/style.min.css');
//
//if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname(dirname( __FILE__ )) . '/redux-framework/ReduxCore/framework.php' ) ) {
//    require_once( dirname(dirname( __FILE__ )) . '/redux-framework/ReduxCore/framework.php' );
//}
//if ( !isset( $redux_demo ) && file_exists( dirname(dirname( __FILE__ )) . '/redux-framework/sample/sample-config.php' ) ) {
//    require_once( dirname(dirname( __FILE__ )). '/redux-framework/sample/sample-config.php' );
//}

//function test($tmpPath){
//    return get_template_directory().'/templaza-framework/panel/';
////    var_dump(get_template_directory().'/redux-test/panel/');
////    var_dump($tmpPath);
////    die(__METHOD__);
//}
//add_filter( 'redux/redux_demo/panel/templates_path', array($this, 'redux_panel_path') );