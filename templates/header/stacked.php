<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;
use TemPlazaFramework\CSS;

$gb_options                 = Functions::get_theme_options();
$options                    = Functions::get_header_options();

$mode           = isset($options['header-stacked-menu-mode'])?$options['header-stacked-menu-mode']:'center';
$block_1_type   = isset($options['header-block-1-type'])?$options['header-block-1-type']:'blank';
$block_1_custom = isset($options['header-block-1-custom'])?$options['header-block-1-custom']:'';
$block_2_type   = isset($options['header-block-2-type'])?$options['header-block-2-type']:'blank';
$block_2_custom = isset($options['header-block-2-custom'])?$options['header-block-2-custom']:'';

$enable_offcanvas           = isset($options['enable-offcanvas'])?filter_var($options['enable-offcanvas'], FILTER_VALIDATE_BOOLEAN):false;
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
$offcanvas_direction        = isset($options['offcanvas-direction'])?$options['offcanvas-direction']:'offcanvasDirLeft';
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'uk-display-block';

$dropdown_arrow             = isset($options['dropdown-arrow'])?filter_var($options['dropdown-arrow'], FILTER_VALIDATE_BOOLEAN):true;
$dropdown_animation_type    = isset($options['dropdown-animation-type'])?(bool) $options['dropdown-animation-type']:'fade';
$dropdown_animation_effect  = isset($options['dropdown-animation-effect'])?$options['dropdown-animation-effect']:'fade-down';
$dropdown_animation_effect  = $dropdown_animation_type === 'none'?'':$dropdown_animation_effect;
$dropdown_trigger           = isset($options['dropdown-trigger'])?$options['dropdown-trigger']:'hover';

$navClass = ['nav', 'navbar-nav', 'templaza-nav', 'uk-flex', 'uk-flex-center', 'uk-flex-middle'];
$navClassLeft = ['nav', 'navbar-nav', 'templaza-nav', 'uk-flex', 'uk-flex-left', 'uk-flex-top', 'uk-padding-remove-left'];
$navClassDivided = ['nav', 'navbar-nav', 'templaza-nav'];
$navWrapperClass = ['templaza-nav-wraper', 'uk-width', 'uk-visible@m', 'px-2'];

$header_menu                = isset($options['header-menu'])?$options['header-menu']:'header';
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;
$block_1_sidebar            = isset($options['header-block-1-sidebar'])?$options['header-block-1-sidebar']:'';
$block_2_sidebar            = isset($options['header-block-2-sidebar'])?$options['header-block-2-sidebar']:'';
$header_mobile_menu         = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'header';

$icon_position         = isset($options['stacked-icon-position'])?$options['stacked-icon-position']:'top';
$block1_position         = isset($options['header-block-1-position'])?$options['header-block-1-position']:'center';

$header_stack_divi         = isset($options['stacked-divided-background'])?filter_var($options['stacked-divided-background'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_top_bg = isset($gb_options['background-stacked-top-section'])?$gb_options['background-stacked-top-section']:'';
$header_stack_top_color = isset($gb_options['color-stacked-top-section'])?$gb_options['color-stacked-top-section']:'';
$header_stack_logo_bg = isset($gb_options['background-logo-section'])?$gb_options['background-logo-section']:'';
$header_stack_menu_bg = isset($gb_options['background-menu-section'])?$gb_options['background-menu-section']:'';
$header_stack_inner_width = isset($options['stacked-divided-inner-width'])?$options['stacked-divided-inner-width']:'none';
$header_cart = isset($gb_options['templaza-shop-mini-cart'])?$gb_options['templaza-shop-mini-cart']:'';
$header_stack_search         = isset($options['stacked-divided-search'])?filter_var($options['stacked-divided-search'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_account         = isset($options['stacked-divided-account'])?filter_var($options['stacked-divided-account'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_cart         = isset($options['stacked-divided-cart'])?filter_var($options['stacked-divided-cart'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_logo_border = isset($options['logo-section-border'])?$options['logo-section-border']:'';
$login_modals               = isset($gb_options['templaza-shop-account-login'])?$gb_options['templaza-shop-account-login']:'modal';

$search_icon_type           = isset($options['search-icon-type'])?$options['search-icon-type']:'default';
$account_icon_type          = isset($options['account-icon-type'])?$options['account-icon-type']:'default';
$cart_icon_type             = isset($options['cart-icon-type'])?$options['cart-icon-type']:'default';

$navClass[] = $dropdown_animation_effect;
$navClassLeft[] = $dropdown_animation_effect;
// Get data attributes - them added from header shortcode
$data_attribs = $menu_datas = Functions::get_attributes('header');

$data_attribs    = join(' ', array_map(function($v, $k){
    return !empty($v)?$k . '="' . $v . '"':$k;
}, $data_attribs, array_keys($data_attribs)));
$data_attribs   = ' '.$data_attribs;
$search_icon_html = '<i class="fas fa-search"></i>';
$account_icon_html = '<i class="fas fa-user"></i>';
$cart_icon_html = '<i class="fas fa-shopping-cart"></i>';
if($search_icon_type == 'fontawesome' ){
    $search_icon = isset($options['search-icon'])?$options['search-icon']:'';
    $search_icon_html = '<i class="'.$search_icon.'"></i>';
}elseif ($search_icon_type == 'custom'){
    $search_icon = isset($options['search-icon-custom'])?$options['search-icon-custom']:'';
    if($search_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($search_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $search_icon_html = '<img src="'.$search_icon['url'].'" alt="'.esc_attr__('Search','templaza-framework').'" '.$log_svg.'/>';
    }
}
if($account_icon_type == 'fontawesome' ){
    $account_icon = isset($options['account-icon'])?$options['account-icon']:'';
    $account_icon_html = '<i class="'.$account_icon.'"></i>';
}elseif ($account_icon_type == 'custom'){
    $account_icon = isset($options['account-icon-custom'])?$options['account-icon-custom']:'';
    if($account_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($account_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $account_icon_html = '<img src="'.$account_icon['url'].'" alt="'.esc_attr__('Account','templaza-framework').'" '.$log_svg.'/>';
    }
}
if($cart_icon_type == 'fontawesome' ){
    $cart_icon = isset($options['cart-icon'])?$options['cart-icon']:'';
    $cart_icon_html = '<i class="'.$account_icon.'"></i>';
}elseif ($cart_icon_type == 'custom'){
    $cart_icon = isset($options['cart-icon-custom'])?$options['cart-icon-custom']:'';
    if($account_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($cart_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $cart_icon_html = '<img src="'.$cart_icon['url'].'" alt="'.esc_attr__('Cart','templaza-framework').'" '.$log_svg.'/>';
    }
}
$header_menu_bg     = CSS::make_color_rgba_redux($header_stack_menu_bg);
$header_logo_bg     = CSS::make_color_rgba_redux($header_stack_logo_bg);
$header_stacked_top_bg     = CSS::make_color_rgba_redux($header_stack_top_bg);
$header_stacked_top_color     = CSS::make_color_rgba_redux($header_stack_top_color);
if($header_stack_divi == true) {
    $header_styles = [];
    if (!empty($header_menu_bg)) {
        $header_styles[] = '.templaza-divi-menu-wrap{background-color: ' . $header_menu_bg . ' !important;}';
    }
    if (!empty($header_logo_bg)) {
        $header_styles[] = '.templaza-divi-logo-wrap{background-color: ' . $header_logo_bg . ' !important;}';
    }
    if (!empty($header_stacked_top_bg)) {
        $header_styles[] = '.templaza-stacked-top-section{background-color: ' . $header_stacked_top_bg . ' !important;}';
    }
    if (!empty($header_stacked_top_bg)) {
        $header_styles[] = '.templaza-stacked-top-section *{color: ' . $header_stacked_top_color . ' !important;}';
    }
    Templates::add_inline_style(implode('', $header_styles));
    $header_stack_designs = array(
        array(
            'enable' => true,
            'class' => '.templaza-divi-logo-wrap, .menu-item-logo',
            'options' => array(
                'stacked-divided-top-padding',
                'logo-section-border',
            ),
        ),
        array(
            'enable' => true,
            'class' => '.templaza-stacked-top-section',
            'options' => array(
                'stacked-divided-header-top-padding',
                'stacked-top-section-border',
            ),
        ),
        array(
            'enable' => true,
            'class' => '.templaza-stacked-menu-section',
            'options' => array(
                'stacked-divided-header-menu-padding',
            ),
        ),
        array(
            'enable' => true,
            'class' => 'header form input, header form select',
            'options' => array(
                'input-border',
            ),
        ),
    );
    if (count($header_stack_designs)) {
        $styles = array();

        foreach ($header_stack_designs as $design) {
            $enable = isset($design['enable']) ? (bool)$design['enable'] : false;
            if ($enable) {
                $css_responsive = array(
                    'desktop' => '',
                    'tablet' => '',
                    'mobile' => '',
                );
                $css = Templates::make_css_design_style($design['options'], $options,$important = true);
                if (!empty($css)) {
                    if (is_array($css)) {
                        foreach ($css as $device => $stack_style) {
                            if (isset($css_responsive[$device]) && !empty($css_responsive[$device])) {
                                $stack_style .= $css_responsive[$device];
                            }
                            if (!empty($stack_style)) {
                                $stack_style = $design['class'] . '{' . $stack_style . '}';
                                Templates::add_inline_style($stack_style, $device);
                            }
                        }
                    } else {
                        Templates::add_inline_style($design['class'] . '{' . $css . '}');
                    }
                }
            }
        }
    }
}
$social_profiles    = isset($gb_options['social'])?$gb_options['social']:'';

if ($mode == 'left') {
    echo '<div class="uk-grid-match uk-grid-collapse " data-uk-grid>';
    ?>
    <div class="uk-hidden@m uk-flex uk-flex-left uk-flex-middle">
        <div class="header-mobilemenu-trigger uk-position-center-left uk-margin-left burger-menu-button uk-text-left" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
            <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
        </div>
    </div>
    <div class="uk-width-auto@m templaza-divi-logo-wrap stacked-left-logo-wrap">
        <div class="tz-stacked-left-logo uk-flex uk-flex-middle">
            <?php Templates::load_my_layout('logo'); ?>
        </div>
    </div>
    <div class="uk-width-expand@m uk-visible@m templaza-stacked-left-right">
        <?php
        if($block_1_type !='blank' || $block_2_type !='blank'){
            echo '<div class="templaza-stacked-left-top uk-grid-collapse uk-flex uk-flex-middle templaza-stacked-top-section" data-uk-grid>';
        }
        if ($block_1_type != 'blank'): ?>
            <div class=" uk-text-left uk-visible@m uk-width-auto@m">
                <?php
                if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
                    echo '<div class="header-block-item">';
                    echo '<div class="templaza-sidebar">';
                    dynamic_sidebar($block_1_sidebar);
                    echo '</div>';
                    echo '</div>';
                }
                if ($block_1_type == 'custom') {
                    echo '<div class="header-block-item">';
                    echo wp_kses($block_1_custom,'post');
                    echo '</div>';
                }
                if ($block_1_type == 'social') {
                    Templates::load_my_layout('inc.social');
                }
                if ($block_1_type == 'contact') {
                    Templates::load_my_layout('inc.contact');
                }
                ?>
            </div>
        <?php endif; ?>
        <?php if ($block_2_type != 'blank'): ?>
            <div class=" uk-text-right uk-flex uk-flex-right uk-visible@m uk-width-expand@m">
                <?php
                if ($block_2_type == 'sidebar' && is_active_sidebar($block_2_sidebar)){
                    echo '<div class="header-block-item">';
                    echo '<div class="templaza-sidebar">';
                    dynamic_sidebar($block_2_sidebar);
                    echo '</div>';
                    echo '</div>';
                }
                if ($block_2_type == 'custom') {
                    echo '<div class="header-block-item">';
                    echo wp_kses($block_2_custom,'post');
                    echo '</div>';
                }
                if ($block_2_type == 'social') {
                    Templates::load_my_layout('inc.social');
                }
                if ($block_2_type == 'contact') {
                    Templates::load_my_layout('inc.contact');
                }
                ?>
            </div>
        <?php endif;
        if($block_1_type !='blank' || $block_2_type !='blank'){
            echo '</div>';
        }
        ?>
        <div class="uk-flex uk-flex-middle uk-flex-left templaza-stacked-menu-section" <?php echo wp_kses($data_attribs,'data');?>>
            <?php
            // header nav starts
            Menu::get_nav_menu(array(
                'theme_location'  => $header_menu,
                'menu_class'      => implode(' ', $navClassLeft),
                'container_class' => implode(' ', $navWrapperClass),
                'menu_id'         => '',
                'depth'           => $header_menu_level, // Level
                'templaza_megamenu_html_data' => $menu_datas
            ));
            // header nav ends
            ?>
            <?php if ($enable_offcanvas) {
                Templates::load_my_layout('inc.icon',true,false);
                ?>
                <div class="header-offcanvas-trigger uk-margin-left burger-menu-button <?php echo esc_attr($offcanvas_togglevisibility); ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php echo esc_attr($offcanvas_animation); ?>" data-direction="<?php echo esc_attr($offcanvas_direction); ?>" >
                    <button type="button" class="button">
                         <span class="box">
                            <span class="inner"></span>
                         </span>
                    </button>
                </div>
            <?php }else{
                Templates::load_my_layout('inc.icon',true,false);
            } ?>
        </div>
    </div>

    <?php
echo '</div>';
}
?>
<div class="uk-flex">
  <div class="header-stacked-section uk-flex uk-width uk-flex-column uk-flex-between ">
     <?php
     if ($mode == 'center') {
        echo '<div class="uk-flex uk-width templaza-logo-center-wrap">';
        ?>
           <div class="uk-flex uk-flex-first uk-flex-middle uk-hidden@m">
              <div class="header-mobilemenu-trigger burger-menu-button uk-hidden@m" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
                 <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
              </div>
           </div>
        <?php
        echo '<div class="uk-flex uk-width-expand uk-flex-center templaza-logo-center-wrap">';
        Templates::load_my_layout('logo');
        echo '</div>';
        echo '</div>';
        // header nav starts -->
        ?>
        <div class="uk-flex uk-width-auto uk-flex-center uk-flex-middle templaza-center-menu-wrap uk-visible@m"<?php echo wp_kses($data_attribs,'post');?>>
            <?php if($header_stack_search){ ?>
            <div class="uk-flex uk-flex-left uk-flex-middle">
                <div class="header-search uk-position-relative header-icon">
                    <span>
                        <?php echo $search_icon_html; ?>
                    </span>
                    <form method="get" class="searchform " action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" class="field uk-input inputbox search-query uk-margin-remove-vertical" name="s" placeholder="<?php esc_attr_e( 'Search...', 'medil');?>" />
                        <button type="submit" class="submit searchsubmit has-button-icon uk-position-right" name="submit" data-uk-icon="search"></button>
                    </form>
                </div>
            </div>
            <?php } ?>
            <div class="<?php echo implode(' ', $navWrapperClass)?>">
               <?php
               Menu::get_nav_menu(array(
                   'theme_location'              => $header_menu,
                   'menu_class'                  => implode(' ', $navClass),
                   'container_class'             => implode(' ', $navWrapperClass),
                   'menu_id'                     => '',
                   'depth'                       => $header_menu_level, // Level
                   'templaza_megamenu_html_data' => $menu_datas
               ));
               ?>
            </div>
            <?php
            if ($enable_offcanvas || $header_stack_cart || $header_stack_account) {
                ?>
                <div class="uk-flex uk-flex-right uk-flex-middle">
                    <?php
                    if($header_stack_cart && class_exists( 'woocommerce' )){ ?>
                        <div class="header-cart header-icon">
                            <a href="<?php echo esc_url( wc_get_cart_url() ) ?>" data-toggle="<?php echo esc_attr($header_cart); ?>" data-target="cart-modal">
                                <?php echo $cart_icon_html; ?>
                                <span class="counter cart-counter"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
                            </a>
                        </div>
                    <?php }
                    if($header_stack_account && class_exists( 'woocommerce' )){ ?>
                    <div class="header-account header-icon">
                        <a class="account-icon" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) ?>"
                           data-toggle="<?php echo esc_attr($login_modals);?>"
                           data-target="account-modal">
                            <?php echo $account_icon_html; ?>
                        </a>
                        <?php if ( is_user_logged_in() ) : ?>
                            <div class="account-links">
                                <ul>
                                    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                                        <li class="account-link--<?php echo esc_attr( $endpoint ); ?>">
                                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="underline-hover">
                                                <?php echo esc_html( $label ); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php }
                    if ($enable_offcanvas) {
                        ?>
                        <div class="header-offcanvas-trigger burger-menu-button <?php
                        echo esc_attr($offcanvas_togglevisibility); ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php
                        echo esc_attr($offcanvas_animation); ?>" data-direction="<?php echo esc_attr($offcanvas_direction); ?>">
                            <button type="button" class="button">
                       <span class="box">
                          <span class="inner"></span>
                       </span>
                            </button>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        // header nav ends
        // header block starts
         if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
             echo '<div class="uk-flex uk-width uk-flex-center uk-visible@m header-block-item py-3">';
             echo '<ul id="sidebar">';
             dynamic_sidebar($block_1_sidebar);
             echo '</ul>';
             echo '</div>';
         }
        if ($block_1_type == 'custom') {
           echo '<div class="uk-flex uk-width uk-flex-center uk-visible@m header-block-item py-3">';
           echo wp_kses($block_1_custom,'post');
           echo '</div>';
        }

        // header block ends
     }
     if ($mode == 'seperated') {
        // header block starts
         if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
             echo '<div class="uk-flex uk-width-expand uk-flex-center uk-visible@m header-block-item py-3">';
             echo '<ul id="sidebar">';
             dynamic_sidebar($block_1_sidebar);
             echo '</ul>';
             echo '</div>';
         }
        if ($block_1_type == 'custom') {
            echo '<div class="uk-flex uk-width-expand uk-flex-center uk-visible@m header-block-item py-3">';
           echo wp_kses($block_1_custom,'post');
           echo '</div>';
        }
        // header nav starts
        ?>
        <div class="header-stacked-inner uk-flex uk-width uk-flex-center uk-flex-middle"<?php echo wp_kses($data_attribs,'post');?>>
              <div class="uk-flex uk-flex-left uk-flex-middle uk-hidden@m">
                 <div class="header-mobilemenu-trigger d-lg-none burger-menu-button" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
                    <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
                 </div>
              </div>
              <?php
           echo '<div class="uk-flex uk-width uk-flex-center">';
           echo '<div class="uk-hidden@m">';
           Templates::load_my_layout('logo', true, false);
           echo '</div>';
           ?>
                <?php
                Menu::get_nav_menu(array(
                    'theme_location'  => $header_menu,
                    'menu_class'      => implode(' ', $navClass),
                    'container_class' => implode(' ', $navWrapperClass),
                    'menu_id'         => '',
                    'depth'           => $header_menu_level, // Level
                    'templaza_is_header'          => true,
                    'templaza_megamenu_html_data' => $menu_datas
                ));
                ?>
            <?php
           echo '</div>';
           if ($enable_offcanvas) {
              ?>
              <div class="uk-flex uk-flex-right uk-flex-middle">
                 <div class="header-offcanvas-trigger burger-menu-button <?php
                 echo esc_attr($offcanvas_togglevisibility); ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php
                 echo esc_attr($offcanvas_animation); ?>" data-direction="<?php echo esc_attr($offcanvas_direction); ?>">
                    <button type="button" class="button">
                       <span class="box">
                          <span class="inner"></span>
                       </span>
                    </button>
                 </div>
              </div>
              <?php
           }
           ?>
        </div>
        <?php
        // header nav ends
        // header block starts
         if ($block_2_type == 'sidebar' && is_active_sidebar($block_2_sidebar)){
             echo '<div class="uk-flex uk-width uk-flex-center uk-visible@m block-sidebar header-block-item py-3">';
             dynamic_sidebar($block_2_sidebar);
             echo '</div>';
         }
        if ($block_2_type == 'custom') {
           echo '<div class="uk-flex uk-width uk-flex-center uk-visible@m header-block-item py-3">';
           echo wp_kses($block_2_custom,'post');
           echo '</div>';
        }
        // header block ends
     }
     if ($mode == 'divided') {
         if($header_stack_divi == true){
             echo '<div class="templaza-divi-logo-wrap">';
             ?>
        <div class="uk-container uk-flex uk-flex-between  uk-container-<?php echo esc_attr($header_stack_inner_width);?>">
        <?php
         }else{
             echo '<div class="uk-flex uk-width uk-flex-between templaza-divi-logo-wrap">';
         }
        ?>

        <?php if (!empty($header_mobile_menu)) { ?>
           <div class="uk-flex uk-flex-left uk-flex-middle uk-hidden@m">
              <div class="uk-hidden@m header-mobilemenu-trigger burger-menu-button" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
                 <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
              </div>
           </div>
           <?php
            }
            if (!empty($block_1_type)) {
               echo '<div class="uk-flex uk-width-auto uk-flex-center uk-flex-left@m tz-logo-block">';
            } else {
               echo '<div class="uk-flex uk-width-auto uk-flex-center tz-logo-block">';
            }
        Templates::load_my_layout('logo');
        echo '</div>';

        // header block starts
         if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
             echo '<div class="uk-flex uk-width-expand uk-flex-'.$block1_position.' uk-flex-middle uk-visible@m block-sidebar header-block-item">';
             dynamic_sidebar($block_1_sidebar);
             echo '</div>';
         }
        if ($block_1_type == 'custom') {
           echo '<div class="uk-flex uk-width-expand uk-flex-'.$block1_position.' uk-flex-middle uk-visible@m header-block-item">';
           echo wp_kses($block_1_custom,'post');
           echo '</div>';
        }
        // header block ends
        ?>
            <?php if ( (($header_stack_search || $header_stack_cart || $header_stack_account) && $icon_position == 'top') || $enable_offcanvas){ ?>
            <div class="uk-flex uk-flex-right uk-flex-middle">
                <?php
                if($icon_position == 'top'){
                    Templates::load_my_layout('inc.icon');
                }
                if ($enable_offcanvas) {
                    ?>
                    <div class="header-offcanvas-trigger header-icon burger-menu-button <?php echo esc_attr($offcanvas_togglevisibility);
                    ?>" data-offcanvas="#templaza-offcanvas" data-effect="<?php echo esc_attr($offcanvas_animation);
                    ?>" data-direction="<?php echo esc_attr($offcanvas_direction); ?>">
                        <button type="button" class="button">
                            <span class="box">
                               <span class="inner"></span>
                            </span>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php } ?>
        <?php
        if($header_stack_divi == true){
            echo '</div>';
        }
        echo '</div>';
        // header nav starts -->
        if($header_stack_divi == true){
            echo '<div class="templaza-divi-menu-wrap uk-visible@m ">';
        ?>
        <div class="uk-container uk-flex uk-flex-center  uk-container-<?php echo esc_attr($header_stack_inner_width);?>">
            <?php
        }else{
            echo '<div class="uk-flex uk-width uk-visible@m templaza-divi-menu-wrap">';
        }
        ?>
        <div class="uk-flex uk-flex-left uk-flex-1 uk-flex-middle "<?php echo wp_kses($data_attribs,'post');?>>
            <div class="<?php echo implode(' ', $navWrapperClass)?>">
                <?php
                // header nav starts
                Menu::get_nav_menu(array(
                    'theme_location'  => $header_menu,
                    'menu_class'      => implode(' ', $navClassLeft),
                    'container_class' => implode(' ', $navWrapperClass),
                    'menu_id'         => '',
                    'depth'           => $header_menu_level, // Level
                    'templaza_is_header'          => true,
                    'templaza_megamenu_html_data' => $menu_datas
                ));
                // header nav ends
                ?>
            </div>
        </div>
        <?php
        // header nav ends
        // header block starts
         if ($block_2_type == 'sidebar' && is_active_sidebar($block_2_sidebar)){
             echo '<div class="block-sidebar header-block-item uk-flex uk-flex-right uk-flex-middle">';
             dynamic_sidebar($block_2_sidebar);
             echo '</div>';
         }
        if ($block_2_type == 'custom') {
           echo '<div class="header-block-item  uk-flex uk-flex-right uk-flex-middle ">';
           echo wp_kses($block_2_custom,'post');
           echo '</div>';
        }
        if($icon_position == 'bottom'){
            echo '<div class="header-block-icon uk-flex uk-flex-right uk-flex-middle">';
            Templates::load_my_layout('inc.icon');
            echo '</div>';
        }
        ?>
            <?php
        if($header_stack_divi == true){
            echo '</div>';
        }
        echo '</div>';
        // header block ends
     }
     ?>
  </div>
</div>