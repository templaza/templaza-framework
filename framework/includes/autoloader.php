<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

//require_once .'../../includes/autoloader.php';

require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH.'/media.php';
require_once 'admin_functions.php';
require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH.'/classes/class-templaza_api.php';
require_once 'menu_admin.php';


require_once TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH . '/admin/admin_autoloader.php';

// Include helper
require_once TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH.'/helpers/AdminHelper/templaza_style.php';
require_once TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH.'/helpers/AdminHelper/templaza_header.php';
require_once TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH.'/helpers/AdminHelper/templaza_footer.php';


require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH.'/templates.php';
require_once 'template_admin.php';
require_once 'classes/class-templaza-enqueue.php';
require_once 'classes/class-templaza-post_type.php';
require_once 'classes/class-templaza-post_type-configuration.php';
//require_once TEMPLAZA_FRAMEWORK_CORE_PATH.'/includes/classes/class-templaza-post_type.php';
//require_once '../../includes/menu.php';
//require_once '../../includes/templates.php';
//require_once '../../includes/fonts.php';
//require_once __DIR__.'/shortcode.php';
//require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/helper/fieldhelper.php';