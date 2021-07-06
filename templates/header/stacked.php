<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;

$options        = Functions::get_theme_options();

$mode           = isset($options['header-stacked-menu-mode'])?$options['header-stacked-menu-mode']:'center';
$block_1_type   = isset($options['header-block-1-type'])?$options['header-block-1-type']:'blank';
$block_1_custom = isset($options['header-block-1-custom'])?$options['header-block-1-custom']:'';
$block_2_type   = isset($options['header-block-2-type'])?$options['header-block-2-type']:'blank';
$block_2_custom = isset($options['header-block-2-custom'])?$options['header-block-2-custom']:'';

$enable_offcanvas           = isset($options['enable-offcanvas'])?filter_var($options['enable-offcanvas'], FILTER_VALIDATE_BOOLEAN):false;
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
$offcanvas_direction        = isset($options['offcanvas-direction'])?$options['offcanvas-direction']:'offcanvasDirLeft';
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'d-block';

$dropdown_arrow             = isset($options['dropdown-arrow'])?filter_var($options['dropdown-arrow'], FILTER_VALIDATE_BOOLEAN):true;
//$dropdown_animation_speed   = isset($options['dropdown-animation-speed'])?(bool) $options['dropdown-animation-speed']:300;
//$dropdown_animation_ease    = isset($options['dropdown-animation-ease'])?(bool) $options['dropdown-animation-ease']:'linear';
$dropdown_animation_type    = isset($options['dropdown-animation-type'])?(bool) $options['dropdown-animation-type']:'fade';
$dropdown_animation_effect  = isset($options['dropdown-animation-effect'])?$options['dropdown-animation-effect']:'fade-down';
$dropdown_animation_effect  = $dropdown_animation_type == 'none'?'':$dropdown_animation_effect;
//$dropdown_animation_speed_1 = isset($options['dropdown-animation-speed-1'])?$options['dropdown-animation-speed-1']:300;
//$dropdown_animation_speed_2 = isset($options['dropdown-animation-speed-2'])?$options['dropdown-animation-speed-2']:300;
$dropdown_trigger           = isset($options['dropdown-trigger'])?$options['dropdown-trigger']:'hover';

$navClass = ['nav', 'navbar-nav', 'templaza-nav', 'justify-content-center', 'd-flex', 'align-items-center'];
$navClassLeft = ['nav', 'navbar-nav', 'templaza-nav', 'justify-content-left', 'd-flex', 'align-items-left'];
$navClassDivided = ['nav', 'navbar-nav', 'templaza-nav'];
$navWrapperClass = ['templaza-nav-wraper', 'align-self-center', 'px-2', 'd-none', 'd-lg-block', 'w-100'];

$header_menu                = isset($options['header-menu'])?$options['header-menu']:'header';
$header_menu_level          = isset($options['header-menu-level'])?(int) $options['header-menu-level']:0;
$block_1_sidebar            = isset($options['header-block-1-sidebar'])?$options['header-block-1-sidebar']:'';
$block_2_sidebar            = isset($options['header-block-2-sidebar'])?$options['header-block-2-sidebar']:'';
$header_mobile_menu         = isset($options['header-mobile-menu'])?$options['header-mobile-menu']:'header';

$navClass[] = $dropdown_animation_effect;
//$dropdown_style = '.templaza-nav.'.$dropdown_animation_effect.' .sub-menu {
//    transition-duration: '.$dropdown_animation_speed_1.'ms, '.$dropdown_animation_speed_2.'ms;
//}';
//Templates::add_inline_style($dropdown_style);

// Get data attributes - them added from header shortcode
$data_attribs = $menu_datas = Functions::get_attributes('header');

$data_attribs    = join(' ', array_map(function($v, $k){
    return !empty($v)?$k . '="' . $v . '"':$k;
}, $data_attribs, array_keys($data_attribs)));
$data_attribs   = ' '.$data_attribs;
?>
<div class="d-flex">
  <div class="header-stacked-section d-flex justify-content-between flex-column w-100">
     <?php
     if ($mode == 'center') {
        echo '<div class="w-100 d-flex justify-content-center">';
        ?>
<!--        --><?php //if (!empty($header_mobile_menu)) { ?>
           <div class="d-flex d-lg-none justify-content-start">
              <div class="header-mobilemenu-trigger d-lg-none burger-menu-button align-self-center" data-offcanvas="#templaza-mobilemenu" data-effect="mobilemenu-slide">
                 <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
              </div>
           </div>
<!--        --><?php //} ?>
        <?php
        echo '<div class="d-flex w-100 justify-content-center">';
        Templates::load_my_layout('logo');
        echo '</div>';
        if ($enable_offcanvas) {
           ?>
           <div class="d-flex justify-content-end">
              <div class="header-offcanvas-trigger burger-menu-button align-self-center <?php echo $offcanvas_togglevisibility; ?>" data-offcanvas="#astroid-offcanvas" data-effect="<?php echo $offcanvas_animation; ?>" data-direction="<?php echo $offcanvas_direction; ?>">
                 <button type="button" class="button">
                    <span class="box">
                       <span class="inner"></span>
                    </span>
                 </button>
              </div>
           </div>
           <?php
        }
        echo '</div>';
        // header nav starts -->
        ?>
        <div class="w-100 d-none d-lg-flex justify-content-center pt-3"<?php echo $data_attribs;?>>
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
        </div>
        <?php
        // header nav ends
        // header block starts
         if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
             echo '<div class="w-100 header-block-item d-none d-lg-flex justify-content-center py-3">';
             echo '<ul id="sidebar">';
             dynamic_sidebar($block_1_sidebar);
             echo '</ul>';
             echo '</div>';
         }
        if ($block_1_type == 'custom') {
           echo '<div class="w-100 header-block-item d-none d-lg-flex justify-content-center py-3">';
           echo $block_1_custom;
           echo '</div>';
        }

        // header block ends
     }
     if ($mode == 'seperated') {
        // header block starts
         if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
             echo '<div class="w-100 header-block-item d-none d-lg-flex justify-content-center py-3">';
             echo '<ul id="sidebar">';
             dynamic_sidebar($block_1_sidebar);
             echo '</ul>';
             echo '</div>';
         }
        if ($block_1_type == 'custom') {
           echo '<div class="w-100 header-block-item d-none d-lg-flex justify-content-center py-3">';
           echo $block_1_custom;
           echo '</div>';
        }
        // header nav starts
        ?>
        <div class="header-stacked-inner w-100 d-flex justify-content-center"<?php echo $data_attribs;?>>
<!--           --><?php //if (!empty($header_mobile_menu)) { ?>
              <div class="d-flex d-lg-none justify-content-start">
                 <div class="header-mobilemenu-trigger d-lg-none burger-menu-button align-self-center" data-offcanvas="#astroid-mobilemenu" data-effect="mobilemenu-slide">
                    <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
                 </div>
              </div>
              <?php
//           }
           echo '<div class="d-flex w-100 justify-content-center">';
           echo '<div class="d-lg-none">';
           Templates::load_my_layout('logo');
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
              <div class="d-flex justify-content-end">
                 <div class="header-offcanvas-trigger burger-menu-button align-self-center <?php
                 echo $offcanvas_togglevisibility; ?>" data-offcanvas="#astroid-offcanvas" data-effect="<?php
                 echo $offcanvas_animation; ?>" data-direction="<?php echo $offcanvas_direction; ?>">
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
             echo '<div class="w-100 header-block-item d-none d-lg-flex justify-content-center py-3">';
             echo '<ul id="sidebar">';
             dynamic_sidebar($block_2_sidebar);
             echo '</ul>';
             echo '</div>';
         }
        if ($block_2_type == 'custom') {
           echo '<div class="w-100 header-block-item d-none d-lg-flex justify-content-center py-3">';
           echo $block_2_custom;
           echo '</div>';
        }
        // header block ends
     }
     if ($mode == 'divided') {
        echo '<div class="w-100 d-flex justify-content-center">';
        ?>
        <?php if (!empty($header_mobile_menu)) { ?>
           <div class="d-flex d-lg-none justify-content-start">
              <div class="header-mobilemenu-trigger d-lg-none burger-menu-button align-self-center" data-offcanvas="#astroid-mobilemenu" data-effect="mobilemenu-slide">
                 <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
              </div>
           </div>
           <?php
        }
        if (!empty($block_1_type)) {
           echo '<div class="d-flex w-100 justify-content-center justify-content-lg-start">';
        } else {
           echo '<div class="d-flex w-100 justify-content-center py-3">';
        }
        Templates::load_my_layout('logo');
        echo '</div>';

        // header block starts
         if ($block_1_type == 'sidebar' && is_active_sidebar($block_1_sidebar)){
             echo '<div class="d-none d-lg-flex w-100 header-block-item justify-content-end py-3 align-items-center">';
             echo '<ul id="sidebar">';
             dynamic_sidebar($block_1_sidebar);
             echo '</ul>';
             echo '</div>';
         }
        if ($block_1_type == 'custom') {
           echo '<div class="d-none d-lg-flex w-100 header-block-item justify-content-end py-3 align-items-center">';
           echo $block_1_custom;
           echo '</div>';
        }
        // header block ends

        if ($enable_offcanvas) {
           ?>
           <div class="d-flex justify-content-end">
              <div class="header-offcanvas-trigger burger-menu-button align-self-center <?php echo $offcanvas_togglevisibility;
              ?>" data-offcanvas="#astroid-offcanvas" data-effect="<?php echo $offcanvas_animation;
              ?>" data-direction="<?php echo $offcanvas_direction; ?>">
                 <button type="button" class="button">
                    <span class="box">
                       <span class="inner"></span>
                    </span>
                 </button>
              </div>
           </div>
           <?php
        }
        echo '</div>';
        // header nav starts -->
        echo '<div class="w-100 d-none d-lg-flex">';
        ?>
        <div class="d-flex justify-content-start pt-3 flex-grow-1"<?php echo $data_attribs;?>>
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
             echo '<div class="d-flex header-block-item justify-content-end py-3 align-items-center">';
             echo '<ul id="sidebar">';
             dynamic_sidebar($block_2_sidebar);
             echo '</ul>';
             echo '</div>';
         }
        if ($block_2_type == 'custom') {
           echo '<div class="d-flex header-block-item justify-content-end py-3 align-items-center">';
           echo $block_2_custom;
           echo '</div>';
        }
        echo '</div>';
        // header block ends
     }
     ?>
  </div>
</div>