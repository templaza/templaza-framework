<?php

defined( 'ABSPATH' ) || exit;

if(!defined('TEMPLAZA_FRAMEWORK_PATH')){
    define('TEMPLAZA_FRAMEWORK_PATH', dirname( dirname(__FILE__)));
}
if(!defined('TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH')){
    define('TEMPLAZA_FRAMEWORK_PLUGIN_DIR_PATH', dirname(TEMPLAZA_FRAMEWORK_PATH ));
}
if(!defined('TEMPLAZA_FRAMEWORK_CORE_PATH')){
    define('TEMPLAZA_FRAMEWORK_CORE_PATH', TEMPLAZA_FRAMEWORK_PATH.'/framework');
}
if(!defined('TEMPLAZA_FRAMEWORK_NAME')){
    define('TEMPLAZA_FRAMEWORK_NAME', basename(TEMPLAZA_FRAMEWORK_PATH));
}
if(!defined('TEMPLAZA_FRAMEWORK_PREFIX')){
    define('TEMPLAZA_FRAMEWORK_PREFIX', 'tzfrm');
}