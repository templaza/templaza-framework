<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

$menu    = isset($atts['nav_menu'])?$atts['nav_menu']:'';
if ($menu){
//    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
//    // Get menu.
//    $nav_menu = ! empty( $menu ) ? wp_get_nav_menu_object( $menu ) : false;
    if(get_the_ID() == 186){
//        var_dump($nav_menu);
    }


    $type = 'WP_Nav_Menu_Widget';
    $args = array();

    global $wp_widget_factory;
    // to avoid unwanted warnings let's check before using widget
    if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
        ?>

<div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
    echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
    <aside id="widget-area-<?php echo $atts['id']; ?>" class="widget-area">
    <?php
//        ob_start();
        the_widget( $type, $atts, $args );
//        $output .= ob_get_clean();
    } ?>
    </aside>
</div>
        <?php

//    $nav_menu_args = array(
//        'fallback_cb' => '',
//        'menu'        => $nav_menu,
//    );
//
//    wp_nav_menu( $nav_menu );
//    ?>
<!--    <div--><?php //echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?><!-- class="--><?php
//    echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?><!--">-->
<!--        <aside id="widget-area---><?php //echo $atts['id']; ?><!--" class="widget-area">-->
<!--        --><?php //dynamic_sidebar($sidebar); ?>
<!--        </aside>-->
<!--    </div>-->
<!--    <div class="menu">Menu</div>-->
<!--<aside id="widget-area-831600074697460" class="widget-area">-->
<!--    <div class="widget widget_nav_menu">-->
<!--        <div class="widget-content">-->
<!--            <h3 class="widget-title subheading heading-size-3">User Links</h3>-->
<!--            <div class="menu-userlinks-container"><ul id="menu-userlinks" class="menu"><li id="menu-item-2647" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-74 current_page_item menu-item-2647"><a href="http://wordpress.templaza.com/duongtv/templaza-framework/" aria-current="page">Home page</a></li>-->
<!--                    <li id="menu-item-2648" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2648"><a href="http://wordpress.templaza.com/duongtv/templaza-framework/about-v2/">About v2</a></li>-->
<!--                    <li id="menu-item-2649" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2649"><a href="http://wordpress.templaza.com/duongtv/templaza-framework/portfolio/">Portfolio</a></li>-->
<!--                    <li id="menu-item-2650" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2650"><a href="#">Contact</a></li>-->
<!--                </ul></div></div></div>-->
<!--</aside>-->
    <?php
}
?>
