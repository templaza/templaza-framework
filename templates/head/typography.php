<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Fonts;

$options        = Functions::get_theme_options();

//Font family
$ast_fontfamily = array();
// Body Font Styles
$body_font           = isset($options['typography-body-option'])?$options['typography-body-option']:array();
//$body_font = $template->params->get('body_typography_options', NULL);
//if ($body_font === NULL) {
//   $body_font = new \stdClass();
//}

//$in_head = true;
//if (isset($params) && !empty($params) && !$params['in_head']) {
//   $in_head = false;
//}

$typography = array('body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');

$styles = $menu_style = $submenu_style = $top_bar_style = $footer_style = ['desktop' => '', 'tablet' => '', 'mobile' => ''];

$libraryFonts = Fonts::get_uploaded_fonts();

// Body, H1 - H6 font styles.
foreach ($typography as $typo) {
   $typoType = isset($options['typography-'.$typo])?$options['typography-'.$typo]:'default';
   if (trim($typoType) == 'custom') {
      $typoOption = 'typography-'.$typo . '-option';
      $typoParams = isset($options[$typoOption])?$options[$typoOption]:array();
//      var_dump($typoParams);
       $font_family = $typoParams['font-family'];
      $styles['desktop'] .= $typo . ',.' . $typo . '{';

      $styles['tablet'] .= $typo . ',.' . $typo . '{';
      $styles['mobile'] .= $typo . ',.' . $typo . '{';

      if (!empty($font_family)) {
         if (isset($libraryFonts[$font_family])) {
            $styles['desktop'] .= 'font-family: ' . $libraryFonts[$font_family]['name'] . ',' . $typoParams['font-backup'] . ';';
            Fonts::load_library_font($libraryFonts[$font_family]);
         } else {
            $styles['desktop'] .= 'font-family: ' . $font_family . ',' . $typoParams['font-backup'] . ';';
            if (!Fonts::is_system_font($font_family)) {
//                $ast_fontfamily[]   = $font_family;
//                if($ast_fontfamily && isset() && !in_array($font_family, $ast_fontfamily[$font_family])) {
//                    $ast_fontfamily[$font_family][] = $font_family;

                if(!isset($ast_fontfamily[$font_family])) {
                    $ast_fontfamily[$font_family] = array();
                }
                if (isset($typoParams['font-weight']) && !empty($typoParams['font-weight'])
                    && !in_array($typoParams['font-weight'], $ast_fontfamily[$font_family])) {
                    $ast_fontfamily[$font_family][]   = $typoParams['font-weight'];
                }
            }
         }
      }

      if (isset($typoParams['font-size']) && !empty($typoParams['font-size'])) {
         if (is_array($typoParams['font-size'])) {
            // if responsive
            foreach ($typoParams['font-size'] as $device => $font_size) {
                if(!empty($font_size)) {
                    $styles[$device] .= 'font-size: ' . $font_size . ';';
                }
            }
         } else {
            // if old type value
            $styles['desktop'] .= 'font-size: ' . $typoParams['font-size'] . ';';
         }
      }

      if (isset($typoParams['color']) && !empty($typoParams['color'])) {
         $styles['desktop'] .= 'color: ' . $typoParams['color'] . ';';
      }

      if (isset($typoParams['letter-spacing']) && !empty($typoParams['letter-spacing'])) {
         if (is_array($typoParams['letter-spacing'])) {
            // if responsive
             foreach ($typoParams['letter-spacing'] as $device => $letter_spacing) {
                 if(!empty($letter_spacing)) {
                     $styles[$device] .= 'letter-spacing: ' . $letter_spacing . ';';
                 }
            }
         } else {
            // if old type value
             $styles['desktop'] .= 'letter-spacing: ' . $typoParams['letter-spacing'] . ';';
         }
      }

      if (isset($typoParams['font-weight']) && !empty($typoParams['font-weight'])) {
         $styles['desktop'] .= 'font-weight: ' . $typoParams['font-weight'] . ';';
      }

      if (isset($typoParams['line-height']) && !empty($typoParams['line-height'])) {
         if (is_array($typoParams['line-height'])) {
            // if responsive
             foreach ($typoParams['line-height'] as $device => $line_height) {
                 if(!empty($line_height)) {
                     $styles[$device] .= 'line-height: ' . $line_height . ';';
                 }
            }
         } else {
            // if old type value
             $styles['desktop'] .= 'line-height: ' . $typoParams['line-height'] .';';
         }
      }

      if (isset($typoParams['text-transform']) && !empty($typoParams['text-transform'])) {
         $styles['desktop'] .= 'text-transform: ' . $typoParams['text-transform'] . ';';
      }
      $styles['desktop'] .= '}';
      $styles['tablet'] .= '}';
      $styles['mobile'] .= '}';
   }
}

// Menu Font Styles
$menuType = isset($options['typography-menu'])?$options['typography-menu']:'';

if (trim($menuType) == 'custom') {
   $menu_font           = isset($options['typography-menu-option'])?$options['typography-menu-option']:array();
   $menu_font_family    = $typoParams['font-family'];
   $menu_style = ['desktop' => '.templaza-nav>li>a,.templaza-sidebar-menu>li>a {', 'tablet' => '.templaza-nav>li>a,.templaza-sidebar-menu>li>a {', 'mobile' => '.templaza-nav>li>a,.templaza-sidebar-menu>li>a {'];

   if (isset($menu_font_family) && !empty($menu_font_family)) {

      if (isset($libraryFonts[$menu_font_family])) {
         $menu_style['desktop'] .= 'font-family: ' . $libraryFonts[$menu_font_family]['name'] . ';';
         Fonts::load_library_font($libraryFonts[$menu_font_family]);
      } else {
         $menu_style['desktop'] .= 'font-family: ' . $menu_font_family . ';';
         if (!Fonts::is_system_font($menu_font_family)) {
//            $ast_fontfamily[]   = $menu_font_family;
             if(!isset($ast_fontfamily[$menu_font_family])) {
                 $ast_fontfamily[$menu_font_family] = array();
             }
             if (isset($menu_font['font-weight']) && !empty($menu_font['font-weight'])
                 && !in_array($menu_font['font-weight'], $ast_fontfamily[$menu_font_family])) {
                 $ast_fontfamily[$menu_font_family][]   = $menu_font['font-weight'];
             }
         }
      }
   }

   if (isset($menu_font['font-size']) && !empty($menu_font['font-size'])) {
      if (is_array($menu_font['font-size'])) {
         // if responsive
          foreach ($menu_font['font-size'] as $device => $font_size) {
              if(!empty($font_size)) {
                  $menu_style[$device] .= 'font-size: ' . $font_size . ';';
              }
         }
      } else {
         // if old type value
          $menu_style['desktop'] .= 'font-size: ' . $menu_font['font-size'] . ';';
      }
   }

   if (isset($menu_font['color']) && !empty($menu_font['color'])) {
      $menu_style['desktop'] .= 'color: ' . $menu_font['color']. ';';
   }

   if (isset($menu_font['letter-spacing']) && !empty($menu_font['letter-spacing'])) {
      if (is_array($menu_font['letter-spacing'])) {
         // if responsive
          foreach ($menu_font['letter-spacing'] as $device => $letter_spacing) {
              if(!empty($letter_spacing)) {
                  $menu_style[$device] .= 'letter-spacing: ' . $letter_spacing . ';';
              }
         }
      } else {
         // if old type value
          $menu_style['desktop'] .= 'letter-spacing: ' . $menu_font['letter-spacing'] . ';';
      }
   }

   if (isset($menu_font['font-weight']) && !empty($menu_font['font-weight'])) {
      $menu_style['desktop'] .= 'font-weight: ' . $menu_font['font-weight'] . ';';
   }

   if (isset($menu_font['line-height']) && !empty($menu_font['line-height'])) {
      if (is_array($menu_font['line-height'])) {
         // if responsive
          foreach ($menu_font['line-height'] as $device => $line_height) {
              if(!empty($line_height)) {
                  $menu_style[$device] .= 'line-height: ' . $line_height . ';';
              }
         }
      } else {
         // if old type value
          $menu_style['desktop'] .= 'line-height: ' . $menu_font['line-height'] . ';';
      }
   }

   if (isset($menu_font['text-transform']) && !empty($menu_font['text-transform'])) {
      $menu_style['desktop'] .= 'text-transform: ' . $menu_font['text-transform'] . ';';
   }
   $menu_style['desktop'] .= '}';
   $menu_style['mobile'] .= '}';
   $menu_style['tablet'] .= '}';

   if (isset($menu_font['line-height']) && !empty($menu_font['line-height'])) {
      if (is_array($menu_font['line-height'])) {
         // if responsive
          foreach ($menu_font['line-height'] as $device => $line_height) {
              if(!empty($line_height)) {
                  $menu_style[$device] .= '.templaza-sidebar-menu li > .nav-item-caret{line-height: ' . $line_height . ' !important;}';
              }
         }
      } else {
         // if old type value
         $menu_style['desktop'] .= '.templaza-sidebar-menu li > .nav-item-caret{line-height: ' . $menu_font['line-height'] . ' !important;}';
      }
   }
}

// SubMenu Font Styles
$submenuType = isset($options['typography-submenu'])?$options['typography-submenu']:'';
if (trim($submenuType) == 'custom') {
   $submenu_font = isset($options['typography-submenu-option'])?$options['typography-submenu-option']:array();
   $submenu_font_family = count($options) && isset($options['font-family'])?$options['font-family']:'';
   $submenu_style = '.templaza-nav .sub-menu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {';

   $tablet_submenu_style = '.templaza-nav .sub-menu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {';

   $mobile_submenu_style = '.templaza-nav .sub-menu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {';

   $submenu_style = ['desktop' => '.sub-menu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {', 'tablet' => '.sub-menu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {', 'mobile' => '.nav-submenu-container .nav-submenu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {'];

   if (isset($submenu_font_family) && !empty($submenu_font_family)) {
      if (isset($libraryFonts[$submenu_font_family])) {
         $submenu_style['desktop'] .= 'font-family: ' . $libraryFonts[$submenu_font_family]['name'] . ',' . $submenu_font['font-backup'] . ';';
         Fonts::load_library_font($submenu_font_family);
      } else {
         $submenu_style['desktop'] .= 'font-family: ' . $submenu_font_family . ', ' . $submenu_font['font-backup']  . ';';
         if (!Fonts::is_system_font($submenu_font_family)) {
//             $ast_fontfamily[]  = $submenu_font_family;

             if(!isset($ast_fontfamily[$submenu_font_family])) {
                 $ast_fontfamily[$submenu_font_family] = array();
             }
             if (isset($submenu_font['font-weight']) && !empty($submenu_font['font-weight'])
                 && !in_array($submenu_font['font-weight'], $ast_fontfamily[$submenu_font_family])) {
                 $ast_fontfamily[$submenu_font_family][]   = $submenu_font['font-weight'];
             }
         }
      }
   }

   if (isset($submenu_font['font-size']) && !empty($submenu_font['font-size'])) {
      if (is_array($submenu_font['font-size'])) {
         // if responsive
          foreach ($submenu_font['font-size'] as $device => $font_size) {
            $submenu_style[$device] .= 'font-size: ' . $font_size. ';';
         }
      } else {
         // if old type value
         $submenu_style['desktop'] .= 'font-size: ' . $submenu_font['font-size'] . ';';
      }
   }

   if (isset($submenu_font['color']) && !empty($submenu_font['color'])) {
      $submenu_style['desktop'] .= 'color: ' . $submenu_font['color'] . ';';
   }

   if (isset($submenu_font['letter-spacing']) && !empty($submenu_font['letter-spacing'])) {
      if (is_array($submenu_font['letter-spacing'])) {
         // if responsive
          foreach ($submenu_font['letter-spacing'] as $device => $letter_spacing) {
              if(!empty($letter_spacing)) {
                  $submenu_style[$device] .= 'letter-spacing: ' . $letter_spacing . ';';
              }
         }
      } else {
         // if old type value
         $submenu_style['desktop'] .= 'letter-spacing: ' . $submenu_font['letter-spacing'] . ';';
      }
   }

   if (isset($submenu_font['font-weight']) && !empty($submenu_font['font-weight'])) {
      $submenu_style['desktop'] .= 'font-weight: ' . $submenu_font['font-weight'] . ';';
   }

   if (isset($submenu_font['line-height']) && !empty($submenu_font['line-height'])) {
      if (is_array($submenu_font['line-height'])) {
         // if responsive
          foreach ($submenu_font['line-height'] as $device => $line_height) {
              if(!empty($line_height)) {
                  $submenu_style[$device] .= 'line-height: ' . $line_height . ';';
              }
         }
      } else {
         // if old type value
         $submenu_style['desktop'] .= 'line-height: ' . $submenu_font['line-height'] . ';';
      }
   }

   if (isset($submenu_font['text-transform']) && !empty($submenu_font['text-transform'])) {
      $submenu_style['desktop'] .= 'text-transform: ' . $submenu_font['text-transform'] . ';';
   }
   $submenu_style['desktop'] .= '}';
   $submenu_style['tablet'] .= '}';
   $submenu_style['mobile'] .= '}';
}

// Top Bar Font Styles
$topbarType = isset($options['typography-top-bar'])?$options['typography-top-bar']:'';
if (trim($topbarType) == 'custom') {
    $top_bar_font = isset($options['typography-top-bar-option'])?$options['typography-top-bar-option']:array();
	$top_bar_font_family = count($top_bar_font) && isset($top_bar_font['font-family'])?$top_bar_font['font-family']:'';
	$top_bar_style = '.templaza-topsidebar-section {';

	$top_bar_style = ['desktop' => '.top-bar {', 'tablet' => '.top-bar {', 'mobile' => '.top-bar {'];

	if (isset($top_bar_font_family) && !empty($top_bar_font_family)) {
		if (isset($libraryFonts[$top_bar_font_family])) {
			$top_bar_style['desktop'] .= 'font-family: ' . $libraryFonts[$top_bar_font_family]['name'] . ',' . $top_bar_font['font-backup'] . ';';
			Fonts::load_library_font($top_bar_font_family);
		} else {
            $top_bar_style['desktop'] .= 'font-family: ' . $top_bar_font_family . ',' . $top_bar_font['font-backup'] . ';';
			if (!Fonts::is_system_font($top_bar_font_family)) {
//                $ast_fontfamily[]   = $top_bar_font_family;
                if(!isset($ast_fontfamily[$top_bar_font_family])) {
                    $ast_fontfamily[$top_bar_font_family] = array();
                }
                if (isset($top_bar_font['font-weight']) && !empty($top_bar_font['font-weight'])
                    && !in_array($top_bar_font['font-weight'], $ast_fontfamily[$top_bar_font_family])) {
                    $ast_fontfamily[$top_bar_font_family][]   = $top_bar_font['font-weight'];
                }
			}
		}
	}

	if (isset($top_bar_font['line-height']) && !empty($top_bar_font['line-height'])) {
		if (is_array($top_bar_font['line-height'])) {
			// if responsive
            foreach ($top_bar_font['line-height'] as $device => $line_height) {
                if(!empty($line_height)) {
                    $top_bar_style[$device] .= 'font-size: ' . $line_height . ';';
                }
			}
		} else {
			// if old type value
            $top_bar_style['desktop'] .= 'font-size: ' . $top_bar_font['font-size'] .  ';';
		}
	}

	if (isset($top_bar_font['color']) && !empty($top_bar_font['color'])) {
		$top_bar_style['desktop'] .= 'color: ' . $top_bar_font['color'] . ';';
	}

	if (isset($top_bar_font['letter-spacing']) && !empty($top_bar_font['letter-spacing'])) {
		if (is_array($top_bar_font['letter-spacing'])) {
			// if responsive
            foreach ($top_bar_font['letter-spacing'] as $device => $letter_spacing) {
                if(!empty($letter_spacing)) {
                    $top_bar_style[$device] .= 'letter-spacing: ' . $letter_spacing . ';';
                }
			}
		} else {
			// if old type value
            $top_bar_style['desktop'] .= 'letter-spacing: ' . $top_bar_font['letter-spacing'] .';';
		}
	}

	if (isset($top_bar_font['font-weight']) && !empty($top_bar_font['font-weight'])) {
		$top_bar_style['desktop'] .= 'font-weight: ' . $top_bar_font['font-weight'] . ';';
	}

	if (isset($top_bar_font['line-height']) && !empty($top_bar_font['line-height'])) {
		if (is_array($top_bar_font['line-height'])) {
			// if responsive
            foreach ($top_bar_font['line-height'] as $device => $line_height) {
                if(!empty($line_height)) {
                    $top_bar_style[$device] .= 'line-height: ' . $line_height . ';';
                }
			}
		} else {
			// if old type value
			$top_bar_style['desktop'] .= 'line-height: ' . $top_bar_font['line-height'] .  ';';
		}
	}

	if (isset($top_bar_font['text-transform']) && !empty($top_bar_font['text-transform'])) {
		$top_bar_style['desktop'] .= 'text-transform: ' . $top_bar_font['text-transform'] . ';';
	}
	$top_bar_style['desktop'] .= '}';
	$top_bar_style['tablet'] .= '}';
	$top_bar_style['mobile'] .= '}';
}

// Footer Font Styles
$footerType = isset($options['typography-footer'])?$options['typography-footer']:'';
if (trim($footerType) == 'custom') {
	$footer_font = isset($options['typography-footer-option'])?$options['typography-footer-option']:array();
    $footer_font_family = count($footer_font) && isset($footer_font['font-family'])?$footer_font['font-family']:'';
	$footer_style = '#templaza-footer {';

	$footer_style = ['desktop' => '#templaza-footer {', 'tablet' => '#astroid-footer {', 'mobile' => '#templaza-footer {'];

	if (isset($footer_font_family) && !empty($footer_font_family)) {
		if (isset($libraryFonts[$footer_font_family])) {
			$footer_style['desktop'] .= 'font-family: ' . $libraryFonts[$footer_font_family]['name'] . ',' . $footer_font['font-backup'] . ';';
			Fonts::load_library_font($footer_font_family);
		} else {
			$footer_style['desktop'] .= 'font-family: ' . $footer_font_family . ', ' . $footer_font['font-backup'] . ';';
			if(Fonts::is_system_font($footer_font_family)){
//			    $ast_fontfamily[]   = $footer_font_family;
                if(!isset($ast_fontfamily[$footer_font_family])) {
                    $ast_fontfamily[$footer_font_family] = array();
                }
                if (isset($footer_font['font-weight']) && !empty($footer_font['font-weight'])
                    && !in_array($footer_font['font-weight'], $ast_fontfamily[$footer_font_family])) {
                    $ast_fontfamily[$footer_font_family][]   = $footer_font['font-weight'];
                }
            }
		}
	}

	if (isset($footer_font['font-size']) && !empty($footer_font['font-size'])) {
		if (is_array($footer_font['font-size'])) {
			// if responsive
            foreach ($footer_font['font-size'] as $device => $font_size) {
                if(!empty($font_size)) {
                    $footer_style[$device] .= 'font-size: ' . $font_size . ';';
                }
			}
		} else {
			// if old type value
            $footer_style['desktop'] .= 'font-size: ' . $footer_font['font_size'] . ';';
		}
	}

	if (isset($footer_font['color']) && !empty($footer_font['color'])) {
		$footer_style['desktop'] .= 'color: ' . $footer_font['color'] . ';';
	}

	if (isset($footer_font['letter-spacing']) && !empty($footer_font['letter-spacing'])) {
		if (is_array($footer_font['letter-spacing'])) {
			// if responsive
            foreach ($footer_font['letter-spacing'] as $device => $letter_spacing) {
                if(!empty($letter_spacing)) {
                    $footer_style[$device] .= 'letter-spacing: ' . $letter_spacing . ';';
                }
			}
		} else {
			// if old type value
            $footer_style['desktop'] .= 'letter-spacing: ' . $footer_font['letter-spacing'] . ';';
		}
	}

	if (isset($footer_font['font-weight']) && !empty($footer_font['font-weight'])) {
		$footer_style['desktop'] .= 'font-weight: ' . $footer_font['font-weight'] . ';';
	}

	if (isset($footer_font['line-height']) && !empty($footer_font['line-height'])) {
		if (is_array($footer_font['line-height'])) {
			// if responsive
            foreach ($footer_font['line-height'] as $device => $line_height) {
                if(!empty($line_height)) {
                    $footer_style[$device] .= 'line-height: ' . $line_height . ';';
                }
			}
		} else {
			// if old type value
            $footer_style['desktop'] .= 'line-height: ' . $footer_font['line-height'] . ';';
		}
	}

	if (isset($footer_font['text-transform']) && !empty($footer_font['text-transform'])) {
		$footer_style['desktop'] .= 'text-transform: ' . $footer_font['text-transform'] . ';';
	}
	$footer_style['desktop'] .= '}';
	$footer_style['tablet'] .= '}';
	$footer_style['mobile'] .= '}';
}

// styles for tablet
$tabletCSS = '';
if (!empty($styles['tablet'])) {
	$tabletCSS .= $styles['tablet'];
}
if (!empty($menu_style['tablet'])) {
	$tabletCSS .= $menu_style['tablet'];
}
if (isset($submenu_style['tablet'])) {
	$tabletCSS .= $submenu_style['tablet'];
}
if (isset($top_bar_style['tablet'])) {
	$tabletCSS .= $top_bar_style['tablet'];
}
if (isset($footer_style['tablet'])) {
	$tabletCSS .= $footer_style['tablet'];
}

// styles for mobile
$mobileCSS = '';
if (!empty($styles['mobile'])) {
	$mobileCSS .= $styles['mobile'];
}
if (!empty($menu_style['mobile'])) {
	$mobileCSS .= $menu_style['mobile'];
}
if (isset($submenu_style['mobile'])) {
	$mobileCSS .= $submenu_style['mobile'];
}
if (isset($top_bar_style['mobile'])) {
	$mobileCSS .= $top_bar_style['mobile'];
}
if (isset($footer_style['mobile'])) {
	$mobileCSS .= $footer_style['mobile'];
}

// Let's add combined style sheet here
foreach($ast_fontfamily as $key => &$value){
    if(is_array($value)){
        $value    = str_replace(" ", "+", $key).':'.implode(",", $value);
    }
}

//$ast_fontfamily_list = implode("|", str_replace(" ", "+", array_unique($ast_fontfamily)));
$ast_fontfamily_list = implode("|", $ast_fontfamily);
//var_dump($ast_fontfamily_list);
//if ($in_head) {
   if (!empty($ast_fontfamily_list)) {
       wp_enqueue_style('templaza-google-font', 'https://fonts.googleapis.com/css?family=' . $ast_fontfamily_list);
   }

   Templates::add_inline_style($styles['desktop']);
   Templates::add_inline_style($menu_style['desktop']);
   Templates::add_inline_style($submenu_style['desktop']);
   Templates::add_inline_style($footer_style['desktop']);
   Templates::add_inline_style($top_bar_style['desktop']);
   Templates::add_inline_style($tabletCSS, 'tablet');
   Templates::add_inline_style($tabletCSS, 'mobile');
//} else {
//   if (!empty($ast_fontfamily_list)) {
//      echo '<link href="' . 'https://fonts.googleapis.com/css?family=' . $ast_fontfamily_list . '" rel="stylesheet" type="text/css" />';
//   }
//   echo "<style>";
//   echo $styles['desktop'];
//   echo $menu_style['desktop'];
//   echo $submenu_style['desktop'];
//   echo $top_bar_style['desktop'];
//   echo $footer_style['desktop'];
//   echo $tabletCSS;
//   echo $mobileCSS;
//   echo "</style>";
//}
