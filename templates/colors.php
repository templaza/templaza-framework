<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use \TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options = Functions::get_theme_options();

// Body
$body_css        = '';
$body_text_color        = isset($options['body-text-color'])?$options['body-text-color']:'';
if(is_array($body_text_color) && isset($body_text_color['rgba'])) {
    if($body_text_color['alpha'] == 1){
        $body_text_color  = $body_text_color['color'];
    }else {
        $body_text_color    = $body_text_color['rgba'];
    }
    if(!empty($body_text_color)){
        $body_css    .= 'color:'.$body_text_color.';';
    }
}
$body_link_color        = isset($options['body-link-color'])?$options['body-link-color']:'';
if(is_array($body_link_color) && isset($body_link_color['rgba'])) {
    if($body_link_color['alpha'] == 1){
        $body_link_color  = $body_link_color['color'];
    }else {
        $body_link_color    = $body_link_color['rgba'];
    }
}
$body_heading_color     = isset($options['body-heading-color'])?$options['body-heading-color']:'';
if(is_array($body_heading_color) && isset($body_heading_color['rgba'])) {
    if($body_heading_color['alpha'] == 1){
        $body_heading_color  = $body_heading_color['color'];
    }else {
        $body_heading_color    = $body_heading_color['rgba'];
    }
}
$body_link_hover_color  = isset($options['body-link-hover-color'])?$options['body-link-hover-color']:'';
if(is_array($body_link_hover_color) && isset($body_link_hover_color['rgba'])) {
    if($body_link_hover_color['alpha'] == 1){
        $body_link_hover_color  = $body_link_hover_color['color'];
    }else {
        $body_link_hover_color  = $body_link_hover_color['rgba'];
    }
}
$body_background_color  = isset($options['body-background-color'])?$options['body-background-color']:'';
if(is_array($body_background_color) && isset($body_background_color['rgba'])) {
    if($body_background_color['alpha'] == 1){
        $body_background_color  = $body_background_color['color'];
    }else {
        $body_background_color    = $body_background_color['rgba'];
    }
    if(!empty($body_background_color)){
        $body_css    .= 'background-color:'.$body_background_color.';';
    }
}
$body_background_image  = isset($options['body-background-image'])?$options['body-background-image']:'';
if(is_array($body_background_image) && !empty($body_background_image['background-image'])) {
    $body_css   .= CSS::background('', $body_background_image['background-image'],
        $body_background_image['background-repeat'], $body_background_image['background-attachment'],
        $body_background_image['background-position'], $body_background_image['background-size'] );
}

// Header
$header_background_color        = isset($options['header-bg'])?$options['header-bg']:'';
if(is_array($header_background_color) && isset($header_background_color['rgba'])) {
    if($header_background_color['alpha'] == 1){
        $header_background_color  = $header_background_color['color'];
    }else {
        $header_background_color  = $header_background_color['rgba'];
    }
}
$header_text_color        = isset($options['header-text-color'])?$options['header-text-color']:'';
if(is_array($header_text_color) && isset($header_text_color['rgba'])) {
    if($header_text_color['alpha'] == 1){
        $header_text_color  = $header_text_color['color'];
    }else {
        $header_text_color  = $header_text_color['rgba'];
    }
}
$header_heading_color        = isset($options['header-heading-color'])?$options['header-heading-color']:'';
if(is_array($header_heading_color) && isset($header_heading_color['rgba'])) {
    if($header_heading_color['alpha'] == 1){
        $header_heading_color  = $header_heading_color['color'];
    }else {
        $header_heading_color  = $header_heading_color['rgba'];
    }
}
$header_link_color        = isset($options['header-link-color'])?$options['header-link-color']:'';
if(is_array($header_link_color) && isset($header_link_color['rgba'])) {
    if($header_link_color['alpha'] == 1){
        $header_link_color  = $header_link_color['color'];
    }else {
        $header_link_color  = $header_link_color['rgba'];
    }
}
$header_link_hover_color        = isset($options['header-link-hover-color'])?$options['header-link-hover-color']:'';
if(is_array($header_link_hover_color) && isset($header_link_hover_color['rgba'])) {
    if($header_link_hover_color['alpha'] == 1){
        $header_link_hover_color  = $header_link_hover_color['color'];
    }else {
        $header_link_hover_color  = $header_link_hover_color['rgba'];
    }
}
$header_logo_text_color        = isset($options['header-logo-text-color'])?$options['header-logo-text-color']:'';
if(is_array($header_logo_text_color) && isset($header_logo_text_color['rgba'])) {
    if($header_logo_text_color['alpha'] == 1){
        $header_logo_text_color  = $header_logo_text_color['color'];
    }else {
        $header_logo_text_color  = $header_logo_text_color['rgba'];
    }
}
$header_logo_text_tagline_color        = isset($options['header-logo-text-tagline-color'])?$options['header-logo-text-tagline-color']:'';
if(is_array($header_logo_text_tagline_color) && isset($header_logo_text_tagline_color['rgba'])) {
    if($header_logo_text_tagline_color['alpha'] == 1){
        $header_logo_text_tagline_color  = $header_logo_text_tagline_color['color'];
    }else {
        $header_logo_text_tagline_color  = $header_logo_text_tagline_color['rgba'];
    }
}
$sticky_header_background_color        = isset($options['sticky-header-background-color'])?$options['sticky-header-background-color']:'';
if(is_array($sticky_header_background_color) && isset($sticky_header_background_color['rgba'])) {
    if($sticky_header_background_color['alpha'] == 1){
        $sticky_header_background_color  = $sticky_header_background_color['color'];
    }else {
        $sticky_header_background_color  = $sticky_header_background_color['rgba'];
    }
}
$topbar_bordercolor        = isset($options['topbar-bordercolor'])?$options['topbar-bordercolor']:'';
if(is_array($topbar_bordercolor) && isset($topbar_bordercolor['rgba'])) {
    if($topbar_bordercolor['alpha'] == 1){
        $topbar_bordercolor  = $topbar_bordercolor['color'];
    }else {
        $topbar_bordercolor  = $topbar_bordercolor['rgba'];
    }
}

// Main Menu
$main_link_color        = isset($options['main-menu-link-color'])?$options['main-menu-link-color']:'';
if(is_array($main_link_color) && isset($main_link_color['rgba'])) {
    if($main_link_color['alpha'] == 1){
        $main_link_color  = $main_link_color['color'];
    }else {
        $main_link_color  = $main_link_color['rgba'];
    }
}
$main_link_hover_color        = isset($options['main-menu-link-active-color'])?$options['main-menu-link-active-color']:'';
if(is_array($main_link_hover_color) && isset($main_link_hover_color['rgba'])) {
    if($main_link_hover_color['alpha'] == 1){
        $main_link_hover_color  = $main_link_hover_color['color'];
    }else {
        $main_link_hover_color  = $main_link_hover_color['rgba'];
    }
}
$main_link_active_color        = isset($options['main-menu-link-hover-color'])?$options['main-menu-link-hover-color']:'';
if(is_array($main_link_active_color) && isset($main_link_active_color['rgba'])) {
    if($main_link_active_color['alpha'] == 1){
        $main_link_active_color  = $main_link_active_color['color'];
    }else {
        $main_link_active_color  = $main_link_active_color['rgba'];
    }
}
$sidebar_separate_color        = isset($options['sidebar-separate-color'])?$options['sidebar-separate-color']:'';
if(is_array($sidebar_separate_color) && isset($sidebar_separate_color['rgba'])) {
    if($sidebar_separate_color['alpha'] == 1){
        $sidebar_separate_color  = $sidebar_separate_color['color'];
    }else {
        $sidebar_separate_color  = $sidebar_separate_color['rgba'];
    }
}

// Sticky Menu
$sticky_link_color        = isset($options['sticky-menu-link-color'])?$options['sticky-menu-link-color']:'';
if(is_array($sticky_link_color) && isset($sticky_link_color['rgba'])) {
    if($sticky_link_color['alpha'] == 1){
        $sticky_link_color  = $sticky_link_color['color'];
    }else {
        $sticky_link_color  = $sticky_link_color['rgba'];
    }
}
$sticky_link_hover_color        = isset($options['sticky-menu-link-hover-color'])?$options['sticky-menu-link-hover-color']:'';
if(is_array($sticky_link_hover_color) && isset($sticky_link_hover_color['rgba'])) {
    if($sticky_link_hover_color['alpha'] == 1){
        $sticky_link_hover_color  = $sticky_link_hover_color['color'];
    }else {
        $sticky_link_hover_color  = $sticky_link_hover_color['rgba'];
    }
}
$sticky_link_active_color        = isset($options['sticky-menu-link-active-color'])?$options['sticky-menu-link-active-color']:'';
if(is_array($sticky_link_active_color) && isset($sticky_link_active_color['rgba'])) {
    if($sticky_link_active_color['alpha'] == 1){
        $sticky_link_active_color  = $sticky_link_active_color['color'];
    }else {
        $sticky_link_active_color  = $sticky_link_active_color['rgba'];
    }
}

// Dropdown Menu
$dropdown_main_background_color        = isset($options['dropdown-menu-background-color'])?$options['dropdown-menu-background-color']:'';
if(is_array($dropdown_main_background_color) && isset($dropdown_main_background_color['rgba'])) {
    if($dropdown_main_background_color['alpha'] == 1){
        $dropdown_main_background_color  = $dropdown_main_background_color['color'];
    }else {
        $dropdown_main_background_color = $dropdown_main_background_color['rgba'];
    }
}
$dropdown_main_link_color               = isset($options['dropdown-menu-link-color'])?$options['dropdown-menu-link-color']:'';
if(is_array($dropdown_main_link_color) && isset($dropdown_main_link_color['rgba'])) {
    if($dropdown_main_link_color['alpha'] == 1){
        $dropdown_main_link_color  = $dropdown_main_link_color['color'];
    }else {
        $dropdown_main_link_color = $dropdown_main_link_color['rgba'];
    }
}
$dropdown_main_hover_link_color         = isset($options['dropdown-menu-link-hover-color'])?$options['dropdown-menu-link-hover-color']:'';
if(is_array($dropdown_main_hover_link_color) && isset($dropdown_main_hover_link_color['rgba'])) {
    if($dropdown_main_hover_link_color['alpha'] == 1){
        $dropdown_main_hover_link_color  = $dropdown_main_hover_link_color['color'];
    }else {
        $dropdown_main_hover_link_color = $dropdown_main_hover_link_color['rgba'];
    }
}
$dropdown_main_hover_background_color   = isset($options['dropdown-menu-hover-bg-color'])?$options['dropdown-menu-hover-bg-color']:'';
if(is_array($dropdown_main_hover_background_color) && isset($dropdown_main_hover_background_color['rgba'])) {
    if($dropdown_main_hover_background_color['alpha'] == 1){
        $dropdown_main_hover_background_color  = $dropdown_main_hover_background_color['color'];
    }else {
        $dropdown_main_hover_background_color = $dropdown_main_hover_background_color['rgba'];
    }
}
$dropdown_main_active_link_color        = isset($options['dropdown-menu-link-active-color'])?$options['dropdown-menu-link-active-color']:'';
if(is_array($dropdown_main_active_link_color) && isset($dropdown_main_active_link_color['rgba'])) {
    if($dropdown_main_active_link_color['alpha'] == 1){
        $dropdown_main_active_link_color  = $dropdown_main_active_link_color['color'];
    }else {
        $dropdown_main_active_link_color  = $dropdown_main_active_link_color['rgba'];
    }
}
$dropdown_main_active_background_color  = isset($options['dropdown-menu-active-bg-color'])?$options['dropdown-menu-active-bg-color']:'';
if(is_array($dropdown_main_active_background_color) && isset($dropdown_main_active_background_color['rgba'])) {
    if($dropdown_main_active_background_color['alpha'] == 1){
        $dropdown_main_active_background_color  = $dropdown_main_active_background_color['color'];
    }else {
        $dropdown_main_active_background_color  = $dropdown_main_active_background_color['rgba'];
    }
}

// Mobile OffCanvas
$mobile_background_color        = isset($options['off-canvas-background-color'])?$options['off-canvas-background-color']:'';
if(is_array($mobile_background_color) && isset($mobile_background_color['rgba'])) {
    if($mobile_background_color['alpha'] == 1){
        $mobile_background_color  = $mobile_background_color['color'];
    }else {
        $mobile_background_color  = $mobile_background_color['rgba'];
    }
}
$mobile_link_color        = isset($options['off-canvas-mobile-menu-link-color'])?$options['off-canvas-mobile-menu-link-color']:'';
if(is_array($mobile_link_color) && isset($mobile_link_color['rgba'])) {
    if($mobile_link_color['alpha'] == 1){
        $mobile_link_color  = $mobile_link_color['color'];
    }else {
        $mobile_link_color  = $mobile_link_color['rgba'];
    }
}
$mobile_menu_text_color        = isset($options['off-canvas-mobile-menu-text-color'])?$options['off-canvas-mobile-menu-text-color']:'';
if(is_array($mobile_menu_text_color) && isset($mobile_menu_text_color['rgba'])) {
    if($mobile_menu_text_color['alpha'] == 1){
        $mobile_menu_text_color  = $mobile_menu_text_color['color'];
    }else {
        $mobile_menu_text_color  = $mobile_menu_text_color['rgba'];
    }
}
$off_canvas_button_color        = isset($options['off-canvas-button-color'])?$options['off-canvas-button-color']:'';
if(is_array($off_canvas_button_color) && isset($off_canvas_button_color['rgba'])) {
    if($off_canvas_button_color['alpha'] == 1){
        $off_canvas_button_color  = $off_canvas_button_color['color'];
    }else {
        $off_canvas_button_color  = $off_canvas_button_color['rgba'];
    }
}
$sticky_off_canvas_button_color        = isset($options['sticky-off-canvas-button-color'])?$options['sticky-off-canvas-button-color']:'';
if(is_array($sticky_off_canvas_button_color) && isset($sticky_off_canvas_button_color['rgba'])) {
    if($sticky_off_canvas_button_color['alpha'] == 1){
        $sticky_off_canvas_button_color  = $sticky_off_canvas_button_color['color'];
    }else {
        $sticky_off_canvas_button_color  = $sticky_off_canvas_button_color['rgba'];
    }
}
$off_canvas_button_color_close        = isset($options['off-canvas-button-color-close'])?$options['off-canvas-button-color-close']:'';
if(is_array($off_canvas_button_color_close) && isset($off_canvas_button_color_close['rgba'])) {
    if($off_canvas_button_color_close['alpha'] == 1){
        $off_canvas_button_color_close  = $off_canvas_button_color_close['color'];
    }else {
        $off_canvas_button_color_close  = $off_canvas_button_color_close['rgba'];
    }
}
$mobile_active_link_color        = isset($options['off-canvas-mobile-menu-link-color'])?$options['off-canvas-mobile-menu-link-color']:'';
if(is_array($mobile_active_link_color) && isset($mobile_active_link_color['rgba'])) {
    if($mobile_active_link_color['alpha'] == 1){
        $mobile_active_link_color  = $mobile_active_link_color['color'];
    }else {
        $mobile_active_link_color  = $mobile_active_link_color['rgba'];
    }
}
$mobile_active_background_color        = isset($options['off-canvas-mobile-menu-active-bg-color'])?$options['off-canvas-mobile-menu-active-bg-color']:'';
if(is_array($mobile_active_background_color) && isset($mobile_active_background_color['rgba'])) {
    if($mobile_active_background_color['alpha'] == 1){
        $mobile_active_background_color  = $mobile_active_background_color['color'];
    }else {
        $mobile_active_background_color  = $mobile_active_background_color['rgba'];
    }
}


//$mobile_background_color = $template->params->get('mobile_backgroundcolor', '');
//$mobile_link_color = $template->params->get('mobile_menu_link_color', '');
//$mobile_menu_text_color = $template->params->get('mobile_menu_text_color', '');
//$off_canvas_button_color = $template->params->get('off_canvas_button_color', '');
//$sticky_off_canvas_button_color = $template->params->get('sticky_off_canvas_button_color', '');
//$off_canvas_button_color_close = $template->params->get('off_canvas_button_color_close', '');
//$mobile_active_link_color = $template->params->get('mobile_menu_active_link_color', '');
//$mobile_active_background_color = $template->params->get('mobile_menu_active_bg_color', '');

//Miscellaneous -> Contact Us
$contact_icon_color        = isset($options['contact-icon-color'])?$options['contact-icon-color']:'';
if(is_array($contact_icon_color) && isset($contact_icon_color['rgba'])) {
    if($contact_icon_color['alpha'] == 1){
        $contact_icon_color  = $contact_icon_color['color'];
    }else {
        $contact_icon_color  = $contact_icon_color['rgba'];
    }
}
//$icon_color = $template->params->get('icon_color', '');

// Chưa có options cần xem xét
//$social_icon_color = $template->params->get('social_icon_color', '');
//$social_icon_color_hover = $template->params->get('social_icon_color_hover', '');

//Extensions
//$hikacart_icon_color = $template->params->get('hikacart_icon_color', '');
//$login_icon_color = $template->params->get('login_icon_color', '');
//$menu_icon_color = $template->params->get('dropdownmenu_icon_color', '');
?>

<?php
// Body Coloring
$body_styles = [];
if (!empty($body_css)) {
    $body_styles[] = 'body{ ' . $body_css . '}';
}
if (!empty($body_heading_color)) {
    $body_styles[] = 'h1,h2,h3,h4,h5,h6{color: ' . $body_heading_color . ';}';
}
if (!empty($body_link_color)) {
    $body_styles[] = 'body a{color: ' . $body_link_color . ';}';
}
if (!empty($body_link_hover_color)) {
    $body_styles[] = 'body a:hover{color: ' . $body_link_hover_color . ';}';
}
?>

<?php
// Header Coloring
$header_styles = [];
if (!empty($header_background_color)) {
   $header_styles[] = '.templaza-header-section,.templaza-sidebar-header{ background-color: ' . $header_background_color . ' !important;}';
}
if (!empty($header_text_color)) {
   $header_styles[] = 'header{ color: ' . $header_text_color . ' !important;}';
}
if (!empty($header_heading_color)) {
	$header_styles[] = 'header h1,header h2,header h3,header h4,header h5,header h6{ color: ' . $header_heading_color . ' !important;}';
}
if (!empty($header_link_color)) {
	$header_styles[] = 'header a{ color: ' . $header_link_color . ' !important;}';
}
if (!empty($header_link_hover_color)) {
	$header_styles[] = 'header a:hover{ color: ' . $header_link_hover_color. ' !important;}';
}
if (!empty($header_logo_text_color)) {
   $header_styles[] = '.templaza-logo-text .site-title{ color: ' . $header_logo_text_color . ' !important;}';
}
if (!empty($header_logo_text_tagline_color)) {
   $header_styles[] = '.templaza-logo-text .site-tagline{ color: ' . $header_logo_text_tagline_color . ' !important;}';
}
if (!empty($sticky_header_background_color)) {
   $header_styles[] = '#templaza-sticky-header{ background-color: ' . $sticky_header_background_color . ' !important;}';
}
if (!empty($topbar_bordercolor)) {
	$header_styles[]    = '.top-bar, .top-bar .templaza-contact-info > span,.top-bar .templaza-social-icons > li,.top-bar .jollyany-hikacart, .top-bar .jollyany-login, .top-bar .border-right {border-color:'.$topbar_bordercolor.' !important;}';
}
?>

<?php
// Main Menu Coloring
$main_menu_styles = [];
if (!empty($main_link_color)) {
   $main_menu_styles[] = '.templaza-nav .menu-item > a{ color: ' . $main_link_color . ' !important;}';
   $main_menu_styles[] = '.templaza-sidebar-menu .menu-item > a{ color: ' . $main_link_color . ' !important;}';
}
if (!empty($main_link_hover_color)) {
   $main_menu_styles[] = '.templaza-nav .menu-item > a:hover, .templaza-nav .menu-item > a:focus{ color: ' . $main_link_hover_color . ' !important;}';
   $main_menu_styles[] = '.templaza-sidebar-menu .menu-item > a:hover, .templaza-sidebar-menu .menu-item > a:focus{ color: ' . $main_link_hover_color . ' !important;}';
}
if (!empty($main_link_active_color)) {
   $main_menu_styles[] = '.templaza-nav .menu-item.current-menu-item > a{ color: ' . $main_link_active_color . ' !important;}';
   $main_menu_styles[] = '.templaza-sidebar-menu .menu-item.current-menu-item > a{ color: ' . $main_link_active_color . ' !important;}';
}
if (!empty($off_canvas_button_color)) {
   $main_menu_styles[] = '.burger-menu-button .inner, .burger-menu-button .inner::before, .burger-menu-button .inner::after { background-color: ' . $off_canvas_button_color . ' !important;}';
}
if (!empty($sidebar_separate_color)) {
	$main_menu_styles[] = '.templaza-sidebar-menu li, .templaza-sidebar-menu li > ul { border-color: ' . $sidebar_separate_color . ' !important;}';
}
?>

<?php
// Sticky Menu Coloring
$sticky_menu_styles = [];
if (!empty($sticky_link_color)) {
	$sticky_menu_styles[] = '#templaza-sticky-header .templaza-nav > .menu-item > a{ color: ' . $sticky_link_color . ' !important;}';
	$sticky_menu_styles[] = '#templaza-sticky-header .templaza-sidebar-menu .menu-item > a{ color: ' . $sticky_link_color . ' !important;}';
}
if (!empty($sticky_link_hover_color)) {
	$sticky_menu_styles[] = '#templaza-sticky-header .templaza-nav > .menu-item > a:hover, .templaza-nav .menu-item > a:focus{ color: ' . $sticky_link_hover_color . ' !important;}';
	$sticky_menu_styles[] = '#templaza-sticky-header .templaza-sidebar-menu .menu-item > a:hover, .templaza-sidebar-menu .menu-item > a:focus{ color: ' . $sticky_link_hover_color . ' !important;}';
}
if (!empty($sticky_link_active_color)) {
	$sticky_menu_styles[] = '#templaza-sticky-header .templaza-nav > .menu-item.current-menu-item > a{ color: ' . $sticky_link_active_color . ' !important;}';
	$sticky_menu_styles[] = '#templaza-sticky-header .templaza-sidebar-menu .menu-item.current-menu-item > a{ color: ' . $sticky_link_active_color . ' !important;}';
}
if (!empty($sticky_off_canvas_button_color)) {
	$sticky_menu_styles[] = '#templaza-sticky-header .burger-menu-button .inner, #templaza-sticky-header .burger-menu-button .inner::before, #templaza-sticky-header .burger-menu-button .inner::after { background-color: ' . $sticky_off_canvas_button_color . ' !important;}';
}
?>

<?php
// Dropdown Coloring
$dropdown_styles = [];
if (!empty($dropdown_main_background_color)) {
   $dropdown_styles[] = '.templaza-nav .sub-menu{ background: ' . $dropdown_main_background_color . ' !important;}';
}
if (!empty($dropdown_main_background_color)) {
   $dropdown_styles[] = '.has-megamenu.open .arrow{ border-bottom-color: ' . $dropdown_main_background_color . ' !important;}';
}
if (!empty($dropdown_main_link_color)) {
   $dropdown_styles[] = '.templaza-nav .sub-menu .menu-item > a{ color: ' . $dropdown_main_link_color . ' !important;}';
}
if (!empty($dropdown_main_active_link_color)) {
   $dropdown_styles[] = '.templaza-nav .sub-menu .menu-item.current-menu-item > a, .menu_open .menu-go-back .fas{ color: ' . $dropdown_main_active_link_color . ' !important;}';
}
if (!empty($dropdown_main_active_background_color)) {
   $dropdown_styles[] = '.templaza-nav .sub-menu .menu-item.current-menu-item > a{ background-color: ' . $dropdown_main_active_background_color . ' !important;}';
}
if (!empty($dropdown_main_hover_link_color)) {
   $dropdown_styles[] = '.templaza-nav .sub-menu .menu-item > a:hover, .templaza-nav .megamenu-submenu-container .megamenu-submenu li > a:hover{ color: ' . $dropdown_main_hover_link_color . ' !important;}';
}
if (!empty($dropdown_main_hover_background_color)) {
   $dropdown_styles[] = '.templaza-nav .sub-menu .menu-item > a:hover{ background-color: ' . $dropdown_main_hover_background_color . ' !important;}';
}
?>

<?php
// Off-Canvas Coloring
$mobilemenu_styles = [];
if (!empty($mobile_background_color)) {
   $mobilemenu_styles[] = '.templaza-offcanvas, .templaza-mobilemenu, .templaza-mobilemenu-container .templaza-mobilemenu-inner .dropdown-menus,.templaza-offcanvas .burger-menu-button{ background-color: ' . $mobile_background_color . ' !important;}';
}
if (!empty($mobile_menu_text_color)) {
   $mobilemenu_styles[] = '.templaza-offcanvas, .templaza-mobilemenu, .menu_open .menu-indicator-back .fas { color: ' . $mobile_menu_text_color . ' !important;}';
}
if (!empty($mobile_link_color)) {
   $mobilemenu_styles[] = '.templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-item a, .templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-indicator .menu-item .fas{ color: ' . $mobile_link_color . ' !important;}';
}
if (!empty($off_canvas_button_color_close)) {
	$mobilemenu_styles[] = '.templaza-offcanvas .burger-menu-button .inner, .templaza-offcanvas .burger-menu-button .inner::before, .templaza-offcanvas .burger-menu-button .inner::after, .templaza-mobilemenu-open .burger-menu-button .inner, .templaza-mobilemenu-open .burger-menu-button .inner::before, .templaza-mobilemenu-open .burger-menu-button .inner::after { background-color: ' . $off_canvas_button_color_close . ' !important;}';
}
if (!empty($mobile_active_link_color)) {
   $mobilemenu_styles[] = '.templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-item.current-menu-item > a, .templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-item.current-menu-item > .nav-header, .templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-item.nav-item-active > a, .templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-item.current-menu-item > .menu-indicator .fas, .templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-item.nav-item-active .fas{ color: ' . $mobile_active_link_color . ' !important;}';
}
if (!empty($mobile_active_background_color)) {
   $mobilemenu_styles[] = '.templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-item.current-menu-item, .templaza-mobilemenu-container .templaza-mobilemenu-inner .menu-item.nav-item-active, .menu-go-back { background-color: ' . $mobile_active_background_color . ' !important;}';
}
?>

<?php
//Miscellaneous -> Contact Us
$miscellaneous          = [];
if (!empty($contact_icon_color)) {
	$miscellaneous[]    = '.templaza-contact-info i[class*="fa-"]{color:' . $contact_icon_color . ' !important;}';
}
//if (!empty($social_icon_color)) {
//	$miscellaneous[]    = '.templaza-social-icons > li a{color:'.$social_icon_color.' !important;}';
//}
//if (!empty($social_icon_color_hover)) {
//	$miscellaneous[]    = '.templaza-social-icons > li a:hover{color:'.$social_icon_color_hover.' !important;}';
//}
?>

<?php
//Extensions
//$extensions             = [];
//if (!empty($hikacart_icon_color)) {
//	$extensions[]       = 'a.jollyany-hikacart-icon i[class*="fa-"]{color:' . $hikacart_icon_color . ' !important;}';
//}
//if (!empty($login_icon_color)) {
//	$extensions[]       = 'a.jollyany-login-icon i[class*="fa-"]{color:' . $login_icon_color . ' !important;}';
//}
//if (!empty($menu_icon_color)) {
//	$extensions[]       = 'a#jollyany-dropdownmenu i[class*="fa-"]{color:' . $menu_icon_color . ' !important;}';
//}
?>

<?php
Templates::add_inline_style(implode('', $body_styles));
Templates::add_inline_style(implode('', $header_styles));
Templates::add_inline_style(implode('', $main_menu_styles));
Templates::add_inline_style(implode('', $sticky_menu_styles));
Templates::add_inline_style(implode('', $dropdown_styles));
Templates::add_inline_style(implode('', $mobilemenu_styles));
Templates::add_inline_style(implode('', $miscellaneous));
//Templates::add_inline_style(implode('', $extensions));

?>