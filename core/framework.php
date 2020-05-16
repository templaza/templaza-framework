<?php

namespace TemPlazaFramework\Core;

use Cassandra\Value;

defined( 'ABSPATH' ) || exit;

class Framework{
    public function init(){

        $plgPath    = dirname(TEMPLAZA_FRAMEWORK_PATH);
        if ( !class_exists( 'ReduxFramework' ) && file_exists( $plgPath . '/redux-framework/ReduxCore/framework.php' ) ) {
            require_once( $plgPath . '/redux-framework/ReduxCore/framework.php' );
        }
        if ( !isset( $redux_demo ) && file_exists( $plgPath. '/redux-framework/sample/sample-config.php' ) ) {
            require_once( $plgPath. '/redux-framework/sample/sample-config.php' );
        }

        add_filter( 'redux/redux_demo/panel/templates_path', array($this, 'redux_panel_path') );
    }

    public function redux_panel_path($tmpPath){
        return get_template_directory().'/templaza-framework/core/templates/redux-panel/';
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