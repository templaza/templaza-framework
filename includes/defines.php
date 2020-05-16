<?php

defined( 'ABSPATH' ) || exit;

if(!defined('TEMPLAZA_FRAMEWORK_PATH')){
    define('TEMPLAZA_FRAMEWORK_PATH', dirname( dirname(__FILE__)));
}
if(!defined('TEMPLAZA_FRAMEWORK_CORE_PATH')){
    define('TEMPLAZA_FRAMEWORK_CORE_PATH', TEMPLAZA_FRAMEWORK_PATH.'/core');
}
if(!defined('TEMPLAZA_FRAMEWORK_NAME')){
    define('TEMPLAZA_FRAMEWORK_NAME', basename(TEMPLAZA_FRAMEWORK_PATH));
}