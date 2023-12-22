<?php

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use TemPlazaFramework\Functions;

$args   = $this -> get_arguments();

$opt_name   = $args['opt_name'];

if($redux  = \Redux::instance($opt_name)) {
    $redux -> options   = Functions::get_global_colors_options();
//    $redux -> options_class -> set(Functions::get_global_colors_options());
    if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
        $redux->_register_settings();
        $redux->generate_panel();
    }elseif(isset($redux -> options_class)){
        $redux -> options_class -> register();
        $redux -> render_class->generate_panel();
    }
}
?>
