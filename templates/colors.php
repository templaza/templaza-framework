<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use \TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options = Functions::get_theme_options();
$header_options    = Functions::get_header_options();
// Body
$body_css               = '';
$body_text_color        = isset($options['body-text-color'])?$options['body-text-color']:'';
$body_text_color        = CSS::make_color_rgba_redux($body_text_color);
$body_css              .= !empty($body_text_color)?'color:'.$body_text_color.';':'';

$body_link_color        = isset($options['body-link-color'])?$options['body-link-color']:'';
$body_link_color        = CSS::make_color_rgba_redux($body_link_color);

$body_heading_color     = isset($options['body-heading-color'])?$options['body-heading-color']:'';
$body_heading_color     = CSS::make_color_rgba_redux($body_heading_color);

$body_link_hover_color  = isset($options['body-link-hover-color'])?$options['body-link-hover-color']:'';
$body_link_hover_color  = CSS::make_color_rgba_redux($body_link_hover_color);

$body_background_color  = isset($options['body-background-color'])?$options['body-background-color']:'';
$body_background_color  = CSS::make_color_rgba_redux($body_background_color);
$body_css              .= !empty($body_background_color)?'background-color:'.$body_background_color.';':'';

$body_background_image  = isset($options['body-background-image'])?$options['body-background-image']:'';
if(is_array($body_background_image) && !empty($body_background_image['background-image'])) {
    $body_css   .= CSS::background('', $body_background_image['background-image'],
        $body_background_image['background-repeat'], $body_background_image['background-attachment'],
        $body_background_image['background-position'], $body_background_image['background-size'] );
}

// Header
$header_background_color    = isset($options['header-bg'])?$options['header-bg']:'';
$header_background_color    = CSS::make_color_rgba_redux($header_background_color);

$header_text_color          = isset($options['header-text-color'])?$options['header-text-color']:'';
$header_text_color          = CSS::make_color_rgba_redux($header_text_color);

$header_heading_color       = isset($options['header-heading-color'])?$options['header-heading-color']:'';
$header_heading_color       = CSS::make_color_rgba_redux($header_heading_color);

$header_link_color          = isset($options['header-link-color'])?$options['header-link-color']:'';
$header_link_color          = CSS::make_color_rgba_redux($header_link_color);

$header_link_hover_color    = isset($options['header-link-hover-color'])?$options['header-link-hover-color']:'';
$header_link_hover_color    = CSS::make_color_rgba_redux($header_link_hover_color);

$header_logo_text_color     = isset($options['header-logo-text-color'])?$options['header-logo-text-color']:'';
$header_logo_text_color     = CSS::make_color_rgba_redux($header_logo_text_color);

$header_logo_text_tagline_color     = isset($options['header-logo-text-tagline-color'])?$options['header-logo-text-tagline-color']:'';
$header_logo_text_tagline_color     = CSS::make_color_rgba_redux($header_logo_text_tagline_color);

$sticky_header_background_color     = isset($options['sticky-header-background-color'])?$options['sticky-header-background-color']:'';
$sticky_header_background_color     = CSS::make_color_rgba_redux($sticky_header_background_color);

$topbar_bordercolor         = isset($options['topbar-bordercolor'])?$options['topbar-bordercolor']:'';
$topbar_bordercolor         = CSS::make_color_rgba_redux($topbar_bordercolor);

$header_iconcolor         = isset($options['header-icon-color'])?$options['header-icon-color']:'';
$header_iconcolor         = CSS::make_color_rgba_redux($header_iconcolor);
$header_iconsize         = isset($header_options['header-icon-size'])?$header_options['header-icon-size']:'';


// Main Menu
$main_link_color            = isset($options['main-menu-link-color'])?$options['main-menu-link-color']:'';
$main_link_color            = CSS::make_color_rgba_redux($main_link_color);

$main_link_hover_color      = isset($options['main-menu-link-hover-color'])?$options['main-menu-link-hover-color']:'';
$main_link_hover_color      = CSS::make_color_rgba_redux($main_link_hover_color);

$main_link_active_color     = isset($options['main-menu-link-active-color'])?$options['main-menu-link-active-color']:'';
$main_link_active_color     = CSS::make_color_rgba_redux($main_link_active_color);

$main_link_border_active_color     = isset($options['main-menu-border-color'])?$options['main-menu-border-color']:'';
$main_link_border_active_color     = CSS::make_color_rgba_redux($main_link_active_color);

$sidebar_separate_color     = isset($options['sidebar-separate-color'])?$options['sidebar-separate-color']:'';
$sidebar_separate_color     = CSS::make_color_rgba_redux($sidebar_separate_color);

// Sticky Menu
$sticky_link_color          = isset($options['sticky-menu-link-color'])?$options['sticky-menu-link-color']:'';
$sticky_link_color          = CSS::make_color_rgba_redux($sticky_link_color);

$sticky_link_hover_color    = isset($options['sticky-menu-link-hover-color'])?$options['sticky-menu-link-hover-color']:'';
$sticky_link_hover_color    = CSS::make_color_rgba_redux($sticky_link_hover_color);

$sticky_link_active_color   = isset($options['sticky-menu-link-active-color'])?$options['sticky-menu-link-active-color']:'';
$sticky_link_active_color   = CSS::make_color_rgba_redux($sticky_link_active_color);

// Dropdown Menu
$dropdown_main_background_color     = isset($options['dropdown-menu-background-color'])?$options['dropdown-menu-background-color']:'';
$dropdown_main_background_color     = CSS::make_color_rgba_redux($dropdown_main_background_color);

$dropdown_main_link_color           = isset($options['dropdown-menu-link-color'])?$options['dropdown-menu-link-color']:'';
$dropdown_main_link_color           = CSS::make_color_rgba_redux($dropdown_main_link_color);

$dropdown_main_hover_link_color     = isset($options['dropdown-menu-link-hover-color'])?$options['dropdown-menu-link-hover-color']:'';
$dropdown_main_hover_link_color     = CSS::make_color_rgba_redux($dropdown_main_hover_link_color);

$dropdown_main_hover_background_color   = isset($options['dropdown-menu-hover-bg-color'])?$options['dropdown-menu-hover-bg-color']:'';
$dropdown_main_hover_background_color   = CSS::make_color_rgba_redux($dropdown_main_hover_background_color);

$dropdown_main_active_link_color        = isset($options['dropdown-menu-link-active-color'])?$options['dropdown-menu-link-active-color']:'';
$dropdown_main_active_link_color        = CSS::make_color_rgba_redux($dropdown_main_active_link_color);

$dropdown_main_active_background_color  = isset($options['dropdown-menu-active-bg-color'])?$options['dropdown-menu-active-bg-color']:'';
$dropdown_main_active_background_color  = CSS::make_color_rgba_redux($dropdown_main_active_background_color);

// Mobile OffCanvas
$mobile_background_color        = isset($options['off-canvas-background-color'])?$options['off-canvas-background-color']:'';
$mobile_background_color        = CSS::make_color_rgba_redux($mobile_background_color);

$mobile_link_color              = isset($options['off-canvas-mobile-menu-link-color'])?$options['off-canvas-mobile-menu-link-color']:'';
$mobile_link_color              = CSS::make_color_rgba_redux($mobile_link_color);

$mobile_menu_text_color         = isset($options['off-canvas-mobile-menu-text-color'])?$options['off-canvas-mobile-menu-text-color']:'';
$mobile_menu_text_color         = CSS::make_color_rgba_redux($mobile_menu_text_color);

$off_canvas_button_color        = isset($options['off-canvas-button-color'])?$options['off-canvas-button-color']:'';
$off_canvas_button_color        = CSS::make_color_rgba_redux($off_canvas_button_color);

$sticky_off_canvas_button_color = isset($options['sticky-off-canvas-button-color'])?$options['sticky-off-canvas-button-color']:'';
$sticky_off_canvas_button_color = CSS::make_color_rgba_redux($sticky_off_canvas_button_color);

$sticky_icon_color = isset($options['sticky-icon-color'])?$options['sticky-icon-color']:'';
$sticky_icon_color = CSS::make_color_rgba_redux($sticky_icon_color);

$off_canvas_button_color_close  = isset($options['off-canvas-button-color-close'])?$options['off-canvas-button-color-close']:'';
$off_canvas_button_color_close  = CSS::make_color_rgba_redux($off_canvas_button_color_close);

$mobile_active_link_color       = isset($options['off-canvas-mobile-menu-link-color'])?$options['off-canvas-mobile-menu-link-color']:'';
$mobile_active_link_color       = CSS::make_color_rgba_redux($mobile_active_link_color);

$mobile_active_background_color = isset($options['off-canvas-mobile-menu-active-bg-color'])?$options['off-canvas-mobile-menu-active-bg-color']:'';
$mobile_active_background_color = CSS::make_color_rgba_redux($mobile_active_background_color);

//$mobile_background_color = $template->params->get('mobile_backgroundcolor', '');
//$mobile_link_color = $template->params->get('mobile_menu_link_color', '');
//$mobile_menu_text_color = $template->params->get('mobile_menu_text_color', '');
//$off_canvas_button_color = $template->params->get('off_canvas_button_color', '');
//$sticky_off_canvas_button_color = $template->params->get('sticky_off_canvas_button_color', '');
//$off_canvas_button_color_close = $template->params->get('off_canvas_button_color_close', '');
//$mobile_active_link_color = $template->params->get('mobile_menu_active_link_color', '');
//$mobile_active_background_color = $template->params->get('mobile_menu_active_bg_color', '');

//Miscellaneous -> Contact Us
$contact_icon_color     = isset($options['contact-icon-color'])?$options['contact-icon-color']:'';
$contact_icon_color     = CSS::make_color_rgba_redux($contact_icon_color);

//$icon_color = $template->params->get('icon_color', '');

// Chưa có options cần xem xét
//$social_icon_color = $template->params->get('social_icon_color', '');
//$social_icon_color_hover = $template->params->get('social_icon_color_hover', '');

//Extensions
//$hikacart_icon_color = $template->params->get('hikacart_icon_color', '');
//$login_icon_color = $template->params->get('login_icon_color', '');
//$menu_icon_color = $template->params->get('dropdownmenu_icon_color', '');

$button_css             = '';
$button_color           = isset($options['button-color'])?$options['button-color']:'';
$button_color_hover     = isset($options['button-color-hover'])?$options['button-color-hover']:'';
$button_bg_color        = isset($options['button-background-color'])?$options['button-background-color']:'';
$button_bg_color_hover  = isset($options['button-background-color-hover'])?$options['button-background-color-hover']:'';

$button_color           = CSS::make_color_rgba_redux($button_color);
$button_bg_color        = CSS::make_color_rgba_redux($button_bg_color);
$button_color_hover     = CSS::make_color_rgba_redux($button_color_hover);
$button_bg_color_hover  = CSS::make_color_rgba_redux($button_bg_color_hover);

$button_css             = !empty($button_color)?'color:'.$button_color.';':'';
$button_css            .= !empty($button_bg_color)?'background-color:'.$button_bg_color.';':'';
$button_css             = !empty($button_css)?'form input[type="submit"], form button{'.$button_css.'}':'';
Templates::add_inline_style($button_css);
$button_css             = '';
$button_css            .= !empty($button_color_hover)?'color:'.$button_color_hover.';':'';
$button_css            .= !empty($button_bg_color_hover)?'background-color:'.$button_bg_color_hover.';':'';
$button_css             = !empty($button_css)?'form input[type="submit"]:hover, form button:hover{'.$button_css.'}':'';
Templates::add_inline_style($button_css);

$woo_css             = '';
$woo_icon_color           = isset($options['woo-catalog-icon-color'])?$options['woo-catalog-icon-color']:'';
$woo_icon_color_hover     = isset($options['woo-catalog-icon-color-hover'])?$options['woo-catalog-icon-color-hover']:'';
$woo_icon_bg_color        = isset($options['woo-catalog-icon-bg-color'])?$options['woo-catalog-icon-bg-color']:'';
$woo_icon_bg_color_hover  = isset($options['woo-catalog-icon-bg-color-hover'])?$options['woo-catalog-icon-bg-color-hover']:'';

$woo_icon_color           = CSS::make_color_rgba_redux($woo_icon_color);
$woo_icon_bg_color        = CSS::make_color_rgba_redux($woo_icon_bg_color);
$woo_icon_color_hover     = CSS::make_color_rgba_redux($woo_icon_color_hover);
$woo_icon_bg_color_hover  = CSS::make_color_rgba_redux($woo_icon_bg_color_hover);


$woo_css             = !empty($woo_icon_color)?'color:'.$woo_icon_color.';':'';
$woo_css            .= !empty($woo_icon_bg_color)?'background-color:'.$woo_icon_bg_color.';':'';
$woo_css             = !empty($woo_css)?'ul.products li.product .product-thumbnail .product-loop__buttons .tz-loop-button{'.$woo_css.'}':'';
Templates::add_inline_style($woo_css);
$woo_css             = '';
$woo_css            .= !empty($woo_icon_color_hover)?'color:'.$woo_icon_color_hover.';':'';
$woo_css            .= !empty($woo_icon_bg_color_hover)?'background-color:'.$woo_icon_bg_color_hover.';':'';
$woo_css             = !empty($woo_css)?'ul.products li.product .product-thumbnail .product-loop__buttons .tz-loop-button:hover{'.$woo_css.'}':'';
Templates::add_inline_style($woo_css);
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
if (!empty($header_iconcolor)) {
	$header_styles[]    = 'header .header-icon i{color:'.$header_iconcolor.';}';
	$header_styles[]    = 'header .header-icon svg{fill:'.$header_iconcolor.';}';
}
if (!empty($header_iconsize)) {
	$header_styles[]    = 'header .header-icon i, .templaza-header-sticky .header-icon i{font-size:'.$header_iconsize.';}';
	$header_styles[]    = 'header .header-icon svg, .templaza-header-sticky .header-icon svg{width:'.$header_iconsize.';}';
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
if (!empty($main_link_border_active_color)) {
   $main_menu_styles[] = '.templaza-nav .menu-item.current-menu-item > a, .templaza-nav .menu-item > a:hover, .templaza-nav .menu-item > a:focus{ border-color: ' . $main_link_border_active_color . ' !important;}';
   $main_menu_styles[] = '.templaza-sidebar-menu .menu-item.current-menu-item > a, .templaza-sidebar-menu .menu-item > a:hover, .templaza-sidebar-menu .menu-item > a:focus{ border-color: ' . $main_link_border_active_color . ' !important;}';
}
if (!empty($off_canvas_button_color)) {
   $main_menu_styles[] = '.burger-menu-button .inner, .burger-menu-button .inner::before, .burger-menu-button .inner::after { background-color: ' . $off_canvas_button_color . ' !important;}';
}
if (!empty($sidebar_separate_color)) {
	$main_menu_styles[] = '.templaza-sidebar-menu li { border-color: ' . $sidebar_separate_color . ' !important;}';
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
if (!empty($sticky_icon_color)) {
	$sticky_menu_styles[] = '#templaza-sticky-header .header-icon a, #templaza-sticky-header .header-icon i { color: ' . $sticky_icon_color . ' !important;}';
}
?>

<?php
// Dropdown Coloring
$dropdown_styles = [];
if (!empty($dropdown_main_background_color)) {
   $dropdown_styles[] = '.templaza-nav .sub-menu, .header-account .account-links ul{ background: ' . $dropdown_main_background_color . ' !important;}';
}
if (!empty($dropdown_main_background_color)) {
   $dropdown_styles[] = '.has-megamenu.open .arrow{ border-bottom-color: ' . $dropdown_main_background_color . ' !important;}';
}
if (!empty($dropdown_main_link_color)) {
   $dropdown_styles[] = '.templaza-nav .sub-menu .menu-item > a, .header-account .account-links ul li a{ color: ' . $dropdown_main_link_color . ' !important;}';
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
	$miscellaneous[]    = '.templaza-contact .contact-icon{color:' . $contact_icon_color . ' !important;}';
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