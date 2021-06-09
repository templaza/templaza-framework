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

use TemPlazaFramework\TemPlazaFrameWork;

require_once(  'class.templaza-framework.php' );


//$GLOBALS['templaza_framework'] = new TemPlazaFramework\TemPlazaFrameWork();
//add_action('init', array($GLOBALS['templaza_framework'], 'init'), 1);

TemPlazaFrameWork::instance();