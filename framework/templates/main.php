<?php
/**
 * Base layout for all admin pages
 */

defined('TEMPLAZA_FRAMEWORK') or die;

use TemPlazaFramework\Installation\Controller\BaseController;

$theme_imports  = apply_filters('templaza-framework-installation_register', array());
$controller = BaseController::getInstance('',
    array(
        'basePath'                  => TEMPLAZA_FRAMEWORK_ADMIN_PATH,
        'theme_name'                => \get_template(),
        'theme_config_registered'   => $theme_imports
    )
);
//$this -> controller -> set('theme_demo_datas', $this -> theme_demo_datas);
//
//if($action){
//    $this -> controller -> execute($action);
//}

$controller -> display();