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

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

require_once dirname(__FILE__).'/includes/defines.php';
require_once dirname(__FILE__).'/includes/functions.php';

use TemPlazaFramework\Core\Framework;

class TemPlazaFrameWork{
    public function init(){
        if(is_admin()){
            if(!class_exists('TemPlazaFrameWork\Core\Framework')) {
                require_once TEMPLAZA_FRAMEWORK_CORE_PATH . '/framework.php';
            }
            $core   = new Framework();
            $core -> init();
        }
    }
}

$GLOBALS['templaza_framework'] = new TemPlazaFrameWork();
add_action('init', array($GLOBALS['templaza_framework'], 'init'), 1);