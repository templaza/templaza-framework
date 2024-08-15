<?php

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Functions;
use TemPlazaFramework\AdminHelper\Templaza_Style;
use TemPlazaFramework\AdminHelper\Templaza_Header;
use TemPlazaFramework\AdminHelper\Templaza_Footer;

function templaza_framework_get_templaza_style_by_slug(){
    return Functions::get_templaza_style_by_slug();
}

function templaza_framework_get_templaza_style_items_by_slug(){
    return Templaza_Style::get_items_by_slug();
}
function templaza_framework_get_templaza_header_items_by_slug(){
    return Templaza_Header::get_items_by_slug();
}
function templaza_framework_get_templaza_footer_items_by_slug(){
    return Templaza_Footer::get_items_by_slug();
}