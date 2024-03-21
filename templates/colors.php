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

$body_border_color  = isset($options['body-border-color'])?$options['body-border-color']:'';
$body_border_color  = CSS::make_color_rgba_redux($body_border_color);

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

$sticky_heading_color       = isset($options['sticky-heading-color'])?$options['sticky-heading-color']:'';
$sticky_heading_color       = CSS::make_color_rgba_redux($sticky_heading_color);

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
$main_link_border_active_color     = CSS::make_color_rgba_redux($main_link_border_active_color);

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

$footer_css             = '';
$footer_link_color      = isset($options['footer-link-color'])?$options['footer-link-color']:'';
$footer_link_color_hover     = isset($options['footer-link-color-hover'])?$options['footer-link-color-hover']:'';

$footer_link_color           = CSS::make_color_rgba_redux($footer_link_color);
$footer_link_color_hover        = CSS::make_color_rgba_redux($footer_link_color_hover);

$footer_css             = !empty($footer_link_color)?'color:'.$footer_link_color.';':'';
$footer_css             = !empty($footer_css)?'.templaza-footer a{'.$footer_css.'}':'';
Templates::add_inline_style($footer_css);

$footer_css             = !empty($footer_link_color_hover)?'color:'.$footer_link_color_hover.';':'';
$footer_css             = !empty($footer_css)?'.templaza-footer a:hover{'.$footer_css.'}':'';
Templates::add_inline_style($footer_css);

?>

<?php
$body_modal_bg     = isset($options['body-modal-bg'])?$options['body-modal-bg']:'';
$site_maxwidth     = isset($options['layout-maxwidth'])?$options['layout-maxwidth']:'';
$body_modal_bg     = CSS::make_color_rgba_redux($body_modal_bg);
// Body Coloring
$body_styles = [];
if (!empty($site_maxwidth)) {
    $body_styles[] = '.templaza-layout.templaza-layout-boxed .templaza-wrapper{ max-width:' . $site_maxwidth . ';}';
}
if (!empty($body_css)) {
    $body_styles[] = 'body{ ' . $body_css . '}';
}

if (!empty($body_heading_color)) {
    $body_styles[] = 'h1,h2,h3,h4,h5,h6,
    .tribe-events-view.tribe-common .tribe-events-calendar-list__event-title, 
    .tribe-events-view.tribe-common .tribe-events-calendar-list__event-date-tag-daynum,
    body .tribe-common .tribe-events-calendar-list__event-venue-title,
    .single-tribe_events .tribe-events-content h2, .single-tribe_events .tribe-events-content h3, 
    .single-tribe_events .tribe-events-content h4, .single-tribe_events .tribe-events-content h5, 
    .single-tribe_events .tribe-events-content h6, .single-tribe_events .tribe-events-event-meta h2, 
    .single-tribe_events .tribe-events-event-meta h3, .single-tribe_events .tribe-events-event-meta h4, 
    .single-tribe_events .tribe-events-event-meta h5, .single-tribe_events .tribe-events-event-meta h6
    body .tribe-events .tribe-events-calendar-list__event-title-link{color: ' . $body_heading_color . ';}';
}
if (!empty($body_link_color)) {
    $body_styles[] = 'body a{color: ' . $body_link_color . ';}';
}
if (!empty($body_link_hover_color)) {
    $body_styles[] = 'body a:hove{color: ' . $body_link_hover_color . ';}';
}
if (!empty($body_modal_bg)) {
    $body_styles[] = '.uk-modal-dialog, #ap-product-modal .uk-container{background-color: ' . $body_modal_bg . ';}';
}
if (!empty($body_text_color)) {
    $body_styles[] = '.tribe-common--breakpoint-medium.tribe-events .tribe-events-calendar-list__event-description,
    .single-tribe_events .tribe-events-content{color: ' . $body_text_color . ';}';
}
if (!empty($body_border_color)) {
    $body_styles[] = '.woocommerce-tabs>ul.tabs,
    table td, table th, .wp-block-table td, .wp-block-table th,
    .woocommerce .deal-expire-countdown .timer .digits,
    .templaza-modal .modal-header,
    table.shop_table tbody tr:not(:last-child),
    .templaza-modal .cart-panel-content.panel-content,
    .woocommerce-checkout form.checkout input[type="text"], .woocommerce-checkout form.checkout input[type="tel"],
     .woocommerce-checkout form.checkout input[type="email"],     
     .woocommerce-checkout form.checkout textarea, .woocommerce-checkout form.checkout select,
    .single-product div.product .templaza-wishlist-button .yith-wcwl-add-button,
     .single-product div.product .templaza-wishlist-button .yith-wcwl-wishlistexistsbrowse,
     .select2 span.select2-selection--single:hover, .select2.select2-container--open .select2-selection--single,
     .select2-container .select2-dropdown, .select2-container .select2-search--dropdown .select2-search__field,
     .select2 span.select2-selection--single{border-color: ' . $body_border_color . ';}';
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
if (!empty($sticky_heading_color)) {
    $header_styles[] = '.templaza-header-sticky h1,.templaza-header-sticky h2,.templaza-header-sticky h3,.templaza-header-sticky h4,.templaza-header-sticky h5,.templaza-header-sticky h6{ color: ' . $sticky_heading_color . ' !important;}';
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
   $main_menu_styles[] = '.templaza-nav > .menu-item.current-menu-item > a, .templaza-nav > .menu-item > a:hover, .templaza-nav > .menu-item > a:focus{ border-color: ' . $main_link_border_active_color . ' !important;}';
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
	$sticky_menu_styles[] = '#templaza-sticky-header .header-icon a,#templaza-sticky-header .header-icon span, #templaza-sticky-header .header-icon i { color: ' . $sticky_icon_color . ' !important;}';
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
// Blog color
$blog_quote_bg     = isset($options['blog-quote-bg-color'])?$options['blog-quote-bg-color']:'';
$blog_quote_bg     = CSS::make_color_rgba_redux($blog_quote_bg);
$blog_quote_color     = isset($options['blog-quote-color'])?$options['blog-quote-color']:'';
$blog_quote_color     = CSS::make_color_rgba_redux($blog_quote_color);
$blog_border_color     = isset($options['blog-border-color'])?$options['blog-border-color']:'';
$blog_border_color     = CSS::make_color_rgba_redux($blog_border_color);
$blog_meta_color     = isset($options['blog-meta-color'])?$options['blog-meta-color']:'';
$blog_meta_color     = CSS::make_color_rgba_redux($blog_meta_color);
$blog_meta_link_color     = isset($options['blog-meta-link-color'])?$options['blog-meta-link-color']:'';
$blog_meta_link_color     = CSS::make_color_rgba_redux($blog_meta_link_color);
$blog_author_bg_color     = isset($options['blog-author-bg-color'])?$options['blog-author-bg-color']:'';
$blog_author_bg_color     = CSS::make_color_rgba_redux($blog_author_bg_color);
$blog_author_color     = isset($options['blog-author-color'])?$options['blog-author-color']:'';
$blog_author_color     = CSS::make_color_rgba_redux($blog_author_color);
$blog_meta_link_hover_color     = isset($options['blog-meta-link-hover-color'])?$options['blog-meta-link-hover-color']:'';
$blog_meta_link_hover_color     = CSS::make_color_rgba_redux($blog_meta_link_hover_color);
$blog_author_bg_color     = isset($options['blog-author-bg-color'])?$options['blog-author-bg-color']:'';
$blog_author_bg_color     = CSS::make_color_rgba_redux($blog_author_bg_color);
$blog_author_color     = isset($options['blog-author-color'])?$options['blog-author-color']:'';
$blog_author_color     = CSS::make_color_rgba_redux($blog_author_color);

$blog_cm_bg_color     = isset($options['blog-input-cm-bg-color'])?$options['blog-input-cm-bg-color']:'';
$blog_cm_bg_color     = CSS::make_color_rgba_redux($blog_cm_bg_color);
$blog_cm_color     = isset($options['form-input-cm-color'])?$options['form-input-cm-color']:'';
$blog_cm_color     = CSS::make_color_rgba_redux($blog_cm_color);

$sidebar_bg_color     = isset($options['sidebar-bg-color'])?$options['sidebar-bg-color']:'';
$sidebar_bg_color     = CSS::make_color_rgba_redux($sidebar_bg_color);
$sidebar_widget_color     = isset($options['sidebar-heading-color'])?$options['sidebar-heading-color']:'';
$sidebar_widget_color     = CSS::make_color_rgba_redux($sidebar_widget_color);
$sidebar_widget_content_color     = isset($options['sidebar-widget-content-color'])?$options['sidebar-widget-content-color']:'';
$sidebar_widget_content_color     = CSS::make_color_rgba_redux($sidebar_widget_content_color);
$sidebar_widget_border_color     = isset($options['sidebar-widget-border-color'])?$options['sidebar-widget-border-color']:'';
$sidebar_widget_border_color     = CSS::make_color_rgba_redux($sidebar_widget_border_color);
$sidebar_post_title_color     = isset($options['sidebar-post-title-color'])?$options['sidebar-post-title-color']:'';
$sidebar_post_title_color     = CSS::make_color_rgba_redux($sidebar_post_title_color);
$sidebar_post_title_hover_color     = isset($options['sidebar-post-title-hover-color'])?$options['sidebar-post-title-hover-color']:'';
$sidebar_post_title_hover_color     = CSS::make_color_rgba_redux($sidebar_post_title_hover_color);

$sidebar_tag_bg_color     = isset($options['sidebar-tag-bg-color'])?$options['sidebar-tag-bg-color']:'';
$sidebar_tag_bg_color     = CSS::make_color_rgba_redux($sidebar_tag_bg_color);
$sidebar_tag_color     = isset($options['sidebar-tag-color'])?$options['sidebar-tag-color']:'';
$sidebar_tag_color     = CSS::make_color_rgba_redux($sidebar_tag_color);
$sidebar_tag_bg_hover_color     = isset($options['sidebar-tag-bg-hover-color'])?$options['sidebar-tag-bg-hover-color']:'';
$sidebar_tag_bg_hover_color     = CSS::make_color_rgba_redux($sidebar_tag_bg_hover_color);
$sidebar_tag_hover_color     = isset($options['sidebar-tag-hover-color'])?$options['sidebar-tag-hover-color']:'';
$sidebar_tag_hover_color     = CSS::make_color_rgba_redux($sidebar_tag_hover_color);

$form_input_bg     = isset($options['form-input-bg-color'])?$options['form-input-bg-color']:'';
$form_input_bg     = CSS::make_color_rgba_redux($form_input_bg);
$form_input_color     = isset($options['form-input-color'])?$options['form-input-color']:'';
$form_input_color     = CSS::make_color_rgba_redux($form_input_color);
$blogs          = [];
if (!empty($blog_quote_bg)) {
    $blogs[]    = '.wp-block-quote, blockquote{background-color:' . $blog_quote_bg . ';}';
}
if (!empty($blog_quote_color)) {
    $blogs[]    = '.wp-block-quote p, .wp-block-quote, blockquote {color:' . $blog_quote_color . ';}';
}
if (!empty($blog_border_color)) {
    $blogs[]    = 'div.templaza-single .templaza-blog-item-info,
    .templaza-ap-single .ap-single-box,
    .templaza-ap-single .ap-content-group-scroll,
     .templaza-single .templaza-single-share-box {border-color:' . $blog_border_color . ';}';
}
if (!empty($blog_border_color)) {
    $blogs[]    = 'body .tribe-events .tribe-events-calendar-list__month-separator:after{background-color:' . $blog_border_color . ';}';
}
if (!empty($blog_meta_color)) {
    $blogs[]    = '.templaza-archive .templaza-archive-item span {color:' . $blog_meta_color . ';}';
}
if (!empty($blog_meta_color)) {
    $blogs[]    = '.templaza-archive .templaza-archive-item span {color:' . $blog_meta_color . ';}';
}
if (!empty($blog_meta_link_color)) {
    $blogs[]    = '.templaza-archive .templaza-archive-item span a,
    .templaza-archive .templaza-archive-item span.category a,
    .templaza-archive .templaza-archive-item span.author a, 
    .templaza-archive .templaza-archive-item span.tag a{color:' . $blog_meta_link_color . ';}';
}
if (!empty($blog_meta_link_hover_color)) {
    $blogs[]    = '.templaza-archive .templaza-archive-item span a:hover, 
    .templaza-archive .templaza-archive-item span.category a:hover, 
    .templaza-archive .templaza-archive-item span.author a:hover, 
    .templaza-archive .templaza-archive-item span.tag a:hover{color:' . $blog_meta_link_hover_color . ';}';
}
if (!empty($blog_author_bg_color)) {
    $blogs[]    = ' .templaza-single .templaza-single-box.templaza-single-author{background-color:' . $blog_author_bg_color . ';}';
}
if (!empty($blog_author_color)) {
    $blogs[]    = '.templaza-archive-item span.tag a:hover{color:' . $blog_author_color . ';}';
}
if (!empty($blog_cm_bg_color)) {
    $blogs[]    = 'form.comment-form textarea{background-color:' . $blog_cm_bg_color . ';}';
}
if (!empty($blog_cm_color)) {
    $blogs[]    = 'form.comment-form textarea{color:' . $blog_cm_color . ';}';
}
if (!empty($sidebar_bg_color)) {
    $blogs[]    = 'div.templaza-sidebar,
    body .tribe-events .tribe-events-c-events-bar__search-container, 
    body .tribe-events-view.tribe-events .tribe-events-header--has-event-search .tribe-events-c-events-bar,
    .single-tribe_events .tribe-events-single .tribe-events-event-meta,
    body .tribe-events .datepicker{background-color:' . $sidebar_bg_color . ';}';
}
if (!empty($sidebar_widget_color)) {
    $blogs[]    = 'div.templaza-sidebar .widget .wp-block-heading,.woocommerce-cart .cart-collaterals .shop_table tr,
    body .tribe-events .tribe-events-calendar-list__event-title-link:visited, 
    body .tribe-events .tribe-events-calendar-list__event-title-link:focus, 
    body .tribe-events .tribe-events-calendar-list__event-title-link:active, 
    body .tribe-events .tribe-events-calendar-list__event-title-link:hover,
    body .tribe-events .tribe-events-calendar-list__event-title-link,
    .tribe-events-view.tribe-common .tribe-common-h6--min-medium,
    .single-tribe_events .tribe-events-meta-group .tribe-events-single-section-title,
    .single-tribe_events .tribe-events-single .tribe-events-event-meta.tz-single-event-price .tribe-events-cost, 
    .templaza_woo_filter-name{color:' . $sidebar_widget_color . ';}';
}
if (!empty($sidebar_widget_content_color)) {
    $blogs[]    = 'div.templaza-sidebar .widget, 
    .single-tribe_events .tribe-events-single .tribe-events-event-meta dd,
    .single-tribe_events .tribe-events-single .tribe-events-event-meta.tz-single-event-price .label,
    .single-tribe_events .tribe-events-single .tribe-events-event-meta dd a,
    div.templaza-sidebar .widget ul>li{color:' . $sidebar_widget_content_color . ';}';
}
if (!empty($sidebar_widget_border_color)) {
    $blogs[]    = 'div.templaza-sidebar .widget, 
    body .tribe-events-view.tribe-events .tribe-events-header--has-event-search .tribe-events-c-events-bar,
    .templaza-sidebar .templaza_woo_filter{border-color:' . $sidebar_widget_border_color . ';}';
}
if (!empty($sidebar_post_title_color)) {
    $blogs[]    = 'div.templaza-sidebar .wp-block-latest-posts>li>a,
    .wp-block-latest-comments .wp-block-latest-comments__comment-meta .wp-block-latest-comments__comment-link{color:' . $sidebar_post_title_color . ';}';
}
if (!empty($sidebar_post_title_hover_color)) {
    $blogs[]    = 'div.templaza-sidebar .wp-block-latest-posts>li>a:hover,
    .wp-block-latest-comments .wp-block-latest-comments__comment-meta .wp-block-latest-comments__comment-link:hover{color:' . $sidebar_post_title_hover_color . ';}';
}
if (!empty($sidebar_tag_bg_color)) {
    $blogs[]    = '.wp-block-tag-cloud a, .tagcloud a{background-color:' . $sidebar_tag_bg_color . ';}';
}
if (!empty($sidebar_tag_color)) {
    $blogs[]    = '.wp-block-tag-cloud a, .tagcloud a{color:' . $sidebar_tag_color . ';}';
}
if (!empty($sidebar_tag_bg_hover_color)) {
    $blogs[]    = '.wp-block-tag-cloud a:hover, .tagcloud a:hover{background-color:' . $sidebar_tag_bg_hover_color . ';}';
}
if (!empty($sidebar_tag_hover_color)) {
    $blogs[]    = '.wp-block-tag-cloud a:hover, .tagcloud a:hover{color:' . $sidebar_tag_hover_color . ';}';
}
if (!empty($form_input_color)) {
    $blogs[]    = 'form input,form input[type="text"],
     form input[type="email"], form input[type="password"],
     .select2-container--default .select2-selection--single .select2-selection__rendered,
     body div.wpforms-container-full .wpforms-form input[type="date"], 
     body div.wpforms-container-full .wpforms-form input[type="datetime"], 
     body div.wpforms-container-full .wpforms-form input[type="datetime-local"], 
     body div.wpforms-container-full .wpforms-form input[type="email"], 
     body div.wpforms-container-full .wpforms-form input[type="month"], 
     body div.wpforms-container-full .wpforms-form input[type="number"], 
     body div.wpforms-container-full .wpforms-form input[type="password"], 
     body div.wpforms-container-full .wpforms-form input[type="range"], 
     body div.wpforms-container-full .wpforms-form input[type="search"], 
     body div.wpforms-container-full .wpforms-form input[type="tel"], 
     body div.wpforms-container-full .wpforms-form input[type="text"], 
     body div.wpforms-container-full .wpforms-form input[type="time"], 
     body div.wpforms-container-full .wpforms-form input[type="url"], 
     body div.wpforms-container-full .wpforms-form input[type="week"], 
     body div.wpforms-container-full .wpforms-form select, 
     body div.wpforms-container-full .wpforms-form textarea,
      form textarea{color:' . $form_input_color . ';}';
}
if (!empty($form_input_bg)) {
    $blogs[]    = 'form input, form input[type="text"],
     form input[type="email"], form input[type="password"], 
     body div.wpforms-container-full .wpforms-form input[type="date"], 
     body div.wpforms-container-full .wpforms-form input[type="datetime"], 
     body div.wpforms-container-full .wpforms-form input[type="datetime-local"], 
     body div.wpforms-container-full .wpforms-form input[type="email"], 
     body div.wpforms-container-full .wpforms-form input[type="month"], 
     body div.wpforms-container-full .wpforms-form input[type="number"], 
     body div.wpforms-container-full .wpforms-form input[type="password"], 
     body div.wpforms-container-full .wpforms-form input[type="range"], 
     body div.wpforms-container-full .wpforms-form input[type="search"], 
     body div.wpforms-container-full .wpforms-form input[type="tel"], 
     body div.wpforms-container-full .wpforms-form input[type="text"],
     body div.wpforms-container-full .wpforms-form input[type="time"], 
     body div.wpforms-container-full .wpforms-form input[type="url"], 
     body div.wpforms-container-full .wpforms-form input[type="week"], 
     body div.wpforms-container-full .wpforms-form select, 
     body div.wpforms-container-full .wpforms-form textarea,
     form textarea{background-color:' . $form_input_bg . ';}';
}

// Woo filter
$woo_filter_css = [];
$woo_filter_color     = isset($options['woo-filter-color'])?$options['woo-filter-color']:'';
$woo_filter_color     = CSS::make_color_rgba_redux($woo_filter_color);
$woo_filter_hover_color     = isset($options['woo-filter-hover-color'])?$options['woo-filter-hover-color']:'';
$woo_filter_hover_color     = CSS::make_color_rgba_redux($woo_filter_hover_color);
$woo_single_sticky_bg     = isset($options['woo-single-sticky-cart-bg'])?$options['woo-single-sticky-cart-bg']:'';
$woo_single_sticky_bg     = CSS::make_color_rgba_redux($woo_single_sticky_bg);
$woo_catalog_color     = isset($options['woo-catalog-title-color'])?$options['woo-catalog-title-color']:'';
$woo_catalog_color     = CSS::make_color_rgba_redux($woo_catalog_color);
$woo_catalog_meta_color     = isset($options['woo-catalog-meta-color'])?$options['woo-catalog-meta-color']:'';
$woo_catalog_meta_color     = CSS::make_color_rgba_redux($woo_catalog_meta_color);
$woo_quantity_bg     = isset($options['woo-single-quantity-background'])?$options['woo-single-quantity-background']:'';
$woo_quantity_bg     = CSS::make_color_rgba_redux($woo_quantity_bg);
$woo_quantity_color     = isset($options['woo-single-quantity-color'])?$options['woo-single-quantity-color']:'';
$woo_quantity_color     = CSS::make_color_rgba_redux($woo_quantity_color);
$woo_modal_bg_color     = isset($options['woo-modal-bg-color'])?$options['woo-modal-bg-color']:'';
$woo_modal_bg_color     = CSS::make_color_rgba_redux($woo_modal_bg_color);
$woo_cart_link_color     = isset($options['woo-cart-link-color'])?$options['woo-cart-link-color']:'';
$woo_cart_link_color     = CSS::make_color_rgba_redux($woo_cart_link_color);
$woo_cart_link_hover_color     = isset($options['woo-cart-link-hover-color'])?$options['woo-cart-link-hover-color']:'';
$woo_cart_link_hover_color     = CSS::make_color_rgba_redux($woo_cart_link_hover_color);
$woo_checkout_label_color     = isset($options['woo-checkout-label-color'])?$options['woo-checkout-label-color']:'';
$woo_checkout_label_color     = CSS::make_color_rgba_redux($woo_checkout_label_color);
$woo_checkout_sidebar_bg     = isset($options['woo-checkout-side-bg-color'])?$options['woo-checkout-side-bg-color']:'';
$woo_checkout_sidebar_bg     = CSS::make_color_rgba_redux($woo_checkout_sidebar_bg);
$woo_checkout_sidebar_border     = isset($options['woo-checkout-side-border-color'])?$options['woo-checkout-side-border-color']:'';
$woo_checkout_sidebar_border     = CSS::make_color_rgba_redux($woo_checkout_sidebar_border);

if (!empty($woo_filter_color)) {
    $woo_filter_css[]    = 'form input,form textarea{background-color:' . $woo_filter_color . ';}';
}
if (!empty($woo_filter_hover_color)) {
    $woo_filter_css[]    = '.products-filter--checkboxes .products-filter__option.selected>.products-filter__option-name,
     .products-filter--checkboxes .products-filter__option:hover>.products-filter__option-name,
     .products-filter--ranges .products-filter__option.selected>.products-filter__option-name,
     .products-filter--ranges .products-filter__option:hover>.products-filter__option-name{color:' . $woo_filter_hover_color . ';}';
}
if (!empty($woo_single_sticky_bg)) {
    $woo_filter_css[]    = '.templaza-sticky-add-to-cart{background-color:' . $woo_single_sticky_bg . ';}';
}
if (!empty($woo_catalog_color)) {
    $woo_filter_css[]    = 'ul.products li.product .woocommerce-loop-product__title,
     .woocommerce-tabs>ul.tabs>li>a,.woocommerce-tabs>ul.tabs>li >a:hover,
     .single-product div.product .product_meta .label,
     .single-product-extra-content strong,
     .widget_shopping_cart_content .woocommerce-mini-cart-item__name a,
     .single-product div.product.product-type-variable form.cart .variations td.label,
     .single-product div.product .woocommerce-Reviews ol.commentlist li .woocommerce-review__author,
     .single-product div.product .woocommerce-Reviews .comment-respond .comment-reply-title,
      .woocommerce-tabs>ul.tabs>li.active>a, .templaza-sticky-add-to-cart__content-title{color:' . $woo_catalog_color . ';}';
}
if (!empty($woo_catalog_meta_color)) {
    $woo_filter_css[]    = 'ul.products li.product .meta-cat, .single-product div.product .product_meta>span a:not(:hover){color:' . $woo_catalog_meta_color . ';}';
}
if (!empty($woo_quantity_bg)) {
    $woo_filter_css[]    = '.product-qty-number .quantity, .product-qty-number .quantity .templaza-qty-button:before{background-color:' . $woo_quantity_bg . ';}';
}
if (!empty($woo_quantity_color)) {
    $woo_filter_css[]    = '.product-qty-number .quantity,
    .single-product div.product .templaza-wishlist-button .yith-wcwl-add-button i,
     .single-product div.product .templaza-wishlist-button .yith-wcwl-wishlistexistsbrowse i,
     .product-qty-number .quantity .qty{color:' . $woo_quantity_color . ';}';
}

if (!empty($woo_modal_bg_color)) {
    $woo_filter_css[]    = '.templaza-modal .cart-panel-content.panel-content,
    .templaza-modal .modal-content, .templaza-modal .modal-header,
    .quick-view-modal .woocommerce .product,
     .templaza-modal .widget_shopping_cart_content .widget_shopping_cart_footer{background-color:' . $woo_modal_bg_color . ';}';
}
if (!empty($woo_cart_link_color)) {
    $woo_filter_css[]    = '.woocommerce-cart .cart-collaterals .wc-proceed-to-checkout .continue-button,
    .woocommerce-cart table.shop_table .product-remove .remove{color:' . $woo_cart_link_color . ';}';
}
if (!empty($woo_cart_link_hover_color)) {
    $woo_filter_css[]    = '.woocommerce-cart table.shop_table .product-remove .remove:hover,
    .woocommerce-cart .cart-collaterals .wc-proceed-to-checkout .continue-button:hover{color:' . $woo_cart_link_hover_color . ';}';
}
if (!empty($woo_checkout_label_color)) {
    $woo_filter_css[] = '.woocommerce-checkout form.checkout .form-row label,
    .woocommerce-checkout .checkout-form-col .woocommerce-info a,
    .woocommerce-checkout .woocommerce-checkout-payment input[type="radio"]:checked+label,
    table.shop_table thead th,
    .woocommerce-checkout .woocommerce-checkout-review-order-table tfoot td, 
    .woocommerce-checkout .woocommerce-checkout-review-order-table tfoot th,
    .select2-container.select2-container--default .select2-results__option[data-selected=true],
    .select2-container .select2-results__options .select2-results__option--highlighted,
    .select2-container .select2-results__options .select2-results__option[aria-selected=true]
    {color:' . $woo_checkout_label_color . ';}';
}
if (!empty($woo_checkout_label_color)) {
    $woo_filter_css[]    = '.woocommerce-checkout .woocommerce-checkout-payment input[type="radio"]+label:after
    {background-color:' . $woo_checkout_label_color . ';}';
}
if (!empty($woo_checkout_sidebar_border)) {
    $woo_filter_css[]    = '.woocommerce-checkout .woocommerce-checkout-review-order-table tfoot td, 
    .woocommerce-checkout .woocommerce-checkout-review-order-table tfoot th,
    .woocommerce-checkout .woocommerce-checkout-review-order-table thead th,
    .woocommerce-checkout .woocommerce-checkout-review-order-table,
    .woocommerce-checkout .woocommerce-checkout-payment input[type="radio"]:checked+label:before
    {border-color:' . $woo_checkout_sidebar_border . ';}';
}
if (!empty($woo_checkout_sidebar_bg)) {
    $woo_filter_css[]    = '
    .woocommerce-checkout .checkout-form-cols,
    .woocommerce-error,
    .woocommerce-checkout .tz-shop-order-wrap,
    .select2-container .select2-dropdown, .select2-container .select2-search--dropdown .select2-search__field,
     .woocommerce-cart .cart-collaterals .cart_totals{background-color:' . $woo_checkout_sidebar_bg . ';}';
}

// Woo filter
$advanced_product_css = [];
$ap_title_color     = isset($options['ap-archive-title-color'])?$options['ap-archive-title-color']:'';
$ap_title_color     = CSS::make_color_rgba_redux($ap_title_color);
if (!empty($ap_title_color)) {
    $advanced_product_css[]    = '
    .ap-item .ap-title a, .templaza-ap-single .ap-content-group-scroll .ap-scroll-item{color:' . $ap_title_color . ';}';
}
$ap_title_hover_color     = isset($options['ap-archive-title-hover-color'])?$options['ap-archive-title-hover-color']:'';
$ap_title_hover_color     = CSS::make_color_rgba_redux($ap_title_hover_color);
if (!empty($ap_title_hover_color)) {
    $advanced_product_css[]    = '
    .ap-item .ap-title a:hover{color:' . $ap_title_color . ';}';
}

$ap_icon_bg     = isset($options['ap-icon-bg'])?$options['ap-icon-bg']:'';
$ap_icon_bg     = CSS::make_color_rgba_redux($ap_icon_bg);
if (!empty($ap_icon_bg)) {
    $advanced_product_css[]    = '
    .ap-button-info .ap-button,.templaza-ap-single .ap-single-button-wrap .ap-btn,
    .templaza-ap-single .ap-single-button-wrap .ap-btn .ap-share-item{background-color:' . $ap_icon_bg . ';}';
}
$ap_icon_color     = isset($options['ap-icon-color'])?$options['ap-icon-color']:'';
$ap_icon_color     = CSS::make_color_rgba_redux($ap_icon_color);
if (!empty($ap_icon_color)) {
    $advanced_product_css[]    = '
    .ap-button-info .ap-button{color:' . $ap_icon_color . ';}';
}

$ap_icon_hover_bg     = isset($options['ap-icon-hover-bg'])?$options['ap-icon-hover-bg']:'';
$ap_icon_hover_bg     = CSS::make_color_rgba_redux($ap_icon_hover_bg);
if (!empty($ap_icon_hover_bg)) {
    $advanced_product_css[]    = '
    .ap-button-info .ap-button:hover,
    .templaza-ap-single .ap-single-button-wrap .ap-btn:hover, 
    .templaza-ap-single .ap-single-button-wrap .ap-btn.ap-in-compare-list{background-color:' . $ap_icon_hover_bg . ';}';
}
$ap_icon_hover_color     = isset($options['ap-icon-hover-color'])?$options['ap-icon-hover-color']:'';
$ap_icon_hover_color     = CSS::make_color_rgba_redux($ap_icon_hover_color);
if (!empty($ap_icon_hover_color)) {
    $advanced_product_css[]    = '
    .ap-button-info .ap-button:hover{color:' . $ap_icon_hover_color . ';}';
}
$ap_icon_border_color     = isset($options['ap-icon-border-color'])?$options['ap-icon-border-color']:'';
$ap_icon_border_color     = CSS::make_color_rgba_redux($ap_icon_border_color);
if (!empty($ap_icon_border_color)) {
    $advanced_product_css[]    = '
    .ap-button-info .ap-button{border-color:' . $ap_icon_border_color . ';}';
}

$ap_field_label_color     = isset($options['ap-field-label-color'])?$options['ap-field-label-color']:'';
$ap_field_label_color     = CSS::make_color_rgba_redux($ap_field_label_color);
if (!empty($ap_field_label_color)) {
    $advanced_product_css[]    = '
    .ap-field-label{color:' . $ap_field_label_color . ';}';
}
$ap_field_value_color     = isset($options['ap-field-value-color'])?$options['ap-field-value-color']:'';
$ap_field_value_color     = CSS::make_color_rgba_redux($ap_field_value_color);
if (!empty($ap_field_value_color)) {
    $advanced_product_css[]    = '
    .ap-spec-value{color:' . $ap_field_value_color . ' !important;}';
}
$ap_price_color     = isset($options['ap-price-color'])?$options['ap-price-color']:'';
$ap_price_color     = CSS::make_color_rgba_redux($ap_price_color);
if (!empty($ap_price_color)) {
    $advanced_product_css[]    = '
    .ap-item .ap-price{color:' . $ap_price_color . ' !important;}';
}
$ap_price_msrp_color     = isset($options['ap-price-msrp-color'])?$options['ap-price-msrp-color']:'';
$ap_price_msrp_color     = CSS::make_color_rgba_redux($ap_price_msrp_color);
if (!empty($ap_price_msrp_color)) {
    $advanced_product_css[]    = '
    .ap-item .ap-price .ap-price-msrp,
    .ap-item.ap-item-style1 .ap-inner .ap-price-box .ap-price-msrp{color:' . $ap_price_msrp_color . ' !important;}';
}
$ap_item_footer_border     = isset($options['ap-item-footer-border'])?$options['ap-item-footer-border']:'';
$ap_item_footer_border     = CSS::make_color_rgba_redux($ap_item_footer_border);
if (!empty($ap_item_footer_border)) {
    $advanced_product_css[]    = '
    .ap-item .ap-inner .ap-info-inner.ap-info-bottom,
    .ap-item.ap-item-style5 .ap-inner .ap-info-inner.ap-info-bottom,
    div.ap-item.ap-item-style5.ap-item-list .ap-inner .ap-info-inner.ap-info-bottom,
    .ap-item.ap-item-style2 .ap-inner .ap-info-inner.ap-info-bottom{border-color:' . $ap_item_footer_border . ' ;}';
}
$ap_meta_color     = isset($options['ap-meta-color'])?$options['ap-meta-color']:'';
$ap_meta_color     = CSS::make_color_rgba_redux($ap_meta_color);
if (!empty($ap_meta_color)) {
    $advanced_product_css[]    = '
    .ap-item.ap-item-style1 .ap-inner .ap-price-box .ap-unit{color:' . $ap_meta_color . ' ;}';
}
$ap_filter_label     = isset($options['ap-filter-label-color'])?$options['ap-filter-label-color']:'';
$ap_filter_label     = CSS::make_color_rgba_redux($ap_filter_label);
if (!empty($ap_filter_label)) {
    $advanced_product_css[]    = '
    .advanced-product-search-form label.search-label{color:' . $ap_filter_label . ' ;}';
}
$ap_filter_input_border     = isset($options['ap-filter-input-border'])?$options['ap-filter-input-border']:'';
$ap_filter_input_border     = CSS::make_color_rgba_redux($ap_filter_input_border);
if (!empty($ap_filter_input_border)) {
    $advanced_product_css[]    = '
    .templaza-sidebar .advanced-product-search-form .uk-form-controls select,
    .ui-slider.ui-slider-horizontal, 
    .templaza-sidebar .advanced-product-search-form .uk-form-controls input{border-color:' . $ap_filter_input_border . ' ;}';
}
$ap_filter_bg_input     = isset($options['ap-filter-input-bg'])?$options['ap-filter-input-bg']:'';
$ap_filter_bg_input     = CSS::make_color_rgba_redux($ap_filter_bg_input);
if (!empty($ap_filter_bg_input)) {
    $advanced_product_css[]    = '
    .templaza-sidebar .advanced-product-search-form .uk-form-controls select,
    .ui-slider .ui-slider-range, 
    .templaza-sidebar .advanced-product-search-form .uk-form-controls input{background-color:' . $ap_filter_bg_input . ' ;}';
}
$ap_filter_color_input     = isset($options['ap-filter-input-color'])?$options['ap-filter-input-color']:'';
$ap_filter_color_input     = CSS::make_color_rgba_redux($ap_filter_color_input);
if (!empty($ap_filter_color_input)) {
    $advanced_product_css[]    = '
    .templaza-sidebar .advanced-product-search-form .uk-form-controls select, 
    .templaza-sidebar .advanced-product-search-form .uk-form-controls input{color:' . $ap_filter_color_input . ' ;}';
}
$ap_filter_color     = isset($options['ap-filter-color'])?$options['ap-filter-color']:'';
$ap_filter_color     = CSS::make_color_rgba_redux($ap_filter_color);
if (!empty($ap_filter_color)) {
    $advanced_product_css[]    = '
    .ap-search-max-height .ap-search-ep{color:' . $ap_filter_color . ' ;}';
}

$ap_filter_hover_color     = isset($options['ap-filter-hover-color'])?$options['ap-filter-hover-color']:'';
$ap_filter_hover_color     = CSS::make_color_rgba_redux($ap_filter_hover_color);
if (!empty($ap_filter_hover_color)) {
    $advanced_product_css[]    = '
    .ap-search-max-height .ap-search-ep:hover{color:' . $ap_filter_hover_color . ' ;}';
}

$ap_list_grid_bg     = isset($options['ap-list-grid-bg'])?$options['ap-list-grid-bg']:'';
$ap_list_grid_bg     = CSS::make_color_rgba_redux($ap_list_grid_bg);
if (!empty($ap_list_grid_bg)) {
    $advanced_product_css[]    = '
    .templaza-ap-archive-view span.switcher_btn, .templaza-ap-archive-sort select:not([multiple]):not([size]){background-color:' . $ap_list_grid_bg . ' ;}';
}
$ap_list_grid_color     = isset($options['ap-list-grid-color'])?$options['ap-list-grid-color']:'';
$ap_list_grid_color     = CSS::make_color_rgba_redux($ap_list_grid_color);
if (!empty($ap_list_grid_color)) {
    $advanced_product_css[]    = '
    .templaza-ap-archive-view span.switcher_btn, .templaza-ap-archive-sort select:not([multiple]):not([size]){color:' . $ap_list_grid_color . ' ;}';
}
$ap_list_grid_hover_bg     = isset($options['ap-list-grid-hover-bg'])?$options['ap-list-grid-hover-bg']:'';
$ap_list_grid_hover_bg     = CSS::make_color_rgba_redux($ap_list_grid_hover_bg);
if (!empty($ap_list_grid_hover_bg)) {
    $advanced_product_css[]    = '
    .templaza-ap-archive-view span.switcher_btn:hover, 
    .templaza-ap-archive-view span.switcher_btn.uk-active{background-color:' . $ap_list_grid_hover_bg . ' ;}';
}
$ap_list_grid_hover_color     = isset($options['ap-list-grid-hover-color'])?$options['ap-list-grid-hover-color']:'';
$ap_list_grid_hover_color     = CSS::make_color_rgba_redux($ap_list_grid_hover_color);
if (!empty($ap_list_grid_hover_color)) {
    $advanced_product_css[]    = '
    .templaza-ap-archive-view span.switcher_btn:hover{color:' . $ap_list_grid_hover_color . ' ;}';
}
$ap_list_grid_border     = isset($options['ap-list-grid-border'])?$options['ap-list-grid-border']:'';
$ap_list_grid_border     = CSS::make_color_rgba_redux($ap_list_grid_border);
if (!empty($ap_list_grid_border)) {
    $advanced_product_css[]    = '
    .templaza-ap-archive-view{border-color:' . $ap_list_grid_border . ' ;}';
}
$ap_list_grid_label     = isset($options['ap-list-grid-label'])?$options['ap-list-grid-label']:'';
$ap_list_grid_label     = CSS::make_color_rgba_redux($ap_list_grid_label);
if (!empty($ap_list_grid_label)) {
    $advanced_product_css[]    = '
    .templaza-ap-archive-view h3, .templaza-ap-archive-view label{color:' . $ap_list_grid_label . ' ;}';
}
$ap_single_price_bg     = isset($options['ap-single-price-bg'])?$options['ap-single-price-bg']:'';
$ap_single_price_bg     = CSS::make_color_rgba_redux($ap_single_price_bg);
if (!empty($ap_single_price_bg)) {
    $advanced_product_css[]    = '
    .templaza-ap-single .ap-single-side-box.ap-single-price-box{background-color:' . $ap_single_price_bg . ' ;}';
}
$ap_single_price_color     = isset($options['ap-single-price-color'])?$options['ap-single-price-color']:'';
$ap_single_price_color     = CSS::make_color_rgba_redux($ap_single_price_color);
if (!empty($ap_single_price_color)) {
    $advanced_product_css[]    = '
    .templaza-ap-single .ap-single-side-box .price, 
    .templaza-ap-single .ap-single-side-box .single-price-label{color:' . $ap_single_price_color . ' ;}';
}
$ap_single_sidebox_title     = isset($options['ap-single-side-box-title'])?$options['ap-single-side-box-title']:'';
$ap_single_sidebox_title     = CSS::make_color_rgba_redux($ap_single_sidebox_title);
if (!empty($ap_single_sidebox_title)) {
    $advanced_product_css[]    = '
    .templaza-ap-single .ap-single-side-box.uk-accordion .uk-accordion-title, 
    .templaza-ap-single .ap-single-side-box .widget-title{color:' . $ap_single_sidebox_title . ' ;}';
}
$ap_single_sidebox_label     = isset($options['ap-single-side-box-field-label'])?$options['ap-single-side-box-field-label']:'';
$ap_single_sidebox_label     = CSS::make_color_rgba_redux($ap_single_sidebox_label);
if (!empty($ap_single_sidebox_label)) {
    $advanced_product_css[]    = '
    ..templaza-ap-single .ap-single-side-box .field-label{color:' . $ap_single_sidebox_label . ' ;}';
}
$ap_single_sidebox_value     = isset($options['ap-single-side-box-field-value'])?$options['ap-single-side-box-field-value']:'';
$ap_single_sidebox_value     = CSS::make_color_rgba_redux($ap_single_sidebox_value);
if (!empty($ap_single_sidebox_value)) {
    $advanced_product_css[]    = '
    .templaza-ap-single .ap-single-side-box .field-value{color:' . $ap_single_sidebox_value . ' ;}';
}
$ap_single_sidebox_border     = isset($options['ap-single-side-box-border'])?$options['ap-single-side-box-border']:'';
$ap_single_sidebox_border     = CSS::make_color_rgba_redux($ap_single_sidebox_border);
if (!empty($ap_single_sidebox_border)) {
    $advanced_product_css[]    = '
    .templaza-ap-single .ap-single-side-box.ap-specs .widget-content, 
    .templaza-ap-single .templaza-block-author-social a, .templaza-ap-single .author-header{border-color:' . $ap_single_sidebox_border . ' ;}';
}
$ap_single_sidebox_author_bg     = isset($options['ap-single-side-box-author-bg'])?$options['ap-single-side-box-author-bg']:'';
$ap_single_sidebox_author_bg     = CSS::make_color_rgba_redux($ap_single_sidebox_author_bg);
if (!empty($ap_single_sidebox_author_bg)) {
    $advanced_product_css[]    = '
    .templaza-ap-single .ap-single-side-box.ap-single-author-box{background-color:' . $ap_single_sidebox_author_bg . ' ;}';
}
$ap_single_sidebox_author_title     = isset($options['ap-single-side-box-author-title'])?$options['ap-single-side-box-author-title']:'';
$ap_single_sidebox_author_title     = CSS::make_color_rgba_redux($ap_single_sidebox_author_title);
if (!empty($ap_single_sidebox_author_title)) {
    $advanced_product_css[]    = '
    .templaza-ap-single .ap-single-author-box .widget-title{color:' . $ap_single_sidebox_author_title . ' ;}';
}
$ap_single_sidebox_author_color     = isset($options['ap-single-side-box-author-color'])?$options['ap-single-side-box-author-color']:'';
$ap_single_sidebox_author_color     = CSS::make_color_rgba_redux($ap_single_sidebox_author_color);
if (!empty($ap_single_sidebox_author_color)) {
    $advanced_product_css[]    = '
    .templaza-ap-single .ap-single-author-box{color:' . $ap_single_sidebox_author_color . ' ;}';
}
$ap_single_sidebox_form_input_bg     = isset($options['ap-single-side-box-input-bg'])?$options['ap-single-side-box-input-bg']:'';
$ap_single_sidebox_form_input_bg     = CSS::make_color_rgba_redux($ap_single_sidebox_form_input_bg);
if (!empty($ap_single_sidebox_form_input_bg)) {
    $advanced_product_css[]    = '
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="date"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="datetime"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="datetime-local"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="email"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="month"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="number"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="password"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="range"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="search"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="tel"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="text"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="time"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="url"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="week"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form select, 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form textarea{background-color:' . $ap_single_sidebox_form_input_bg . ' ;}';
}
$ap_single_sidebox_form_input_color     = isset($options['ap-single-side-box-input-color'])?$options['ap-single-side-box-input-color']:'';
$ap_single_sidebox_form_input_color     = CSS::make_color_rgba_redux($ap_single_sidebox_form_input_color);
if (!empty($ap_single_sidebox_form_input_color)) {
    $advanced_product_css[]    = '
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="date"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="datetime"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="datetime-local"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="email"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="month"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="number"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="password"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="range"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="search"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="tel"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="text"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="time"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="url"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form input[type="week"], 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form select, 
    body .ap-templaza-sidebar div.wpforms-container-full .wpforms-form textarea{color:' . $ap_single_sidebox_form_input_color . ' ;}';
}

Templates::add_inline_style(implode('', $body_styles));
Templates::add_inline_style(implode('', $header_styles));
Templates::add_inline_style(implode('', $main_menu_styles));
Templates::add_inline_style(implode('', $sticky_menu_styles));
Templates::add_inline_style(implode('', $dropdown_styles));
Templates::add_inline_style(implode('', $mobilemenu_styles));
Templates::add_inline_style(implode('', $miscellaneous));
Templates::add_inline_style(implode('', $blogs));
Templates::add_inline_style(implode('', $woo_filter_css));
Templates::add_inline_style(implode('', $advanced_product_css));

?>