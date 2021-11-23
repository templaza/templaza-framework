<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Menu;

$options                    = Functions::get_theme_options();

$header                     = isset($options['enable-header'])?filter_var($options['enable-header'], FILTER_VALIDATE_BOOLEAN):true;
$enable_offcanvas           = isset($options['enable-offcanvas'])?filter_var($options['enable-offcanvas'], FILTER_VALIDATE_BOOLEAN):false;
$offcanvas_sidebar          = isset($options['offcanvas-sidebar'])?$options['offcanvas-sidebar']:'';
$offcanvas_menu_location    = isset($options['offcanvas-menu-location'])?$options['offcanvas-menu-location']:'header';
$offcanvas_menu_level       = isset($options['offcanvas-menu-level'])?(int) $options['offcanvas-menu-level']:0;
$offcanvas_animation        = isset($options['offcanvas-animation'])?$options['offcanvas-animation']:'st-effect-1';
//$offcanvas_direction        = isset($options['offcanvas-direction'])?(bool) $options['offcanvas-direction']:true;
$panelwidth                 = isset($options['offcanvas-panelwidth']) &&
                                !empty($options['offcanvas-panelwidth'])?$options['offcanvas-panelwidth']:'320px';
$offcanvas_togglevisibility = isset($options['offcanvas-togglevisibility'])?$options['offcanvas-togglevisibility']:'uk-display-block';

$navClass                   = ['nav menu list-inline uk-display-block'];

if (!$header || !$enable_offcanvas) {
	return;
}
?>
    <div class="templaza-offcanvas uk-hidden d-init" id="templaza-offcanvas">
        <div class="burger-menu-button active">
            <button type="button" class="button close-offcanvas offcanvas-close-btn">
         <span class="box">
            <span class="inner"></span>
         </span>
            </button>
        </div>
        <div class="templaza-offcanvas-inner">
			<?php
            if ($offcanvas_sidebar && is_active_sidebar($offcanvas_sidebar)){
                echo '<div id="templaza-offcanvas-sidebar" class="templaza-sidebar">';
                    echo '<aside id="widget-area-'.uniqid().'" class="widget-area">';
                        dynamic_sidebar($offcanvas_sidebar);
                    echo '</aside>';
                echo '</div>';
            }
             ?>
        </div>
    </div>

<?php
$style = '.templaza-offcanvas {width: ' . $panelwidth . ';} .templaza-offcanvas .dropdown-menus {width: ' . $panelwidth . ' !important;}';

// Effects Styles
switch ($offcanvas_animation) {
	case 'st-effect-1':
		$style .= '.st-effect-1.templaza-offcanvas{visibility:visible;-webkit-transform:translate3d(-100%, 0, 0);transform:translate3d(-100%, 0, 0);}.st-effect-1.templaza-offcanvas-open .st-effect-1.templaza-offcanvas{ visibility:visible;-webkit-transform:translate3d(0, 0, 0);transform:translate3d(0, 0, 0);}.st-effect-1.templaza-offcanvas::after{display:none;}.offcanvasDirRight .st-effect-1.templaza-offcanvas{visibility:visible;-webkit-transform:translate3d(100%, 0, 0);transform:translate3d(100%, 0, 0);}';
		break;
	case 'st-effect-2':
		$style .= '.st-effect-2.templaza-offcanvas-open .templaza-content{-webkit-transform:translate3d(' . $panelwidth . ', 0, 0);transform:translate3d(' . $panelwidth . ', 0, 0);}.st-effect-2.templaza-offcanvas-open .st-effect-2.templaza-offcanvas{-webkit-transform:translate3d(0%, 0, 0);transform:translate3d(0%, 0, 0);}.templaza-offcanvas-opened .templaza-wrapper{background:rgb(173, 181, 189);}.st-effect-2.templaza-offcanvas{z-index:0 !important;}.st-effect-2.templaza-offcanvas-open .st-effect-2.templaza-offcanvas{visibility: visible; -webkit-transition:-webkit-transform 0.5s;transition:transform 0.5s;}.st-effect-2.templaza-offcanvas::after{display:none;}.offcanvasDirRight .st-effect-2.templaza-offcanvas-open .templaza-content{-webkit-transform:translate3d(-' . $panelwidth . ', 0, 0);transform:translate3d(-' . $panelwidth . ', 0, 0);}';
		break;
	case 'st-effect-3':
		$style .= '.st-effect-3.templaza-offcanvas-open .templaza-content{-webkit-transform:translate3d(' . $panelwidth . ', 0, 0);transform:translate3d(' . $panelwidth . ', 0, 0);}.st-effect-3.templaza-offcanvas-open .st-effect-3.templaza-offcanvas{-webkit-transform:translate3d(0%, 0, 0);transform:translate3d(0%, 0, 0);}.st-effect-3.templaza-offcanvas{-webkit-transform:translate3d(-100%, 0, 0);transform:translate3d(-100%, 0, 0);}.st-effect-3.templaza-offcanvas-open .st-effect-3.templaza-offcanvas{visibility:visible;-webkit-transition:-webkit-transform 0.5s;transition:transform 0.5s;}.st-effect-3.templaza-offcanvas::after{display: none;}.offcanvasDirRight .st-effect-3.templaza-offcanvas-open .templaza-content {-webkit-transform: translate3d(-' . $panelwidth . ', 0, 0);transform: translate3d(-' . $panelwidth . ', 0, 0);}.offcanvasDirRight .st-effect-3.templaza-offcanvas {-webkit-transform: translate3d(100%, 0, 0);transform: translate3d(100%, 0, 0);}';
		break;
	case 'st-effect-9':
		$style .= '.st-effect-9.templaza-container{-webkit-perspective:1500px;perspective:1500px;}.st-effect-9 .templaza-content{-webkit-transform-style:preserve-3d;transform-style:preserve-3d;}.st-effect-9.templaza-offcanvas-open .templaza-content{-webkit-transform:translate3d(0, 0, -' . $panelwidth . ');transform:translate3d(0, 0, -' . $panelwidth . ');}.st-effect-9.templaza-offcanvas{opacity:1;-webkit-transform:translate3d(-100%, 0, 0);transform:translate3d(-100%, 0, 0);}.st-effect-9.templaza-offcanvas-open .st-effect-9.templaza-offcanvas{visibility:visible;-webkit-transition:-webkit-transform 0.5s;transition:transform 0.5s;-webkit-transform:translate3d(0, 0, 0);transform:translate3d(0, 0, 0);}.st-effect-9.templaza-offcanvas::after{display:none;}';
		break;
}

Templates::add_inline_style($style);
?>