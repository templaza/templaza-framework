<?php
/*
Plugin Name: Templaza Framework
Plugin URI: http://wordpress.org/plugins/plazart-installation/
Description: This plugin help you manage or install... demo data of themes.
Author: templaza-framework
Version: 1.0.0
Text Domain: templaza-framework
Author URI: http://templaza.com
Forum: https://www.templaza.com/Forums.html
Ticket: https://www.templaza.com/tz_membership/addticket.html
FanPage: https://www.facebook.com/templaza
Twitter: https://twitter.com/templazavn
Google+: https://plus.google.com/+Templaza
*/
//
//namespace TemPlazaFramework;
//
//defined( 'ABSPATH' ) || exit;
//
//require_once dirname(__FILE__).'/includes/defines.php';
//require_once dirname(__FILE__).'/includes/functions.php';
//
//use Cassandra\Value;
//use TemPlazaFramework\Core\Framework;
//use TemPlazaFramework\Functions;
//use ScssPhp\ScssPhp\Formatter\Compressed;
//
//class TemPlazaFrameWork{
//    public function init(){
//        if(is_admin()){
//            if(!class_exists('TemPlazaFrameWork\Core\Framework')) {
//                require_once TEMPLAZA_FRAMEWORK_CORE_PATH . '/framework.php';
//            }
//            $core   = new Framework();
//            $core -> init();
//        }else{
//            $compiled_css   = Functions::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH);
//
//            var_dump($compiled_css); die();
//
////            wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__css');
//
//        }
//    }
//
//}

use TemPlazaFramework\TemPlazaFrameWork;

require_once(  'class.templaza-framework.php' );


//$GLOBALS['templaza_framework'] = new TemPlazaFramework\TemPlazaFrameWork();
//add_action('init', array($GLOBALS['templaza_framework'], 'init'), 1);

TemPlazaFrameWork::instance();