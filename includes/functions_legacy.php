<?php

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Functions;
use TemPlazaFramework\AdminHelper\Templaza_Style;

function templaza_framework_get_templaza_style_by_slug(){
    return Functions::get_templaza_style_by_slug();
}

function templaza_framework_get_templaza_style_items_by_slug(){
    return Templaza_Style::get_items_by_slug();
}